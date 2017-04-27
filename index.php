<?php

require_once(__DIR__ . '/start.php');

$templateObj = $container->TemplateLoaderObj;

$templateObj->AddTemplateVariable('today',date('m/d/Y'));

$template = $templateObj->GetTemplate('hello-world');

$templateObj->AddTemplateVariable('serverPath',$container->ConfigObj->rootPath);

$template .= $templateObj->GetTemplate('foo-bar');

echo $template;
