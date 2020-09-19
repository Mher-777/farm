<?php

namespace common\modules\languages\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;


class ListWidget extends Widget
{

    public $languagesArr;

    public function init()
    {
        $language = Yii::$app->language;
        $langArr = [];

        foreach (Yii::$app->getModule('languages')->languages as $key => $value){
            $langArr += [$value => Html::a($key, ['languages/default/index', 'lang' => $value], [
                'class' => 'bmd-ripple',
            ])];
        }

        if(isset($langArr[$language])) {
            unset($langArr[$language]);
        }

        $this->languagesArr = $langArr;
    }

    public function run()
    {
        return $this->render('list',[
            'langArr' => $this->languagesArr,
        ]);
    }
}
