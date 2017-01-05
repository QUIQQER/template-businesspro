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
    /**
     * @param array $params
     * @return array
     */
    public static function getConfig($params)
    {
        try {
            return QUI\Cache\Manager::get('quiqqer/templateBusinessPro');
        } catch (QUI\Exception $Exception) {
        }

        $config = array();

        /* @var $Project QUI\Projects\Project */
        $Project  = $params['Project'];
        $Site     = $params['Site'];
        $Template = $params['Template'];

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
         * no breadcrumb?
         */

        $showBreadcrumb = false;

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbStartPage');
                break;

            case 'layout/noSidebar':
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbNoSidebar');
                break;

            case 'layout/rightSidebar':
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbRightSidebar');
                break;

            case 'layout/leftSidebar':
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbLeftSidebar');
                break;
        }

        /**
         * nav bar colors
         */

        $navBarMainColor      = '#2d4d88';
        $navBarFontColor      = '#ffffff';
        $mobileFontColor      = '#fff';
        $mobileMenuBackground = '#252122';

        if ($Project->getConfig('templateBusinessPro.settings.navBarMainColor')) {
            $navBarMainColor = $Project->getConfig('templateBusinessPro.settings.navBarMainColor');
        }

        if ($Project->getConfig('templateBusinessPro.settings.navBarFontColor')) {
            $navBarFontColor = $Project->getConfig('templateBusinessPro.settings.navBarFontColor');
        }

        if ($Project->getConfig('templateBusinessPro.settings.mobileFontColor')) {
            $mobileFontColor = $Project->getConfig('templateBusinessPro.settings.mobileFontColor');
        }

        if ($Project->getConfig('templateBusinessPro.settings.mobileMenuBackground')) {
            $mobileMenuBackground = $Project->getConfig('templateBusinessPro.settings.mobileMenuBackground');
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

        $config += array(
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
            'mobileFontColor'       => $mobileFontColor,
            'mobileMenuBackground'  => $mobileMenuBackground,
            'navBarHeight'          => (int)$Project->getConfig('templateBusinessPro.settings.navBarHeight'),
            'pageMaxWidth'          => $Project->getConfig('templateBusinessPro.settings.pageMaxWidth'),
            'headerHeight'          => $Project->getConfig('templateBusinessPro.settings.headerHeight'),
            'headerHeightValue'     => (int)$Project->getConfig('templateBusinessPro.settings.headerHeightValue'),
            'bgColorSwitcherPrefix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherPrefix'),
            'bgColorSwitcherSuffix' => $Project->getConfig('templateBusinessPro.settings.bgColorSwitcherSuffix'),
            'navBarShadow'          => $Project->getConfig('templateBusinessPro.settings.navBarShadow'),
            'headerImagePosition'   => $Project->getConfig('templateBusinessPro.settings.headerImagePosition'),
            'shareShow'             => $Project->getConfig('templateBusinessPro.settings.shareShow'),
            'shareFacebook'         => $Project->getConfig('templateBusinessPro.settings.shareFacebook'),
            'shareTwitter'          => $Project->getConfig('templateBusinessPro.settings.shareTwitter'),
            'shareGoogle'           => $Project->getConfig('templateBusinessPro.settings.shareGoogle'),
            'navPos'                => $Project->getConfig('templateBusinessPro.settings.navPos')
        );

        /**
         * own site type?
         */

        $config += array(
            'quiTplType'     => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'BricksManager'  => \QUI\Bricks\Manager::init(),
            'showHeader'     => $showHeader,
            'showBreadcrumb' => $showBreadcrumb
        );


        /**
         * Body Class
         */

        $bodyClass = '';

        switch ($Template->getLayoutType()) {
            case 'layout/startpage':
                $bodyClass = 'startpage';
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

        $config += array(
            'typeClass' => 'type-' . str_replace(array('/', ':'), '-', $Site->getAttribute('type')),
            'bodyClass' => $bodyClass
        );

        /**
         * Mega menu
         */

        $searchMobile = '';

        $MegaMenu    = $params['MegaMenu'];

        $types = array(
            'quiqqer/sitetypes:types/search',
            'quiqqer/search:types/search'
        );

        $searchSites = $Project->getSites(array(
            'where' => array(
                'type' => array(
                    'type' => 'IN',
                    'value' => $types
                )
            ),
            'limit' => 1
        ));

        if (count($searchSites)) {
            try {
                $searchUrl = $searchSites[0]->getUrlRewritten();

                $searchMobile = '<div class="quiqqer-menu-megaMenu-mobile-search hide-on-desktop"
                                  style="width: auto; font-size: 30px !important;">
                    <a href="' . $searchUrl . '"
                    class="header-bar-search-link searchMobile">
                        <i class="fa fa-search header-bar-search-icon"></i>
                    </a>
                </div>';
            } catch (QUI\Exception $Exception) {
                QUI\System\Log::addNotice($Exception->getMessage());
            }
        }

        $alt = "";
        if ($Project->getMedia()->getLogoImage()) {
            $alt = $Project->getMedia()->getLogoImage()->getAttribute('title');
        }
        

        $MegaMenu->prependHTML(
            '<div class="header-bar-inner-logo">
                <a href="' . URL_DIR . '" class="page-header-logo">
                <img src="' . $Project->getMedia()->getLogo() . '" alt="' . $alt . '"/></a>
            </div>'
        );

        try {
            QUI::getPackage('quiqqer/search');
            $Locale = QUI::getLocale();

            $MegaMenu->appendHTML(
                '<div class="header-bar-suggestSearch hide-on-mobile">
                    <input type="search" data-qui="package/quiqqer/search/bin/controls/Suggest" 
                    placeholder="' . $Locale->get('quiqqer/template-businesspro', 'navbar.search.text') . '"/>
                </div>' .
                $searchMobile
            );
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::addNotice($Exception->getMessage());
        }

        $config += array(
            'MegaMenu' => $MegaMenu
        );

        $config += array(
            'Breadcrumb' => $params['Breadcrumb']
        );

        QUI\Cache\Manager::set(
            'quiqqer/templateBusinessPro',
            $config
        );

        return $config;
    }
}
