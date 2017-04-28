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

    private $configObj;
}