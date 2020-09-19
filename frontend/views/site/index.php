<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\models\User;
use common\models\Session;
use yii\helpers\Url;
?>
<div class="loader"></div>
<!-- CONTENT -->
<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-4">
            <!-- PROFILE -->
            <?php if (Yii::$app->user->isGuest) : ?>
            <center class="pri-ferma-text">
                <h2><i class="priv"><?= Yii::t('app', 'Фермерский дом') ?></i></h2>
                <p class="priv"><?= Yii::t('app', 'gameDescription') ?></p>
                <h3 class="text-ferma"></h3>
            </center>
            <?php else: ?>
                <div class="pri-ferma-text">
                    <div class="co">
                        <div class="col-md-3">
                            <center class="avatar"><img src="<?php if(!$user->photo){ echo '/avata
                            rs/ava.png'; }else{ echo '/avatars/'.$user->photo.''; } ?>" class="ava"><a href="<?= Url::toRoute('/profile/index') ?>" class="btn btn-danger bmd-ripple btn-xs ex"><?= $user->username ?></a></center>
                        </div>
                        <div class="col-md-8 to">
                            <p class="p-class-ferma"><?= Yii::t('app', 'Добро пожаловать') ?>!<span class="float-float">
                            <?php

                            $male_alt = Yii::t('app', 'Ваш пол') . ' - ';

                            if($user->sex == User::SEX_MALE){
                                $male_img = User::SEX_MALE_IMG;
                                $male_alt .= Yii::t('app', 'Мужской');
                            }
                            else
                            {
                                $male_img = User::SEX_FEMALE_IMG;
                                $male_alt .= Yii::t('app', 'Женский');;
                            }

                            ?>
                                <img class="ava-ferma" alt="<?= Yii::t('app', 'Мужчина') ?>" src="<?= '/img/'.$male_img; ?>" title="<?= $male_alt; ?>">
                                </span>
                                <a href="<?= Url::toRoute('/mails/in/') ?>">
                                    <i class="bmd-icon material-icons ri mes" title="<?= Yii::t('app', 'Написать сообщение') ?>">
                                        <?php
                                            if($mails > 0){
                                                echo '<img src="/img/mail-icon1.png" style="margin-top:-5px; width: 20px; height: 15px;" alt="">';
                                            }else{
                                                echo '<img src="/img/mail-icon.png" style="margin-top:-5px; width: 20px; height: 15px;" alt="">';
                                            }
                                        ?>
                                    </i>
                                </a></p>
                            <p class="p-class-ferma"><?= Yii::t('app', 'Ваш уровень') ?>:<span class="badge bmd-bg-primary float-float"><?= $user->level ?></span> </p>
                            <p class="p-class-ferma"><?= Yii::t('app', 'Оплата') ?>: <span class="badge bmd-bg-success float-float" title="<?= Yii::t('app', 'Баланс для оплаты') ?>"> <?= number_format($user->for_pay,2, '.', ' ') ?> <?= Yii::t('app', 'руб') ?></span></p>
                            <p class="p-class-ferma"><?= Yii::t('app', 'Вывод') ?>: <span class="badge bmd-bg-success float-float" title="<?= Yii::t('app', 'Баланс для вывода') ?>"> <?= number_format($user->for_out,2, '.', ' ') ?> <?= Yii::t('app', 'руб') ?></span></p>
                        </div>
                        <div class="col-md-12">
                            <div class="col-md-11 col-md-offset-1 col-mod-0">
                                <span><?= Yii::t('app', 'Опыт') ?>:<!--<span class="badge bmd-bg-primary float-float">350/1820</span><a href="#"></a>--></span>
                                <div class="progress-ferma">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0" aria-valuemax="100" style="width:<?=(($user->experience)*100)/($user->need_experience)?>%">
                                        <span class="sr-only">70% Complete</span>
                                        <div class="u_exp"><?=$user->experience;?>/<?=$user->need_experience;?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-11 col-md-offset-1 col-mod-0">
                                <span><?= Yii::t('app', 'Энергия') ?>:<!--<span class="badge bmd-bg-success float-float"><?/*=$user->energy;*/?></span>--><a href="#"></a></span>
                                <div class="progress-ferma">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0" aria-valuemax="100" style="width:<?php if(($user->energy)>1000) { echo 100; } else { echo ($user->energy)/10; }?>%">
                                        <span class="sr-only">70% Complete</span>
                                        <div class="u_exp"><?=$user->energy;?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-ferma"><?= Yii::t('app', 'Фермерский дом') ?></h3>
                </div>
            <?php endif; ?>
        </div>
        <div class="col-md-4 img">
            <center><a href="" data-toggle="modal" data-target="#youtubeModal" class="btn btn-danger1 bmd-ripple bmd-fab1 bmd-floating youtubei">
                    <i class="bmd-icon1 material-icons">play_arrow</i>

                </a>
                <br>
                <!--            <a href="" class="btn btn-primary  bmd-ripple start">Начать игру</a>-->
                <?php if(Yii::$app->user->isGuest): ?>
                    <a data-toggle="modal" data-target="#complete-dialog" role="button" aria-expanded="false" href="#" class="btn btn-primary  bmd-ripple mar-gin"><?= Yii::t('app', 'Начать игру') ?></a>
                <?php else: ?>
                    <a class="btn btn-primary  bmd-ripple mar-gin" href="<?= Url::toRoute('/game') ?>"><?= Yii::t('app', 'Начать игру') ?></a>
                <?php endif; ?>
            </center>
        </div>

        <div class="col-md-4">
            <div class="pri-ferma-text-1">
                <div class="ferma-blok">
                    <p class="padding-farma"><?= Yii::t('app', 'Пользователей') ?>:
                        <span class="badge bmd-bg-primary float-float"><?= $user_count_total ?> [+<?= $today_users ?> <?= mb_strtolower(Yii::t('app', 'Новых')) ?>]</span>
                    </p>
                    <p class="padding-farma"><?= Yii::t('app', 'Выплат') ?>:<span class="badge bmd-bg-info float-float"><?= number_format($payOutCount, 0, '.', ' ') ?></span>  </p>
                    <p class="padding-farma"><?= Yii::t('app', 'На сайте') ?>:<a href="<?= Url::toRoute('/online') ?>"><span class="badge bmd-bg-info float-float bmd-ripple" >  <?= $user_count ?>/<?= $online_users; ?> <?= Yii::t('app', 'Кто') ?>?</span></a></p>
                    <p class="padding-farma"><?= Yii::t('app', 'Время сервера') ?>:&nbsp;&nbsp;
                        <span class="badge bmd-bg-success float-float">
                        <span class="afss_day_bv"></span>&nbsp;<span class="afss_month_bv"></span>,
                        <span class="afss_hours_bv">00</span>:
                        <span class="afss_mins_bv">00</span>:
                        <span class="afss_secs_bv">00&nbsp;</span>&nbsp;
                        </span>
                    </p>
                </div>
                <h3 class="text-ferma-1">FarmHouse.Pro</h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="col-md-6 col-md-offset-3 lef">
            <center>
                <a href="#home" data-toggle="tab" class="bmd-ripple btn mod-ferma bmd-ink-grey-400"><?= Yii::t('app', 'Куплено сегодня') ?></a>
                <a href="#profile" data-toggle="tab" class="bmd-ripple btn mod-ferma"><?= Yii::t('app', 'Куплено') ?></a>
                <a href="#dropdown1" data-toggle="tab" class="bmd-ripple btn mod-ferma bmd-ink-grey-400"><?= Yii::t('app', 'Статистика покупок') ?></a>
            </center>
        </div>
        <div id="myTabContent" class="tab-content">
            <div class="tab-pane fade dist" id="home">
                <div class="col-md-3">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->today_bought_chickens)[0]?></span>
                        <?= Yii::t('app', 'Кур') ?>
                    </li>
                </div>
                <div class="col-md-3">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->today_bought_bulls)[0]?></span>
                        <?= Yii::t('app', 'Бычков') ?>
                    </li>
                </div>
                <div class="col-md-3">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->today_bought_goats)[0]?></span>
                        <?= Yii::t('app', 'Коз') ?>
                    </li>
                </div>
                <div class="col-md-3">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->today_bought_cows)[0]?></span>
                        <?= Yii::t('app', 'Коров') ?>
                    </li>
                </div>
            </div>
            <div class="tab-pane fade active in dis" id="profile">
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_lands)[0]?></span>
                        <?= Yii::t('app', 'Полей') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_paddock_chickens)[0]?></span>
                        <?= Yii::t('app', 'Загонов кур') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_paddock_bulls)[0]?></span>
                        <?= Yii::t('app', 'Загонов бычков') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_paddock_goats)[0]?></span>
                        <?= Yii::t('app', 'Загонов коз') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_paddock_cows)[0]?></span>
                        <?= Yii::t('app', 'Загонов коров') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_factory_dough)[0]?></span>
                        <?= Yii::t('app', 'Фабрика теста') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_factory_mince)[0]?></span>
                        <?= Yii::t('app', 'Фабрика фарша') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_factory_cheese)[0]?></span>
                        <?= Yii::t('app', 'Фабрика сыра') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_factory_curd)[0]?></span>
                        <?= Yii::t('app', 'Фабрика творога') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_meat_bakery)[0]?></span>
                        <?= Yii::t('app', 'Пекарней "с мясом"') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_cheese_bakery)[0]?></span>
                        <?= Yii::t('app', 'Пекарней "с сыром"') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_curd_bakery)[0]?></span>
                        <?= Yii::t('app', 'Пекарней "с творогом"') ?>
                    </li>
                </div>
            </div>
            <div class="tab-pane fade dist" id="dropdown1">
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_chickens)[0]?></span>
                        <?= Yii::t('app', 'Кур') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_bulls)[0]?></span>
                        <?= Yii::t('app', 'Бычков') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_goats)[0]?></span>
                        <?= Yii::t('app', 'Коз') ?>
                    </li>
                </div>
                <div class="col-md-3 sts">
                    <li class="list-group-item">
                        <span class="badge bmd-bg-success"><?=explode(':', $statistics->all_bought_cows)[0]?></span>
                        <?= Yii::t('app', 'Коров') ?>
                    </li>
                </div>
            </div>
        </div>
        <div>
            <div class="col-md-3">
                <li class="list-group-item">
                    <span class="badge bmd-bg-primary"><?= Yii::t('app', 'Дата') ?></span>
                    <?= Yii::t('app', 'Старт игры') ?>
                </li>
            </div>
            <div class="col-md-3">
                <li class="list-group-item">
                    <span class="badge bmd-bg-primary"><?= number_format($allPayDiff,2, '.', ' ') ?> <?= Yii::t('app', 'руб') ?></span>
                    <?= Yii::t('app', 'Резерв выплат') ?>
                </li>
            </div>
            <div class="col-md-3">
                <li class="list-group-item">
                    <span class="badge bmd-bg-primary"><?= number_format($farmstorage->money_storage,2, '.', ' ') ?> руб</span>
                    <?= Yii::t('app', 'Резерв ярмарки') ?>
                </li>
            </div>
            <div class="col-md-3">
                <li class="list-group-item">
                    <span class="badge bmd-bg-primary"><?= number_format($allPayOutSum,2, '.', ' ')?> руб</span>
                    <?= Yii::t('app', 'Выплачено') ?>
                </li>
            </div>
        </div>

    </div>
	 <body>
	 <!--LiveInternet counter--><script type="text/javascript"><!--
