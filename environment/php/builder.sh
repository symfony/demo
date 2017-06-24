#!/usr/bin/env bash

docker build -t sergeyz/php:7.1 -f 7.1/Dockerfile .
docker build -t sergeyz/php:7.0 -f 7.0/Dockerfile .
docker build -t sergeyz/php:5.6 -f 5.6/Dockerfile .
docker build -t sergeyz/php:5.5 -f 5.5/Dockerfile .
