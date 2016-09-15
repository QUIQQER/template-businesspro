<?php

/**
 * Emotion
 */

QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

QUI\Utils\Site::setRecursivAttribute($Site, 'layout');


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
    'shareShow'             => $Project->getConfig('templateBusinessPro.settings.shareShow'),
    'shareFacebook'         => $Project->getConfig('templateBusinessPro.settings.shareFacebook'),
    'shareTwitter'          => $Project->getConfig('templateBusinessPro.settings.shareTwitter'),
    'shareGoogle'           => $Project->getConfig('templateBusinessPro.settings.shareGoogle'),
    'navPos'                => $Project->getConfig('templateBusinessPro.settings.navPos')
));

//$countUrl = file_get_contents("https://graph.facebook.com/?id=http://www.google.com");
//$count = json_decode($countUrl, true);
//var_dump($count);
//echo $count['shares'];
//echo isset($count['shares'])?intval($count['shares']):0;
//$Facebook1 = new QUI\Socialshare\Shares\Facebook(array(
//    'theme'     => 'flat',
//    'showLabel' => true,
//    'showIcon'  => true
//));
//
//$Facebook1->setTheme('flat');


$Facebook1 = new QUI\Socialshare\Shares\Facebook(array(
    'theme'     => 'flat',
    'showLabel' => true,
    'showIcon'  => true
));

//echo $Facebook1->create();
//$Facebook1->setStyle('outline', '2px solid red');
//$Facebook1->setStyles(array(
//    'font-size' => '20px',
//    'outline' => '2px solid black'
//));

$Engine->assign(array(
    'Facebook'  => new QUI\Socialshare\Shares\Facebook(array()),
    'Pinterest' => new QUI\Socialshare\Shares\Pinterest(array()),
    'Twitter'   => new QUI\Socialshare\Shares\Twitter(array()),
    'Google'    => new QUI\Socialshare\Shares\Google(array()),
    'Mail'      => new QUI\Socialshare\Shares\Mail(array())
));

//$Facebook1->setStyle('outline', '2px solid red !important');
//$Facebook1->setStyle('border', '2px solid red');
//echo $Facebook1->create();


//$Facebook = new QUI\Socialshare\Shares\Facebook;
//$Facebook->showLabel();
//$Facebook->showIcon();
//echo $Facebook->create();
//$Facebook->setTheme('flat');
//echo print_r(array_keys($Facebook->getAttributes()));
//echo $Facebook->getAttribute('theme');
/**
 * own site type?
 */

$Engine->assign(array(
    'ownSideType'   =>
        strpos($Site->getAttribute('type'), 'quiqqer/template-businesspro:') !== false
            ? 1 : 0,
    'quiTplType'    => $Project->getConfig('templateBusinessPro.settings.standardType'),
    'BricksManager' => \QUI\Bricks\Manager::init(),
    'noHeader'      => $noHeader
));


/**
 * Body Class
 */

$bodyClass = '';

switch ($Template->getLayoutType()) {
    case 'layout/startpage':
        $bodyClass = 'homepage';
        break;

    case 'layout/leftSidebar':
        $bodyClass = 'left-sidebar';
        break;

    case 'layout/rightSidebar':
        $bodyClass = 'right-sidebar';
        break;

    default:
        $bodyClass = 'no-sidebar';
}

$Engine->assign('bodyClass', $bodyClass);

$Engine->assign(
    'typeClass',
    'type-' . str_replace(array('/', ':'), '-', $Site->getAttribute('type'))
);

/* Menu */
$MegaMenu = new QUI\Menu\MegaMenu(array(
    'showStart' => false
));

$MegaMenu->prependHTML('<div class="header-bar-inner-logo">
        <a href="' . '#' . '" class="page-header-logo">
         <img src="' . $Project->getMedia()->getLogo() . '"/></a>
     </div>');

$MegaMenu->appendHTML('<div class="header-bar-search">
        <a href="' . $Project->getConfig('templateBusinessPro.settings.searchLink') . '" class="header-bar-search-link">
            <i class="fa fa-search header-bar-search-icon"></i>
        </a>    
    </div>');

$Engine->assign(array(
    'MegaMenu' => $MegaMenu
));
