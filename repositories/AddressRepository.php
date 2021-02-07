<?php

namespace app\repositories;

use app\models\Addresses;

class AddressRepository
{
    public function findOne(int $id): ?Addresses
    {
        return Addresses::findOne($id);
    }

    public function delete(int $id)
    {
        $address = $this->findOne($id);
        if ($address) {
            $address->delete();
        }
    }

    public function getQuery()
    {
        return Addresses::find();
    }

    public function updateOrCreate(Addresses $address, array $data): bool
    {
        return $address->load($data) && $address->save();
    }
}