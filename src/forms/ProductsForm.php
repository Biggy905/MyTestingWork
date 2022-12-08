<?php

namespace app\forms;

use app\components\forms\AbstractForm;

final class ProductsForm extends AbstractForm
{
    public string $id;
    public string $name;
    public string $details;

    public function rules(): array
    {
        return [
            [
                ['id', 'name'],
                'integer',
            ],
            [
                'details',
                'safe',
            ]
        ];
    }
}
