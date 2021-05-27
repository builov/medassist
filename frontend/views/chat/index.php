<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'МедЧат';
?>
<div class="chat-page">


        <div class="row">
            <div class="col-sm-12">

                <h3 class="mb-5">Врач <?= $doctor->lastname ?> <?= $doctor->firstname ?> <?= $doctor->patronim ?></h3>

                <ul class="nav nav-tabs mb-5">
                    <li class="nav-item">
                        <a class="nav-link" href="/">График приема</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link active" href="/chat">Чат с пациентом</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-2">
                <p><em><?= $doctor->firstname ?> <?= $doctor->patronim ?></em>:</p>
            </div>
            <div class="col-sm-10">
                <p>Здравствуйте, <?= $session->profile->firstname ?> <?= $session->profile->patronim ?>.
                    На что жалуетесь?<br>
                    Отметьте подходящие пункты, или, если подходящих нет, впишите в пустое поле в самом низу.</p>
            </div>
        </div>



        <div class="row mt-5 content">
            <div class="col-sm-6">
                <h4 class="mb-5">Жалобы</h4>

                <?php $form = ActiveForm::begin([
                    'id' => 'complaints-form',
//                    'action' => '/complaint/add',
                    'enableAjaxValidation'   => false,
                    'enableClientValidation' => true,
                    'validateOnBlur'         => false,
                    'validateOnType'         => false,
                    'validateOnChange'       => false,
                    'validateOnSubmit'       => true,
                ]); ?>



                <?= $form->field($complaints_form, 'complaint1')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint2')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint3')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint4')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint5')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint6')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint7')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint8')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint9')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint10')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint11')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint12')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint13')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint14')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint15')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint16')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint17')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint18')->checkbox() ?>
                <?= $form->field($complaints_form, 'complaint19')->checkbox() ?>
                <div id="custom-complaints"></div>
                <?= $form->field($complaints_form, 'complaint20')->textarea(['rows' => 2, 'cols' => 5]) ?>

<!--                <div class="form-group">-->
<!--                    --><?//= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
<!--                </div>-->

                <?php ActiveForm::end(); ?>
            </div>



            <div class="col-sm-6 chat-area">
                <div class="chat">
                    <div class="chat-header bg-primary text-white text-center">
                        <?= $doctor->lastname ?> <?= $doctor->firstname ?> <?= $doctor->patronim ?>
                    </div>
                    <div class="chat-body">

                        <div id="messages-area"></div>

                        <?php $form2 = ActiveForm::begin([
                            'id' => 'message-form',
                            'enableAjaxValidation'   => false,
                            'enableClientValidation' => false,
                            'validateOnBlur'         => false,
                            'validateOnType'         => false,
                            'validateOnChange'       => false,
                            'validateOnSubmit'       => false,
                        ]); ?>

                        <div class="input-wrap">
                            <?= $form2->field($message_form, 'message')->textarea(['rows' => 2, 'cols' => 5])->label(false) ?>

                            <img class="send-but" src="/img/send.png" />
                        </div>

                        <?php ActiveForm::end(); ?>

                        <a class="clear-chat" href="">Очистить чат</a>

                    </div>
                </div>
            </div>
        </div>

        </div>


</div>

<script>
    var session = '<?= $session->id ?>';
    var doctor = '<?= $session->doctor ?>';
    var patient = '<?= $session->patient ?>';
</script>
