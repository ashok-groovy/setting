<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model vendor\yii2generalsetting\yii2generalsetting\modules\allsettings\models\AllSettingFields */
/* @var $form yii\widgets\ActiveForm */
$label = "Value";
if($model->s_type == "file"){
    $label = "Enter File Type";
}
if($model->isNewRecord == 1){
    $model->s_id = $_GET['sid'];
    
    
}
?>

<div class="all-setting-fields-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 's_id')->dropDownList($allSettings) ?>

    <?= $form->field($model, 's_label')->textInput() ?>

    <?= $form->field($model, 's_type')->dropDownList([ 'text' => 'Text', 'radio' => 'Radio', 'checkbox' => 'Checkbox', 'file' => 'File', 'files' => 'Files','dropdown'=>'DropDown','color'=>'Colorpicker','textarea'=>'Textarea' ], ['prompt' => '']) ?>

    <?= $form->field($model, 's_value')->textInput()->label($label); ?>

    <?= $form->field($model, 's_note')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script>
setTimeout(function() {
    $(document).ready(function(){
        // alert(6552);
        $(document).on("change","#allsettingfields-s_type",function(e) {
            e.preventDefault();
            var old_val = $('.field-allsettingfields-s_value').find('label').text();
            if($(this).val() == 'file'){
                $('.field-allsettingfields-s_value').find('label').text('Enter File Type');
                $('#allsettingfields-s_value').attr("placeholder",'Like jpg,png,jpeg');
            }else{
                $('.field-allsettingfields-s_value').find('label').text('Value');
                $('#allsettingfields-s_value').attr("placeholder",'');

            }
        });
    })
}, 1000);

</script>
