<?php

class ReportController extends Controller
{
    public function filters()
    {
        return ['accessControl'];
    }

    public function accessRules()
    {
        return [
            ['allow',
                'actions'=>['topAuthors'],
                'expression'=>'Yii::app()->user->checkAccess("report.view")',
            ],
            ['deny','users'=>['*']],
        ];
    }

    public function actionTopAuthors()
    {
        $year = Yii::app()->request->getParam('year');

        $rows = [];

        if ($year) {

            $sql = "
                SELECT a.id, a.full_name, COUNT(*) AS cnt
                FROM author a
                JOIN book_author ba ON ba.author_id = a.id
                JOIN book b ON b.id = ba.book_id
                WHERE b.year = :year
                GROUP BY a.id
                ORDER BY cnt DESC
                LIMIT 10
            ";

            $rows = Yii::app()->db
                ->createCommand($sql)
                ->queryAll(true, [':year'=>$year]);
        }

        $this->render('topAuthors',[
            'rows'=>$rows,
            'year'=>$year,
        ]);
    }
}