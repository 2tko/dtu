<?php

namespace app\repositories;

use app\models\Addresses;
use app\models\Clients;
use \Yii;

class ClientRepository
{
    public function findOne(int $id): ?Clients
    {
        return Clients::findOne($id);
    }

    public function delete(int $id)
    {
        $client = $this->findOne($id);
        if ($client) {
            $client->delete();
        }
    }

    public function getQuery()
    {
        return Clients::find();
    }

    public function create(Clients $client, Addresses $address, array $data): bool
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $client->load($data);
            $address->load($data);
            $client->save();
            $client->link('addresses', $address);

            $transaction->commit();
            return true;
        } catch (\Exception $e) {
            echo $e->getMessage();
            $transaction->rollBack();
        }

        return false;
    }

    public function update(Clients $client, array $data): bool
    {
        return $client->load($data) && $client->save();
    }
}