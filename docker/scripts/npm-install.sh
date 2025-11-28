#!/bin/sh
# Helper: run npm install in the `assess-app` service
docker-compose -f docker/docker-compose.yml run --rm assess-app npm install
