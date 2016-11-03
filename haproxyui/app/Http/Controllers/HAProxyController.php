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
}
