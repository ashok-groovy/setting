<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFields */
/* @var $form yii\widgets\ActiveForm */
if($model->isNewRecord == 1){
    $model->s_id = $_GET['sid'];
}
?>
<style>
.mainSclass .col22 {
    width: 22%;
    display: inline-block;
    margin: 10px;
}

.mainSclass .help-block {
    float: left;
}
</style>

<div class="all-setting-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_id')->dropDownList($allSettings); ?>

    <div class="mainSclass ApendDiv">
        <div class="clondiv">
            <div class="col22">
                <?= $form->field($model, 's_label[]')->textInput() ?>
            </div>
            <div class="col22">
                <?= $form->field($model, 's_type[]')->dropDownList([ 'text' => 'Text', 'radio' => 'Radio', 'checkbox' => 'Checkbox', 'file' => 'File', 'files' => 'Files','textarea'=>'Textarea'  ], ['prompt' => '']) ?>
            </div>
            <div class="col22">
                <?= $form->field($model, 's_value[]')->textInput() ?>
            </div>
            <div class="col22">
                <button class="btn btn-success btn-clone-setting"><i class="fa fa-plus"></i></button>
            </div>
        </div>
    </div>
    

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<script>
setTimeout(function() {
    $(document).ready(function(){
        $(document).on("click",".btn-clone-setting",function(e) {
            e.preventDefault();
            var html = $('.clondiv').first().clone();
            html.find('label').remove();
            html.find('input').val("");
            $(this).closest('.ApendDiv').after().append(html);
        });
    })
}, 1000);

</script>