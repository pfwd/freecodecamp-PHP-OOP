# FreeCodeCamp PHP OOP Course
### By Peter Fisher How To Code Well

- [Installation](#installation)
- [Requirements](#requirements)
- [Testing](#testing)

## Installation
Create `.env` 
```
$ cp .env.dist .env
```
Modify values in `.env`

Creating Docker Machine (Optional)
```
$ docker-machine create howtocodewell-oop-php
$ docker-machine env howtocodewell-oop-php
$ eval $(docker-machine env howtocodewell-oop-php)
```

Create the containers and build the images
```
$ docker-compose up -d --build
```

Find IP of Docker machine
```
$ docker-machine ip howtocodewell-oop-php
192.168.99.100
```

Put the IP in a browser

## Requirements
- Docker 18.09.2
- Docker Machine 0.16.1 (Optional)
- Docker Compose 1.23.2 

## Testing
Run unit tests
```
$ docker-compose exec web vendor/bin/codecept run unit 
```

Run unit tests with code coverage
```
$ docker-compose exec web vendor/bin/codecept run unit --coverage --coverage-xml --coverage-html
$ open tests/_output/coverage/index.html
```

Run acceptance tests
```
$ docker-compose exec web vendor/bin/codecept run acceptance
```