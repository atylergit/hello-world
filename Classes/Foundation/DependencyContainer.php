<?php

/*****************************************************************************************
 * @name...........: DependencyContainer
 * @class..........: DependencyContainer
 * @description..... This serves as the dependency injection container for the application
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

        $this->InitialiseInjection($this);
    }

    private function InitialiseInjection($container)
    {
        $WarpObjectObjFcn = function ($container) {
            /** @var WarpObject $WarpObjectObj */
            $WarpObjectObj = new WarpObject();
            return $WarpObjectObj;
        };
        $this->WarpObjectObj = $WarpObjectObjFcn;
    }
}