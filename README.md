# FreeCodeCamp PHP OOP Course
### By Peter Fisher How To Code Well

- [Installation](#installation)
    - [Database](#database)
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

### Database
*Please note: This will delete the database and create a new one. All data will be lost*

To rebuild the database run the following command from the host machine. (Change <DB_PASSWORD>)
```
$ docker-compose exec -T db mysql -u root --password=<DB_PASSWORD> < mysql/rebuild.sql
```
Or from within the container
```
$ docker-compose exec db mysql -u root -p
Enter password: 

mysql> use invoice_app;
mysql> source /scripts/rebuild.sql
```
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