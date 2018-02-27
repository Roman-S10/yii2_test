<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Добавить товар', [
                'value'=>Url::to('index.php?r=product/create'),
                'class' => 'btn btn-success',
                'id' => 'product-modal-btn'
            ]) ?>
    </p>

    <?php
    Modal::begin([
        'header' => '<h2>Добавление товара</h2>',
        'id' => 'product-modal',
    ]);

    echo '<div id="product-modal-content"></div>';

    Modal::end();
    ?>

    <?php Pjax::begin( ['id' =>'products']) ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name:ntext',
            'price:ntext',
            'description:ntext',
            'product_group_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
