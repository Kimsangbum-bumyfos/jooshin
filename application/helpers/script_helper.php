<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function alert_after_history($msg, $level = -1) {
    $level = $level ? $level : -1;
    echo "<script type='text/javascript'> alert('".$msg."'); history.go($level); </script>";
}

function history($level = -1) {
    $level = $level ? $level : -1;
    echo "<script type='text/javascript'> history.go($level); </script>";
}
?>
