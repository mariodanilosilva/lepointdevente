# Lepointdevente

## Project requirements
Install Docker and Docker Compose on your machine. Here are links to detailed installation instructions: 
- https://docs.docker.com/engine/install/
- https://docs.docker.com/compose/install/

When opening a lepointdevente project, you need: 
- execute the command sequence: 
```bash
#1
$ docker run --rm --interactive --tty --volume $PWD:/app composer update
```
This will get the dependencies associated with the project and allow you to run it on your mahcine.

```bash
#2
$ docker-compose up -d
```
This will create the container with the PHP and NGINX service.

## Access the service
The project was set to run on port 80, access the browser [http://localhost](http://localhost) and check if the service is running.