new Image().src = "//counter.yadro.ru/hit?r"+
escape(document.referrer)+((typeof(screen)=="undefined")?"":
";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?
screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+
";"+Math.random();//--></script><!--/LiveInternet-->

<body>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter = new Ya.Metrika({
                    id:,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/30953776" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->

<!-- CONTENT END -->
<?= \frontend\widgets\ReviewsWidget::widget(); ?>


      <!-- Modal Youtube -->
        <div id="youtubeModal" class="modal" tabindex="-1" role="dialog">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                      </div>
                        <div class="modal-body">
                        <iframe class="youtube" width="100%" height="500" src="" frameborder="0" allowfullscreen></iframe>
                    </div>
                    </div>
                  </div>
           </div>
        </div>
          <!-- Modal End Youtube -->



<script type="text/javascript">
    // disable video after hide modal
    $(document).ready(function(){
        $("#youtubeModal").on("hidden.bs.modal", function () {
            var src = $(this).find('iframe').attr('src');
            $("#youtubeModal iframe").attr("src", '');
            $(this).find('iframe').attr('src', src);
        });
    });


    // Wait for window load
    //$(window).load(function() {
    // Animate loader off screen
       // $(".loader").fadeOut("slow");
    //});

    var secund = 0, minute = 0, hour = 0, datatimes = 0;

    function setHour(hour, minute, secund) {

        $('span.afss_hours_bv').text(hour);

        if (String(minute).length > 1)
            $('span.afss_mins_bv').text(minute);
        else
            $('span.afss_mins_bv').text("0" + minute);
        if (String(secund).length > 1)
            $('span.afss_secs_bv').text(secund);
        else
            $('span.afss_secs_bv').text("0" + secund);
    }

    function setDate(d, m) {
        var months = {
            ru: ['Января', 'Февраля', 'Марта', 'Апреля', 'Мая', 'Июня', 'Июля', 'Августа', 'Сентября', 'Октября', 'Ноября', 'Декабря'],
            en: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December']
        };
        var month = months['<?= Yii::$app->language ?>'];

        $('span.afss_day_bv').text(d);
        $('span.afss_month_bv').text(month[m]);
    }

    function SetTime(hour,minute,secund) {
        intervalID = setInterval(function () {
            secund = secund + 1;
            datatimes = datatimes + 1;
            setHour(hour, minute, secund);
            if (secund == 60) {
                secund = 0;
                minute++;
            }
            if (minute == 60) {
                minute = 0;
                hour++;
            }
            if (hour == 24) {
                hour = 0;
            }

            // set day and month [interval 600 = 10 minutes]
            if (datatimes == 600) {
                $.ajax({
                    url: "<?= Url::toRoute('site/server-time') ?>",
                    type: "POST",
                    async: true,
                    data: { '_csrf': "<?= Yii::$app->request->csrfToken ?>" }
                }).done(function(response){
                    if(response.status)
                    {
                        setDate(response.day, response.month);
                    }
                });
                datatimes = 0;
            }

        }, 1000);
    }
    SetTime(<?= date('H')?>, <?= date('i')?>, <?= date('s')?>);
    setDate(<?= date('j')?>, <?= (int)date('n')-1 ?>);

</script>
