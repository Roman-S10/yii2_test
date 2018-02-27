<?php

use app\models\ProductGroup;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <?php
    $groups = ProductGroup::find()->all();
    $items = ArrayHelper::map($groups,'id','name');
    $params = [
        'prompt' => 'Укажите группу таваров'
    ];
    ?>

    <?= $form->field($model, 'name')->input('text')->label('Название') ?>

    <?= $form->field($model, 'price')->input('text')->label('Цена') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание') ?>

    <?= $form->field($model, 'product_group_id')->dropDownList($items,$params)->label('Группа таваров'); ?>


    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php
$script = <<< JS
$(document).ready(function () {

    var productForm = $('#product-modal form');
    productForm.on('beforeSubmit', function () {
        $.post(
            productForm.attr('action'),
            productForm.serialize()
        ).done(function (result) {
            if( result === 'success'){
                productForm.trigger('reset');
                $('#product-modal').modal('hide');
                $.pjax.reload({container: '#products'});
                console.log('success');
            }
        });
        return false;

    });
});
JS;
$this->registerJs($script);
?>

</div>
