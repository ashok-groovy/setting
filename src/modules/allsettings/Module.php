<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings;

use yii;
use vendor\yii2generalsetting\yii2generalsetting\modules\assets\AllAsset;
/**
 * allsettings module definition class
 */
class Module extends \yii\base\Module 
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        // AllAsset::register($this);
        parent::init();
    }
}
