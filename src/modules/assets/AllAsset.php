<?php
namespace vendor\yii2generalsetting\yii2generalsetting\modules\assets;

use yii;
use yii\web\AssetBundle;

class AllAsset extends AssetBundle
{
    
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $sourcePath = '@vendor/yii2generalsetting/modules/assest';
    public $css = [
        'css/social.css',
        'css/toolkit.css'
    ];
    public $js = [
        'js/jquery.min.js',
        'js/social.js',
        'js/toolkit.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}