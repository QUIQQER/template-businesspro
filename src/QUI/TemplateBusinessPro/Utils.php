<?php

/**
 * This file contains QUI\TemplateBusinessPro\TemplateLoader
 */

namespace QUI\TemplateBusinessPro;

use QUI;

/**
 * Help Class for Template Business Pro
 *
 * @return array
 * @author www.pcsg.de (Michael Danielczok)
 *
 * @package QUI\TemplateBusinessPro
 */
class Utils
{
    /**
     * @param array $params
     * @return array
     */
    public static function getConfig($params)
    {
        $cacheName = md5($params['Project']->getName() . $params['Project']->getLang() . $params['Site']->getId());

        try {
            return QUI\Cache\Manager::get(
                'quiqqer/templateBusinessPro/' . $cacheName
            );
        } catch (QUI\Exception $Exception) {
        }

        $config = [];

        /* @var $Project QUI\Projects\Project */
        $Project = $params['Project'];
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

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderStartPage');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbStartPage');
                break;

            case 'layout/noSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderNoSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbNoSidebar');
                break;

            case 'layout/rightSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderRightSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbRightSidebar');
                break;

            case 'layout/leftSidebar':
                $showHeader = $Project->getConfig('templateBusinessPro.settings.showHeaderLeftSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbLeftSidebar');
                break;
        }


        $showPageTitle = $params['Site']->getAttribute('templateBusinessPro.showTitle');
        $showPageShort = $params['Site']->getAttribute('templateBusinessPro.showShort');

        /* site own show header */
        switch ($params['Site']->getAttribute('templateBusinessPro.showEmotion')) {
            case 'show':
                $showHeader = true;
                break;
            case 'hide':
                $showHeader = false;
        }

        /**
         * Theme color
         */

        $themeColor = false;
        if ($Project->getConfig('templateBusinessPro.settings.themeColor')) {
            $themeColor = $Project->getConfig('templateBusinessPro.settings.themeColor');
        }

        $settingsCSS = include 'settings.css.php';

        $config += [
            'quiTplType' => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'showHeader' => $showHeader,
            'showBreadcrumb' => $showBreadcrumb,
            'settingsCSS' => '<style data-no-cache="1">' . $settingsCSS . '</style>',
            'typeClass' => 'type-' . str_replace(['/', ':'], '-', $params['Site']->getAttribute('type')),
            'showPageTitle' => $showPageTitle,
            'showPageShort' => $showPageShort,
            'themeColor' => $themeColor,
            'useSlideOutMenu' => true, // for now is always true because quiqqer use currently only SlideOut nav
        ];

        // set cache
        QUI\Cache\Manager::set(
            'quiqqer/templateBusinessPro/' . $cacheName,
            $config
        );

        return $config;
    }
}
