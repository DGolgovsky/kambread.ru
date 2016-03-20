<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = \Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
Здравствуйте, <?= $user->name ?>,

Пройдите по ссылке ниже для сброса Вашего пароля:

<?= $resetLink ?>
