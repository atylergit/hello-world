<?php
/**
 * Created by PhpStorm.
 * User: anthony tyler
 * Date: 4/28/2017
 * Time: 8:38 AM
 */
require_once('../start.php');

if (!isset($_POST['command']) || is_null($_POST['command']) || '' === $_POST['command']) {
    $output = array(
        'status' => 'error',
        'error' => 'POST command is required and was not supplied',
        'friendlyText' => 'There was an error, please contact an admin',
        'request' => '<pre>' . print_r($_POST, true) . '</pre>'
    );
    die(json_encode($output));
}

$command = 'Ajax' . $_POST['command'] . 'Obj';
if (!class_exists($command)) {
    $output = array(
        'status' => 'error',
        'error' => 'The provided command is invalid',
        'friendlyText' => 'There was an error, please contact an admin'
    );
    die(json_encode($output));
}

try {
    echo json_encode($container->$command->Run());
} catch (Exception $exception) {
    $output = array(
        'status' => 'error',
        'error' => $exception,
        'friendlyText' => 'There was an error, please contact an admin'
    );
    die(json_encode($output));
}