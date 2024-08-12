<?php

require_once __DIR__ . '/Ping.php';
require_once __DIR__ . '/Validation.php';

use App\Validation;
use App\Ping;

class Index
{
    private $data;
    private $config;
    private $ping;

    public function __construct()
    {
        $this->data = require 'data.php';
        $this->config = require 'config.php';
        $this->ping = new Ping();
    }

    public function run()
    {
        $count = $active = 0;

        foreach ($this->data as $item) {
            $count++;
            $name = $item['name'];
            $ip = $item['ip'];

            // Select the ping method based on OS configuration
            $pingMethod = $this->config['os'] === 'linux' ? 'linuxPing' : 'windowsPing';
            $ping = $this->ping->$pingMethod($ip);

            // Output status
            $status = $ping ? 'Active' : 'Inactive';
            echo "$ip ----- $name ----- $status<br>";

            if ($ping) {
                $active++;
            }
        }

        // Output totals
        echo "<br>Total: $count; Active: $active";
    }
}

// Execute the script
(new Index())->run();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping Monitor</title>
</head>
<body>
 </body>
</html>