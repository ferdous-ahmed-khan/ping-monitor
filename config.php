<?php
$osName = php_uname('s');

switch ($osName) {
    case 'Windows NT':
        $os = 'windows';
        break;
    case 'Linux':
        $os = 'linux';
        break;
    default:
        die("Error: Unsupported OS.");
}

return ['os' => $os];


// os must be either 'windows' or 'linux'. you can manually set it here
// return ['os' => 'windows'];

