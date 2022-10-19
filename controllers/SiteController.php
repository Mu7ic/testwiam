<?php

namespace app\controllers;

use app\models\VoteImages;
use Yii;
use yii\base\BaseObject;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    public string $image;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex($vote = null)
    {
        $request = Yii::$app->request;
        $ct = VoteImages::find()->count();

        if ($request->get('vote') === 'up') {
            $votes = Yii::$app->session->get('votes', $ct);
            Yii::$app->session->set('votes', $votes++);
        }
        $this->image = "https://picsum.photos/id/{$ct}/300/300";

        return $this->render('index', ['id' => $ct, 'image' => $this->image, 'votes' => $ct]);
    }

    public function actionVoted()
    {
        $request = Yii::$app->request;
        if ($request->isPost) {
            $voted = new VoteImages();
            $voted->id_image = $request->post('id');
            $voted->url_image = $request->post('url');
            $voted->vote = $request->post('vote');
            $voted->save(false);

            return $request->post('vote');
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionAuth($token)
    {
        if ($token === "xyz123") {
            $model = new LoginForm();
            $model->username = 'admin';
            $model->password = 'admin';
            if ($model->login()) {
                return $this->redirect('/site/admin');
            }
        }
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAdmin()
    {
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $dataProvider = new ActiveDataProvider([
            'query' => VoteImages::find()->orderBy(['id_image' => SORT_ASC]),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('admin', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Deletes an existing VoteImages model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $vote = $this->findModel($id);
        $vote->vote = null;
        $vote->save();

        return $this->redirect(['admin']);
    }

    /**
     * Finds the VoteImages model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return VoteImages the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = VoteImages::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
