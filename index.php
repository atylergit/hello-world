<?php

require_once(__DIR__ . '/start.php');

$templateObj = $container->TemplateLoaderObj;

$templateObj->AddTemplateVariable('today', date('m/d/Y'));
$arrayStuff = array(
    'hello' => 'this is a list using a foreach loop',
    'foo'   => 'here\'s an item',
    'bar'   => 'And another one',
    'Aye'   => 'Just one more...'
);
$templateObj->AddLoopContent('mrLoopy', $arrayStuff, 'foreach', 'li');
$template = $templateObj->GetTemplate('hello-world');

$templateObj->AddTemplateVariable('serverPath', $container->ConfigObj->rootPath);

$template .= $templateObj->GetTemplate('foo-bar');

echo $template;
