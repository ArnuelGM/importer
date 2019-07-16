<?php
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;

$adapter = new Local(__DIR__.'/../');
$filesystem = new Filesystem($adapter);