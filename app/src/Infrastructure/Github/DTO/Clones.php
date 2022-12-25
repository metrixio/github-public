<?php

declare(strict_types=1);

namespace App\Infrastructure\Github\DTO;

final class Clones
{
    public function __construct(
        public readonly int $count,
        public readonly int $uniques,
    ) {
    }
}
