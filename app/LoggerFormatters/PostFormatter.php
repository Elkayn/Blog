<?php

namespace App\LoggerFormatters;

use Illuminate\Log\Logger;
use Monolog\Formatter\LineFormatter;

class PostFormatter
{
    /**
     * Create a new class instance.
     */
    public function __invoke(Logger $logger): void
    {
        foreach ($logger->getHandlers() as $handler) {
            $handler->setFormatter(new LineFormatter(
                'jhb [%datetime%] %channel%.%level_name%: %message% %context% %extra%' . PHP_EOL
            ));
        }
    }
}
