<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettings */

$this->title = Yii::t('app', 'Create All Settings');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'All Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-settings-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
