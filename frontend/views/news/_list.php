<?php

use yii\helpers\Url;

$titleAttribute = 'title' . (Yii::$app->language == 'en' ? '_en' : '');
$teaserAttribute = 'teaser' . (Yii::$app->language == 'en' ? '_en' : '');

?>

<blockquote class="bmd-border-primary">
    <p class="faq_title"><a href="<?= Url::toRoute('/news/view/' . $model->id) ?>"><?php echo $model->$titleAttribute ?></a> </p>
    <div class="faq_content"><?php echo $model->$teaserAttribute ?></div>
    <?= '<hr>' ?>
    <div class="faq_content" style="margin-top: 7px;"><?= Yii::t('app', 'Комментариев') ?> (<?= ($model->comments_count) ? $model->comments_count : "0"; ?>) : <?=date('Y-m-d H:i:s', $model->created_at);?> </div>
</blockquote>
