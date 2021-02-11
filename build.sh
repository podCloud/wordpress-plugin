#!/bin/sh

cd "$(dirname "$0")"
cd gutenberg
npm run build
cd ..
cp gutenberg/gutenberg-helper.js dist/trunk/
cp -r podcloud/* dist/trunk/
