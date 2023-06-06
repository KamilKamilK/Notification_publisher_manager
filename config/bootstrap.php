<?php

use Symfony\Component\Dotenv\Dotenv;

(new Dotenv())->usePutenv(true)->loadEnv(dirname(__DIR__) . '/.env');
