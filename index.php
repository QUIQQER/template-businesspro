<?php

/**
 * Emotion
 */

\QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');





/**
 * Project Logo
 */

$logo       = false;
$configLogo = $Project->getConfig('templateBusinessPro.settings.logo');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogo)) {
    $logo = $configLogo;
}

/**
 * Project Logo Small
 */

$logoSmall       = false;
$configLogoSmall = $Project->getConfig('templateBusinessPro.settings.logoSmall');

if (QUI\Projects\Media\Utils::isMediaUrl($configLogoSmall)) {
    $logoSmall = $configLogoSmall;
}

/**
 * no header?
 */

$noHeader = false;

switch ($Template->getLayoutType()) {
    case 'layout/startPage':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderStartPage');
        break;

    case 'layout/noSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderNoSidebar');
        break;

    case 'layout/rightSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderRightSidebar');
        break;

    case 'layout/leftSidebar':
        $noHeader = $Project->getConfig('templateBusinessPro.settings.noHeaderLeftSidebar');
        break;
}

/**
 * nav bar colors
 */

$navBarMainColor  = '#2d4d88';
$navBarHoverColor = '#4d6d97';
$navBarFontColor  = '#ffffff';

if ($Project->getConfig('templateBusinessPro.settings.navBarMainColor')) {
    $navBarMainColor = $Project->getConfig('templateBusinessPro.settings.navBarMainColor');
}

if ($Project->getConfig('templateBusinessPro.settings.navBarHoverColor')) {
    $navBarHoverColor = $Project->getConfig('templateBusinessPro.settings.navBarHoverColor');
}

if ($Project->getConfig('templateBusinessPro.settings.navBarFontColor')) {
    $navBarFontColor = $Project->getConfig('templateBusinessPro.settings.navBarFontColor');
}

/**
 * colors
 */

$colorFooterBackground = '#414141';
$colorFooterFont       = '#D1D1D1';
$colorMain             = '#dd151b';
$buttonFontColor       = '#ffffff';
$colorFooterLinks      = '#E6E6E6';
$colorMainContentBg    = '#ffffff';
$colorMainContentFont  = '#5d5d5d';

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

if ($Project->getConfig('templateBusinessPro.settings.colorFooterLinks')) {
    $colorFooterLinks = $Project->getConfig('templateBusinessPro.settings.colorFooterLinks');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentBg')) {
    $colorMainContentBg = $Project->getConfig('templateBusinessPro.settings.colorMainContentBg');
}

if ($Project->getConfig('templateBusinessPro.settings.colorMainContentFont')) {
    $colorMainContentFont = $Project->getConfig('templateBusinessPro.settings.colorMainContentFont');
}

$Engine->assign(array(
    'colorFooterBackground' => $colorFooterBackground,
    'colorFooterFont'       => $colorFooterFont,
    'colorMain'             => $colorMain,
    'buttonFontColor'       => $buttonFontColor,
    'colorFooterLinks'      => $colorFooterLinks,
    'colorMainContentBg'    => $colorMainContentBg,
    'colorMainContentFont'  => $colorMainContentFont,
    'navBarMainColor'       => $navBarMainColor,
    'navBarHoverColor'      => $navBarHoverColor,
    'navBarFontColor'       => $navBarFontColor,
    'navBarHeight'          => (int)$Project->getConfig('templateBusinessPro.settings.navBarHeight'),
    'pageMaxWidth'          => $Project->getConfig('templateBusinessPro.settings.pageMaxWidth'),
    'headerHeight'          => $Project->getConfig('templateBusinessPro.settings.headerHeight'),
    'headerHeightValue'     => (int)$Project->getConfig('templateBusinessPro.settings.headerHeightValue'),
    'bgColorSwitcherPrefix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherPrefix'),
    'bgColorSwitcherSuffix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherSuffix'),
    'navBarShadow'          => $Project->getConfig('templateBusinessPro.settings.navBarShadow'),
    'headerImagePosition'   => $Project->getConfig('templateBusinessPro.settings.headerImagePosition'),
    'searchShow'            => $Project->getConfig('templateBusinessPro.settings.searchShow'),
    'searchLink'            => $Project->getConfig('templateBusinessPro.settings.searchLink'),
    'headerPrefixFullSize'  => $Site->getAttribute('templateBusinessPro.settings.headerPrefixFullSize')
));


/**
 * own site type?
 */

$Engine->assign(array(
    'logo'          => $logo,
    'logoSmall'     => $logoSmall,
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-businessprof:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBusinessPro.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'noHeader'      => $noHeader
));
