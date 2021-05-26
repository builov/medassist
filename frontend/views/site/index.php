<?php

/* @var $this yii\web\View */

$this->title = 'МедЧат';
?>

<div class="site-index">


        <div class="row">
            <div class="col-sm-12">

                <h3 class="mb-5">Врач <?= $doctor->lastname ?> <?= $doctor->firstname ?> <?= $doctor->patronim ?></h3>

                <ul class="nav nav-tabs">
                    <li class="nav-item active">
                        <a class="nav-link active" href="">График приема</a>
                    </li>
                    <li class="nav-item">
                        <?php
                            foreach ($model as $appointment)
                            {
                                $code = $appointment->code;
                                break;
                            }
                        ?>
                        <a class="nav-link" href="/chat/<?= $code ?>">Чат с пациентом</a>
                    </li>
                </ul>


                <table class="table queue mt-4">
                    <?php foreach ($model as $appointment): ?>

                        <tr>
                            <td><?= $appointment->profile->lastname ?> <?= $appointment->profile->firstname ?> <?= $appointment->profile->patronim ?></td>
                            <td><?= date('d-m-Y H:i', $appointment->starttime) ?></td>
                            <td><?= $appointment->code ?></td>
                            <td><a class="btn btn-primary" href="/chat/<?= $appointment->code ?>" role="button">Открыть чат</a></td>
                        </tr>

                    <? endforeach; ?>
                </table>

            </div>
        </div>


</div>
