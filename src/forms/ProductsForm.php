<?php

namespace app\forms;

final class ProductsForm extends AbstractForm
{
    public string $id;
    public string $name;
    public string $details;

    public function validate()
    {
        $this->errorsValidate = [];
    }
}
