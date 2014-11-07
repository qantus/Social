<?php
/**
 * 
 *
 * All rights reserved.
 * 
 * @author Falaleev Maxim
 * @email max@studio107.ru
 * @version 1.0
 * @company Studio107
 * @site http://studio107.ru
 * @date 07/11/14.11.2014 22:31
 */

namespace Modules\Social\Helpers;

use Mindy\Base\Mindy;
use Mindy\Utils\RenderTrait;

class SocialHelper
{
    use RenderTrait;

    public static function render($template = 'social/_social.html')
    {
        $module = Mindy::app()->getModule('Social');
        echo self::renderTemplate($template, [
            'providers' => $module->social->getProviders()
        ]);
    }
}
