<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFields */

$this->title = Yii::t('app', 'Update All Setting Fields: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'All Setting Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="all-setting-fields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'allSettings'=>$allSettings,
    ]) ?>

</div>
