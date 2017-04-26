<?php

/*****************************************************************************************
 * @name...........: DependencyContainer
 * @class..........: DependencyContainer
 * @description..... This serves as a very simple dependency injection container for the application
 *
 * @author.........: ATyler
 * @createDate.....: 04/25/2017
 *
 ******************************************************************************************/
class DependencyContainer
{
    /** @var  WarpObject $WarpObjectObj */
    public $WarpObjectObj;

    function __construct()
    {

        $this->InitialiseInjection();
    }

    private function InitialiseInjection()
    {
        $this->WarpObjectObj = new WarpObject();
    }
}