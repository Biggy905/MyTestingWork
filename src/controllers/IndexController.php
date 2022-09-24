<?php

namespace app\controllers;

use app\components\Controller;

final class IndexController extends Controller
{
    public function actionError(): array
    {
        return $this->response(
            [
                'code' => 404,
                'message' => 'This request is not found.'
            ]
        );
    }
}