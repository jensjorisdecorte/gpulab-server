# gpulab-server
### An intuitive webserver for management of the GPULab software by UGent.

## Setup
Add this docker container to a new or existing docker-compose.yml file like this:

```
services:
  ...
  gpulab:
    container_name: gpulab
    image: jensjorisdecorte/gpulab-server
    ports:
      - "80:80"
    volumes:
      - ./www:/var/www
      - ./gpulab-config/gpulab-pass.txt:/etc/pass/pass.txt
      - ./gpulab-config/certs:/etc/certs
    environment:
      - GPULAB_SERVER_USER=eduplat
    ...
```
