<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'О компании';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-about">
    <p>Дата основания предприятия - декабрь 1956 г.</p>
    <p>В 1993 году хлебокомбинат вышел из подчинения Министерства хлебопекарной промышленности, стал структурой муниципалитета.
        В августе 2006 года было создано ОАО «Камышинский хлебокомбинат» путем преобразования муниципального унитарного предприятия «Камышинский хлебокомбинат».
        Учредителем ОАО «Камышинский хлебокомбинат» является комитет по управлению имуществом Администрации городского округа – город Камышин.</p>
    <div>
        <p>На предприятии проводится проверка поступающего сырья, контроль всех этапов технологического производства.
            Контроль качества готовой продукции проводятся силами собственной лаборатории.</p>
        <p>ОАО «Камышинский хлебокомбинат» выпускает широкий ассортимент хлебобулочных изделий из натурального сырья.
            Вся продукция предприятия сертифицирована и производится согласно существующей нормативно-технической документации.</p>
    </div>
    <h4><span class="glyphicon glyphicon-map-marker"></span> Location</h4>
    <div id="map_canvas" style="width:640px; height:380px"></div>
    <br/>
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
</div>
