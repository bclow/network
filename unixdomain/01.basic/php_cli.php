#!/usr/bin/env php
<?php
$dest   = "\0hidden";

$dest   = $argv[1] ?? $argv[1];

$fp     = stream_socket_client('unix://'.$dest, $errno, $errstr);
if(!$fp) {
    echo "ERROR: $errno - $errstr\n";
} else {
    $readfh     = fopen("php://stdin", "rb");
    while($readfh) {
        $buff   = fread($readfh, 2*1024);
        if(!$buff) {
            break;
        }

        fwrite($fp, $buff);
    }

    if($readfh) {
        fclose($readfh);
    }
}


?>
