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
    /**
     * AjaxBaseControllerObjAbs constructor.
     * @param $configObj
     */
    function __construct($configObj)
    {
        $this->configObj = $configObj;
    }

    /**
     *
     */
    function __destruct()
    {
    }

    /**
     *
     */
    public function ValidateCommand()
    {
    }

    /**
     * @return array
     */
    public function Run() {
        return array();
    }

    /**
     * @var
     */
    private $configObj;
}