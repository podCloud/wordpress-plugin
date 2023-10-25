#!/bin/sh
set -ex

BASE_DIR=$(realpath "$(dirname "$0")/..")

cd $BASE_DIR/gutenberg
export NODE_OPTIONS=--openssl-legacy-provider
npm run build

cd $BASE_DIR

cp gutenberg/gutenberg-helper.js support/dist/trunk/
cp -r podcloud/* support/dist/trunk/