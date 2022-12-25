<?php

declare(strict_types=1);

namespace App\Api\Cli;

use App\Application\GithubRepositoryRegistry;
use App\Application\Job\GithubDataCollector;
use App\Application\Metrics\Collector;
use App\Application\Metrics\GithubCollectors;
use Psr\Log\LoggerInterface;
use Spiral\Console\Command;
use Spiral\Queue\Options;
use Spiral\Queue\QueueInterface;

final class CollectMetrics extends Command
{
    protected const SIGNATURE = <<<CMD
        collect:start
        {--i|interval=60 : Interval in seconds}
    CMD;

    protected const DESCRIPTION = 'Collect github metrics';

    public function __invoke(
        LoggerInterface $logger,
        GithubRepositoryRegistry $registry,
        Collector $metrics,
        QueueInterface $queue,
    ): int {
        $interval = $this->getInterval();

        while (true) {
            $metrics->declare(new GithubCollectors());

            foreach ($registry->getRepositories() as $repository) {
                $logger->debug('Collecting metrics', ['repository' => $repository]);

                $queue->push(
                    GithubDataCollector::class,
                    ['repository' => $repository],
                    (new Options())->withHeader('attempts', '3')
                );
            }

            \sleep($interval);
        }

        return self::SUCCESS;
    }

    /**
     * @return positive-int
     */
    public function getInterval(): int
    {
        return \max(
            (int)$this->option('interval'),
            10
        );
    }
}
