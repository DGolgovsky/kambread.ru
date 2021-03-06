<?php
$this->title = $model->s_name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр', 'url' => ['view', 'id' => $model->idproduct]];
$this->params['breadcrumbs'][] = 'Изображения';
?>
<h2>
    <small><p class="text-info">ВНИМАНИЕ! Не загружайте изображения большого размера!</p></small>
</h2>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
            <?php echo $form->field($model, 'general_image')->widget(\kartik\file\FileInput::classname(), [
                'options' => [
                    'accept' => 'image/*',
                ],
                'pluginOptions' => [
                    'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
                    'uploadExtraData' => [
                        'product_id' => $model->idproduct,
                    ],
                    'allowedFileExtensions' => ['jpg', 'png', 'gif'],
                    'initialPreview' => $image,
                    'showUpload' => true,
                    'showRemove' => true,
                    'dropZoneEnabled' => false
                ]
            ]);
            ?>
        </div>
    </div>
    <p>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </p>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
