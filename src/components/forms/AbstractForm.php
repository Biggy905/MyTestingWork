<?php

namespace app\components\forms;

use ReflectionClass;
use ReflectionProperty;
use app\components\Validator;

abstract class AbstractForm implements FormInterface
{
    protected Validator $validator;

    public function __construct()
    {
        $this->validator = new Validator($this->rules());
    }

    public function setAttributes(array $attributes = []): void
    {
        foreach ($attributes as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }
    }

    public function getAttributes(): array
    {
        $reflectionClass = new ReflectionClass($this);

        $attributes = [];
        foreach ($reflectionClass->getProperties(ReflectionProperty::IS_PUBLIC) as $name) {
            $property = $name->getName();
            $attributes[$property] = $this->{$property};
        }

        return $attributes;
    }

    protected function rules(): array
    {
        return [];
    }

    public function getErrors()
    {

    }
}