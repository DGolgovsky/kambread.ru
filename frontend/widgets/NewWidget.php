<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\db\Query;

class NewWidget extends Widget
{
    private $_query;

    public function init()
    {
        $this->_query = new Query();
    }

    public function run()
    {
        $query = $this->_query;
        $result = $query->from('product')->andwhere('status=true')->where('new=true')->limit(5)->all(); // ->FilterWhere(['<>', 'idproduct', $this->id])

        return $this->render('new', ['result' => $result]);
    }
}
