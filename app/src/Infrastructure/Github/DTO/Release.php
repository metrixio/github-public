<?php

declare(strict_types=1);

namespace App\Infrastructure\Github\DTO;

final class Release
{
    public function __construct(
        public readonly string $tag,
        public readonly string $asset,
        public readonly int $downloads
    ){
    }
}
