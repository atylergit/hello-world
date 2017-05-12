<?php

require_once(__DIR__ . '/start.php');

$viewController = $container->ViewControllerObj;
echo $viewController->Run();