<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'About', 'url' => ['/site/about']],
        ['label' => 'Contact', 'url' => ['/site/contact']],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
<script>

    $(function() {

        $(document).keyup(function(e) {
            if (e.key === "Enter" || e.keyCode === 13)
            {
                if ($(document.activeElement).attr('id') == 'messageform-message')
                {
                    console.log($(document.activeElement).attr('id'));
                    var text = $('#messageform-message').val();
                    var data = [session, doctor, text];
                    createChatMessage(data);
                }
                else if ($(document.activeElement).attr('id') == 'complaintsform-complaint20')
                {
                    if ($(document.activeElement).val().trim() != '')
                    {
                        var field_name = (document.activeElement.name).match(/ComplaintsForm\[(.+)\]/)[1];
                        var description = $(document.activeElement).val().trim();
                        var data = [session, doctor, patient, field_name, description];
                        saveСomplaint(data, 1);
                    }
                }


                // console.log($(document.activeElement).attr('id'));
                // console.log($('#messageform-message'));


            }
        });

        function refresh(params)
        {
            $.ajax({
                url: '/refresh-complaints',
                type: 'post',
                data: {data: params},
                dataType: 'text',
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    var response = JSON.parse(data); // console.log(typeof fields);
                    // console.log(response);

                    //Жалобы
                    var fields = response['complaints'];
                    $('#complaints-form input:checkbox').prop('checked', false);
                    $('#custom-complaints p').remove();

                    if (typeof fields !== 'undefined')
                    {
                        fields.forEach(function(item) {
                            // console.log(item);
                            var _class = item[0] + '-' + item[2];
                            if (item[0] == 'complaint20' && !$('#custom-complaints .'+ _class).length)
                            {
                                $('#custom-complaints').append($('<p>', {class: _class, text: item[1]}).append($('<img>', {src: '/img/delete.jpg'}).attr('data-id', item[2])));
                            }
                            else $('#complaintsform-' + item[0]).prop('checked', true);
                        });
                    }

                    //Чат
                    var messages = response['messages'];
                    if (typeof messages !== 'undefined')
                    {
                        messages.forEach(function(item) {
                            // console.log(item);
                            if (!$('#messages-area p[data-id = ' + item[0] + ']').length)
                            {
                                $('#messages-area').append($('<p>', {text: item[1]}).attr('data-id', item[0]));
                            }
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }


        if ($('.chat-page').length) var timer = setInterval(refresh, 1000, [session, doctor]);



        //todo Чат

        $('#message-form img.send-but').on('click', function()
        {
            var text = $('#messageform-message').val();
            var data = [session, doctor, text];
            createChatMessage(data);
        });

        function createChatMessage(data)
        {
            // console.log(text);
            $.ajax({
                url: '/create-chat-message',
                type: 'post',
                data: {data: data},
                dataType: 'text',
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    // console.log(data);
                    $('#messageform-message').val('');
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }

        $('a.clear-chat').on('click', function(e)
        {
            e.preventDefault();

            var data = [session, doctor];

            $.ajax({
                url: '/clear-chat',
                type: 'post',
                data: {data: data},
                dataType: 'text',
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    // console.log(data);
                    $('#messages-area').empty();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        });


        //todo Жалобы

        $('#complaints-form input').on('change', function() {
            // console.log(session);
            // console.log(doctor);
            // console.log(patient);
            var field_name = (this.name).match(/ComplaintsForm\[(.+)\]/)[1];
            var field_state = ($(this).is(':checked')) ? 1 : 0;
            var description = $(this).parent("label").text().trim();
            var data = [session, doctor, patient, field_name, description];
            saveСomplaint(data, field_state);
        });
        $('#complaints-form textarea').on('blur', function() {
            if ($(this).val().trim() != '')
            {
                var field_name = (this.name).match(/ComplaintsForm\[(.+)\]/)[1];
                var description = $(this).val().trim();
                var data = [session, doctor, patient, field_name, description];
                saveСomplaint(data, 1);
            }
        });
        $('#custom-complaints').on('click', 'img', function() {

            // console.log($(this).attr('data-id'));

            var id = $(this).attr('data-id')
            var data = ['custom', id];
            saveСomplaint(data, 0);

        });
        function saveСomplaint(params, field_state)
        {
            var action = (field_state) ? 'add' : 'delete';

            // console.log(params);

            $.ajax({
                url: '/complaint/' + action,
                type: 'post',
                data: {data: params},
                dataType: 'text',
                beforeSend: function() {},
                complete: function() {},
                success: function(data) {
                    console.log(params);
                    if (params[0] == 'custom') { //если это удаление жалобы "Иное"
                        // $('#custom-complaints').empty();
                        $('.complaint20-' + params[1]).remove();
                    }
                    else if (params[3] == 'complaint20') //ели это отправка жалобы "Иное"
                    {
                        $('#complaintsform-complaint20').val('');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }

    });
</script>
</body>
</html>
<?php $this->endPage() ?>
