#!/usr/bin/env bash

# docker ps -aq | xargs docker rm -fv
# skip drone
docker ps -a | grep -v drone | cut -d' ' -f1 | xargs docker rm -f

docker volume ls -q | xargs docker volume rm -f
docker network ls -q | xargs docker network rm

# docker images -q | xargs docker rmi -f
