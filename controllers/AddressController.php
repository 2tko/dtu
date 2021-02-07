<?php

namespace app\controllers;

use app\helpers\CountryHelper;
use app\repositories\AddressRepository;
use Yii;
use app\models\Addresses;
use yii\base\Module;
use yii\web\Controller;

class AddressController extends Controller
{
    private $addressRepository;

    public function __construct($id, Module $module, array $config = [], AddressRepository $addressRepository)
    {
        parent::__construct($id, $module, $config);

        $this->addressRepository = $addressRepository;
    }

    public function actionCreate()
    {
        $model = new Addresses();
        if ($this->addressRepository->updateOrCreate($model, Yii::$app->request->post())) {
            return $this->redirect(['/client/view', 'id' => $model->client_id]);
        }

        $model->client_id = Yii::$app->request->get('client_id');
        return $this->render('create', [
            'model' => $model,
            'countries' => CountryHelper::all(),
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->addressRepository->findOne($id);
        if ($this->addressRepository->updateOrCreate($model, Yii::$app->request->post())) {
            return $this->redirect(['/client/view', 'id' => $model->client_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'countries' => CountryHelper::all(),
        ]);
    }

    public function actionDelete($id)
    {
        $this->addressRepository->delete($id);
        return $this->goBack(Yii::$app->request->referrer);
    }
}
