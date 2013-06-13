<?php

require_once __DIR__ . '/../vendor/autoload.php'; 
use Symfony\Component\Routing\Matcher\Dumper\PhpMatcherDumper;
use Symfony\Component\Routing\Matcher\Dumper\ApacheMatcherDumper;

$routes = include __DIR__ . '/../src/app.php';
//$dumper = new PhpMatcherDumper($routes);
$dumper = new ApacheMatcherDumper($routes); 
echo $dumper->dump();    