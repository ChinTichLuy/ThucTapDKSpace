<?php

namespace App\Services;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LoggerService
{
    protected Logger $logger;

    public function __construct()
    {
        $this->logger = new Logger('custom');
        $this->logger->pushHandler(new StreamHandler(storage_path('logs/custom.log')));
    }

    public function logInfo(string $message): void
    {
        $this->logger->info($message);
    }

    public function logError(string $message): void
    {
        $this->logger->error($message);
    }
}
