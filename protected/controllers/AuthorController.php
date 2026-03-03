<?php

class AuthorController extends Controller
{
    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions'=>['index','view'],
                'expression'=>'Yii::app()->user->checkAccess("author.view")',
            ],
            ['allow',
                'actions'=>['create'],
                'expression'=>'Yii::app()->user->checkAccess("author.create")',
            ],
            ['allow',
                'actions'=>['update'],
                'expression'=>'Yii::app()->user->checkAccess("author.update")',
            ],
            ['allow',
                'actions'=>['delete'],
                'expression'=>'Yii::app()->user->checkAccess("author.delete")',
            ],
            ['deny','users'=>['*']],
        ];
    }

    public function actionIndex()
    {
        $model = new Author('search');
        $model->unsetAttributes();

        if (isset($_GET['Author'])) {
            $model->attributes = $_GET['Author'];
        }

        $this->render('index', ['model'=>$model]);
    }

    public function actionView($id)
    {
        $this->render('view', [
            'model'=>$this->loadModel($id)
        ]);
    }

    public function actionCreate()
    {
        $model = new Author;

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];

            if ($model->save(false)) {
                $this->redirect(['view','id'=>$model->id]);
            }
        }

        $this->render('create',['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Author'])) {
            $model->attributes = $_POST['Author'];

            if ($model->save(false)) {
                $this->redirect(['view','id'=>$model->id]);
            }
        }

        $this->render('update',['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(['index']);
    }

    protected function loadModel($id)
    {
        $model = Author::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404);
        return $model;
    }
}