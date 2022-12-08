<?php

namespace app\console\commands;

use app\components\Validator;
use app\forms\ProductsForm;
use yii\console\Controller;

class TestController extends Controller
{
    public function actionReflection(): void
    {
        $attributes = [
            'id' => 'sjlskj',
            'name' => 'TestName',
            'details' => 'Nfa;lkg wersdfs kf;sdfk',
        ];

        $form = new ProductsForm();
        $form->setAttributes($attributes);

        $validator = new Validator($form);
        if (!$validator->validate()) {
            var_dump($validator->getErrors());
        }
    }
}