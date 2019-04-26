<?php

namespace vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\controllers;

use Yii;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingFields;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettings;
use vendor\yii2generalsetting\yii2generalsetting\src\modules\allsettings\models\AllSettingFieldsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * AllSettingFieldsController implements the CRUD actions for AllSettingFields model.
 */
class AllSettingFieldsController extends Controller
{
    /**
     * {@inheritdoc}
     */
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

    /**
     * Lists all AllSettingFields models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(!isset($_GET['sid']) || $_GET['sid'] == ''){
            return $this->redirect(['/allsettings/']);
        }
        $searchModel = new AllSettingFieldsSearch();
        $allSettings = AllSettings::find()->asArray()->all();
        $allSettings = ArrayHelper::map($allSettings, 'id', 'title');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'allSettings'=>$allSettings
        ]);
    }

    public function actionBulkcreate(){
        $model = new AllSettingFields();
        $allSettings = AllSettings::find()->asArray()->all();
        $allSettings = ArrayHelper::map($allSettings, 'id', 'title');
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            if(!empty($post['AllSettingFields'])){
                foreach($post['AllSettingFields']['s_label'] as $k=>$v){
                    $imodel = AllSettingFields::find()->where(['s_label'=>$v,'s_id'=>$post['AllSettingFields']['s_id']])->one();
                    if(empty($imodel)){
                        $imodel = new AllSettingFields();
                        $imodel->s_label = $v;
                    }
                    $imodel->s_id = $post['AllSettingFields']['s_id'];
                    $imodel->s_type = $post['AllSettingFields']['s_type'][$k];
                    $imodel->s_value = $post['AllSettingFields']['s_value'][$k];
                    $imodel->save();
                    
                }
                return $this->redirect(['index', 'sid' => $post['AllSettingFields']['s_id']]);
            }
        }

        return $this->render('_bulk', [
            'model' => $model,
            'allSettings'=>$allSettings
        ]);
    }

    /**
     * Displays a single AllSettingFields model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AllSettingFields model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AllSettingFields();
        $allSettings = AllSettings::find()->asArray()->all();
        $allSettings = ArrayHelper::map($allSettings, 'id', 'title');
       
        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post();
            $imodel = AllSettingFields::find()->where(['s_label'=>$model->s_label,'s_id'=>$model->s_id])->one();
            if(!empty($imodel)){
                $model = $imodel;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'allSettings'=>$allSettings
        ]);
    }

    /**
     * Updates an existing AllSettingFields model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $allSettings = AllSettings::find()->asArray()->all();
        $allSettings = ArrayHelper::map($allSettings, 'id', 'title');
       
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'allSettings'=>$allSettings
        ]);
    }

    /**
     * Deletes an existing AllSettingFields model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        print_r($_GET);die;
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AllSettingFields model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AllSettingFields the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AllSettingFields::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
