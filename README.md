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
      - /path/to/gpulab-pass.txt:/etc/pass/pass.txt
      - /path/to/gpulab-decrypted-cert.pem:/etc/certs/decrypted_cert.pem
    environment:
      - GPULAB_SERVER_USER=eduplat
  ...
```
