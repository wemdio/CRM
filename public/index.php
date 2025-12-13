<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    if ($context['APP_ENV'] === 'dev') {
        ini_set('display_errors', '1');
        error_reporting(E_ALL);
    }
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
