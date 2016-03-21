<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\db\Query;

class NewWidget extends  Widget
{
    private $_query;

    public function init()
    {
        $this->_query = new Query();
    }

    public function run()
    {
        $query = $this->_query;
        $result = $query->from('product')->where('new=1')->limit(5)->all();

        return $this->render('new',['result' => $result]);
    }
}
