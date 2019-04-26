<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettings */

$this->title = Yii::t('app', 'Update All Settings: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'All Settings'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="all-settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
