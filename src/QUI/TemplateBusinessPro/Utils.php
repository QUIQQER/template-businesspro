<?php

/**
 * This file contains QUI\TemplateBusinessPro\TemplateLoader
 */

namespace QUI\TemplateBusinessPro;

use QUI;

/**
 * Help Class for Template Business Pro
 *
 * @package QUI\TemplateBusinessPro
 * @author www.pcsg.de (Michael Danielczok)
 */
class Utils
{
    public static function getConfig($params)
    {
        $Project  = $params['Project'];
        $Site     = $params['Site'];
        $Template = $params['Template'];
        $Engine   = $params['Engine'];

        /**
         * Emotion
         */

        QUI\Utils\Site::setRecursivAttribute($Site, 'image_emotion');

        QUI\Utils\Site::setRecursivAttribute($Site, 'layout');


        /**
         * no header?
         */

        $showHeader = false;

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderStartPage');
                break;

            case 'layout/noSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderNoSidebar');
                break;

            case 'layout/rightSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderRightSidebar');
                break;

            case 'layout/leftSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderLeftSidebar');
                break;
        }

        /**
         * nav bar colors
         */

        $navBarMainColor = '#2d4d88';
        $navBarFontColor = '#ffffff';

        if ($Project->getConfig('templateBusinessPro.settings.navBarMainColor')) {
            $navBarMainColor = $Project->getConfig('templateBusinessPro.settings.navBarMainColor');
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

        $colorMainLighter = \QUI\Utils\Convert::colorBrightness($colorMain, 0.7);

        $Engine->assign(array(
            'Convert'               => new \QUI\Utils\Convert(),
            'colorFooterBackground' => $colorFooterBackground,
            'colorFooterFont'       => $colorFooterFont,
            'colorMain'             => $colorMain,
            'buttonFontColor'       => $buttonFontColor,
            'colorFooterLinks'      => $colorFooterLinks,
            'colorMainContentBg'    => $colorMainContentBg,
            'colorMainContentFont'  => $colorMainContentFont,
            'navBarMainColor'       => $navBarMainColor,
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

        /**
         * own site type?
         */

        $Engine->assign(array(
            'ownSideType'   =>
                strpos($Site->getAttribute('type'), 'quiqqer/template-businesspro:') !== false
                    ? 1 : 0,
            'quiTplType'    => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'BricksManager' => \QUI\Bricks\Manager::init(),
            'showHeader'    => $showHeader
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

        /**
         * Mega menu
         */

        $MegaMenu = new QUI\Menu\MegaMenu(array(
            'showStart' => false
        ));

        $MegaMenu->prependHTML('<div class="header-bar-inner-logo">
        <a href="' . $Project->firstChild()->getUrl() . '" class="page-header-logo">
         <img src="' . $Project->getMedia()->getLogo() . '"/></a>
     </div>');

        if ($Project->getConfig('templateBusinessPro.settings.searchShow')) {
            $MegaMenu->appendHTML('<div class="header-bar-search">
        <a href="' . $Project->getConfig('templateBusinessPro.settings.searchLink') . '" class="header-bar-search-link">
            <i class="fa fa-search header-bar-search-icon"></i>
        </a>    
    </div>');
        }

        $Engine->assign(array(
            'MegaMenu' => $MegaMenu
        ));
    }
}
