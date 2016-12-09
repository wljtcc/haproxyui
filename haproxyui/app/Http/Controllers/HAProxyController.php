<?php

namespace App\Http\Controllers;

use App\HAProxyUI;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use HAProxy;
use Illuminate\View\View;

class HAProxyController extends Controller
{
    public function HAProxy(){

        require_once 'haproxy/autoload.php';

        $haproxyui = HAProxyUI::all();

        // Create a Executor for HTTP
        $exec = new HAProxy\Executor('http://192.168.200.205/stats', HAProxy\Executor::HTTP);

        // Set your HAProxy stats page credentials
        $exec->setCredentials('admin', 'dataeasy');

        $stats = HAProxy\Stats::get($exec);
        $backend = $stats->getBackendNames();

        $a = $stats->getServiceStats('DEMO_DOCFLOW','URUGUAI');

        return view('haproxy.haproxy')
            ->with('backend', $backend)
            ->with('a', $a);

    }

    public function haproxyBackend()
    {
        require_once 'haproxy/autoload.php';

        // Create a Executor for HTTP
        $exec = new HAProxy\Executor('http://192.168.200.205/stats', HAProxy\Executor::HTTP);

        // Set your HAProxy stats page credentials
        $exec->setCredentials('admin', 'dataeasy');
        $stats = HAProxy\Stats::get($exec);
        $backend = $stats->getBackendNames();

        // Tamanho do BackEnd
        $count = count($backend);
        //echo $count;

        for ($i = 1; $i < $count; $i++){
            echo array_flatten($backend)[$i];
            echo "<p>";
            // Return Servers this Backend
            $this->haproxyBackendServers($backend[$i]);
            echo "<p>";
        }

    }

    protected function haproxyBackendServers($backend)
    {
        require_once 'haproxy/autoload.php';

        // Create a Executor for HTTP
        $exec = new HAProxy\Executor('http://192.168.200.205/stats', HAProxy\Executor::HTTP);

        // Set your HAProxy stats page credentials
        $exec->setCredentials('admin', 'dataeasy');
        $stats = HAProxy\Stats::get($exec);
        $servers = $stats->getServerNames($backend);

        // Tamanho do Server Backend
        $cservers = count($servers);
        //echo $cservers;

        for ($s = 0; $s < $cservers-1; $s++){
            echo "Server: ";
            $bserver = array_flatten($servers)[$s];
            echo array_flatten($servers)[$s];
            echo "<p>";
        }
    }

    public function haproxyBackendServersStats(/*$backend, $server*/){

        require_once 'haproxy/autoload.php';

        // Create a Executor for HTTP
        $exec = new HAProxy\Executor('http://192.168.200.205/stats', HAProxy\Executor::HTTP);

        // Set your HAProxy stats page credentials
        $exec->setCredentials('admin', 'dataeasy');
        $stats = HAProxy\Stats::get($exec);
        $backend = $stats->getBackendNames();
        $servers = $stats->getServerNames($backend[1]);
        var_dump($servers);

        $server_stats = $stats->getServiceStats($backend[1],$servers[0]);

        echo "<pre>";

        print_r($server_stats->info->pxname); // Backend
        echo "<p>";

        print_r($server_stats->info->svname); // Server
        echo "<p>";

        print_r($server_stats->info->status); // Status Server
        echo "<p>";

        print_r($server_stats->info->check_status);
        echo "<p>";

        print_r($server_stats->session->scur); // Session Current
        echo "<p>";

        print_r($server_stats->session->smax); // Max Session
        echo "<p>";

        print_r(floor($server_stats->bytes->bin/1000)/1000); // Bytes In (Mbyte)
        echo "<p>";

        ;
        print_r(floor($server_stats->bytes->bout/1000)/1000); // Bytes Out (Mbyte)
        echo "<p>";

        print_r($server_stats);
        echo "</pre>";


    }
}
