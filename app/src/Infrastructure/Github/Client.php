<?php

declare(strict_types=1);

namespace App\Infrastructure\Github;

use App\Infrastructure\Github\DTO\Clones;
use App\Infrastructure\Github\DTO\Referrers;
use App\Infrastructure\Github\DTO\Releases;
use App\Infrastructure\Github\DTO\Repository;
use Symfony\Contracts\HttpClient\HttpClientInterface;

final class Client implements ClientInterface
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {
    }

    public function getRepository(string $name): Repository
    {
        $data = $this->request('GET', "/repos/{$name}");

        return new Repository(
            name: $data['name'],
            stargazersCount: $data['stargazers_count'],
            watchersCount: $data['watchers_count'],
            forksCount: $data['forks_count'],
            openIssuesCount: $data['open_issues_count'],
            subscribersCount: $data['subscribers_count'],
        );
    }

    public function getPopularReferrers(string $name): Referrers
    {
        $data = $this->request('GET', "/repos/{$name}/traffic/popular/referrers");

        return new Referrers($data);
    }

    public function getClones(string $name): Clones
    {
        $data = $this->request('GET', "/repos/{$name}/traffic/clones");

        $current = end($data['clones']) ?? [];

        return new Clones($current['count'] ?? 0, $current['uniques'] ?? 0);
    }

    public function getReleases(string $name): Releases
    {
        $data = $this->request('GET', "/repos/{$name}/releases?per_page=5");

        return new Releases($data);
    }

    private function request(string $method, string $uri): array
    {
        $response = $this->httpClient->request($method, $uri);

        if ($response->getStatusCode() !== 200) {
            throw new \RuntimeException('Something went wrong');
        }

        return \json_decode($response->getContent(), true);
    }
}
