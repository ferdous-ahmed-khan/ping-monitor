<?php

namespace App;

class Ping
{
    public function linuxPing(string $ip): bool
    {
        exec("ping -c 1 -W 1 $ip", $output, $status);
        foreach ($output as $line) {
            if (strpos($line, 'packet loss') !== false) {
                return $this->parseLoss($line) === 0;
            }
        }
        return false;
    }

    public function windowsPing(string $ip): bool
    {
        exec("ping -n 2 -w 1000 $ip", $output, $status);
        foreach ($output as $line) {
            if (
                strpos($line, 'Request timed out.') !== false ||
                strpos($line, 'Destination host unreachable.') !== false
            ) {
                return false;
            }
        }
        return true;
    }

    private function parseLoss(string $line): int
    {
        preg_match('/(\d+)% packet loss/', $line, $matches);
        return isset($matches[1]) ? (int) $matches[1] : 100;
    }
}
