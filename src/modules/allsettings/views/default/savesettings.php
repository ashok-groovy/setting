<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;

// print_r($savedData);die;
?>
<style>
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 75%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}
.col-100 label {
    width: 20%;
}
label {
  padding: 12px;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}
.col-100 {
  float: left;
  width: 100%;
  margin-top: 6px;
}


/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

.col-100 span {
    font-weight: 900;
    margin: 10px;
}

.col-100 input,.col-100 span {
    display: inline-block;
}

.submit_save_button {
    float: none !important;
    margin: 0 auto !important;
}

.m0auto {
    text-align: center;
    padding: 20px 20px 10px;
}

.settingDiv {
    border: 1px solid #ddd;
    padding: 2rem 3rem;
    background-color: #fff;
    box-shadow: 0 0 10px 3px rgba(0, 0, 0, 0.06);
}
.settingDiv h2 {
    border-bottom: 1px solid #ddd;
    padding-bottom: 1.5rem;
    font-size: 24px;
    color: #484848;
    letter-spacing: 1px;
}
form {
    border: 1px solid #ddd;
    padding: 1rem 1.6rem;
}
form .row {
    border-bottom: 1px solid #ddd;
}
.col-100 label {
    width: 20%;
    letter-spacing: 1px;
    color: rgba(72, 72, 72, 0.74);
}
.col-100 span img {
    width: 140px;
    height: auto;
    border: 1px solid #ddd;
    padding: 0.5rem;
    border-radius: 5px;
background-color: rgba(238, 238, 238, 0.35);
}
.row.m0auto:last-child {
    border-bottom: 0;
}
.col-100 select, .col-100 input{
    background-color: rgba(255, 255, 255, 0.28);
}
/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-100, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
<div class="container settingDiv">
   
    <h2><?= $name;?></h2>
    <form action="<?php echo Url::base(true);?>/allsettings/default/savesetting/?id=<?php echo $_GET['id']?>" method="post" enctype="multipart/form-data">
    <?php if(!empty($data)){
        foreach($data as $k=>$c){
                $html = '';
                $save = isset($savedData[$c['id']]) ? $savedData[$c['id']] : "";
                $file = '';
                if($c['s_type'] == 'file'){
                  if($save != '' && $c['s_type'] == 'file'){
                    
                    $url = Url::base(true);
                    $path = Yii::getAlias('@app').'/../';
                    // echo $url;die;
                    if(file_exists($path.$save)){
                      $check = getimagesize($path.$save);
                      if($check !== false) {
                          $file = '<img src="'.$url.'/'.$save.'" width=200/>';
                          $uploadOk = 1;
                      } 
                    }
                   
                  }
                  $html = '<input type="'.$c['s_type'].'" value="'.$save.'" id="'.$c['s_label'].'" data-type="'.$c['s_value'].'" name="'.$c['id'].'"><span>'.$file.'</span>';
                }
                if($c['s_type'] == 'text' || $c['s_type'] == 'color'){
                  $html = '<input type="'.$c['s_type'].'" value="'.$save.'" id="'.$c['s_label'].'" data-type="'.$c['s_value'].'" name="setting['.$c['id'].']">';
                }
                if($c['s_type'] == 'files'){
                    $html = '<input type="file" multiple id="'.$c['s_label'].'" name="setting['.$c['id'].']">';
                }
                
                if($c['s_type'] == 'checkbox' || $c['s_type'] == 'radio'){
                    $rc = '';
                    $rcArray = explode(",",$c['s_value']);
                    if(!empty($rcArray)){
                        foreach($rcArray as $df){
                            $checked = "";
                            if(isset($savedData[$c['id']]) && $savedData[$c['id']] != ''){
                                $checked = "";
                                $saveArray = explode(",",$savedData[$c['id']]);
                                if(in_array($df,$saveArray)){
                                  $checked = "checked='checked'";
                                }
                            }
                            $rc .= '<input type="'.$c['s_type'].'" id="'.$df.'" '.$checked.' name="setting['.$c['id'].'][]" value='.$df.'><span for="'.$df.'">'.$df.'</span>';
                        }
                    }
                    $html =  $rc;
                }
                if($c['s_type'] == 'dropdown'){
                    $rc = '<select name="setting['.$c['id'].']">';
                    $rcArray = explode(",",$c['s_value']);
                    $selected = '';
                    if(!empty($rcArray)){
                        foreach($rcArray as $df){
                            $selected = (isset($savedData[$c['id']]) && $savedData[$c['id']] == $df) ? "selected='selected'" : "";
                            
                            $rc .= '<option '.$selected.'>'.$df.'</option>';
                        }
                        $rc .= '</select>';
                    }
                    $html =  $rc;
                }
            ?>
    <div class="row">
      <!-- <div class="col-25">
        
      </div> -->
      <div class="col-100">
      <label for="<?php echo $c['s_label']?>"><?php echo $c['s_label']?></label>
        <?= $html;?>
      </div>
    </div>
    <?php } }?>
    <div class="row m0auto">
      <input type="submit" name="submit" class="btn btn-primary submit_save_button" value="Submit">
      <br>
      <br>
      <?php
        echo Yii::$app->session->getFlash('success_setting');
      ?>
    </div>
    </form>
</div>

<script>
setTimeout(function() {
    $(document).ready(function(){
        $('input[type="file"]').change(function () {
            var ext = $(this).attr('data-type');
            var fileExtension = ext.split(",");
            if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1 && ext != '') {
                alert("Only formats are allowed : "+fileExtension.join(', '));
                $(this).val("");
            }
        });
    })
}, 1000);

</script>
