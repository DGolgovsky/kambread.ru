<?php

namespace frontend\widgets;

use yii\base\Widget;
use yii\db\Query;
use yii;
use yii\web\Response;
use frontend\components\Common;


class NewsWidget extends  Widget
{
    private $_query;

    public function init()
    {
        $this->_query = new Query();
    }

    public function run()
    {
        $query = $this->_query;
        $query_news = $query->from('news')->groupBy('idnews')->orderBy('idnews desc');
        $result_query  = $query_news->limit(5);

        $result = $result_query->all();

        $result_count = $result_query->count();

        return $this->render('news',[
            'result' => $result,
            'result_count' => $result_count,
        ]);
    }
}
