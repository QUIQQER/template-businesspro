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
         * no breadcrumb?
         * Body Class
         *
         * own site type
         */

        $showHeader = false;
        $showBreadcrumb = false;
        $bodyClass = '';

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderStartPage');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbStartPage');
                $bodyClass = 'startpage';
                break;

            case 'layout/noSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderNoSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbNoSidebar');
                $bodyClass = 'left-sidebar';
                break;

            case 'layout/rightSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderRightSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbRightSidebar');
                $bodyClass = 'right-sidebar';
                break;

            case 'layout/leftSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderLeftSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbLeftSidebar');
                $bodyClass = 'no-sidebar';
                break;
        }

        $settingsCSS = include 'settings.css.php';

        $config += array(
            'quiTplType'     => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'BricksManager'  => \QUI\Bricks\Manager::init(),
            'showHeader'     => $showHeader,
            'showBreadcrumb' => $showBreadcrumb,
            'settingsCSS' => '<style>' . $settingsCSS . '</style>',
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
