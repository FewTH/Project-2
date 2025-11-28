#!/bin/sh
# Helper: run composer install in the `assess-app` service
docker-compose -f docker/docker-compose.yml run --rm assess-app composer install
