<?php

namespace app\console\commands;

use yii\console\Controller;

final class RbacController extends Controller
{
    public function actionGo(): void
    {
        echo "Команда пошла!\n";
    }
}