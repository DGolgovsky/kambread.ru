<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Product */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Кабинет', 'url' => ['/cabinet']];
$this->params['breadcrumbs'][] = ['label' => 'Продукция', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">
	<p>
		<?= Html::a('Обновить', ['update', 'id' => $model->idproduct], [
			'class' => 'btn btn-primary'
		]) ?>
	</p>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'idproduct',
			'name',
			'price',
			//'user_id',
			//'general_image',
			'description:ntext',
			'new',
			'type:ntext',
			'recommend',
			'user.name',
			'created_at:date',
			'updated_at:date',
		],
	]) ?>
	<p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->idproduct], [
            'class' => 'btn btn-danger',
			'data' => [
				'confirm' => 'Вы действительно хотите удалить?',
				'method' => 'post',
			],
		]) ?>
	</p>
</div>