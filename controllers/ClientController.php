<?php

namespace app\controllers;

use app\helpers\CountryHelper;
use app\models\Addresses;
use app\repositories\ClientRepository;
use Yii;
use app\models\Clients;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;

class ClientController extends Controller
{
    private $clientRepository;

    public function __construct($id, Module $module, array $config = [], ClientRepository $clientRepository)
    {
        parent::__construct($id, $module, $config);

        $this->clientRepository = $clientRepository;
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->clientRepository->getQuery(),
            'pagination' => [
                'pageSize' => 5,
            ],
            'sort' => [
                'attributes' => ['id'],
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'genders' => Clients::GENDERS,
        ]);
    }

    public function actionView($id)
    {
        $client = $this->clientRepository->findOne($id);
        $dataProviderAddresses = new ArrayDataProvider([
            'allModels' => $client->addresses,
            'sort' => [
                'attributes' => ['id'],
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
            'key' => 'id',
            'pagination' => [
                'pageSize' => 5,
            ],
        ]);

        return $this->render('view', [
            'client' => $client,
            'dataProviderAddresses' => $dataProviderAddresses,
            'countries' => CountryHelper::all(),
            'genders' => Clients::GENDERS,
        ]);
    }

    public function actionCreate()
    {
        $client = new Clients();
        $address = new Addresses();

        if (Yii::$app->request->post()
            && $this->clientRepository->create($client, $address, Yii::$app->request->post())
        ) {
            return $this->redirect(['/client/view', 'id' => $client->id]);
        }

        return $this->render('create', [
            'client' => $client,
            'address' => $address,
            'genders' => Clients::GENDERS,
            'countries' => CountryHelper::all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $client = $this->clientRepository->findOne($id);
        if ($this->clientRepository->update($client, Yii::$app->request->post())) {
            return $this->redirect(['/client/view', 'id' => $client->id]);
        }

        return $this->render('update', [
            'client' => $client,
            'address' => $client->addresses,
            'genders' => Clients::GENDERS,
            'countries' => CountryHelper::all(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->clientRepository->delete($id);
        return $this->redirect(['index']);
    }
}
