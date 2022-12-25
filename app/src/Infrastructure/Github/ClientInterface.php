<?php

declare(strict_types=1);

namespace App\Infrastructure\Github;

use App\Infrastructure\Github\DTO\Clones;
use App\Infrastructure\Github\DTO\Referrers;
use App\Infrastructure\Github\DTO\Releases;
use App\Infrastructure\Github\DTO\Repository;

interface ClientInterface
{
    public function getRepository(string $name): Repository;
    public function getPopularReferrers(string $name): Referrers;
    public function getClones(string $name): Clones;
    public function getReleases(string $name): Releases;
}
