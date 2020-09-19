<link rel="stylesheet" href="/css/social.css">
<link rel="stylesheet" href="/css/comment.css">

<!-- CONTENT -->
<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-7 col-md-offset-3 boxshow">
            <h4 style="text-align:center;"><?= Yii::t('app', 'Последние выплаты') ?></h4>
            <hr>
            <table class="table table-striped table-hover ">
                <thead>
                <tr >
                    <th>No</th>
                    <th><?= Yii::t('app', 'Логин') ?></th>
                    <th><?= Yii::t('app', 'Сумма (руб)') ?></th>
                    <th><?= Yii::t('app', 'Дата') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php $i=1; foreach($payOutList as $history) : ?>
                    <?php $class = ($i%2==0) ? 'info' : 'active'; ?>
                    <tr class="<?= $class;?>">
                        <td><?= $i ?></td>
                        <td><?= $history->username ?></td>
                        <td><?=$history->amount; ?></td>
                        <td><?=date('Y-m-d H:i:s', $history->created_at); ?></td>
                    </tr>
                    <?php $i++ ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= \frontend\widgets\ReviewsWidget::widget(); ?>



