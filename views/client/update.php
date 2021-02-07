<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $client app\models\Clients */
/* @var $address app\models\Addresses */


$this->title = 'Update Clients: ' . $client->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $client->id, 'url' => ['view', 'id' => $client->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="clients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'client' => $client,
        'address' => $address,
        'genders' => $genders,
        'countries' => $countries,
        'ifCreate' => false,
    ]) ?>

</div>