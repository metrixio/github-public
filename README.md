# Github public metrics collector

![github](https://user-images.githubusercontent.com/773481/209463759-1a359047-3263-454b-b8ae-3444b5102bc8.png)

This tool helps developers see how popular their code is and how it's being used. It works with Prometheus and Grafana to gather data from Github and create cool visualizations. You can use Grafana to filter and customize the metrics you collect. We hope you find it helpful!

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
