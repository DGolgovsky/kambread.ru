<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'idproduct',
                    [
                        'label' => 'Наименование',
                        'value' => 'title'
                    ],
                    'user.name',
                    'price',
                    'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {edit} {delete}',
                        'buttons'=>[
                            'view'=>function ($url, $model, $key) {
                                return \yii\helpers\Html::a("<span class='glyphicon glyphicon-eye-open'></span>", Yii::$app->params['baseUrl']."/products/view-product/".$key,['target' => '_blank']);
                            },
                            'edit'=>function ($url, $model, $key) {
                                return \yii\helpers\Html::a("<span class=\"glyphicon glyphicon-pencil\"></span>", Yii::$app->params['baseUrl']."/cabinet/product/update/".$key,['target' => '_blank']);
            }
                        ],
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
