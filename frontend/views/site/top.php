<?php

use yii\helpers\Url;

?>

<div class="modal-header">
    <button type="button" class="close side-target" data-dismiss="modal" aria-hidden="true">×</button>
    <center><h4 class="modal-title"><?= mb_strtoupper(Yii::t('app', 'Топ 100')) ?></h4></center>
    <table class="table table-striped table-hover ">
        <thead>
        <tr >
            <th><?= Yii::t('app', 'Место' ) ?></th>
            <th><?= Yii::t('app', 'Фермер' ) ?></th>
            <th><?= Yii::t('app', 'Уровень' ) ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $i=1; if(Yii::$app->user->isGuest):  ?>
            <?php foreach($users as $idx => $user) : ?>
                <?php $class = ($i%2==0) ? 'info' : 'active'; ?>
                <tr class="<?= $class;?>">
                    <td><?= $idx+1 ?></td>
                    <td><?= $user->username; ?></td>
                    <td><?= $user->level; ?></td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>
        <?php else: ?>
            <?php foreach($users as $idx => $user) : ?>
                <?php $class = ($i%2==0) ? 'info' : 'active'; ?>
                <tr class="<?= $class;?>">
                    <td><?= $idx+1 ?></td>
                    <td><a title="<?= Yii::t('app', 'Смотреть стену фермера') ?> <?= $user->username; ?>" href="<?= Url::toRoute('/profile/view/' . $user->username) ?>"><?= $user->username; ?></a></td>
                    <td><?= $user->level; ?></td>
                </tr>
                <?php $i++ ?>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<!-- Top100 end -->
