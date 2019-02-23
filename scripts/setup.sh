#!/bin/bash

# install gpulab client
pip3 install /etc/client/gpulab-client-1.7.tar.gz

# export language settings needed for click
export LC_ALL=C.UTF-8
export LANG=C.UTF-8

export GPULAB_CERT='/etc/certs/cert_decrypted.pem'
export GPULAB_DEV='False'
