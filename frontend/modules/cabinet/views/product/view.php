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
	<div class="row">
		<div class="col-lg-2 col-sm-2 col-xs-2">
			<p>
				<?= Html::a('Редактировать', ['update', 'id' => $model->idproduct], [
					'class' => 'btn btn-primary'
				]) ?>
			</p>
		</div>
		<div class="col-lg-2 col-sm-2 col-xs-2">
			<p>
				<?= Html::a('Изображения', ['addimg', 'id' => $model->idproduct], [
					'class' => 'btn btn-warning'
				]) ?>
			</p>
		</div>
		<div class="col-lg-2 col-sm-2 col-xs-2">
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
	</div>
	<?=\yii\helpers\Html::img(\frontend\components\Common::getImageProduct($model, true), ['width' => 200]) ?>
	<?=\yii\helpers\Html::img(\frontend\components\Common::getImageProduct($model, false), ['width' => 200]) ?>
	<div class="spacer"></div>
	<?= DetailView::widget([
		'model' => $model,
		'attributes' => [
			//'idproduct',
			'name',
			'weight',
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
	<div class="row">
		<div class="col-lg-2 col-lg-offset-2 col-sm-2 col-sm-offset-1 col-xs-3">
			<?=Html::a('< туда', ['view', 'id' => ($model->findOne($id = $model->idproduct - 1) !== null) ? $id: $id+1], [
				'class' => 'btn btn-default'
			]);
			?>
		</div>
		<div class="col-lg-2 col-lg-offset-4 col-sm-2 col-sm-offset-6 col-xs-3">
			<?= Html::a('сюда >', ['view', 'id' => ($model->findOne($id = $model->idproduct + 1) !== null) ? $id: $id-1], [
				'class' => 'btn btn-default'
			]) ?>
		</div>
	</div>
</div>