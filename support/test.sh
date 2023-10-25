#!/bin/sh
set -ex

cd "$(dirname "$0")"

./install.sh
./build.sh

docker compose up --build -d

echo "http://localhost:8888/"
xdg-open "http://localhost:8888/"