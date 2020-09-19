<?php

use yii\helpers\Url;

?>

<?php if ($news): ?>
    <script type="text/javascript" src="/js/urlControl.js"></script>
    <script>
        $(document).ready(function() {

            $("#news-comment-button").click(function(){
                var element = $(this);
                var issetUrl = false;
                var username = $(".name").html();
                var validate = $('.msg_response').hide();
                var avatar = $(".avatar").html();
                var userID = $('.usersID').text();
                var csrfToken = $('meta[name="csrf-token"]').attr("content");

                var text = element.closest('#news-comment-post').find('#news-comment-textarea').val();
                text = $.trim(text);

                var news_id = element.closest('#news-comment-post').find('.id').text();
                news_id = $.trim(news_id);

                if(text == "" || news_id == ""){
                    $('.msg_response').html('');
                    var message = "<?= Yii::t('app', 'Все поля должны быть заполнены') ?>";
                    validate.append(message);
                    validate.css('color','red');
                    validate.show();
                }else{

                    var findRU = text.indexOf(".ru");
                    var findCOM = text.indexOf(".com");
                    var findNET = text.indexOf(".net");
                    var findORG = text.indexOf(".org");
                    var findHTTP = text.indexOf("http://");
                    var findHTTPS = text.indexOf("https://");
                    var findWWW = text.indexOf("www.");

                    if (findRU >= 0 || findCOM >= 0 || findNET >= 0 || findORG >= 0 || findHTTP >=0 || findHTTPS >=0 || findWWW >= 0){

                    }else {

                        issetUrl = findUrls(text);
                        if (issetUrl.length > 0) {
                            console.log(issetUrl);
                            return 1;
                        }
                        $.ajax({
                            url: "<?= Url::toRoute('/news/viewajax/') ?>",
                            type: "POSt",
                            async: true,
                            data: {'text': text, 'news_id': news_id, 'type': 1, 'id': news_id, 'userID':userID, '_csrf': csrfToken}
                        }).done(function (result) {
                            if (result.newsComment) {
                                var comment = element.parents('div.pri').find('#news-comment-add');
                                var userID = element.closest('.news-comment-list').find('.userID').text();
                                var commentID = result.commentID;
                                comment.before('<div class="news-comment-list">' +

                                    '<img src="/avatars/' + avatar + '" class="news-comment-image" alt="">' +

                                    '<a href="" class="news-comment-user">' + username + '</a>' +
                                    '<span>&nbsp;&nbsp;' + result.date + '</span>' +
                                    '&nbsp;&nbsp;<a href="javascript:void(0);" class="reply_comment" data-username="' + username + '"> <?= Yii::t('app', 'Ответить') ?></a>' +

                                    '<div class="comment-text-div"><p class="news-comment-content">' + text + '</p>' +
                                    '<div class="news-like">' +
                                    '<span class="commentID" style="display: none">' + commentID + '</span>' +
                                    '<span class="userID" style="display: none">' + userID + '</span>' +
                                    '<div class="news-comment-dislike"><span class="news-comment-dislike-count">0</span><a href="javascript:void(0);" class="dislike"><img src="/img/dislike.png" alt=""></a></div>' +
                                    '<div class="news-comment-like"><span class="news-comment-like-count">0</span><a href="javascript:void(0);" class="like"><img src="/img/like.png" alt=""></a></div>' +
                                    '</div>' +
                                    '</div><div style="clear:both"></div>'+
                                    '</div>'
                                );
                                $('#news-comment-textarea').val('');
                                $('span.comment_count').text(result.comment_count);

                            } else {
                                $('.msg_response').html('');
                                validate.css('color', 'red');
                                validate.append(result.msg);
                                validate.show();
                            }
                        });

                    }

                }

            });

        $("body").on('click','.like', function(){
            var element = $(this);
            var userID = $('.usersID').html();
            var commentID = element.closest('.news-comment-list').find('.commentID').text();
            var validate = $('.msg_response_like').hide();
            var thisA = $(this);
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                url: "/news/ajax/",
                type: "POST",
                async:true,
                data: {'userID': userID, 'commentID': commentID, '_csrf': csrfToken, 'type':1}
            }).done(function(result){
                if(result.newsLike){

                    if(result.dislike_count > result.like_count){
                        element.closest('.news-comment-list').find('.news-comment-content').css({"color":"#777777","cursor":"text"});
                    }else{
                        element.closest('.news-comment-list').find('.news-comment-content').css({"color":"#fff","cursor":"text"});
                    }

                    thisA.parent('.news-comment-like').find(".news-comment-like-count").empty();
                    thisA.parent('div').find(".news-comment-like-count").append(result.like_count);

                    element.closest('.news-like').find('.news-comment-dislike-count').empty();
                    element.closest('.news-like').find(".news-comment-dislike-count").append(result.dislike_count);

                }else{
                    $('.msg_response_like').html('');
                    validate.css('color','red');
                    validate.append(result.msg);
                    validate.show();
                }
            });

        });

        $("body").on('click','.dislike', function(){
            var element = $(this);
            var userID = $('.usersID').html();
            var commentID = element.closest('.news-comment-list').find('.commentID').text();
            var validate = $('.msg_response_like').hide();
            var thisA = $(this);
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                url: "/news/ajax/",
                type: "POST",
                async:true,
                data: {'userID': userID, 'commentID': commentID, '_csrf': csrfToken, 'type':2}
            }).done(function(result){
                if(result.newsDisLike){

                    if(result.dislike_count > result.like_count){
                        element.closest('.news-comment-list').find('.news-comment-content').css({"color":"#777777","cursor":"text"});
                    }else{
                        element.closest('.news-comment-list').find('.news-comment-content').css({"color":"#fff","cursor":"text"});
                    }

                    thisA.parent('.news-comment-dislike').find(".news-comment-dislike-count").empty();
                    thisA.parent('div').find(".news-comment-dislike-count").append(result.dislike_count);
                    element.closest('.news-like').find('.news-comment-like-count').empty();
                    element.closest('.news-like').find(".news-comment-like-count").append(result.like_count);

                }else{
                    $('.msg_response_like').html('');
                    validate.css('color','red');
                    validate.append(result.msg);
                    validate.show();
                }
            });

        });

        $("body").on('click','.news-like-btn', function(){
            var element = $(this);
            var userID = $('.usersID').html();
            var newsID = $('.newsID').html();
            var validate = $('.msg_response_like').hide();
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                url: "/news/ajaxlike/",
                type: "POST",
                async:true,
                data: {'userID': userID, 'newsID': newsID, '_csrf': csrfToken, 'type':10}
            }).done(function(result){
                if(result.newsLike){

                    element.closest('.news-view-div').find(".news-like-count").empty();
                    element.closest('.news-view-div').find(".news-like-count").append(result.news_like_count);

                    element.closest('.news-view-div').find('.news-dislike-count').empty();
                    element.closest('.news-view-div').find(".news-dislike-count").append(result.news_dislike_count);

                    }else{
                        $('.msg_response_like').html('');
                        validate.css('color','red');
                        validate.append(result.msg);
                        validate.show();
                    }
                });

        });

        $("body").on('click','.news-dislike-btn', function(){
            var element = $(this);
            var userID = $('.usersID').html();
            var newsID = $('.newsID').html();
            var validate = $('.msg_response_like').hide();
            var csrfToken = $('meta[name="csrf-token"]').attr("content");

            $.ajax({
                url: "<?= Url::toRoute('/news/ajaxlike/') ?>",
                type: "POST",
                async:true,
                data: {'userID': userID, 'newsID': newsID, '_csrf': csrfToken, 'type':11}
            }).done(function(result){
                if(result.newsDisLike){

                    element.closest('.news-view-div').find(".news-dislike-count").empty();
                    element.closest('.news-view-div').find(".news-dislike-count").append(result.news_dislike_count);

                    element.closest('.news-view-div').find('.news-like-count').empty();
                    element.closest('.news-view-div').find(".news-like-count").append(result.news_like_count);

                }else{
                    $('.msg_response_like').html('');
                    validate.css('color','red');
                    validate.append(result.msg);
                    validate.show();
                }
            });

        });

        var i = $("#news-comment .news-comment-list").length;
        var a = i-3;

        if(i > 3){
            $("#news-comment .news-comment-list:gt(2)").hide();
            var showAllStr = "<?= Yii::t('app', 'Показать все') ?>";
            var commentsStr = "<?= Yii::t('app', 'комментария') ?>";
            $("#news-comment").append('<a id="show-comment" class="show-comment-btn" href="javascript:void(0);">' + showAllStr + ' ('+(i-3)+') ' + commentsStr + '</a>');
        }

        $("#show-comment").click(function(){
            var time = 0;
            $("#news-comment .news-comment-list:hidden").each(function(){
                time = time + 150;
                $(this).delay(time).fadeIn(300);
            });
            $(this).fadeOut(300);
            return false;
        });

        /* Reply Comment */
        $("body").on('click','.reply_comment', function(){
            var username = $(this).data('username');
            $('textarea#news-comment-textarea').val("<b>"+username+"</b>" + ", ");
            $('textarea#news-comment-textarea').focus();
        });

    });

    </script>
