<?php

namespace App;

class Ping
{

    public function linuxPing($ip)
    {
        exec("ping -c 1 -W 1 $ip", $output, $status);
        foreach ($output as $line) {
            if (strpos($line, 'packet loss') !== false) {
                // Extract the loss percentage
                preg_match('/(\d+)% packet loss/', $line, $matches);
                $loss = isset($matches[1]) ? intval($matches[1]) : 100;
                return $loss === 0;
            }
        }
        // Default to inactive if no loss info is found
        return false;
    }

    public function windowsPing($ip)
    {
        exec("ping -n 1 -w 1000 $ip", $output, $status);
        foreach ($output as $line) {
            if (strpos($line, 'Lost =') !== false) {
                // Extract the loss percentage
                preg_match('/\((\d+)% loss\)/', $line, $matches);
                $loss = isset($matches[1]) ? intval($matches[1]) : 100;
                return $loss === 0;
            }
        }
        // Default to inactive if no loss info is found
        return false;
    }
}
