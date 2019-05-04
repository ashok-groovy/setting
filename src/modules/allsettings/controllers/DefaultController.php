<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\controllers;

use Yii;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettings;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\SettingSaved;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingsSearch;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingFields;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\helpers\Url;
use yii\db\Schema;



/**
 * DefaultController implements the CRUD actions for AllSettings model.
 */
class DefaultController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $enableCsrfValidation = false;
    public $development = true;
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function init(){
        $this->createTableallSettings();
        $this->createTableallSettingFields();
        $this->createSettingsaveds();
        $daa = Yii::$app->get('getsettings', true);
        $this->development = $daa->development;
    }

    public function createTableallSettings(){
        $db = Yii::$app->db;
        $connection = new \yii\db\Connection([
            'dsn' => $db->dsn,
            'username' => $db->username,
            'password' => $db->password,
        ]);
        $connection->open();
        if(Yii::$app->db->getTableSchema('all_settings', true) === null){
            $sqlQuery = "CREATE TABLE `all_settings` (
                `id` int(11) AUTO_INCREMENT PRIMARY KEY,
                `title` varchar(255) NOT NULL,
                `icon` text
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $sqlCommand = $db->createCommand($sqlQuery);            
            $sqlCommand->execute();
            $sqlQueryAfter = "ALTER TABLE `all_settings` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";
            $sqlCommand2 =  $db->createCommand($sqlQueryAfter);
            $sqlCommand2->execute();
            return true;
        }
    }

    public function createTableallSettingFields(){
        $db = Yii::$app->db;
        $connection = new \yii\db\Connection([
            'dsn' => $db->dsn,
            'username' => $db->username,
            'password' => $db->password,
        ]);
        $connection->open();
        if(Yii::$app->db->getTableSchema('all_setting_fields', true) === null){           
            $allsqlQuery = "CREATE TABLE `all_setting_fields` (
                `id` int(11)  AUTO_INCREMENT PRIMARY KEY,
                `s_id` int(11) NOT NULL,
                `s_label` varchar(255) NOT NULL,
                `s_type` enum('text','radio','checkbox','file','files','dropdown','color') NOT NULL DEFAULT 'text',
                `s_value` text NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1";
               
            $asqlCommand = $db->createCommand($allsqlQuery);                  
            $asqlCommand->execute();           
            $asqlQueryAfter = "ALTER TABLE `all_setting_fields` ADD CONSTRAINT `fk_setting_key1` FOREIGN KEY (`s_id`) REFERENCES `all_settings` (`id`);";
            $asqlCommand2 =  $db->createCommand($asqlQueryAfter);
            $asqlCommand2->execute();
            return true;
        }
    }

    public function createSettingsaveds(){
        $db = Yii::$app->db;
        $connection = new \yii\db\Connection([
            'dsn' => $db->dsn,
            'username' => $db->username,
            'password' => $db->password,
        ]);
        $connection->open();
        if(Yii::$app->db->getTableSchema('setting_saved', true) === null){
            $ssqlQuery = "CREATE TABLE `setting_saved` (
                `id` int(11)  AUTO_INCREMENT PRIMARY KEY,
                `f_id` int(11) NOT NULL,
                `value` text NOT NULL
              ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
            $ssqlCommand = $db->createCommand($ssqlQuery);            
            $ssqlCommand->execute();
            $ssqlQueryAfter = "ALTER TABLE `setting_saved` ADD CONSTRAINT `fk_f_id1` FOREIGN KEY (`f_id`) REFERENCES `all_setting_fields` (`id`);";
            $ssqlCommand2 =  $db->createCommand($ssqlQueryAfter);
            $ssqlCommand2->execute();
            return true;
        }
    }

    /**
     * Lists all AllSettings models.
     * @return mixed
     */
    public function actionIndex()
    {
        if($this->development){
            $searchModel = new AllSettingsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            return $this->redirect(Url::base(true));
        }
    }

    /**
     * Displays a single AllSettings model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if($this->development){
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }else{
            return $this->redirect(Url::base(true));
        }
    }

    /**
     * Creates a new AllSettings model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if($this->development){
            $model = new AllSettings();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(Url::base(true));
        }
    }

    /**
     * Updates an existing AllSettings model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if($this->development){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }else{
            return $this->redirect(Url::base(true));
        }
    }

    /**
     * Deletes an existing AllSettings model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the AllSettings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AllSettings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AllSettings::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionSavesetting($id){
        $data = AllSettingFields::find()->where(['s_id'=>$id])->asArray()->all();
        if(!empty($data)){
            $result = ArrayHelper::getColumn($data, 'id');
            $savedData = SettingSaved::find()->where('f_id IN('.implode(",",$result).')')->asArray()->all();
            $savedData = ArrayHelper::map($savedData, 'f_id','value');
            $thisModel = $this->findModel($id);
            if(isset($_POST['submit'])){           
                if(!empty($_POST)){
                    if(isset($_POST['setting'])){
                        foreach($_POST['setting'] as $k=>$v){                                     
                            if(is_array($v)){
                                $saved = SettingSaved::find()->where(['f_id'=>$k])->one();
                                if(empty($saved)){
                                    $saved = new SettingSaved();
                                }                                                    
                                $saved->f_id = $k;
                                $saved->value = implode(",",$v);
                                $saved->save();
                            }else{
                                $saved = SettingSaved::find()->where(['f_id'=>$k])->one();
                                if(empty($saved)){
                                    $saved = new SettingSaved();    
                                } 
                                $saved->f_id = $k;
                                $saved->value = $v;
                                $saved->save();
                            }
                        }
                    }
                }
                if(!empty($_FILES)){
                    foreach($_FILES as $k=>$v){ 
                        if($v['error'] != 0) continue;                                     
                        $filedVal = AllSettingFields::find()->where(['s_id'=>$k])->asArray()->one();
                        $file = $this->fileUpload($v);
                        $saved = SettingSaved::find()->where(['f_id'=>$k])->one();
                        
                        $path = Yii::getAlias('@app').'/../';
                        if(!empty($saved) && file_exists($path.$saved->value)){
                            unlink($path.$saved->value);
                        }
                        if(empty($saved)){
                            $saved = new SettingSaved();    
                        } 
                        $saved->f_id = $k;
                        $saved->value = $file;
                        $saved->save();
                    }
                }
                Yii::$app->session->setFlash('success_setting', 'Successfully updated.');
                return $this->redirect(['savesetting',"id"=>$id]);
            }
            return $this->render('savesettings', [
                'data' => $data,
                'savedData'=>$savedData,
                'name'=>$thisModel->title,
            ]);
        }else{
            return $this->redirect(['index']);
        }
        
    }

    public function fileUpload($files){
        $_FILES = $files;
        $path = Yii::getAlias('@app').'/../';
        $basePath ="uploads/gsetting/";
        $target_dir = $path.$basePath;
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo(basename($_FILES["name"]),PATHINFO_EXTENSION));
        $fileName = uniqid().'.'.$imageFileType;
        $target_file = $target_dir . $fileName;
        // Check if image file is a actual image or fake image
        // if(isset($_POST["submit"])) {
        //     $check = getimagesize($_FILES["tmp_name"]);
        //     if($check !== false) {
        //         echo "File is an image - " . $check["mime"] . ".";die;
        //         $uploadOk = 1;
        //     } else {
        //         echo "File is not an image.";
        //         $uploadOk = 0;
        //     }
        // }
        
        // Check if file already exists
        // if (file_exists($target_file)) {
        //     echo "Sorry, file already exists.";
        //     $uploadOk = 0;
        // }
        // Check file size
        // if ($_FILES["size"] > 500000) {
        //     echo "Sorry, your file is too large.";
        //     $uploadOk = 0;
        // }
        // Allow certain file formats
        // if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        // && $imageFileType != "gif" ) {
        //     echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //     $uploadOk = 0;
        // }
       
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            return "";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["tmp_name"], $target_file)) {
                return $basePath.$fileName;
            } else {
                return "";
            }
        }
    }

    public function actionGetcategoryconfig($cname,$type = "json"){       
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
            echo "No Record";die;
        }
    }

    public function actionGetcategorysingleconfig($cname,$fname,$type = "json"){       
        $getID = AllSettings::find()->where(["title"=>$cname])->one();
        if(!empty($getID)){
            $id = $getID->id;
            $data = AllSettingFields::find()->where(['s_id'=>$id,'s_label'=>$fname])->asArray()->all();       
            $result = ArrayHelper::getColumn($data, 'id');
            if(empty($result)){
                return json_encode( "No Record");die;
            }        
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
            echo "No Record";die;
        }
    }
}
