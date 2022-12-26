# Github public metrics collector

<a href="https://packagist.org/packages/metrixio/github-public"><img src="https://poser.pugx.org/metrixio/github-public/require/php"></a>
<a href="https://packagist.org/packages/metrixio/github-public"><img src="https://poser.pugx.org/metrixio/github-public/version"></a>
<a href="https://github.com/metrixio/github-public/actions"><img src="https://github.com/metrixio/twitter/github-public/workflows/docker-image.yml/badge.svg"></a>
<a href="https://packagist.org/packages/metrixio/github-public"><img src="https://poser.pugx.org/metrixio/github-public/downloads"></a>

![github](https://user-images.githubusercontent.com/773481/209463759-1a359047-3263-454b-b8ae-3444b5102bc8.png)

This tool helps developers see how popular their code is and how it's being used.

It works with Prometheus and Grafana to collect data from Github, store it in Prometheus, and create visualizations with Grafana. You can use Grafana to customize the data you collect and create dashboards that fit your needs.

## Dashboard

![image](https://user-images.githubusercontent.com/773481/209463810-43f33164-0be3-42f2-97e8-7c6b6d0a226c.png)

## Usage

To get started with this package, you'll need to create a Github API token. Once you have that, you can start collecting metrics data.

```dotenv
# Gitgub API token
GITHUB_TOKEN=

# Github repositories to follow (comma separated)
GITHUB_REPOSITORIES=
```

### Docker

```yaml
version: "3.7"

services:
    twitter-metrics:
        image: ghcr.io/metrixio/github-public:latest
        environment:
            GITHUB_TOKEN: ...
            GITHUB_REPOSITORIES: ...
        restart: on-failure

    prometheus:
        image: prom/prometheus
        volumes:
            - ./runtime/prometheus:/prometheus
        restart: always

    grafana:
        image: grafana/grafana
        depends_on:
            - prometheus
        ports:
            - 3000:3000
        volumes:
            - ./runtime/grafana:/var/lib/grafana
        restart: always
```

### Local server

```bash
composer create-project metrixio/github-public
```

Define the repositories you want to track in `.env` file

```dotenv
# Gitgub API token
GITHUB_TOKEN=xxx

# Github repositories to follow (comma separated)
GITHUB_REPOSITORIES=spiral/framework,...
```

Once the project is installed and configured you can start application server:

```bash
./rr serve
```

Metrics will be available on http://127.0.0.1:2112.

> **Note**:
> To fix unable to open metrics page, change metrics address in RoadRunner config file to `127.0.0.1:2112`.


-----

The package is built with some of the best tools out there for PHP. It's powered by [Spiral Framework](https://github.com/spiral/framework/), which makes it super fast and efficient, and it uses [RoadRunner](https://github.com/roadrunner-server/roadrunner) as the server, which is a really great tool for collecting metrics data for Prometheus.
