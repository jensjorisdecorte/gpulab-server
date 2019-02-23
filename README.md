# gpulab-server
### An intuitive webserver for management of the GPULab software by UGent.

(image is currently tagged beta)

![home ui of gpulab-server](https://raw.githubusercontent.com/jensjorisdecorte/gpulab-server/master/images/home.png)

## Setup
1. choose a password to protect the GPULab server

Encrypt this password with a bcrypt hasher (e.g. https://www.browserling.com/tools/bcrypt) and paste the hash on the first line of a file called ```gpulab_pass.txt```

2. Decrypt your GPULab certificate (explained on https://doc.ilabt.imec.be/ilabt/gpulab/cli.html#basic-cli-usage) and save it to ```gpulab_decrypted_cert.pem```

3. Decide on a username for the GPULab server (e.g. ```myGPULabServerUsername```)

3. Add the docker container to a new or existing docker-compose.yml file like this:

```
services:
  ...
  gpulab-server:
    container_name: gpulab-server
    image: jpdcorte/gpulab-server:beta
    ports:
      - "80:80"
    volumes:
      - ./relative/path/to/gpulab_pass.txt:/etc/pass/pass.txt
      - ./relative/path/to/gpulab_decrypted_cert.pem:/etc/certs/decrypted_cert.pem
    environment:
      - GPULAB_SERVER_USER=myGPULabServerUsername
  ...
```
