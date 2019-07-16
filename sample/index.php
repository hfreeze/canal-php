<?php
namespace sample;

use client\Show;
use client\SimpleCanalConnector;

require_once __DIR__. '/../init.php';

try {
    $conn = new SimpleCanalConnector();
    $conn->connect("127.0.0.1", 11111, 10, 1800, 1800);
    $conn->checkValid();
    $conn->subscribe("example", ".*\\..*");

    while (true) {
        $message = $conn->get(10);
        $entries = $message->getEntries();
        if ($entries) {
            foreach ($entries as $entry) {
                Show::println($entry);
            }
        }
        sleep(1);
    }

    $conn->disConnect();
} catch (\Exception $e) {
    echo $e->getMessage(), PHP_EOL;
}