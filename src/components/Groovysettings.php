<?php
namespace vendor\yii2generalsetting\yii2generalsetting\src\components;
 
use Yii;
use yii\base\Component;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettings;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\SettingSaved;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingsSearch;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingFields;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Url;


class Groovysettings extends Component {
   
    public function Getcategoryconfig($cname,$type = "json"){       
        $getID = AllSettings::find()->where(["title"=>$cname])->one();
        if(!empty($getID)){
            $id = $getID->id;
            $data = AllSettingFields::find()->where(['s_id'=>$id])->asArray()->all();       
            $result = ArrayHelper::getColumn($data, 'id');            
            $savedData = SettingSaved::find()->where('f_id IN('.implode(",",$result).')')->asArray()->all();
            $savedData = ArrayHelper::map($savedData, 'f_id','value');
            $newArray = [];
            if(!empty($savedData)){
                foreach($savedData as $k=>$d){
                    $filedVal = AllSettingFields::find()->where(['id'=>$k])->asArray()->one();
                    if($filedVal['s_type'] == 'file'){                   
                        $url = Url::base(true);
                        $path = Yii::getAlias('@app').'/../';
                        // echo $url;die;
                        $check = getimagesize($path.$d);
                        if($check !== false) {
                            $newArray[$filedVal['s_label']] = $url.'/'.$d; 
                            $uploadOk = 1;
                        } 
                    }else{
                        $newArray[$filedVal['s_label']] = $d; 
                    }
                }
            }
            if($type == 'json'){
                return json_encode($newArray);die;
            }else if($type == 'array'){
                return $newArray;
            }
        }else{
            return "No Record";
        }
    }

    public function Getallsttings($type = "json"){
        $allSettings = AllSettings::find()->all();
        $dataArray = [];
        if(!empty($allSettings)){
            foreach($allSettings as $k=>$v){
                $dataArray[$v->title] = $this->Getcategoryconfig($v->title,$type);
            }
        }
        return $dataArray;
    }

    public function Getcategorysingleconfig($cname,$fname,$type = "json"){       
        $getID = AllSettings::find()->where(["title"=>$cname])->one();
        $newArray = '';
        if(!empty($getID)){
            $id = $getID->id;
            $data = AllSettingFields::find()->where(['s_id'=>$id,'s_label'=>$fname])->asArray()->all();       
            $result = ArrayHelper::getColumn($data, 'id');
            
            $savedData = SettingSaved::find()->where('f_id IN('.implode(",",$result).')')->asArray()->all();
            $savedData = ArrayHelper::map($savedData, 'f_id','value');
            
            if(!empty($savedData)){
                foreach($savedData as $k=>$d){
                    $filedVal = AllSettingFields::find()->where(['id'=>$k])->asArray()->one();
                    if($filedVal['s_type'] == 'file'){                   
                        $url = Url::base(true);
                        $path = Yii::getAlias('@app').'/../';
                        // echo $url;die;
                        $check = getimagesize($path.$d);
                        if($check !== false) {
                            $newArray = $url.'/'.$d; 
                            $uploadOk = 1;
                        } 
                    }else{
                        $newArray = $d; 
                    }
                }
            }
            
        }
        return $newArray;
    }
}