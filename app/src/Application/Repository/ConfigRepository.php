<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Infrastructure\Github\GithubConfig;

final class ConfigRepository implements GithubRepositoryInterface
{
    public function __construct(
        private readonly GithubConfig $config,
    ) {
    }

    public function all(): array
    {
        return $this->config->getRepositories();
    }
}
