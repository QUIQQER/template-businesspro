<?php

/**
 * This file contains \QUI\TemplateBusinessPro\EventHandler
 */

namespace QUI\TemplateBusinessPro;

use QUI;

/**
 * Event Class
 *
 * @author www.pcsg.de (Michael Danielczok)
 */
class EventHandler
{
    /**
     * Clear system cache on project save
     *
     * @return void
     */
    public static function onProjectConfigSave(): void
    {
        QUI\Cache\Manager::clear('quiqqer/templateBusinessPro');
    }

    /**
     * Clear system cache on site save
     *
     * @param $Site QUI\Projects\Site
     * @return void
     * @throws QUI\Exception
     */
    public static function onSiteSave(QUI\Interfaces\Projects\Site $Site): void
    {
        $Project = $Site->getProject();
        $cacheName = md5($Project->getName() . $Project->getLang() . $Site->getId());

        try {
            QUI\Cache\Manager::clear('quiqqer/templateBusinessPro' . $cacheName);
        } catch (QUI\Exception $Exception) {
            QUI\System\Log::writeException($Exception);
        }
    }
}
