#!/usr/bin/env bash

DOCKER="docker-compose -f ./docker-compose.yml -p coinhive.com"

#force recreate to
${DOCKER} rm -f
${DOCKER} pull

#build and run
${DOCKER} build
${DOCKER} up -d --force-recreate

#docker
${DOCKER} exec php-coinhive bash
