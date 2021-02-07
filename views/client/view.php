<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $client app\models\Clients */

$this->title = 'Client ' . $client->id;
$this->params['breadcrumbs'][] = ['label' => 'Clients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="clients-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $client->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $client->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $client,
        'attributes' => [
            'id',
            'first_name',
            'last_name',
            'email:email',
            [
                'label' => 'gender',
                'value' => function ($client) use ($genders) {
                    return $genders[$client->gender];

                },
            ],
            'login',
            [
                'attribute'=>'created_at',
                'format' => ['date', 'php:d-m-Y H:i'],
            ],
        ],
    ]) ?>


    <p>
        <?= Html::a('Create Addresses', ['/address/create', 'client_id' => $client->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProviderAddresses,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'client_id',
            'zip_code',
            [
                'attribute' => 'country',
                'value' => function ($model, $key, $index, $column) use ($countries) {
                    return $countries[$model->country];

                },
            ],
            'city',
            'street',
            'house_number',
            'office_number',
            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'urlCreator' => function ($action, $model, $key, $index) {
                    return Url::to(['/address/' . $action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

</div>
