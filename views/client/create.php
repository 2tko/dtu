<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $client app\models\Clients */
/* @var $address app\models\Addresses */

$this->title = 'Create Clients';
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="clients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'client' => $client,
        'address' => $address,
        'genders' => $genders,
        'countries' => $countries,
        'ifCreate' => true,
    ]) ?>

</div>