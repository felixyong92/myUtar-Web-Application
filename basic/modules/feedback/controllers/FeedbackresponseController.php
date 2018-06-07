<?php

namespace app\modules\feedback\controllers;

use Yii;
use app\modules\feedback\models\FeedbackResponse;
use app\modules\feedback\models\FeedbackResponseSearch;
use app\modules\feedback\controllers\FeedbackController;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * FeedbackresponseController implements the CRUD actions for FeedbackResponse model.
 */
class FeedbackresponseController extends Controller
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
     * Lists all FeedbackResponse models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FeedbackResponseSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single FeedbackResponse model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new FeedbackResponse model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FeedbackResponse();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->frId]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing FeedbackResponse model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            return $this->redirect('?r=feedback%2Ffeedback%2Fview&id='.$model->fId);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing FeedbackResponse model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the FeedbackResponse model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return FeedbackResponse the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = FeedbackResponse::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
