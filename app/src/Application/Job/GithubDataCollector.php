<?php

declare(strict_types=1);

namespace App\Application\Job;

use App\Application\Metrics\GithubMetrics;
use App\Infrastructure\Github\ClientInterface;
use Psr\Log\LoggerInterface;
use Spiral\Exceptions\ExceptionReporterInterface;
use Spiral\Queue\Exception\RetryException;
use Spiral\Queue\JobHandler;
use Spiral\Queue\Options;

final class GithubDataCollector extends JobHandler
{
    /**
     * @throws RetryException
     */
    public function invoke(
        GithubMetrics $metrics,
        LoggerInterface $logger,
        ClientInterface $client,
        ExceptionReporterInterface $reporter,
        array $payload,
        array $headers = []
    ): void {
        $name = $payload['repository'];

        $attempts = (int)($headers['attempts'] ?? 0);
        if ($attempts === 0) {
            $logger->warning('Attempt to fetch package [%s] statistics failed', $name);
            return;
        }

        try {
            $repository = $client->getRepository($name);

            $metrics->setSubscribers((float)$repository->subscribersCount, $name);
            $metrics->setWatchers((float)$repository->watchersCount, $name);
            $metrics->setStars((float)$repository->stargazersCount, $name);
            $metrics->setForks((float)$repository->forksCount, $name);
            $metrics->setOpenIssues((float)$repository->openIssuesCount, $name);
        } catch (\Throwable $e) {
            $reporter->report($e);

            throw new RetryException(
                reason: $e->getMessage(),
                options: (new Options())->withDelay(5)->withHeader('attempts', (string)($attempts - 1))
            );
        }
    }
}
