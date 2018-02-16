<?php

namespace base\controllers;

use base\lib\Controller;
use base\lib\Request;
use base\models\ReservationModel;

class Reservation extends Controller
{
    public function index()
    {
        $request = Request::request();
        $model = new ReservationModel();

        $teste = $model->select();

        var_dump($teste);
        exit;

        $data = ['id' => Request::get()['id']];

        if ($request::isPost()) {
            $post = $request::post();
        }

        $this->render($data,'index');
    }
}