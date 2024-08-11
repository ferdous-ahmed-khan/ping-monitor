<?php

namespace App;

class Validation
{

    protected $data;
    protected $config;

    public function __construct()
    {
        //import data and config
        $this->data = require 'data.php';
        $this->config = require 'config.php';

        //validate data
        $this->osValidation();
        $this->dataExist();
        $this->validateData();
    }

    protected function osValidation()
    {
        if ($this->config['os'] !== 'linux' && $this->config['os'] !== 'windows') {
            die("Error: Invalid 'os' value in config file. Must be 'linux' or 'windows'.");
        }
    }

    protected function dataExist()
    {
        if (!is_array($this->data)) {
            die("Error: Data must be an array.");
        }
    }

    protected function validateData()
    {
        foreach ($this->data as $item) {
            if (!is_array($item) || !array_key_exists('name', $item) || !array_key_exists('ip', $item)) {
                die('Please check the data.php file. It should be an array of arrays with keys "name" and "ip".');
            }
        }
        return true;
    }
}
