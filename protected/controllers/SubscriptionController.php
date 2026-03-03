<?php

class SubscriptionController extends Controller
{
    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions'=>['create'],
                'expression'=>'Yii::app()->user->checkAccess("subscription.create")',
            ],
            ['deny','users'=>['*']],
        ];
    }

    public function actionCreate($authorId)
    {
        $model = new AuthorSubscription;
        $model->author_id = $authorId;

        if (isset($_POST['AuthorSubscription'])) {

            $model->attributes = $_POST['AuthorSubscription'];

            if ($model->save(false)) {
                $this->redirect(['/author/view','id'=>$authorId]);
            }
        }

        $this->render('create',[
            'model'=>$model
        ]);
    }
}