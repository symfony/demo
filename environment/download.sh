#!/usr/bin/env bash

REGISTRY=""

if [ -n "$1"     ]; then
    REGISTRY=$1:5000/
fi

docker pull ${REGISTRY}drone/drone:0.7.2
docker pull ${REGISTRY}docker/compose:1.14.0

docker pull ${REGISTRY}php:5.5
docker pull ${REGISTRY}php:5.6
docker pull ${REGISTRY}php:7.0
docker pull ${REGISTRY}php:7.1

docker pull ${REGISTRY}sergeyz/php:5.5
docker pull ${REGISTRY}sergeyz/php:5.6
docker pull ${REGISTRY}sergeyz/php:7.0
docker pull ${REGISTRY}sergeyz/php:7.1

docker pull ${REGISTRY}alpine:3.4
docker pull ${REGISTRY}composer:1.4
docker pull ${REGISTRY}postgres:9.6
docker pull ${REGISTRY}gogs/gogs:0.11.4
docker pull ${REGISTRY}alpine:3.4
