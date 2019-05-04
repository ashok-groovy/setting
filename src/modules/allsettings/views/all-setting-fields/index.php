<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFieldsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Setting Fields');
$this->params['breadcrumbs'][] = $this->title;
$development = Yii::$app->get('getsettings', true);
?>
<div class="all-setting-fields-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php if($development->development){ ?>
            <p>
                <?= Html::a(Yii::t('app', 'Create Setting Fields'), ['create?sid='.$_GET['sid']], ['class' => 'btn btn-success']) ?>
                <?= Html::a(Yii::t('app', 'Bulk Create Setting Fields'), ['bulkcreate?sid='.$_GET['sid']], ['class' => 'btn btn-primary']) ?>
            </p>
    <?php } ?>

    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            
            's_label',
            's_type',
            's_value:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'buttons'=>[
                    'delete' => function ($url, $model) {
                        $url = Url::to(['all-setting-fields/delete', 'id' => $model->id,'sid'=>$_GET['sid']]);
                        $text = Html::a('<i class="glyphicon glyphicon-trash"></i>', $url, ['class'=>'success p-0 openConfirmModal','data-confirm'=>"Are you sure you want to delete this item?","data-method"=>"post"]);
                        return  $text;
                    },
                ],
                'template' => '{view}{update}{delete}',   
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
