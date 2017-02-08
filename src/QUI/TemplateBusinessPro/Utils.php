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
                'quiqqer/templateBusinessPro/' . $params['Site']->getId()
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
        $bodyClass      = '';

        switch ($Template->getLayoutType()) {
            case 'layout/startPage':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderStartPage');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbStartPage');
                $bodyClass      = 'startpage';
                break;

            case 'layout/noSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderNoSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbNoSidebar');
                $bodyClass      = 'left-sidebar';
                break;

            case 'layout/rightSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderRightSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbRightSidebar');
                $bodyClass      = 'right-sidebar';
                break;

            case 'layout/leftSidebar':
                $showHeader     = $Project->getConfig('templateBusinessPro.settings.showHeaderLeftSidebar');
                $showBreadcrumb = $Project->getConfig('templateBusinessPro.settings.showBreadcrumbLeftSidebar');
                $bodyClass      = 'no-sidebar';
                break;
        }

        $settingsCSS = include 'settings.css.php';

        $config += array(
            'quiTplType'     => $Project->getConfig('templateBusinessPro.settings.standardType'),
            'showHeader'     => $showHeader,
            'showBreadcrumb' => $showBreadcrumb,
            'settingsCSS'    => '<style>' . $settingsCSS . '</style>',
            'typeClass'      => 'type-' . str_replace(array('/', ':'), '-', $params['Site']->getAttribute('type')),
            'bodyClass'      => $bodyClass
        );

        // set cache
        QUI\Cache\Manager::set(
            'quiqqer/templateBusinessPro/' . $params['Site']->getId(),
            $config
        );

        return $config;
    }
}
