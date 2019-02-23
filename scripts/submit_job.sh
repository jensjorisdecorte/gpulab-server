#!/bin/bash

export LC_ALL=C.UTF-8;
export LANG=C.UTF-8;
GPULAB_CERT=/etc/certs/cert_decrypted.pem gpulab-cli submit --project=dp2019-11 --wait-run << EOF
 {
     "jobDefinition": {
         "name": "$1",
         "description": "$2",
         "dockerImage": "gpulab.ilabt.imec.be:5000/jupyter-example:v2",
         "jobType": "BATCH",
         "command": "",
         "resources": {
             "gpus": 1,
             "systemMemory": 2000,
             "cpuCores": 1
         },
         "jobDataLocations": [
             {
                 "mountPoint": "/project"
             }
         ],
         "portMappings": [ { "containerPort": 8888 } ]
     }
 }
EOF