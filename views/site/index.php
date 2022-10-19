<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'My Yii Application';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="application/javascript">
    function voted(img, id, int) {

        $.post("/site/voted", {vote: int, id: id, url: img})
            .done(function (data) {
            });
    }
</script>
<div class="site-index">

    <div class="body-content">

        <div class="row">
            <?php Pjax::begin(['id' => 'pjaxContent', 'enablePushState' => false]); ?>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p><img id="image" src="<?= $image ?>"></p>

                <p>
                <?= Html::a('Одобрено', ['/site/index', 'vote' => 'up'], ['class' => 'btn btn-success', 'onclick' => "voted('{$image}',{$id},1)"]) ?>
                <?= Html::a('Отклонено', ['/site/index', 'vote' => 'up'], ['class' => 'btn btn-danger', 'onclick' => "voted('{$image}',{$id},0)"]) ?>
                </p>
            </div>
            <?php Pjax::end(); ?>
        </div>

    </div>

</div>
