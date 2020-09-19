<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-12 pri">
            <div class="faq_page_title">F.A.Q</div>
            <ul class="news_ul">
                <?php foreach($faqs as $faq):?>
                    <?php

                    $titleAttribute = 'title' . (Yii::$app->language == 'en' ? '_en' : '');

                    if (!$faq->$titleAttribute) {
                        continue;
                    }

                    $contentAttribute = 'content' . (Yii::$app->language == 'en' ? '_en' : '');

                    ?>
                    <blockquote class="bmd-border-primary">

                        <p class="faq_title"><?php echo $faq->$titleAttribute ?></p>
                        <div class="faq_content"><?php echo $faq->$contentAttribute ?></div>

                    </blockquote>
                <?php endforeach; ?>
            </ul>
        </div>
<!--        <div class="col-md-4">-->
<!--            --><?//=\frontend\widgets\WelcomeWidget::widget(); ?>
<!--            --><?//=\frontend\widgets\StatisticWidget::widget();?>
<!--        </div>-->
    </div>
</div>

<?= \frontend\widgets\ReviewsWidget::widget(); ?>