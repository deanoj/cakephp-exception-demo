#!/usr/bin/env bash

# symlink web application
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi



