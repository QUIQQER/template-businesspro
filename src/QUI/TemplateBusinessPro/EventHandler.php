<?php
/**
 * Created by PhpStorm.
 * User: michael
 * Date: 04.10.16
 * Time: 09:37
 */

namespace QUI\TemplateBusinessPro;

use QUI;

class EventHandler
{
    public static function onProjectConfigSave()
    {

        try {
            return QUI\Cache\Manager::clear('quiqqer/templateBusinessPro');
        } catch (QUI\Exception $Exception) {
        }

    }
}
