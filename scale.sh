#!/bin/bash
docker-compose up -d --scale traefik=1 --scale  wordpress=3 --scale mysql=3 --no-recreate