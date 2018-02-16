<?php

namespace base\models;

use base\lib\Model;

class ReservationModel extends Model
{
    public function tableName()
    {
       return 'reservation';
    }

    public function select()
    {
        return parent::select();
    }
}