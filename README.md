# Github public metrics collector

![github](https://user-images.githubusercontent.com/773481/209463759-1a359047-3263-454b-b8ae-3444b5102bc8.png)

Welcome to the Github public metrics collector!

This repository provides metrics on the popularity and usage of GitHub repositories. This can help developers understand
how their code is being used and identify areas for improvement.

It is designed to work seamlessly with Prometheus and Grafana. It will collect data from Github and send it to
Prometheus for storage, and then use Grafana to visualize the data in beautiful and informative dashboards. Grafana
offers a variety of options for filtering and specifying the data you want to collect, so you can customize your metrics
collection to fit your needs.

We hope you find this package useful!

## Dashboard

![image](https://user-images.githubusercontent.com/773481/209463810-43f33164-0be3-42f2-97e8-7c6b6d0a226c.png)

## Usage

To use the package, you will need to create a Github API token. Once you have
obtained your API token, you can use the package's functions to authenticate and start collecting data.

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
