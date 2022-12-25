<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\MetricsInterface;

final class GithubMetrics
{
    public function __construct(
        private readonly MetricsInterface $metrics
    ) {
    }

    public function setSubscribers(float $count, string $repository): void
    {
        $this->metrics->set(
            GithubCollectors::SUBSCRIBERS,
            $count,
            [$repository]
        );
    }

    public function setWatchers(float $count, string $repository): void
    {
        $this->metrics->set(
            GithubCollectors::WATCHERS,
            $count,
            [$repository]
        );
    }

    public function setStars(float $count, string $repository): void
    {
        $this->metrics->set(
            GithubCollectors::STARS,
            $count,
            [$repository]
        );
    }

    public function setForks(float $count, string $repository): void
    {
        $this->metrics->set(
            GithubCollectors::FORKS,
            $count,
            [$repository]
        );
    }

    public function setOpenIssues(float $count, string $repository): void
    {
        $this->metrics->set(
            GithubCollectors::OPEN_ISSUES,
            $count,
            [$repository]
        );
    }
}
