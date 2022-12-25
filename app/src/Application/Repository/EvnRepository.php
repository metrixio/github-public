<?php

declare(strict_types=1);

namespace App\Application\Repository;

use Spiral\Boot\EnvironmentInterface;

final class EvnRepository implements GithubRepositoryInterface
{
    public function __construct(
        private readonly EnvironmentInterface $env
    ) {
    }

    public function all(): array
    {
        $data = $this->env->get('GITHUB_REPOSITORIES');

        if ($data === null) {
            return [];
        }

        return \array_filter(\explode(',', (string) $data));
    }
}
