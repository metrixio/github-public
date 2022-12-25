<?php

declare(strict_types=1);

namespace App\Application\Bootloader;

use App\Application\GithubRepositoryRegistry;
use App\Application\Repository\ConfigRepository;
use App\Application\Repository\EvnRepository;
use App\Infrastructure\Github\Client;
use App\Infrastructure\Github\ClientInterface;
use Spiral\Boot\Bootloader\Bootloader;
use Spiral\Boot\EnvironmentInterface;
use Symfony\Component\HttpClient\NativeHttpClient;

final class GithubBootloader extends Bootloader
{
    protected const BINDINGS = [
        ClientInterface::class => [self::class, 'initGithubClient'],
        GithubRepositoryRegistry::class => [self::class, 'initRegistry'],
    ];

    private function initRegistry(
        ConfigRepository $configRepository,
        EvnRepository $envRepository,
    ): GithubRepositoryRegistry {
        $repositories = \array_merge(
            $configRepository->all(),
            $envRepository->all(),
        );

        return new GithubRepositoryRegistry(
            \array_unique($repositories)
        );
    }

    public function initGithubClient(EnvironmentInterface $env): ClientInterface
    {
        return new Client(
            new NativeHttpClient([
                'base_uri' => 'https://api.github.com',
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                    'Authorization' => 'Bearer ' . $env->get('GITHUB_TOKEN'),
                ],
            ])
        );
    }
}
