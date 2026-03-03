<?php

class SiteController extends Controller
{
    public function actionLogin()
    {
        if (!Yii::app()->user->isGuest) {
            $this->redirect(['/site/index']);
        }

        $model = new LoginForm;

        if (isset($_POST['LoginForm'])) {

            $model->attributes = $_POST['LoginForm'];

            if ($model->validate() && $model->login()) {
                $this->redirect(Yii::app()->user->returnUrl);
            }
        }

        $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(['/site/login']);
    }

    public function actionIndex()
    {
        $this->render('index');
    }
}