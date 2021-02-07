<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $client app\models\Clients */
/* @var $address app\models\Addresses */
/* @var $form yii\bootstrap\ActiveForm */
?>

<div class="clients-form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>

    <?= $form->errorSummary($client) ?>

    <?= $form->field($client, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($client, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($client, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($client, 'gender')->dropDownList($genders, ['prompt' => 'Select your gender']) ?>

    <?= $form->field($client, 'login')->textInput(['maxlength' => true]) ?>

    <?= $form->field($client, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($client, 'passport_confirm')->passwordInput(['maxlength' => true]) ?>

    <?php if ($ifCreate): ?>
        <?= $form->field($address, 'zip_code')->textInput(['maxlength' => true]) ?>

        <?= $form->field($address, 'country')->dropDownList($countries, ['prompt' => 'Select your country']) ?>

        <?= $form->field($address, 'city')->textInput() ?>

        <?= $form->field($address, 'street')->textInput(['maxlength' => true]) ?>

        <?= $form->field($address, 'house_number')->textInput(['maxlength' => true]) ?>

        <?= $form->field($address, 'office_number')->textInput(['maxlength' => true]) ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
