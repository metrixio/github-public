<?php

declare(strict_types=1);

namespace App\Infrastructure\Github\DTO;

use Traversable;

final class Releases implements \IteratorAggregate
{
    public function __construct(
        private readonly array $releases
    ) {
    }


    /**
     * @return Traversable<Release>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->releases as $release) {
            foreach ($release['assets'] as $asset) {
                yield new Release(
                    $release['tag_name'],
                    $asset['name'],
                    $asset['download_count']
                );
            }
        }
    }
}
