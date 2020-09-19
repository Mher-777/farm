<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>Здравствуйте, <?= Html::encode($user->username) ?>!</p>

    <p>Воспользуйтесь ссылкой ниже, чтобы сбросить пароль:</p>

    <p><?= Html::a(Html::encode('Сбросить пароль'), $resetLink) ?></p>
</div>
