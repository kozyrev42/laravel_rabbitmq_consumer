1. установил пакет
   `composer require php-amqplib/php-amqplib`

2. создадим консольную команду:
`php artisan make:command ConsumeCommand`

3. команда `ConsumeCommand` запускает процесс, который забирает сообщения из сервиса Рэббит
