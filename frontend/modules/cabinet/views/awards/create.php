<?php
$this->title = 'Добавление награды';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Награды', 'url' => ['/cabinet/awards']];
$this->params['breadcrumbs'][] = 'Добавление';
?>
<div class="awards-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>