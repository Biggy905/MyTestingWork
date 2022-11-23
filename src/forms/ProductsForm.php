<?php

namespace app\forms;

use app\components\Validator;

final class ProductsForm extends AbstractForm
{
    public string $id;
    public string $name;
    public string $details;

    protected function rules(): array
    {
        return [
            [
                ['id', 'name'],
                'string',
            ],
            [
                'details',
                'safe',
            ]
        ];
    }
}
