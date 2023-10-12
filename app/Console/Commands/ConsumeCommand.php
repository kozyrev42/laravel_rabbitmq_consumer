<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan rabbitmq:consume
     * @var string
     */
    protected $signature = 'rabbitmq:consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        echo " [*] Waiting for messages. To exit press CTRL+C\n";


        $callback = function ($msg) {
            echo ' [x] Received: ', $msg->body, "\n";
        };

        $channel->basic_consume('laravel_que', '', false, true, false, false, $callback);

        while ($channel->is_open()) {
            $channel->wait();
        }
    }
}
