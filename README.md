# gpulab-server
### An intuitive webserver for management of the GPULab software by UGent.

The image is currently tagged beta and only supports the ```gpulab.ilabt.imec.be:5000/jupyter-example:v2``` image. I am planning to add support for other images.

![home ui of gpulab-server](https://raw.githubusercontent.com/jensjorisdecorte/gpulab-server/master/images/home.png)

## Setup
1. choose a password to protect the GPULab server

Encrypt this password with a bcrypt hasher (e.g. https://www.browserling.com/tools/bcrypt) and paste the hash on the first line of a file called ```gpulab_pass.txt```

2. Decrypt your GPULab certificate (explained on https://doc.ilabt.imec.be/ilabt/gpulab/cli.html#basic-cli-usage) and save it to ```gpulab_decrypted_cert.pem```

3. Decide on a username for the GPULab server (e.g. ```myGPULabServerUsername```)

3. optional:  define a prefix for each job name (e.g. ```myJobPrefix-```)

4. Add the docker container to a new or existing docker-compose.yml file. **GPULab Server only works behind a secured proxy**.

Your docker-compose.yml file should look something like this:


```
version: "3"

services:

  gpulab-server:
    container_name: gpulab-server
    image: jpdcorte/gpulab-server:beta
    export:
      - "80"
    volumes:
      - ./relative/path/to/gpulab_pass.txt:/etc/pass/pass.txt
      - ./relative/path/to/gpulab_decrypted_cert.pem:/etc/certs/decrypted_cert.pem
    environment:
      - GPULAB_SERVER_USER=myGPULabServerUsername
      - GPULAB_SERVER_JOB_PREFIX=myJobPrefix-
    networks:
      - web
  
  nginx:
    container_name: reverse-proxy
    image: nginx:latest
    volumes:
      - ./relative/path/to/nginx.conf:/etc/nginx/nginx.conf
    ports:
      - "80:80"
      - "443:443"
    depends_on:
      - gpulab-server
    networks:
      - web

networks:
  web:
```

5. make sure the ```nginx.conf``` file includes the right settings to serve the GPULab Server:

```
user  nginx;
worker_processes  1;

http {

    upstream gpulab-server {
        server gpulab-server:80;
    }

    server {
        listen 80;

        location / {
            rewrite ^ https://$host$request_uri? permanent;
        }
    }

    server {
        listen 443 ssl;

        ssl_certificate /absolute/path/to/fullchain.pem;
        ssl_certificate_key /absolute/path/to/privkey.pem;

        location / {
            proxy_pass http://gpulab-server;
            proxy_set_header Host $host;
            proxy_set_header X-Real-IP $remote_addr;
            proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
            proxy_set_header X-Forwarded_Proto $scheme;
        }
    }
}

```

