<?php
require_once 'vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\NativeMailerHandler;

$logger = new Logger('app_logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/app_log.log', Logger::DEBUG));
$logger->pushHandler(new NativeMailerHandler('admin@to_email.com', 'PHP Logger', 'admin@from_email.com'));
$logger->alert("This is an alert message");
?>