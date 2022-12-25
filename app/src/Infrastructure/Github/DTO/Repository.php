<?php

declare(strict_types=1);

namespace App\Infrastructure\Github\DTO;

final class Repository
{
    public function __construct(
        public readonly string $name,
        public readonly int $stargazersCount,
        public readonly int $watchersCount,
        public readonly int $forksCount,
        public readonly int $openIssuesCount,
        public readonly int $subscribersCount,
    ) {
    }
}
