<?php

declare(strict_types=1);

namespace App\Infrastructure\Github;

use Spiral\Core\InjectableConfig;

final class GithubConfig extends InjectableConfig
{
    public const CONFIG = 'github';

    public function __construct(
        protected array $config = [
            'repositories' => [],
        ]
    ) {
    }

    public function getRepositories(): array
    {
        return $this->config['repositories'] ?? [];
    }
}


