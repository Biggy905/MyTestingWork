<?php


namespace app\console\commands;


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

        $product = new ProductsForm();
        $product->setAttributes($attributes);
        $a = $product->getAttributes();

        var_dump($a);
    }
}