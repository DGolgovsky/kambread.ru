<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\db\Query;

class AwardsWidget extends Widget
{
    private $_query;

    public function init()
    {
        $this->_query = new Query();
    }

    public function run()
    {
        $query = $this->_query;
        $result = $query->from('awards')->orderBy('date')->all();

        //TODO Fix this sh*t
        //$result_count = $result->count();
        $result_count = 5;

        $result_img = $query->select('idawards, general_image')
            ->from('awards')
            ->where(['not', ['general_image' => null]])
            ->all();

        return $this->render('awards', [
            'result' => $result,
            'result_count' => $result_count,
            'result_img' => $result_img]);
    }
}
