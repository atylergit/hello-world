<?php

/*****************************************************************************************
 * @name...........: DoSomethingObj
 * @class..........: DoSomethingObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 04/28/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class AjaxDoSomethingObj extends AjaxBaseControllerObjAbs
{
    public function Run()
    {
        $returnArr = array(
            'status' => 'success',
            'message' => 'Yay you did something',
            'data' => array($_POST['something']),
            'friendlyText' => 'Nothing really happened but the command exists and it\'s working'
        );

        return $returnArr;
    }
}