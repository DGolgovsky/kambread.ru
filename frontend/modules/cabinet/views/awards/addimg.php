<?php
$this->title = 'Добавление изображения';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Награды', 'url' => ['/cabinet/awards']];
$this->params['breadcrumbs'][] = ['label' => $model->date, 'url' => ['view', 'id' => $model->idawards]];
$this->params['breadcrumbs'][] = 'Изображения';
?>
<h2>
    <small><p class="text-info">ВНИМАНИЕ! Не загружайте изображения большого размера!</p></small>
</h2>
<div class="container">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
    <?php
    echo $form->field($model, 'general_image')->widget(\kartik\file\FileInput::classname(), [
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
            'uploadExtraData' => [
                'awards_id' => $model->idawards,
            ],
            'allowedFileExtensions' => ['jpg', 'png', 'gif'],
            'initialPreview' => $image,
            'showUpload' => true,
            'showRemove' => true,
            'dropZoneEnabled' => false
        ]
    ]); ?>

    <p>
    <div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </p>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
