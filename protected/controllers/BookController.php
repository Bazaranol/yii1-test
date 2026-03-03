<?php

class BookController extends Controller
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
                'expression'=>'Yii::app()->user->checkAccess("book.view")',
            ],
            ['allow',
                'actions'=>['create'],
                'expression'=>'Yii::app()->user->checkAccess("book.create")',
            ],
            ['allow',
                'actions'=>['update'],
                'expression'=>'Yii::app()->user->checkAccess("book.update")',
            ],
            ['allow',
                'actions'=>['delete'],
                'expression'=>'Yii::app()->user->checkAccess("book.delete")',
            ],
            ['deny','users'=>['*']],
        ];
    }

    public function actionIndex()
    {
        $model = new Book('search');
        $model->unsetAttributes();

        if (isset($_GET['Book'])) {
            $model->attributes = $_GET['Book'];
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
        $model = new Book;

        if (isset($_POST['Book'])) {
            $model->attributes = $_POST['Book'];

            if ($model->save(false)) {

                if (!empty($_POST['authors'])) {
                    $this->saveAuthors($model, $_POST['authors']);
                }

                $this->notifySubscribers($model);

                $this->redirect(['view','id'=>$model->id]);
            }
        }

        $this->render('create', ['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->loadModel($id);

        if (isset($_POST['Book'])) {

            $model->attributes = $_POST['Book'];

            if ($model->save(false)) {

                if (isset($_POST['authors'])) {
                    $this->saveAuthors($model, $_POST['authors'], true);
                }

                $this->redirect(['view','id'=>$model->id]);
            }
        }

        $this->render('update', ['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $this->loadModel($id)->delete();
        $this->redirect(['index']);
    }

    protected function loadModel($id)
    {
        $model = Book::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404);
        return $model;
    }

    protected function saveAuthors(Book $book, array $authorIds, $clear = false)
    {
        if ($clear) {
            Yii::app()->db
                ->createCommand()
                ->delete('book_author','book_id=:id',[':id'=>$book->id]);
        }

        foreach ($authorIds as $authorId) {
            Yii::app()->db->createCommand()->insert('book_author',[
                'book_id'=>$book->id,
                'author_id'=>$authorId,
            ]);
        }
    }

    protected function notifySubscribers(Book $book)
    {
        foreach ($book->authors as $author) {

            foreach ($author->subscriptions as $sub) {

                SmsPilot::send(
                    $sub->phone,
                    'Новая книга автора '.$author->full_name.': '.$book->title
                );
            }
        }
    }
}