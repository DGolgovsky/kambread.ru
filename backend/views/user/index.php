<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <?= \yii\grid\GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    'id',
                    'name',
                    'username',
                    'email',
                    'phone',
                    'group',
                    'created_at:datetime',
                    'last_login_date:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{delete}',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
