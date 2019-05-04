<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'All Settings');
$this->params['breadcrumbs'][] = $this->title;
$development = Yii::$app->get('getsettings', true);

?>
<div class="all-settings-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php if($development->development){ ?>
                <?= Html::a(Yii::t('app', 'Create All Settings'), ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'title',
            'icon:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'buttons'=>[
                'fields' => function ($url, $model) {
                        $url = Url::to(['all-setting-fields/index', 'sid' => $model->id]);
                        $text = Html::a('<i class="glyphicon glyphicon-file"></i>', $url, ['class'=>'success p-0 openConfirmModal']);
                        return  $text;
                    },
                    'htmlsave' => function ($url, $model) {
                        $url = Url::to(['default/savesetting', 'id' => $model->id]);
                        $text = Html::a('<i class="glyphicon glyphicon-file"></i>', $url, ['class'=>'success p-0 openConfirmModal']);
                        return  $text;
                    },
                ],
                'template' => '{view}{update}{delete}{fields}{htmlsave}',   
            ],
        ],
    ]); ?>
</div>
