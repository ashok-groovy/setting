<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFields */

$this->title = Yii::t('app', 'Create All Setting Fields');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'All Setting Fields'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="all-setting-fields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'allSettings'=>$allSettings,
    ]) ?>

</div>
