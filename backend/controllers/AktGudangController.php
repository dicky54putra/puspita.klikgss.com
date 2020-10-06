<?php

namespace backend\controllers;

use Yii;
use backend\models\AktGudang;
use backend\models\AktGudangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AktGudangController implements the CRUD actions for AktGudang model.
 */
class AktGudangController extends Controller
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
     * Lists all AktGudang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AktGudangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AktGudang model.
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
     * Creates a new AktGudang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AktGudang();

        // $kode = AktGudang::find()->select(['max(kode_gudang)+1 as kode_gudang'])->one();
        // $model->kode_gudang = ($kode->kode_gudang == "") ? 1 : $kode->kode_gudang ;
        $total = AktGudang::find()->count();
        $nomor = 'GD' . str_pad($total + 1, 3, "0", STR_PAD_LEFT);

        if ($model->load(Yii::$app->request->post())) {
            $create_in_item =  Yii::$app->request->post('create-in-item');
            $id =  Yii::$app->request->post('id');
            $update_in_item =  Yii::$app->request->post('update-in-item');
            $id_update =  Yii::$app->request->post('id_update');
            if(isset($create_in_item)) {
                $model->save();
                return $this->redirect(['akt-item-stok/create', 'id' => $id]);
            } else if(isset($update_in_item)) {
                $model->save();
                return $this->redirect(['akt-item-stok/update', 'id' => $id_update]);
            } else  {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id_gudang]);
            }
        }
        return $this->render('create', [
            'model' => $model,
            'nomor' => $nomor,
        ]);
    }

    /**
     * Updates an existing AktGudang model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $nomor = $model->kode_gudang;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_gudang]);
        }

        return $this->render('update', [
            'model' => $model,
            'nomor' => $nomor,
        ]);
    }

    /**
     * Deletes an existing AktGudang model.
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
     * Finds the AktGudang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AktGudang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AktGudang::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}