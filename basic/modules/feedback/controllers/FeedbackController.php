<?php

namespace app\modules\feedback\controllers;

use Yii;
use app\modules\feedback\models\Feedback;
use app\models\Department;
use app\modules\feedback\models\FeedbackSearch;
use app\modules\feedback\models\FeedbackResponse;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * FeedbackController implements the CRUD actions for Feedback model.
 */
class FeedbackController extends Controller
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
		else if (Yii::$app->user->identity->dsResponsibility !== 'Super Admin' && !stristr(Yii::$app->user->identity->dsResponsibility, 'Feedback')) 
			throw new ForbiddenHttpException('You are not authorized to perform this action.');
		
		return true;
	}

    /**
     * Lists all Feedback models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionChangedept($id)
    {
        $model = $this->findModel($id);
		$responses = $model->feedbackResponses;
        $newResponse = new FeedbackResponse();
        
        if ($model->load(Yii::$app->request->post())) {
			$newResponse->fId = $id;
			$newResponse->fResponse = 'Feedback redirected to '.$model->dId;
            $newResponse->dId = Yii::$app->user->identity->dId;
            $newResponse->save();
            $model->save();
			
            return $this->redirect(['index']);

        }else{
            return $this->render('other',[
                'model' => $model,
            ]);
        }
    }


    /**
     * Displays a single Feedback model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $responses = $model->feedbackResponses;
        
        $attachments = explode(",",$model->fAttachment);
        $count = count($attachments);
        for($i=1; $i<=$count ; $i++){
            $currentAttachmentNum = "attachment".$i;
            
            $model->$currentAttachmentNum=array_shift($attachments);

        }

        return $this->render('view', [
            'model' => $model,
            'responses' => $responses,
        ]);
    }

    /**
     * Creates a new Feedback model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Feedback();

        if ($model->load(Yii::$app->request->post())) {

            $post= Yii::$app->request->post();
            $attachments_path=[];

             for($x=1; $x<=3; $x++){
                $currentAttachmentNum = 'attachment'.$x;
                $attachment_instace = UploadedFile::getInstance($model,$currentAttachmentNum);

                if($attachment_instace){
                    $model->$currentAttachmentNum = $attachment_instace->baseName . '.' . $attachment_instace->extension;
                    $attachment_instace->saveAs('uploads/attachments/' . $model->$currentAttachmentNum);
                    array_push($attachments_path,  $model->$currentAttachmentNum);
                }

            }

            if($attachments_path!=[]){
                $attachments_path = implode(",", $attachments_path);
                $model->fAttachment = $attachments_path;
            }

            $model->dId = Yii::$app->user->identity->dId;

            // var_dump($model);exit();
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->fId]);
            }else{
                var_dump($model);
                exit();
            }

        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Feedback model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $responses = $model->feedbackResponses;
        $newResponse = new FeedbackResponse();
        if ($newResponse->load(Yii::$app->request->post()) && $model->load(Yii::$app->request->post())) {
            $newResponse->fId = $id;
            $newResponse->dId = Yii::$app->user->identity->dId;
			$newResponse->save();
			$model->save();
            return $this->redirect(['view', 'id' => $model->fId]);
        } else {
            return $this->render('update', [
                'model' => $newResponse,
                'responses' => $responses,
                'feedback' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Feedback model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();    

        return $this->redirect(['index']);
    }

    public function actionUpdateresponse($frid){

        $model = FeedbackResponse::findOne($frid);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect(['view', 'id' => $model->fId]);
        } else {
            return $this->render('updateresponse', [
                'model' => $model,
            ]);
        }

    }

    public function actionDeleteresponse($frid, $id){

        $model = FeedbackResponse::findOne($frid);
        $model->delete();

        return $this->redirect(['view', 'id' => $id]);
    }

   

    /**
     * Finds the Feedback model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Feedback the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Feedback::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
