<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\ActiveForm;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<?php $this->title=Yii::t('app', 'Фермерский дом');?>
	<title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body class="b">
<script>
	window.appLang = "<?= Yii::$app->language ?>";
</script>
<?php $this->beginBody() ?>
<?php $this->registerJsFile('/js/mainAjax.js'); ?>
<?php $this->registerJsFile('/js/alert.js'); ?>

<script  type="text/javascript">
	$(document).ready(function(){

		$("ul#instructions li").first().addClass("active");
		$("div.tab-content .instaruction-show").first().addClass("active in");

	});
</script>
<?php $time = date('H', time()); ?>
<?php if($time > 7 && $time < 21): ?>
<div class="wrapper body-bg-d">
	<?php else: ?>
	<div class="wrapper body-bg-n">
		<?php endif; ?>
		<nav class="navbar navbar-default show">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="bmd-sidebar-toggle" data-target="#sidebar-overlay" style="position:inherit;">
						<i class="flaticon-menu55"><?= Yii::t('app', 'Меню') ?></i>
						<i class="flaticon-close47"></i>
					</a>
				</div>

				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="<?=Url::toRoute('/')?>" class="bmd-ripple"><?= Yii::t('app', 'Главная') ?></a></li>
						<li><a href="<?=Url::toRoute('/news')?>" class="bmd-ripple"><?= Yii::t('app', 'Новости') ?></a></li>
						<li><a href="javascript:void(0);" data-toggle="modal" class="bmd-ripple" data-target="#instruction"><?= Yii::t('app', 'Инструкция') ?></a></li>
						<li><a href="<?=Url::toRoute('/faq')?>" class="bmd-ripple">FAQ</a></li>
						<li><a href="javascript:void(0);" class="btn-ripple bmd-ripple" data-toggle="bmd-bottom-sheet" data-target="#bottom-sheet-default"><?= Yii::t('app', 'Отзывы') ?></a></li>
						<li><a href="<?=Url::toRoute('/charity/list/') ?>" class="bmd-ripple"><span class="badge bmd-bg-success bnd"><img class="clogo animated swing infinite" src="/img/clogo.png"><?= Yii::t('app', 'Благотворительность') ?></a></span></li>
						<li><?= common\modules\languages\widgets\ListWidget::widget() ?></li>
					</ul>
					<?php $instructions = \common\models\Instruction::find()->where(['is_active' => 1])->orderBy(['weight' => SORT_ASC])->all(); ?>
					<!-- Modal Instruction -->
					<div id="instruction" class="modal fade " tabindex="-1">
						<div class="modal-dialog1 ">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<center><h4 class="modal-title"><?= Yii::t('app', 'Инструкция') ?></h4></center>
									<ul class="nav nav-tabs bmd-nav-tabs bmd-nav-tabs-default" id="instructions">
										<?php foreach($instructions as $instruction){ ?>
											<li class=""><a href="#<?php echo $instruction->id; ?>" data-toggle="tab" class="bmd-ripple black" aria-expanded="false"><?= Yii::t('app', $instruction->title) ?></a></li>
										<?php } ?>
									</ul>
									<div id="myTabContent" class="tab-content">
										<?php foreach($instructions as $instruction){ ?>
											<div class="tab-pane fade instaruction-show" id="<?php echo $instruction->id; ?>">
												<p>
													<?php

													$contentAttribute = 'content' . (Yii::$app->language == 'en' ? '_en' : '');
													echo $instruction->$contentAttribute;

													?>
												</p>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Modal End Instruction -->
					<?php

					if (!Yii::$app->user->isGuest) :

						?>
						<!-- Modal Prof -->
						<div id="prof" class="modal fade side-target" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<center>  <div class="tegname"><h2><?= Yii::t('app', 'Профиль') ?></h2></div> </center>
										<ul class="nav nav-tabs modal-data-menu">
											<li class="active"><a class="info-ferma" href="#data" data-toggle="tab"><?= Yii::t('app', 'Смена данных') ?></a></li>
											<li><a class="info-ferma" href="#profile-pass-money" data-toggle="tab"><?= Yii::t('app', 'Получить/смена платежного пароля') ?></a></li>
											<li><a class="info-ferma" href="#profile-pass" data-toggle="tab"><?= Yii::t('app', 'Смена пароля от игры') ?></a></li>
										</ul>
										<div class="tab-content">
											<div class="tab-pane active" id="data">
												<?php $form = ActiveForm::begin(); ?>

												<div style="margin-left: 13px;">
													<p>E-mail</p>
													<input class="form-control" type="text" value="<?= Yii::$app->user->identity->email; ?>" maxlength="50" disabled="disabled">
													<!--													<b style="color:green">Подтвержден</b>-->
												</div>
												<br>
												<div style="margin-left: 13px">
													<p><?= Yii::t('app', 'Пол') ?></p>
													<select id="sex" class="form-control">
														<option value="1"><?= Yii::t('app', 'М') ?></option>
														<option value="0"><?= Yii::t('app', 'Ж') ?></option>
													</select>
												</div>
												<br>

												<div style="margin-left: 13px">
													<p><?= Yii::t('app', 'Получать новости на емайл?') ?></p>
													<select id="mailing" class="form-control">
														<option value="1"><?= Yii::t('app', 'Да') ?></option>
														<option value="0"><?= Yii::t('app', 'Нет') ?></option>
													</select>
													<label><span id="userId" style="display: none;"><?= Yii::$app->user->identity->id; ?></span></label>
													<br>
													<a href="javascript:void();" class="btn btn-success mainProfile-btn">Сохранить</a>
													<div style="clear: both"></div>
													<span class="msg_response_profile" style="color:red; display: none; font-weight: bold;"></span>
												</div>
												<?php ActiveForm::end(); ?><br>
												<p style="margin-left: 13px;"><?= Yii::t('app', 'В целях безопасности личного кабинета, почта пользователей не подлежит изменению. Для смены почты необходимо создать тикет в тех. поддержку. Ваш запрос будет удовлетворён в течении 3-х дней, после проверки на предмет мошенничества.') ?></p>
											</div>
											<div class="tab-pane" id="profile-pass-money">
												<br><?= Yii::t('app', 'Платежный пароль – это дополнительная защита учетной записи от взлома и кражи средств. Платежный пароль используется для вывода средств из проекта и перевода средств другому пользователю.') ?><br>
												<br>
												<form action="" method="post">
													<a href="javascript:void();" class="btn btn-success pay_pass"><?= Yii::t('app', 'Восстановить платежный пароль') ?></a>
													<br>
													<span class="msg_response_paypass" style="color:green; font-weight: bold;"></span>
												</form>
												<font>
													<br><?= Yii::t('app', 'Внимание! При восстановлении старый пароль будет недействителен. Процедура восстановления займет 7 суток. Не используйте эту функцию, если Вы знаете свой платежный пароль.') ?></font>
											</div>
											<div class="tab-pane" id="profile-pass">
												<br>
												<?php $passwordModel = new \frontend\models\ChangePasswordForm(); ?>
												<?php $form = \yii\widgets\ActiveForm::begin(['id' => 'change-pass-form', 'action' => \yii\helpers\Url::toRoute('/ajax/password')]); ?>
												<p>
													<?= $form->field($passwordModel, 'oldPassword')->passwordInput(['class' => 'form-control', 'autocomplete'=>"off", 'placeholder' => Yii::t('app', 'Старый пароль')])->label(false); ?>
												</p>
												<br/>
												<p>
													<?= $form->field($passwordModel, 'password')->passwordInput(['class' => 'form-control', 'autocomplete'=>"off", 'placeholder' => Yii::t('app', 'Новый пароль')])->label(false); ?>
												</p>
												<br/>
												<p>
													<?= $form->field($passwordModel, 'repeatPassword')->passwordInput(['class' => 'form-control', 'autocomplete'=>"off", 'placeholder' => Yii::t('app', 'Новый пароль (Подтверждение)')])->label(false); ?>
												</p>
												<a href="javascript:void(0);" class="btn btn-success mainPassword-btn"><?= Yii::t('app', 'Сохранить') ?></a>
												<span class="msg_response_pass" style="color:red; display: none; font-weight: bold;"></span>
												<?php \yii\widgets\ActiveForm::end(); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- Modal End Prof -->

						<!-- Modal Account -->
						<div id="account" class="modal fade side-target" tabindex="-1">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
										<center>  <div class="tegname"><h2><?= Yii::t('app', 'Аккаунт пользователя') ?></h2></div></center>
										<br>
										<div class="col-md-12">
											<h3><?= Yii::t('app', 'Основные данные') ?></h3>
											<span class="bold"><?= Yii::t('app', 'Дата и время регистрации') ?></span>: <?=date('Y-m-d h:i:s', Yii::$app->user->identity->signup_date); ?><br />
											<span class="bold"><?= Yii::t('app', 'Дата и время последнего входа') ?></span>: <?=date('Y-m-d h:i:s', Yii::$app->user->identity->login_date); ?><br />
											<span class="bold"><?= Yii::t('app', 'Ip регистрации') ?></span>: <?= Yii::$app->user->identity->signup_ip; ?> <br />
											<span class="bold"><?= Yii::t('app', 'Последний ip') ?></span>: <?= Yii::$app->user->identity->last_ip; ?> <br />
											<span class="bold"><?= Yii::t('app', 'Текуший ip') ?></span>: <?php echo $_SERVER["REMOTE_ADDR"]; ?> <br />
											<span class="bold"><?= Yii::t('app', 'Ваша страна') ?></span>: <?= Yii::$app->user->identity->country; ?><br />
											<span class="bold"><?= Yii::t('app', 'Баланс для оплаты') ?></span>: <?= Yii::$app->user->identity->for_pay; ?> <?= mb_strtolower(Yii::t('app', 'Руб')) ?>.   <a href="<?=Url::toRoute('/pay/list')?>"><b><?= Yii::t('app', 'Пополнить') ?></b></a> <a href="<?=Url::toRoute('/pay/transfer') ?>"><b><?= Yii::t('app', 'Перевести средства') ?></b></a><br />
											<span class="bold"><?= Yii::t('app', 'Баланс для вывода') ?></span>: <?= Yii::$app->user->identity->for_out; ?> <?= mb_strtolower(Yii::t('app', 'Руб')) ?>. <a href="<?=Url::toRoute('/pay/out')?>"><b><?= Yii::t('app', 'Вывести') ?></b></a><br />
											<span class="bold"><?= Yii::t('app', 'Выведено') ?></span>: <?= Yii::$app->user->identity->outed; ?> <?= mb_strtolower(Yii::t('app', 'Руб')) ?>.<br /><br />
										</div>
										<div class="col-md-6">
											</p><h3><?= Yii::t('app', 'Друзья') ?></h3>
											<p>
												<a href="<?=Url::toRoute('/site/reflink/')?>"><?= Yii::t('app', 'Материалы для привлечения друзей') ?></a><br />
												<a href="<?=Url::toRoute('/profile/friendlist/')?>"><?= Yii::t('app', 'Список друзей') ?></a><br />
											</p>
										</div>
										<div class="col-md-6">
											<h3><?= Yii::t('app', 'Чат') ?></h3>
											<p>
												<a href="<?=Url::toRoute('/chat/index/')?>"><?= Yii::t('app', 'Общаться в чате') ?></a><br />
											</p>
										</div>
										<div class="clear"></div>
									</div>
									<div style="clear: both"></div>
								</div>
							</div>
						</div>
						<!-- Modal End Account -->

					<?php endif; ?>

					<ul class="nav navbar-nav navbar-right">
						<!--					<li class="dropdown bmd-dropdown">-->

						<?php if (Yii::$app->user->isGuest) : ?>
							<!--<a href="--><?//= Url::toRoute(['/login']) ?><!--" class="regst">Вход</a>-->
							<!--						<a href="" data-toggle="modal" data-target="#complete-dialog" class="bmd-ripple" role="button" aria-expanded="false">Войти<i class="flaticon-show8"></i></a>-->
							<li><a data-toggle="modal" data-target="#complete-dialog" role="button" aria-expanded="false" href="#" class="bmd-ripple"><?= Yii::t('app', 'Войти') ?></a></li>
							<li><a href="#" data-dismiss="modal" data-toggle="modal" data-target="#register" class="bmd-ripple"><?= Yii::t('app', 'Регистрация') ?></a></li>
						<?php else: ?>
							<li><?= Html::a(Yii::t('app', 'Выход'), ['site/logout'], ['data' => ['method' => 'GET'],'class'=>'bmd-ripple']) ?></li>
						<?php endif; ?>

						<!--					</li>-->
					</ul>
				</div>
			</div>
		</nav>
		<!-- inline style for demo purpose -->

		<div id="sidebar-overlay" class="bmd-sidebar bmd-sidebar-left bmd-sidebar-overlay sdb" style="position:fixed;">
			<ul class="bmd-sidebar-nav list-unstyled">
				<li class="bmd-sidebar-brand"><h3><span href="#" style="color:white;" class="bmd-ripple side-target"><?= Yii::t('app', 'Меню') ?></span></h3></li>
				<?php if (\Yii::$app->user->isGuest) : ?>
					<li><a href="<?= Url::toRoute('/tos') ?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Пользовательское соглашение') ?></a></li>
					<li><a href="<?= Url::toRoute('/top') ?>" data-toggle="modal" data-target="#top100" class="bmd-ripple side-target"><?= Yii::t('app', 'Топ 100' ) ?></a></li>
					<!--<li><a href="/pay/last" data-toggle="modal" data-target="#money" class="bmd-ripple side-target">Последние выплаты</a></li>  Он не аякс чтобы пахать в модалке  -->
					<li><a href="<?= Url::toRoute('/pay/last') ?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Последние выплаты') ?></a></li>
					<li><a href="<?= Url::toRoute('/contact') ?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Контакты') ?></a></li>
				<?php else: ?>
					<li>
						<a href="#" data-target="#submenu-info" data-toggle="collapse" class="bmd-ripple parent-menu collapsed side-target">&dArr;  <?= Yii::t('app', 'Пользователь' ) ?></a>
						<ul class="list-unstyled collapse side-target" id="submenu-info">
							<li><a href="" class="side-target" data-toggle="modal" data-target="#account"><?= Yii::t('app', 'Аккаунт' ) ?></a></li>
							<li><a href="" class="side-target" data-toggle="modal" data-target="#prof"><?= Yii::t('app', 'Профиль' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/profile/index/')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Стена фермера' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/profile/my-history/')?>"><?= Yii::t('app', 'История' ) ?></a></li>
						</ul>
					</li>
					<li>
						<a href="#" data-target="#submenu-info1" data-toggle="collapse" class="bmd-ripple parent-menu collapsed side-target">&dArr;  <?= Yii::t('app', 'Баланс' ) ?></a>
						<ul class="list-unstyled collapse side-target" id="submenu-info1">
							<li><a href="<?=Url::toRoute('/pay/list')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Пополнить' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/pay/transfer')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Перевод' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/pay/exchanger')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Обменный пункт' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/pay/out')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Вывод' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/pay/last')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Последние выплаты' ) ?></a></li>
						</ul>
					</li>
					<li>
						<a href="#" data-target="#submenu-info2" data-toggle="collapse" class="bmd-ripple parent-menu collapsed side-target">&dArr;  <?= Yii::t('app', 'Друзья' ) ?></a>
						<ul class="list-unstyled collapse side-target" id="submenu-info2">
							<li><a href="<?=Url::toRoute('/profile/friendlist/')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Ваши друзья' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/site/reflink/')?>" class="side-target"><?= Yii::t('app', 'Рекламные материалы' ) ?></a></li>
						</ul>
					</li>
					<li>
						<a href="#" data-target="#submenu-info3" data-toggle="collapse" class="side-target bmd-ripple collapsed">&dArr;  <?= Yii::t('app', 'Об игре' ) ?></a>
						<ul class="list-unstyled collapse side-target" id="submenu-info3">
							<li><a href="<?=Url::toRoute('/tos')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Польз. Соглашение' ) ?></a></li>
							<li><a href="<?=Url::toRoute('/site/statistics')?>" class="bmd-ripple side-target"><?= Yii::t('app', 'Статистика' ) ?></a></li>
						</ul>
					</li>
					<li><a href="<?=Url::toRoute('/game/')?>" data-toggle="modal" class="side-target"><?= Yii::t('app', 'Игра' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/site/exchange')?>" data-toggle="modal" class="side-target"><?= Yii::t('app', 'Биржа опыта' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/top')?>" class="side-target" data-toggle="modal" data-target="#top100"><?= Yii::t('app', 'Топ 100' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/bonus/index/')?>" class="side-target" data-toggle="modal"><?= Yii::t('app', 'Бонус' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/mails/in/')?>" class="side-target" data-toggle="modal"><?= Yii::t('app', 'Внутренняя почта' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/contact')?>" class="side-target" data-toggle="modal"><?= Yii::t('app', 'Контакты' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/support/out/')?>" class="side-target" data-toggle="modal"><?= Yii::t('app', 'Тех.Поддержка' ) ?></a></li>
					<li><a href="<?=Url::toRoute('/chat/index/')?>" class="side-target" data-toggle="modal"><?= Yii::t('app', 'Чат игры' ) ?></a></li>
					<li><?= Html::a(Yii::t('app', 'Выход' ), ['site/logout'], ['class' => 'bmd-ripple red'], ['data' => ['method' => 'POST']]) ?></li>
				<?php endif; ?>
			</ul>
		</div>
		<?= Breadcrumbs::widget([
			'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
		]) ?>
		<?= Alert::widget() ?>
		<?= $content ?>
	</div>

	<!-- Modal top100 -->
	<div id="top100" class="modal fade side-target" tabindex="-1">
		<div class="modal-dialog1">
			<div class="modal-content">

			</div>
		</div>
	</div>
	<!-- Top100 end -->


	<!-- Modal Money -->
	<div id="money" class="modal fade side-target" tabindex="-1">
		<div class="modal-dialog1">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close side-target" data-dismiss="modal" aria-hidden="true">×</button>
					<center><h4 class="modal-title"><?= Yii::t('app', 'Последние выплаты') ?></h4></center>
					<table class="table table-striped table-hover ">
						<thead>
						<tr>
							<th><?= Yii::t('app', 'Ферма') ?></th>
							<th><?= Yii::t('app', 'Уровень') ?></th>
							<th><?= Yii::t('app', 'Сумма (руб)') ?></th>
							<th><?= Yii::t('app', 'Дата') ?></th>
						</tr>
						</thead>
						<tbody>
						<tr class="info">
							<td>1</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="active">
							<td>2</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="info">
							<td>3</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="active">
							<td>4</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="info">
							<td>5</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="active">
							<td>6</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						<tr class="info">
							<td>7</td>
							<td>Column content</td>
							<td>Column content</td>
							<td>Column content</td>
						</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!-- Money end -->
	<div class="modal" id="message">
		<div class="modal-dialog-f bmd-modal-dialog">
			<div class="modal-content-f">
				<div class="modal-header bmd-bg-ferma">
					<button type="button" class="msg-close side-target close btn-link bmd-flat-btn" data-dismiss="modal" aria-hidden="true">×</button>
					<center><h4 class="modal-title"><?= Yii::t('app', 'Фермерский дом') ?></h4></center>
				</div>
				<div class="modal-body">
					<center>
						<p class="response-answer"></p>
					</center>
				</div>
				<div class="modal-ferma">
					<center><button id="site-close-button" type="button" class="msg-close btn btn-success bmd-ripple bmd-ink-grey-400 btn-fer" data-dismiss="modal"><?= Yii::t('app', 'Закрыть') ?></button></center>
				</div>
			</div>
		</div>
	</div>
</div><!-- End wrapper -->
<footer class="footer">
	<span class="fot"><?= Yii::t('app', 'Все права защищены') ?></span>

	<span class="foot"><a target="_blank" href="http://vk.com"><img class="logo-ferma-vk" src="<?= Yii::$app->getUrlManager()->baseUrl .'/img/vk.svg' ?>"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a target="_blank" href="https://ferma.ru/"><?= Yii::t('app', 'Фермерский дом') ?></a></span>



	<!--		<span class="foot"><a href="https://ferma.ru/">Ферма</a></span>-->

</footer>

<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/hideShowPassword.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php if(!Yii::$app->user->isGuest): ?>
	<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/notify/bootstrap-notify.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
	<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/notifier.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php endif; ?>
<?=\frontend\widgets\LoginWidget::widget(); ?>

<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/prettify.js', ['depends' => [\yii\web\JqueryAsset::className()],['position'=>\yii\web\View::POS_END]]); ?>
<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/main.min.js', ['depends' => [\yii\web\JqueryAsset::className()],['position'=>\yii\web\View::POS_END]]); ?>

<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/gritter/js/jquery.gritter.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<script type="text/javascript">
	$(function() {
		//notify status: 1 - news; 2 - mails, 3 - msgs, 4 - support
		UPDATE_TYPE = 1;

		//menu tray close
		$('html').click(function(event)
		{
			if((!$(event.target).is('div.side-target')) && (!$(event.target).is('a.side-target')) && (!$(event.target).is('i.flaticon-menu55')) && (!$(event.target).is('button.side-target')) )
			{
				var menu = $("#sidebar-overlay");
				if(menu.hasClass("bmd-sidebar-active" ))
				{
					menu.removeClass("bmd-sidebar-active");
				}
			}
		});

	});

	$('document').ready(function()
	{

		$('#changepasswordform-oldpassword').hideShowPassword({
			innerToggle: true
		});

		$('#changepasswordform-password').hideShowPassword({
			innerToggle: true
		});

		$('#changepasswordform-repeatpassword').hideShowPassword({
			innerToggle: true
		});

		//get server time start
		flag = true;
		timer = '';
		if (flag) {
			<?php $date = new DateTime(); ?>
			timer = <?=$date->getTimestamp(); ?>//*1000;
		}
		setInterval(function(){getServerTime($('.server-time'));},1000);

		<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/serverTime.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>
		//get server time end
		$('body').on('click','.msg-close', function()
		{
			location.reload();
		});

	});

	<?php if(!Yii::$app->user->isGuest): ?>
	function checkUpdates()
	{
		if(UPDATE_TYPE == 4)
		{
			url = "<?=Url::toRoute('/news/notify-support') ?>";
			UPDATE_TYPE = 1;
		}
		else
		{
			if(UPDATE_TYPE == 2)
			{
				url = "<?=Url::toRoute('/news/notify-mail') ?>";
			}
			else if(UPDATE_TYPE == 3)
			{
				url = "<?=Url::toRoute('/news/get-notify')?>";
			}
			else
			{
				url = "<?=Url::toRoute('/news/notify-message')?>";
			}
			UPDATE_TYPE += 1;
		}
		$.ajax({
			url: url,
			type: "POST",
			async:true,
			data: { '_csrf': "<?= Yii::$app->request->csrfToken ?>" }
		}).done(function(response){
			if(response.status)
			{
				showNotify(response.title, response.msg, response.url);
			}
		});
	}
	<?php endif; ?>

</script>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
