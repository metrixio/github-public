<?php

declare(strict_types=1);

namespace App\Application\Metrics;

use Spiral\RoadRunner\Metrics\Collector;

final class GithubCollectors implements CollectorsInterface
{
    public const SUBSCRIBERS = 'github_subscribers';
    public const WATCHERS = 'github_watchers';
    public const STARS = 'github_stars';
    public const FORKS = 'github_forks';
    public const CLONES_COUNT = 'github_clones_count';
    public const CLONES_UNIQUES = 'github_clones_uniques';
    public const OPEN_ISSUES = 'github_open_issues';

    public function getIterator(): \Traversable
    {
        yield self::SUBSCRIBERS => Collector::gauge()
            ->withHelp('Github subscribers statistics.')
            ->withLabels('repo');

        yield self::WATCHERS => Collector::gauge()
            ->withHelp('Github watchers statistics.')
            ->withLabels('repo');

        yield self::STARS => Collector::gauge()
            ->withHelp('Github stars statistics.')
            ->withLabels('repo');

        yield self::FORKS => Collector::gauge()
            ->withHelp('Github forks statistics.')
            ->withLabels('repo');

        yield self::CLONES_COUNT => Collector::gauge()
            ->withHelp('Github clones statistics.')
            ->withLabels('repo');

        yield self::CLONES_UNIQUES => Collector::gauge()
            ->withHelp('Github unique clones statistics.')
            ->withLabels('repo');

        yield self::OPEN_ISSUES => Collector::gauge()
            ->withHelp('Github open issues statistics.')
            ->withLabels('repo');
    }
}
