<?php
/**
 * This file contains \QUI\TemplateBusinessPro\EventHandler
 */

namespace QUI\TemplateBusinessPro;

use QUI;

/**
 * Event Class
 *
 *@author www.pcsg.de (Michael Danielczok)
 */
class EventHandler
{
    /**
     * Clear system cache on project save
     *
     * @return void
     */
    public static function onProjectConfigSave()
    {
        try {
            QUI\Cache\Manager::clear('quiqqer/templateBusinessPro');
        } catch (QUI\Exception $Exception) {
        }
    }
}
