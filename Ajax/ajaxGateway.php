<?php
/**
 * Created by PhpStorm.
 * User: anthony tyler
 * Date: 4/28/2017
 * Time: 8:38 AM
 */
require_once('../start.php');

try {
    $command = 'Ajax' . $_POST['command'] . 'Obj';
    if (!class_exists($command)) {
        throw new Exception('The provided command is invalid');
    }
    /** @var AjaxBaseControllerObjAbs $commandObj */
    $commandObj = $container->$command;

    // Basic request validation, more advanced validation should be done in the called class where the command specific code and logic lives
    $commandObj->ValidateCommand();

    // Perform the actual run of the command and echo it's return
    echo json_encode($commandObj->Run());
} catch (Exception $exception) {
    $output = array(
        'status' => 'error',
        'error' => $exception,
        'friendlyText' => 'There was an error, please contact an admin'
    );
    die(json_encode($output));
}