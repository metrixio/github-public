<?php

declare(strict_types=1);

namespace App\Application\Repository;

interface GithubRepositoryInterface
{
    public function all(): array;
}
