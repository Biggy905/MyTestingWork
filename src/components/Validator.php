<?php

namespace app\components;

use app\components\forms\FormInterface;
use yii\base\DynamicModel;

final class Validator
{
    private DynamicModel $model;

    public function __construct(
        public readonly FormInterface $form
    ) {
        $this->init();
    }

    private function init(): void
    {
        $this->model = DynamicModel::validateData(
            $this->form->getAttributes(),
            $this->form->rules()
        );
    }

    public function validate(): bool
    {
        return $this->model->validate();
    }

    public function getErrors(): array
    {
        $message = [];
        foreach ($this->model->getErrors() as $index => $value) {
            $message[] = [
                'field' => $index,
                'message' => $value,
            ];
        }

        return $message;
    }
}
