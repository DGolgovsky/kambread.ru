<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'username',
                    'email',
                    'created_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
