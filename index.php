<?php

require_once __DIR__ . '/Ping.php';
require_once __DIR__ . '/Validation.php';


use App\Validation;
use App\Ping;

class Index
{

    protected $data;
    protected $config;
    protected $ping;
    protected $validation;

    public function __construct()
    {
        $this->data = require 'data.php';
        $this->config = require 'config.php';
        $this->ping = new Ping();
        $this->validation = new Validation();
    }


    public function run()
    {
        // Iterate over the array and ping each IP address
        foreach ($this->data as $item) {
            $name = $item['name'];
            $ip = $item['ip'];
            if ($this->config['os'] === 'linux') {
                $ping = $this->ping->linuxPing($ip);
            } elseif ($this->config['os'] === 'windows') {
                $ping = $this->ping->windowsPing($ip);
            }

            $status = $ping ? 'Active' : 'Inactive';
            echo "$ip ----- $name ----- $status";
            echo "<br>";
        }
    }
}




$index = new Index();
$index->run();
