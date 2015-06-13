<?php

namespace eDemy\BackgroundBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class eDemyBackgroundBundle extends Bundle
{
    public static function getBundleName($type = null)
    {
        if ($type == null) {

            return 'eDemyBackgroundBundle';
        } else {
            if ($type == 'Simple') {

                return 'Background';
            } else {
                if ($type == 'simple') {

                    return 'background';
                }
            }
        }
    }

    public static function eDemyBundle() {

        return true;
    }
}
