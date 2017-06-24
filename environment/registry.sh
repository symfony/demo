#!/usr/bin/env bash

docker run -d -p 5000:5000 --restart always --name registry registry:2

docker push localhost:5000/drone/drone:0.7.2
docker push localhost:5000/docker/compose:1.14.0

docker push localhost:5000/php:5.5
docker push localhost:5000/php:5.6
docker push localhost:5000/php:7.0
docker push localhost:5000/php:7.1

docker push localhost:5000/sergeyz/php:5.5
docker push localhost:5000/sergeyz/php:5.6
docker push localhost:5000/sergeyz/php:7.0
docker push localhost:5000/sergeyz/php:7.1

docker push localhost:5000/alpine:3.4
docker push localhost:5000/composer:1.4
docker push localhost:5000/postgres:9.6
docker push localhost:5000/gogs/gogs:0.11.4
docker push localhost:5000/alpine:3.4
