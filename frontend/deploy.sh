#!/usr/bin/env sh

# abort on errors
set -e

# build
npm run build

# navigate into the build output directory
cd dist

# Prevent GitHub Pages from using Jekyll
touch .nojekyll

git init
git add -A
git commit -m 'deploy'

git push -f git@github.com:tomlidobnik/frontend.git master:gh-pages


cd -