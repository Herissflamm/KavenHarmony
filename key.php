<?php
$key = 'base64:' . base64_encode(random_bytes(32));
file_put_contents('.env', PHP_EOL . "APP_KEY={$key}" . PHP_EOL, FILE_APPEND);