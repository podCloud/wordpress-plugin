#!/bin/sh
set -ex

BASE_DIR=$(realpath "$(dirname "$0")/..")

cd $BASE_DIR/support

mkdir -p test/db
svn co https://plugins.svn.wordpress.org/podcloud dist

cd $BASE_DIR/gutenberg
npm install