<?php

/**
 * Emotion
 */
QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

/**
 * Mega menu
 */
$MegaMenu = new QUI\Menu\MegaMenu(array(
    'showStart' => false
));

/**
 * Breadcrumb
 */
$Breadcrumb = new QUI\Controls\Breadcrumb();

/**
 * Template config
 */
$templateSettings = QUI\TemplateBusinessPro\Utils::getConfig(array(
    'Project'    => $Project,
    'Site'       => $Site,
    'Template'   => $Template,
    'MegaMenu'   => $MegaMenu,
    'Breadcrumb' => $Breadcrumb
));

$Engine->assign($templateSettings);
