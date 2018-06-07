<?php

namespace app\modules\announcement\controllers;

use Yii;
use app\modules\announcement\models\BusService;
use app\modules\announcement\models\BusServiceSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * BusserviceController implements the CRUD actions for BusService model.
 */
class BusserviceController extends Controller
{
    /**
     * @inheritdoc
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
	
	public function beforeAction($action)
	{
        if (Yii::$app->user->isGuest)
            Yii::$app->user->loginRequired();
		else if (Yii::$app->user->identity->dsResponsibility !== 'Super Admin' && !stristr(Yii::$app->user->identity->dsResponsibility, 'Bus Service')) 
			throw new ForbiddenHttpException('You are not authorized to perform this action.');
		
		return true;
	}

    /**
     * Lists all BusService models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusServiceSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single BusService model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
       $model = $this->findModel($id);

    
        if($model->image)
            $images = explode(",",$model->image);
        else
            $images = null;

        if($model->attachment)
            $attachments = explode(",",$model->attachment);
        else
            $attachments = null;

        return $this->render('view', [
            'model' => $model,
            'images' => $images,
            'attachments' => $attachments,
        ]);
    }

    /**
     * Creates a new BusService model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusService();

        if ($model->load(Yii::$app->request->post())) {
            $post= Yii::$app->request->post();
            $images_path=[];
            $attachments_path=[];
            // var_dump( );exit();
            // foreach ($post['Safety']['images_Temp'] as $image) {\

            $image_instaces = UploadedFile::getInstances($model,'images_Temp');
           
            foreach ($image_instaces as $instance) {

                if($instance){
                    $path = $instance->baseName . '.' . $instance->extension;
                    $instance->saveAs('uploads/images/' . $path);
                    array_push($images_path,$path);
                }
            }

         

           $att_instaces = UploadedFile::getInstances($model,'attachments_Temp');
       
            foreach ($att_instaces as $instance) {

                if($instance){
                    $path = $instance->baseName . '.' . $instance->extension;
                    $instance->saveAs('uploads/attachments/' . $path);
                    array_push($attachments_path,$path);
                }
            }
          
            
            if($images_path!=[]){
                $images_path = implode(",", $images_path);
                $model->image = $images_path;
            }
            

            if($attachments_path!=[]){
                $attachments_path = implode(",", $attachments_path);
                $model->attachment = $attachments_path;
            }

            
            $model->dId = Yii::$app->user->identity->dId;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                var_dump($model);
                exit();
            }


            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing BusService model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            if($model->image!=null)
                $images = explode(",",$model->image);
            else
                $images = null;

            if($model->attachment!=null)
                $attachments = explode(",",$model->attachment);
            else
                $attachments = null;

            $post= Yii::$app->request->post();


            if($post['old_image_value']!=null)
                $old_images = explode("-",$post['old_image_value']);
            else
                $old_images = null;


            if($post['old_att_value']!=null)
                $old_attachments = explode("-",$post['old_att_value']);
            else
                $old_attachments = null;

            $images_path=[];
            $attachments_path=[];

            if($images){
                if($old_images){
                    $c = 0;
                    foreach ($images as $image) {
                        
                        if(in_array($c, $old_images))
                            array_push($images_path,$image);
                        else{
                            if(file_exists('uploads/images/'.$image))
                                unlink('uploads/images/'.$image);

                        }
                            
                        $c++;
                    }
                }else{
                    foreach ($images as $image) {
                        if(file_exists('uploads/images/'.$image))
                            unlink('uploads/images/'.$image);
                    }
                }
            }

             if($attachments){
                if($old_attachments){
                    $c = 0;
                    foreach ($attachments as $attachment) {
                        
                        if(in_array($c, $old_attachments))
                            array_push($attachments_path,$attachment);
                        else{
                            if(file_exists('uploads/attachments/'.$attachment))
                                unlink('uploads/attachments/'.$attachment);

                        }
                        $c++;
                    }
                }else{
                    foreach ($attachments as $attachment) {
                        if(file_exists('uploads/attachments/'.$attachment))
                            unlink('uploads/attachments/'.$attachment);
                    }
                }

            }
            

            $image_instaces = UploadedFile::getInstances($model,'images_Temp');
            
            foreach ($image_instaces as $instance) {

                if($instance){
                    $path = $instance->baseName . '.' . $instance->extension;
                    $instance->saveAs('uploads/images/' . $path);
                    array_push($images_path,$path);
                }
            }

           $att_instaces = UploadedFile::getInstances($model,'attachments_Temp');
       
            foreach ($att_instaces as $instance) {

                if($instance){
                    $path = $instance->baseName . '.' . $instance->extension;
                    $instance->saveAs('uploads/attachments/' . $path);
                    array_push($attachments_path,$path);
                }
            }
          
            
            if($images_path!=[]){
                $images_path = implode(",", $images_path);
                $model->image = $images_path;
            }else{
                $model->image = null;
            }
            

            if($attachments_path!=[]){
                $attachments_path = implode(",", $attachments_path);
                $model->attachment = $attachments_path;
            }else{
                $model->attachment = null;
            }

            
            $model->dId = Yii::$app->user->identity->dId;

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                var_dump($model);
                exit();
            }

        } else {


            if($model->image)
                $images = explode(",",$model->image);
            else
                $images = null;

            if($model->attachment)
                $attachments = explode(",",$model->attachment);
            else
                $attachments = null;


            return $this->render('update', [
                'model' => $model,
                'images' => $images,
                'attachments' => $attachments,
            ]);
        }
    }

    /**
     * Deletes an existing BusService model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BusService model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusService the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusService::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
