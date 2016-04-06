<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'idnews',
                    [
                        'label' => 'Наименование',
                        'value' => 'title'
                    ],
                    'user.name',
                    'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view} {edit} {delete}',
                        'buttons'=>[
                            'view'=>function ($url, $model, $key) {
                                return \yii\helpers\Html::a("<span class='glyphicon glyphicon-eye-open'></span>", Yii::$app->params['baseUrl']."/news/view/".$key,['target' => '_blank']);
                            },
                            'edit'=>function ($url, $model, $key) {
                                return \yii\helpers\Html::a("<span class=\"glyphicon glyphicon-pencil\"></span>", Yii::$app->params['baseUrl']."/cabinet/news/update/".$key,['target' => '_blank']);
                            }
                        ],
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
