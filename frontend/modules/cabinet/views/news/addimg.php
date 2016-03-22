<?php
$this->title = 'Добавление изображения';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/cabinet/news']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->idnews]];
$this->params['breadcrumbs'][] = 'Изображения';
?>

<div class="container">
    <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
    <?php
    echo $form->field($model, 'general_image')->widget(\kartik\file\FileInput::classname(),[
        'options' => [
            'accept' => 'image/*',
        ],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['file-upload-general']),
            'uploadExtraData' => [
                'news_id' => $model->idnews,
            ],
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'initialPreview' => $image,
            'showUpload' => true,
            'showRemove' => false,
            'dropZoneEnabled' => false
        ]
    ]); ?>
    <?php
    echo \yii\helpers\Html::label('Images');
    echo \kartik\file\FileInput::widget([
        'name' => 'images',
        'options' => [
            'accept' => 'image/*',
            'multiple'=>true
        ],
        'pluginOptions' => [
            'uploadUrl' => \yii\helpers\Url::to(['file-upload-images']),
            'uploadExtraData' => [
                'news_id' => $model->idnews,
            ],
            'overwriteInitial' => false,
            'allowedFileExtensions' =>  ['jpg', 'png','gif'],
            'initialPreview' => $images_add,
            'showUpload' => true,
            'showRemove' => false,
            'dropZoneEnabled' => false
        ]
    ]); ?>
    <p><div class="form-group">
        <?= \yii\helpers\Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div></p>
    <?php \yii\bootstrap\ActiveForm::end(); ?>
</div>
