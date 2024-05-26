<?php
if (isset($_POST['ip'])) {
    $ip = $_POST['ip'];
    $output = shell_exec("ping -c 4 " . $ip);
    echo "<pre>$output</pre>";
}
?>