<?php foreach($news as $new):?>


<input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
<span class="msg_response_like alert alert-danger" style="color:red; display:none; position: fixed; z-index: 9999999; left: 0px; top: 55px"></span>
<?php if (!Yii::$app->user->isGuest) { ?>
    <span class="usersID" style="display: none"><?= \Yii::$app->user->identity->id; ?></span>
    <span class="newsID" style="display: none"><?= Yii::$app->request->get("id"); ?></span>
<?php } ?>
<div class="bmd-page-container padd">
    <div class="container">
        <div class="col-md-12 pri">
            <div class="faq_page_title"><?= Yii::t('app', 'Новости') ?></div>
            <ul class="news_ul">
                <a href="<?= Url::toRoute('/news/index/') ?>" class="news-backto"><< <?= Yii::t('app', 'Вернуться к списку новостей') ?></a>
                <blockquote class="bmd-border-primary news-view-div">

                    <p class="faq_title"><span href=""><?php echo $new->title ?></span></p>
                    <div class="faq_content news-content-div"><?php echo $new->content ?></div>

                    <?php if (!Yii::$app->user->isGuest) { ?>

                        <div class="div-like-and-dislike">
                            <div class="news-like-div">
                                <span class="news-like-count">
                                    <?= $new->news_like_count; ?>
                                </span>
                                <a href="javascript:void(0);" class="news-like-btn">
                                    <img src="/img/like.png" alt="">
                                </a>
                            </div>

                            <div class="news-dislike-div">
                                <span class="news-dislike-count">
                                    <?= $new->news_dislike_count; ?>
                                </span>
                                <a href="javascript:void(0);" class="news-dislike-btn">
                                    <img src="/img/dislike.png" alt="">
                                </a>
                            </div>
                            <br>
                        </div>

                    <?php } ?>
                    <div style="clear:both;"></div>

                </blockquote>
                <?php endforeach; ?>
            </ul>
            <br>
            <div style="clear: both"></div>
            <div id="news-comment">
                <span style="margin-left: 20px; font-size: 16px;"><?= Yii::t('app', 'Комментарии') ?> (<span class="comment_count"><?php echo ($comment_list ? count($comment_list) : '0'); ?></span>)</span>
            <?php foreach($comment_list as $comments){ ?>

                <div class="news-comment-list">

                    <img src="<?php
                    if(!$comments->user->photo){
                        echo '/avatars/noavatar.png';
                    }else{
                        echo '/avatars/'.$comments->user->photo;
                    }
                    ?>" class="news-comment-image" alt="">

                    <a href="<?= Url::toRoute('/profile/view/' . $comments->user->username) ?>" class="news-comment-user"><?php echo $comments->user->username; ?></a> &nbsp;&nbsp;<span><?php echo date("Y-m-d H:i:s", $comments->date); ?></span> &nbsp;&nbsp;<a href="javascript:void(0);" class="reply_comment" data-username="<?php echo $comments->user->username; ?>"><?= Yii::t('app', 'Ответить') ?></a>
                    </br>
                    <div class="comment-text-div">
                        <?php if($comments->like_count < $comments->dislike_count){ ?>
                            <span class="news-comment-content news-comment-content-dislike">
                                <?php echo $comments->text; ?>
                            </span>
                        <?php }else{ ?>
                            <span class="news-comment-content" style="color: #fff">
                                <?php echo $comments->text; ?>
                            </span>
                        <?php } ?>
                    <div style="clear: both;"></div>
                    </div>

                    <?php if (!Yii::$app->user->isGuest) { ?>
                        <div class="news-like">
                            <span class="commentID" style="display: none"><?= $comments->id; ?></span>
                            <span class="userID" style="display: none"><?= \Yii::$app->user->identity->id; ?></span>
                            <div class="news-comment-dislike">
                                <span class="news-comment-dislike-count"><?= $comments->dislike_count; ?></span>
                                <a href="javascript:void(0);" class="dislike"><img src="/img/dislike.png" alt=""></a>
                            </div>

                            <div class="news-comment-like">
                                <span class="news-comment-like-count"><?= $comments->like_count; ?></span>
                                <a href="javascript:void(0);" class="like"><img src="/img/like.png" alt=""></a>
                            </div>

                            <div style="clear: both;"></div>
                            <br>
                        </div>
                    <?php } ?>

                </div>

            <div style="clear:both"></div>


            <?php } ?>
                <div id="news-comment-add"></div>
            </div>

            <?php
            if (!\Yii::$app->user->isGuest) {
                if(\Yii::$app->user->identity->photo == null){
                    echo '<span class="avatar" style="display: none">noavatar.png</span>';
                }else{
                    echo '<span class="avatar" style="display: none">'.\Yii::$app->user->identity->photo.'</span>';
                }
            }
            ?>

            <div id="news-comment-post">
                <span class="msg_response" style="display: none; color:red; font-weight: bold;"></span>
                <?php if(!Yii::$app->user->isGuest){ ?>
                    <span><?= Yii::t('app', 'Комментарий и лайк стоит 1 ед. энергии') ?></span>
                    <span class="name" style="display: none"><?=\Yii::$app->user->identity->username; ?></span> <div class="comment-add"></div>
                    <span class="level" style="display: none;"><?= $user->level; ?></span>

                    <span class="id" style="display:none;"><?php echo $new->id; ?></span>

                    <?php $form = \yii\widgets\ActiveForm::begin(['validateOnSubmit' => false]); ?>

                        <?= $form->field($model, 'text')->textArea(['id' => 'news-comment-textarea', 'rows' => 4, 'resize' => 'none', 'placeholder' => ''])->label(false); ?>
                        <span class="bmd-bar"></span>

                        <div style="clear:both"></div>

                        <?= \yii\helpers\Html::button(Yii::t('app', 'Добавить'), ['class' => 'btn btn-success', 'id' => 'news-comment-button']); ?>

                    <?php \yii\widgets\ActiveForm::end(); ?>
                <?php }else{ ?>
                    <b style="color: red;"><?= Yii::t('app', 'Оставить комментарий могут только авторизованные пользователи') ?>.</b>
                <?php } ?>
            </div>
            <br><br>
        </div>
    </div>
</div>

<?= \frontend\widgets\ReviewsWidget::widget(); ?>
<?php endif; ?>
