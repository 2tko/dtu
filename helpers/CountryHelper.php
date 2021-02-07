<?php

namespace app\helpers;

use \Yii;

class CountryHelper
{
    public static function all(): array
    {
        return Yii::$app->params['countries'];
    }
}