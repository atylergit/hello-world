<?php

require_once(__DIR__ . '/start.php');

$templateObj = $container->TemplateLoaderObj;

$templateObj->AddTemplateVariable('today',date('d/m/Y'));

echo $templateObj->GetTemplate('hello-world');
