<?php
/**
 * Created by PhpStorm.
 * User: anthony tyler
 * Date: 4/28/2017
 * Time: 8:38 AM
 */

try {
    require_once('../start.php');

    if (!isset($_POST['command']) || is_null($_POST['command']) || '' === $_POST['command']) {
        throw new Exception("POST command is required and was not supplied");
    }

    $command = 'Ajax' . $_POST['command'] . 'Obj';
    if (!class_exists($command)) {
        throw new Exception('The provided command is invalid');
    }

    /**
     * This will give us some basic auto-complete on the commands and tells us what is actually happening
     *
     * @var AjaxBaseControllerObjAbs $commandObj
     */
    $commandObj = $container->$command;

    $commandObj->ValidateCommand();

    // Perform the actual run of the command and echo it's return
    echo json_encode($commandObj->Run());
} catch (Exception $exception) {
    $output = array(
        'status' => 'error',
        'error' => print_r($exception->getTrace(), true),
        'friendlyText' => $exception->getMessage()
    );
    die(json_encode($output));
}