<?php

declare(strict_types=1);

namespace App\Infrastructure\Github\DTO;

use Traversable;

final class Referrers implements \IteratorAggregate
{
    public function __construct(
        private readonly array $referrers
    ) {
    }

    /**
     * @return Traversable<Referrer>
     */
    public function getIterator(): Traversable
    {
        foreach ($this->referrers as $referrer) {
            yield new Referrer(
                $referrer['referrer'],
                $referrer['count'],
                $referrer['uniques']
            );
        }
    }
}
