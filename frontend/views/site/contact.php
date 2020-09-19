<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-12 pri">
            <div class="faq_page_title"><?= Yii::t('app', 'Контакты') ?></div>
            <ul class="news_ul" style="padding-bottom: 50px;">
                <p class="contact-sub-title"> <?= Yii::t('app', 'Контакты администрации') ?>.</p>
                <?php if($contact):?>

                    <div style="margin-right: 35px;">
                        <?php

                        $contentAttribute = 'content' . (Yii::$app->language == 'en' ? '_en' : '');

                        ?>
                        <p><?= $contact->$contentAttribute ?></p>
                    </div>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>

<?= \frontend\widgets\ReviewsWidget::widget(); ?>
