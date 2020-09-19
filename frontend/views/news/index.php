<?php
use yii\widgets\Pjax;
use yii\widgets\ListView;
?>



<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-12 pri">
            <div class="faq_page_title"><?= Yii::t('app', 'Новости игры') ?></div>
            <ul class="news_ul">
<!--                news feed start-->
                <?= \yii\widgets\ListView::widget([

                    'id' => 'block_news',
                    'options'  => ['class' => 'block_news'],
                    'itemOptions' => ['class' => 'news'],
                    'dataProvider' => $blogDataProvider,
                    'layout' => "{items} <div class='clearfix'> </div>{pager}",
                    'itemView' => '_list',
                    'viewParams'=> [],
                    'pager' => [
                        'class' => \nirvana\infinitescroll\InfiniteScrollPager::className(),
                        'widgetId' => 'block_news',
                        'itemsCssClass' => 'block_news',
                        'contentLoadedCallback' => 'fook',
                        'nextPageLabel' => Yii::t('app', 'Загрузить еще'),
                        'registerLinkTags' => true,
                        'linkOptions' => [
                            'class' => 'btn',
                        ],
                        'pluginOptions' => [
                            'contentSelector' => '.block_news',
                            'loading' => [
                                'msgText' => '<em>' . Yii::t('app', 'Новые новости подгружаются') . '...</em>',
                                'finishedMsg' => '<em>' . Yii::t('app', 'Извините, но вы прочитали все') . '!</em>',
                            ],
                            'behavior' => \nirvana\infinitescroll\InfiniteScrollPager::BEHAVIOR_MASONRY,
                        ],
                    ],
                ]);
                ?>
<!--                news feed end-->

            </ul>
        </div>

    </div>
</div>

<?= \frontend\widgets\ReviewsWidget::widget(); ?>

<div id="bottom-sheet-default" class="bmd-bottom-sheet pe">
</div>
 <body>
 <!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->
