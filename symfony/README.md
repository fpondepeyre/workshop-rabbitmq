Workshop Php RabbitMq
=====================

# Requirement

- Php 7.1 (https://secure.php.net/releases/7_1_0.php)
- Docker (https://www.docker.com/)
- Composer (https://getcomposer.org/)
- Git (https://git-scm.com/)

# Install
```
docker run -d --hostname rabbit --name rabbit -p 8080:15672 -p 5672:5672 rabbitmq:3.7.4-management-alpine
composer install
php -S 127.0.0.1:8000 -t public
```

# Workshop

Build with Symfony4 and Rabbitmq (https://www.rabbitmq.com/, http://symfony.com/)

## Example with RabbitMqBundle and "Dead Letter Exchange"


Publish message with controller
```
http://localhost:8000/task
```

Publish messages with command:
```
./bin/console app:publish
```

Consume all messages:
```
./bin/console rabbitmq:consumer task
```

## Example with Messenger Component

Publish message with controller
```
http://localhost:8000/messenger
```

Consume all messages:
``` 
./bin/console messenger:consume-messages default
```