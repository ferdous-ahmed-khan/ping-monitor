# Ping Monitor

A simple ping monitor that shows the active/inactive status of a list of hosts.

## Installation

1. **Configure Hosts:**
   Rename the file `_data.php` to `data.php` and include the hosts you want to monitor. The file should return a PHP array with the host names and their corresponding IP addresses.

   ```php
   <?php
   return [
       ['name' => 'Application 1', 'ip' => '192.168.0.174'],
       ['name' => 'Application 2', 'ip' => '10.1.44.11'],
   ];

2. **Set the Operating System:**
   Edit `config.php` to return the host operating system name. The OS name must be either `linux` or `windows`. By default, the OS name took from the PHP constant `PHP_OS`.

   ```php
   <?php
   // os name must be 'linux' or 'windows'
   return ['os' => $os];

3. **Deploy:**
 Upload the files to your server and access the index.php file to start monitoring your hosts.

    That's it! You're ready to go!
