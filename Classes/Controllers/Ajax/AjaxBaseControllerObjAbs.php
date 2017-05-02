<?php

/*****************************************************************************************
 * @name...........: AjaxBaseControllerObjAbs
 * @class..........: AjaxBaseControllerObjAbs
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 04/28/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
abstract class AjaxBaseControllerObjAbs
{
    function __construct($configObj)
    {
        $this->configObj = $configObj;
    }

    function __destruct()
    {
    }

    public function ValidateCommand() {
        if (!isset($_POST['command']) || is_null($_POST['command']) || '' === $_POST['command']) {
            throw new Exception("POST command is required and was not supplied");
        }

        $command = 'Ajax' . $_POST['command'] . 'Obj';
        if (!class_exists($command)) {
            throw new Exception('The provided command is invalid');
        }
    }

    public function Run() {
        return array();
    }

    private $configObj;
}