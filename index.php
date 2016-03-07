<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');


/**
 * Background
 */

$Background = false;

if ($Project->getConfig('templateBusinessPro.settings.pageBackground')) {
    try {
        $Background = QUI\Projects\Media\Utils::getImageByUrl(
            $Project->getConfig('templateBusinessPro.settings.pageBackground')
        );

    } catch (QUI\Exception $Exception) {
        \QUI\System\Log::writeRecursive($Exception->getMessage());
    }
}


/**
 * Project Logo
 */

$logo = false;
$configLogo = $Project->getConfig('templateBusinessPro.settings.logo');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogo)) {
    $logo = $configLogo;
}

/**
 * Project Logo Small
 */

$logoSmall = false;
$configLogoSmall = $Project->getConfig('templateBusinessPro.settings.logoSmall');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogoSmall)) {
    $logoSmall = $configLogoSmall;
}


/**
 * no header?
 */

$noHeader = false;

switch ($Template->getLayoutType()) {
    case 'layout/rightSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderRightSidebar');
        break;

    case 'layout/leftSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderLeftSidebar');
        break;

    case 'layout/noSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderNoSidebar');
        break;

}

/**
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont = '#D1D1D1';
$colorMain = '#dd151b';
$buttonFontColor = '#ffffff';
$colorBackground = '#F7F7F7';
$colorFooterLinks = '#E6E6E6';
$colorMainContentBg = '#ffffff';
$colorMainContentFont = '5d5d5d';

if ($Project->getConfig('templateBusinessPro.settings.colorFooterBackground')) {
    $colorFooterBackground = $Project->getConfig('templateBusinessPro.settings.colorFooterBackground');
}

if ($Project->getConfig('templateBusinessPro.settings.colorFooterFont')) {
    $colorFooterFont = $Project->getConfig('templateBusinessPro.settings.colorFooterFont');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMain')) {
    $colorMain = $Project->getConfig('templateBusinessPro.settings.colorMain');
}

if ($Project->getConfig('templateBusinessPro.settings.buttonFontColor')) {
    $buttonFontColor = $Project->getConfig('templateBusinessPro.settings.buttonFontColor');
}

if ($Project->getConfig('templateBusinessPro.settings.colorBackground')) {
    $colorBackground = $Project->getConfig('templateBusinessPro.settings.colorBackground');
}

if ($Project->getConfig('templateBusinessPro.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateBusinessPro.settings.colorFooterLinks');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentBg')) {
    $colorMainContentBg = $Project->getConfig('templateBusinessPro.settings.colorMainContentBg');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentFont')) {
    $colorMainContentFont = $Project->getConfig('templateBusinessPro.settings.colorMainContentFont');
}


/**
 * font family
 */

$mainFontFamily = $Project->getConfig('templateBusinessPro.settings.mainFontFamily');


$Engine->assign(array(
    'colorFooterBackground' => $colorFooterBackground,
    'colorFooterFont'       => $colorFooterFont,
    'colorMain'             => $colorMain,
    'buttonFontColor'       => $buttonFontColor,
    'colorBackground'       => $colorBackground,
    'colorFooterLinks'      => $colorFooterLinks,
    'colorMainContentBg'    => $colorMainContentBg,
    'colorMainContentFont'  => $colorMainContentFont,
    'navPos'                => $Project->getConfig('templateBusinessPro.settings.navPos'),
    'pageMaxWidth'          => $Project->getConfig('templateBusinessPro.settings.pageMaxWidth'),
    'headerHeight'          => $Project->getConfig('templateBusinessPro.settings.headerHeight'),
    'headerHeightValue'     => $Project->getConfig('templateBusinessPro.settings.headerHeightValue'),
    'Background'            => $Background,
    'bgColorSwitcherPrefix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherPrefix'),
    'bgColorSwitcherSuffix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherSuffix'),
    'shadow'                => $Project->getConfig('templateBusinessPro.settings.shadow'),
    'menuShadow'            => $Project->getConfig('templateBusinessPro.settings.menuShadow'),
    'headerImagePosition'   => $Project->getConfig('templateBusinessPro.settings.headerImagePosition'),
    'logoHeight'            => $Project->getConfig('templateBusinessPro.settings.logoHeight'),
    'mainFontFamily'        => $mainFontFamily,
    'mainFontFamilyArt'     => $Project->getConfig('templateBusinessPro.settings.mainFontFamilyArt')
));


/**
 * full size
 */

$fullsize = false;
$pageMaxWidth = (int)$Project->getConfig('templateBusinessPro.settings.pageMaxWidth');

if (!$pageMaxWidth){
    $fullsize = true;
}


/**
 * own site type?
 */

$Engine->assign(array(
    'logo'          => $logo,
    'logoSmall'     => $logoSmall,
    'fullsize'      => $fullsize,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-businessprof:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBusinessPro.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'noHeader'     => $noHeader
));
