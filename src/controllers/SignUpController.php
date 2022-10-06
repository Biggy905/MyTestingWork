<?php

namespace app\controllers;

use app\components\Controller;

final class SignUpController extends Controller
{
    public function actionIndex()
    {
        return $this->response(['message' => 'Hello World!']);
    }

    public function actionAuth()
    {


        return $this->response();
    }
}
