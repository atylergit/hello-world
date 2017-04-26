<?php

/*****************************************************************************************
 * @name...........: initializeWarpObject
 * @class..........: initializeWarpObject
 * @description....: It does some stuff
 *
 * @author.........: ATyler
 * @createDate.....: 04/25/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class initializeWarpObject
{
    /**
     * initializeWarpObject constructor.
     */
    function __construct()
    {
        $this->helloWorld = 'Hello World!';
    }

    /**
     * initializeWarpObject destructor.
     *
     * Does nothing
     */
    function __destruct()
    {
    }

    /**
     * Public Properties and Methods
     */

    /**
     * @return string
     */
    public function GetHelloWorld()
    {
        return $this->helloWorld;
    }

    /**
     * Private Properties and Methods
     */

    /** @var string $helloWorld */
    private $helloWorld;
}