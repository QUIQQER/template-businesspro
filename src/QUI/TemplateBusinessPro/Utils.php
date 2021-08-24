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
 *
 * @return array
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
            return QUI\Cache\Manager::get(
                'quiqqer/templateBusinessPro/' . $params['Site']->getId() . $params['Project']->getLang()
            );
        } catch (QUI\Exception $Exception) {
        }

        $config = array();

        /* @var $Project QUI\Projects\Project */
        $Project  = $params['Project'];
        $Template = $params['Template'];

        /**
         * no header?
         * no breadcrumb?
         * Body Class
         *
         * own site type
         */

        $showHeader     = false;
        $showBreadcrumb = false;

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderStartPage');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbStartPage');
                break;

            case 'layout/noSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderNoSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbNoSidebar');
                break;

            case 'layout/rightSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderRightSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbRightSidebar');
                break;

            case 'layout/leftSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderLeftSidebar');
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

        $settingsCSS = include 'settings.css.php';

        $config += array(
            'quiTplType'     => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'showHeader'     => $showHeader,
            'showBreadcrumb' => $showBreadcrumb,
            'settingsCSS'    => '<style>' . $settingsCSS . '</style>',
            'typeClass'      => 'type-' . str_replace(array('/', ':'), '-', $params['Site']->getAttribute('type')),
            'showPageTitle'  => $showPageTitle,
            'showPageShort'  => $showPageShort
        );

        // set cache
        QUI\Cache\Manager::set(
            'quiqqer/templateBusinessPro/' . $params['Site']->getId() . $Project->getLang(),
            $config
        );

        return $config;
    }
}
