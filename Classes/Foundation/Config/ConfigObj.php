<?php

/*****************************************************************************************
 * @name...........: ConfigObj
 * @class..........: ConfigObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 04/26/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class ConfigObj
{
    public $rootPath;

    public $templatePath;

    public $templateName;

    public $databaseHost;

    public $databaseUser;

    public $databasePassword;

    public $databaseName;


    function __construct()
    {
        $this->rootPath = $_SERVER["DOCUMENT_ROOT"] . 'foo/hello-world';

        $this->templateName = 'default';

        $this->templatePath = $this->rootPath . '/Templates/' . $this->templateName;
    }

    function __destruct()
    {
    }
}