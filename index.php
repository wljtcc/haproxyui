<?php

    require_once 'haproxy/autoload.php';


    // Create a Executor for HTTP
    $exec = new HAProxy\Executor('http://192.168.200.205/stats', HAProxy\Executor::HTTP);

    // Set your HAProxy stats page credentials
    $exec->setCredentials('admin', 'dataeasy');

    $stats = HAProxy\Stats::get($exec);
    printf($stats->dumpServiceTree());

    $server =  $stats->getServiceStats('DEMO_DOCFLOW','URUGUAI');
    printf("<br>-------------------------------------<br>");
    echo "{$server->info->service_name}";
    printf("<br>-------------------------------------<br>");
    echo "{$server->health->status} ({$server->health->check_status} - {$server->health->check_duration}ms )<br>";
    echo "<br>-------------------------------------<br>";
    echo $server->dump();
    echo "<br>-------------------------------------<br>";

    echo "teste";
