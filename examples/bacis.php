<?php

require_once __DIR__ . '/../vendor/autoload.php';

use LiteFS\LiteFS;

$fm = new LiteFS(__DIR__ . '/../testdir');

$fm->createDir('logs');
$fm->createFile('logs/test.txt', 'Hello world!');
$fm->appendFile('logs/test.txt', "\nMore text.");
echo $fm->readFile('logs/test.txt');

$files = $fm->listDir('logs');
print_r($files);

$fm->zipDir('logs', 'logs.zip');
$fm->unzip('logs.zip', 'unzipped_logs');
