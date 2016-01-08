<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */
$loader = require __DIR__.'/../vendor/autoload.php';
//Permet à l’autoload d’importer la librarie HTML2PDF
$loader->add('Html2Pdf_', __DIR__.'/../vendor/html2pdf/lib');

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;