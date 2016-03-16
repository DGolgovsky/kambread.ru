<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Advert */

$this->title = $model->idadvert;
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advert-view">
	<h1 style="color: black; align-content: center;">
		<?= Html::encode($this->title) ?>
	</h1>
	<p>
		<?= Html::a('Обновить', ['update', 'id' => $model->idadvert], ['class' => 'btn btn-primary']) ?>
	</p>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			'idadvert',
			'price',
			'address',
			'fk_agent',
			'bedroom',
			'livingroom',
			'parking',
			'kitchen',
			'general_image',
			'description:ntext',
			'location',
			'hot',
			'sold',
			'type',
			'recommend',
			'created_at:date',
			'updated_at:date',
		],
	]) ?>
	<p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idadvert], [
            'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Are you sure you want to delete this item?',
				'method' => 'post',
			],
		]) ?>
	</p>
</div>