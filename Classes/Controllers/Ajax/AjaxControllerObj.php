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
abstract class AjaxControllerObj
{
    /**
     * AjaxBaseControllerObjAbs constructor.
     * @param ConfigObj $configObj
     * @param AuthenticationObj $authenticationObj
     * @internal param $
     */
    function __construct(ConfigObj $configObj, AuthenticationObj $authenticationObj)
    {
        $this->configObj         = $configObj;
        $this->authenticationObj = $authenticationObj;
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
    public function Run()
    {
        return array();
    }

    /**
     * @var
     */
    protected $configObj;

    protected $authenticationObj;

}