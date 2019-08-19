<?php
$excluded_folders = [
    'vendor'
];
$finder = PhpCsFixer\Finder::create()
    ->exclude($excluded_folders)
    ->in(__DIR__);

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@PSR2' => true,
        'lowercase_constants' => false,
        'method_argument_space' => false,
    ))
    ->setFinder($finder);