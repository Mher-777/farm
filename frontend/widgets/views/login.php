<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 18.01.2016
 * Time: 18:28
 */
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>
<?php $this->registerJsFile(Yii::$app->getUrlManager()->baseUrl .'/js/bootstrap.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>

<!-- Modal Login-->
<div id="complete-dialog" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center>
                    <h4 class="modal-title"><?= Yii::t('app', 'Войти') ?></h4>
            </div>
            <div class="modal-body">
                <?php
                $form = ActiveForm::begin(['id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>
<center>
    <span class="err_msg" style="font-family: Roboto, sans-serif; display:none; color:red; font-size: 14px; font-weight: bold; text-align: center;"></span>
</center>
<div class="form-group  has-success">
    <label for="inputEmail" class="col-lg-2 control-label bmd-control-label"><i class="flaticon-black402"></i></label>
    <div class="col-lg-9">
        <div class="bmd-field-group">
            <?php echo $form->field($login_model, 'username', ['options'=>['class'=>'bmd-input']]); ?>

            <span class="bmd-field-feedback"></span>
        </div>
    </div>
</div>
<div class="form-group has-success">
    <label for="inputPassword" class="col-lg-2 control-label bmd-control-label"><i class="flaticon-https"></i></label>
    <div class="col-lg-9">
        <div class="bmd-field-group">
            <?php echo $form->field($login_model, 'password', ['options'=>['class'=>'bmd-input']])->passwordInput(); ?>
        </div>
        <br/>

        <div class="checkbox bmd-checkbox bmd-checkbox-primary">
            <label>
                <input type="checkbox" id="remember_me" class="bmd-ripple">
                <span class="check"></span>
                <?= Yii::t('app', 'Запомнить меня') ?>
            </label>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
<!--                            </form>-->
</div>
    <div class="modal-footer">
        <center>
            <button class="btn btn-primary"  id="login"><?= Yii::t('app', 'Войти') ?></button><br/>
            <br/>
            <button class="btn btn-success do-reg"><?= Yii::t('app', 'Регистрация') ?></button><br/><br/>
            <a href="<?= Url::toRoute('/site/request-password-reset') ?>"><?= Yii::t('app', 'Забыли пароль?') ?></a></center>
    </div>
</div>
</div>
</div>
<!-- Modal Login End -->
<!-- Modal Register-->
<div id="register" class="modal fade" tabindex="-1">
    <div class="modal-dialog"  style="overflow: auto;">
        <div class="modal-content">
            <div class="modal-header" style="padding:15px;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <center><h4 class="modal-title"><?= Yii::t('app', 'Регистрация') ?></h4>
            </div>
            <div class="modal-body" style="top:-30px;">
                <?php $form = ActiveForm::begin(['id' => 'form-signup',
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>
                <center>
                    <span class="signup_err_msg" style="font-family: Roboto, sans-serif; display:none; color:red; font-size: 14px; font-weight: bold; text-align: center;"></span>
                    <span class="signup_succ_msg" style="font-family: Roboto, sans-serif; display:none; color:green; font-size: 16px; font-weight: bold; text-align: center;"></span>
                </center>
                <div class="form-group has-success">
                    <label for="signupform-username" class="col-lg-2 control-label bmd-control-label"><i class="bmd-icon material-icons blue">&#xe7fd;</i></label>
                    <div class="col-lg-9">
                        <div class="bmd-field-group">
                            <?php echo $form->field($signup_model, 'username', ['options'=>['class'=>'bmd-input input-']]); ?>
                            <span class="bmd-field-feedback"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="signupform-password" class="col-lg-2 control-label bmd-control-label"><i class="flaticon-https"></i></label>
                    <div class="col-lg-9">
                        <div class="bmd-field-group">
                            <?= $form->field($signup_model, 'password', ['options'=>['class'=>'bmd-input']])->passwordInput(); ?>
                        </div>
                        <br/>
                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="select" class="col-lg-2 control-label"><i class="bmd-icon material-icons blue">&#xe8d3;</i></label>
                    <div class="col-lg-9">
                        <div role="presentation" class="dropdown bmd-select form-control">
                            <?= $form->field($signup_model, 'sex')->radioList([
                                    '1' => Yii::t('app', 'Мужской'),
                                    '0' => Yii::t('app', 'Женский'),
                                ],
                                [
                                    'item' => function($index, $label, $name, $checked, $value) {

                                        $return = '<label class="modal-radio">';
                                        $checked = ($index == 0) ? 'checked' : '';
                                        $return .= '<input type="radio" name="' . $name . '" value="' . $value . '" tabindex="3"'. $checked.'>';
                                        $return .= '<i></i>';
                                        $return .= '<span>' . ucwords($label) . '</span>';
                                        $return .= '</label>';

                                        return $return;
                                    }
                                ]); ?>
                            <span class="bmd-bar"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group has-success">
                    <label for="inputEmail" class="col-lg-2 control-label bmd-control-label"><i class="flaticon-black402"></i></label>
                    <div class="col-lg-9">
                        <div class="bmd-field-group">
                            <?= $form->field($signup_model, 'email', ['options'=>['class'=>'bmd-input']])->input('email') ?>
                        </div>
                    </div>
                </div>
                <!--                    ref_id-->
                <div class="form-group has-success">
                    <label for="inputEmail" class="col-lg-2 control-label bmd-control-label"></label>

                    <div class="col-lg-9">
                        <div class="bmd-field-group">
                            <input type="hidden" name="ref_id" value="<?= (isset($ref_user) ? $ref_user->id : 0 ) ?>">
                            <strong><?= Yii::t('app', 'Вас пригласил') ?>:</strong> <?= (isset($ref_user) ? $ref_user->username : Yii::t('app', 'Сам(a) пришел(ла)')) ?>
                        </div>
                    </div>
                </div>
                <!--                    red_id end-->
				
                 <div class="checkbox bmd-checkbox bmd-checkbox-primary">
                    <?= $form->field($signup_model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
                        //'captchaAction' => '/frontend/components/MyCaptchaAction',
                        'template' => '<div class="col-lg-3">{image}</div><div class="col-lg-6" style="margin-right: -30px;">{input}</div><br><br>',
                    ]) ?>
                </div>
                <div class="checkbox bmd-checkbox bmd-checkbox-primary mar">
                    <label>
                        <input required type="checkbox" class="bmd-ripple" id="is_confirmed" name="confirm_signup">
                        <span class="check"></span>
                        <?= Yii::t('app', 'Я полностью принимаю условия <a href="{link}" target="_blank">пользовательского соглашения', [
                            'link' => Url::toRoute('/tos'),
                        ]) ?>
                    </label>
                </div>
                <div class="checkbox bmd-checkbox bmd-checkbox-primary mar">
                    <label>
                        <input type="checkbox" class="bmd-ripple" id="is_subscribed">
                        <span class="check"></span>
                        <?= Yii::t('app', 'Я согласен Получать новости на email') ?>
                            <span class="refLink" style="display: none"><?= (isset($ref_user) ? Yii::$app->request->getReferrer() : '')?></span>
                    </label>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="modal-footer" style="margin-top: -40px;">
                <center>
                    <button class="btn btn-primary btn-sm" id="signup"><?= Yii::t('app', 'Зарегистрироваться') ?></button>
                    <button class="btn btn-success btn-sm" data-dismiss="modal"><?= Yii::t('app', 'Отмена') ?></button>
                </center>
            </div>
        </div>
    </div>
</div>
<!-- Modal Register End -->
<!-- Loader Start -->
<div class="loader-modal" style="display: none;">
    <div class="center">
        <img alt="" src="/img/loader.gif" />
    </div>
</div>

<!--<a id="show-message" href="#" data-dismiss="modal" data-toggle="modal" data-target="#message" class="bmd-ripple"></a>-->
<!-- Loader End-->

<?php if (Yii::$app->user->isGuest): ?>

    <script type="application/javascript">
        $(document).ready(function(){
            // show/hide password
            $('#signupform-password').hideShowPassword({
                innerToggle: true
            });

            $('#loginform-password').hideShowPassword({
                innerToggle: true
            });

            // login script
            document.onkeydown = enterLogin;
            function enterLogin(x) {
                var key;
                key = x.which;
                if (key == 13) {
                    $('#login').click()
                }
            }

            $('.do-reg').click(function(e)
            {
                $('#complete-dialog').modal('hide');
                $('#register').modal('show');

                $('body').css('overflow','hidden');
                $('#register').css('overflow','auto');
            });

            $("#register").on("hidden.bs.modal", function () {
                $('body').css('overflow','auto');
                $('#register').css('overflow','hidden');
            });

            $("#register").on('shown.bs.modal', function() {
                $('#complete-dialog').modal('hide');
                $('#register').modal('show');

                $('body').css('overflow','hidden');
                $('#register').css('overflow','auto');
            });

            $('#login').click(function(e){
                var err_msg = $('.err_msg');
                err_msg.hide();
                err_msg.empty();
                e.preventDefault();
                var username = $('#loginform-username').val();
                var password = $('#loginform-password').val();
                var token    = $("input[name=_csrf]").val();
                var rememberMe = $('#remember_me').is(':checked');
                if ($('#login-form').find('.has-error').length) {
                    return true;
                }
                $.ajax({
                    url: "<?= Url::toRoute('site/login') ?>",
                    type: "POST",
                    async:true,
                    data: {'username': username, 'password' : password, '_csrf' : token,'rememberMe':rememberMe }, //'verifyCode':verifyCode
                    beforeSend: function () {
                        $(".loader-modal").show();
                    },
                    complete: function () {
                        $(".loader-modal").hide();
                    }
                }).done(function(response){

                    if(response.status)
                    {
                        err_msg.hide();
                        if(response.is_first)
                        {
                            $('#complete-dialog').modal('hide');
                            $('.response-answer').html(response.msg);
                            $('#message').modal('show');
                        }
                        else
                        {
                            location.reload();
                        }
                    }
                    else
                    {
                        err_msg.empty();
                        err_msg.append(response.msg);
                        err_msg.show();
                        e.preventDefault();
                    }
                });
            });

            //signup script
            $('#signup').click(function(e){
                e.preventDefault();
                var err_msg   = $('.signup_err_msg');
                err_msg.hide();
                var sucs_msg  = $('.signup_succ_msg');
                sucs_msg.hide();
                sucs_msg.empty();
                err_msg.empty();
                var username  = $('#signupform-username').val();
                var patt = /[а-яА-Я]/g;
                if(patt.test(username))
                {
                    err_msg.append('<?= Yii::t('app', 'Логин не должен содержать кириллицу') ?>');
                    err_msg.show();
                    return 1;
                }
                var password  = $('#signupform-password').val();
                var token     = $("input[name=_csrf]").val();
                var email     = $('#signupform-email').val();
                var verifyCode = $('#signupform-verifycode').val();
                var male       = $('input[name="SignupForm[sex]"]:checked').val();
                var is_subscribed = $('#is_subscribed').is(':checked');
                var is_confirmed = $('#is_confirmed').is(':checked');
                is_subscribed    = (is_subscribed == true ? 1 : 0);
                var ref_id       = $("input[name=ref_id]").val();
                var refLink       = $(".refLink").text();
                if ($('#signup-form').find('.has-error').length) {
                    return true;
                }
                if(is_confirmed)
                {
                    $.ajax({
                        url: "<?= Url::toRoute('site/signup') ?>",
                        type: "POST",
                        async: true,
                        data: { 'username': username,
                            'password' : password,
                            '_csrf' : token,
                            'is_subscribed':is_subscribed,
                            'verifyCode':verifyCode,
                            'male': male,
                            'email': email,
                            'is_confirmed' :is_confirmed,
                            'ref_id' : ref_id,
                            'refLink' : refLink
                        },
                        beforeSend: function () {
                            $(".loader-modal").show();
                        },
                        complete: function () {
                            $(".loader-modal").hide();
                        }
                    }).done(function(msg){
                        if(msg.status)
                        {
                            sucs_msg.append('<?= Yii::t('app', 'Регистрация прошла успешно') ?>');
                            sucs_msg.show();
                            $('#signupform-username').val('');
                            $('#signupform-password').val('');
                            $('#signupform-email').val('');
                            $('#signupform-verifycode').val('');
                            signupTimer = setTimeout(function(){
                                $('#register').modal('hide');
                                $('#complete-dialog').modal('show');
                                $('.response-answer').html(response.msg);
                                location.reload();
                            }, 3000);
                        }
                        else
                        {
                            err_msg.append(msg.msg);
                            err_msg.show();
                            $("img[id$='signupform-verifycode-image']").trigger('click');
                        }
                    });
                }
                else
                {
                    err_msg.append('<?= Yii::t('app', 'Условия пользовательского соглашения должны быть приняты') ?>');
                    err_msg.show();
                }
            });

        });
    </script>
<?php endif ?>