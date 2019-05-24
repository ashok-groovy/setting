General Setting - V1
===============
General Setting

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yii2generalsetting/yii2generalsetting "*"
```

or add

```
"yii2generalsetting/yii2generalsetting": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
'components' => [
    'getsettings' => [
        'class' => 'vendor\yii2generalsetting\yii2generalsetting\src\components\Groovysettings',
        'development'=>false,
    ],
],

'modules' => [
    'allsettings' => [
        'class' => 'vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\Module',
    ]
],

open link YOUR_SITE_URL/allsetting


Get Data 
-----

Yii::$app->getsettings->Getallsttings('json'); //get json format
Yii::$app->getsettings->Getallsttings('array'); //get array format

//Single Value By Name
$apiKey = Yii::$app->getsettings->Getcategorysingleconfig('Front Settings','Google Key'); //Front Settings = Setting Name and Google Key = Field Name
