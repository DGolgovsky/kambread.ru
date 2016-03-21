<?php
$this->title = 'Добавление новости';
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['/cabinet/news']];
$this->params['breadcrumbs'][] = 'Добавление';
?>
<div class="news-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
