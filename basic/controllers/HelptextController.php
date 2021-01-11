<?php

namespace app\controllers;

use app\models\Helptext;
use app\models\searches\HelptextSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * HelptextController implements the CRUD actions for Helptext model.
 */
class HelptextController extends Controller
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
     * Lists all Helptext models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HelptextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Helptext models.
     * @return mixed
     */
    public function actionNice()
    {
        $searchModel = new HelptextSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('nice', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Helptext model.
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
     * Finds the Helptext model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Helptext the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Helptext::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Creates a new Helptext model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Helptext();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Helptext model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Helptext model.
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

    public function actionGenerate()
    {
        $model = new Helptext();
        $decr_url = 'https://habr.com/ru/post/481398/';
        $russ = file_get_contents($file = '../../helprus.txt');
        foreach ($arr = explode('<h2>', $russ) as $index => $item) {
            if (preg_match('/^([a-zA-Z_-]+?)<\/h2>(.+?<br ?\/?>)(.+)$/ms', $item, $matches)) {
                $command = trim($matches[1] ?? '');
                $decr = trim(preg_replace('/<br ?\/?>/', '', trim($matches[2] ?? '')));
                $example = trim($matches[3]);
                $commands[$command] = ['command' => $command, 'decr' => $decr, 'example' => $example, 'weight' => $index];
            }
        }
        $def = ['command' => '', 'decr' => '', 'example' => ''];
        $all = Helptext::deleteAll();
        $commands_adv = ['git' => $def, 'grep' => $def, 'ls' => $def, 'curl' => $def, 'man' => $def];
        $commands = array_merge($commands_adv, $commands);
        ksort($commands);
        foreach ($commands as $index => $command) {
            $command['command'] = mb_strlen($command['command']) ? $command['command'] : $index;
            ob_start();
            $text = passthru($cm = $command['command'] . ' --help', $output);
            $content = ob_get_contents();

            $model = new Helptext([
                'command' => $command['command'],
                'created' => time(),
                'updated' => time(),
                'help' => $content,
                'decr' => $command['decr'],
                'example' => $command['example'],
                'parsed' => $content,
                'source' => $cm,
                'device' => 'Notebook',
                'dop_info' => json_encode(['decr_url' => $decr_url, 'parsed' => time(), 'from_file' => $file, 'executor' => 'passthru']),
                'weight' => $command['weight'] * 1,
            ]);
            $saved = $model->save(false);

        }


    }
}
