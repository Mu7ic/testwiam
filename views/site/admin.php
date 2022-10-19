<?php

use app\models\VoteImages;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Vote Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="vote-images-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_image',
                'format' => 'raw',
                'value' => function ($data) {
                    return "<a href='{$data->url_image}'>{$data->id_image}</a>";
                }
            ],
            'vote:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, VoteImages $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
