<?php

/*****************************************************************************************
 * @name...........: AuthenticationObj
 * @class..........: AuthenticationObj
 * @description....:
 *
 * @author.........: ATyler
 * @createDate.....: 05/15/2017
 *
 * @modifications..:
 *
 ******************************************************************************************/
class AuthenticationObj
{

    function __construct(ConfigObj $configObj)
    {
        session_start();
        $this->configObj = $configObj;
    }

    public $authRequired = false;

    public $isAuthenticated = false;

    public function CheckSession()
    {
        if (!isset($_SESSION['isLoggedIn'])) {
            $_SESSION['isLoggedIn'] = false;
        }

        if (true === $_SESSION['isLoggedIn']) {
            $this->isAuthenticated = true;
        }
    }

    public function CreateSession($userName)
    {
        $_SESSION['userName']   = $userName;
        $_SESSION['isLoggedIn'] = true;
    }

    public function CheckForLogOut()
    {
        if (!isset($_GET['page'])) {
            return;
        }

        if ($_GET['page'] == 'Logout' && $this->isAuthenticated === true) {
            $this->DoLogout();
        }
    }

    public function ValidateCredentials($userName, $password)
    {
        $userExists = false;
        if ($userName == 'atyler') {
            $userExists = true;
        }

        if ($password == 'password1!' && $userExists === true) {
            $this->CreateSession($userName);
        } else {
            throw new Exception('Username and password are not correct!');
        }
    }

    public function DoLogout()
    {
        $this->isAuthenticated = false;
        unset($_SESSION['isLoggedIn']);
        session_destroy();
    }

    /** @var ConfigObj $configObj */
    private $configObj;
}