<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field($model, 'price')->textInput() ?>

	<?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

	<div id="map_canvas" style="width:640px; height:380px"></div><br/>

	<?= $form->field($model, 'name')->textInput() ?>

	<?= $form->field($model, 'livingroom')->textInput() ?>

	<?= $form->field($model, 'parking')->textInput() ?>

	<?= $form->field($model, 'kitchen')->textInput() ?>

	<?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

	<?= $form->field($model, 'location')->hiddenInput()->label(false) ?>

	<?= $form->field($model, 'hot')->radioList(['No', 'Yes']) ?>

	<?= $form->field($model, 'sold')->radioList(['No', 'Yes']) ?>

	<?= $form->field($model, 'type')->dropDownList([
		'Баранки',
		'Батоны',
		'Булочки',
		'Кексы',
		'Сухари',
		'Хлеб'
	]) ?>

	<?= $form->field($model, 'recommend')->radioList(['No', 'Yes']) ?>

	<?php
	$this->registerJs("
		var geocoder;
		var map;
		var marker;
		var markers = [];

		function initialize() {
			var latlng = new google.maps.LatLng(50.10725112018604, 45.40386139521479);
			var options = {
				zoom: 10,
				center: latlng,
			};
			map = new google.maps.Map(document.getElementById('map_canvas'), options);
			geocoder = new google.maps.Geocoder();
		}

		function DeleteMarkers() {
		    for (var i = 0; i < markers.length; i++) {
		        markers[i].setMap(null);
		    }
		    markers = [];
		}

		function findLocation(val) {
		    geocoder.geocode( {'address': val}, function(results, status) {
		        var location = results[0].geometry.location
		        map.setCenter(location)
		        map.setZoom(15)
		        DeleteMarkers()

		        $('#product-location').val(location)

		        marker = new google.maps.Marker({
		            map: map,
		            draggable: true,
		            position: location
		        });

		        google.maps.event.addListener(marker, 'dragend', function() {
		            $('#product-location').val(marker.getPosition())
		        });

		        markers.push(marker);
		    })
		}

		$(document).ready(function() {
		    initialize();

		    if( $('#product-address').val()) {
		        _location = $('#product-address').val()
		        findLocation(_location)
		    }

		    $('#product-address').bind('blur keyup',function() {
		        _location = $('#product-address').val()
		        findLocation(_location)
		    })
		});"
    );
    ?>

    <div class="form-group">
        <?= Html::submitButton('Дальше', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>