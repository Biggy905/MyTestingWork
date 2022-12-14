<?php

namespace app\controllers;

use app\components\Controller;

final class IndexController extends Controller
{
    public function actionError(): array
    {
        return $this->response(
            [
                'message' => 'This URL is not found.'
            ]
        );
    }
}