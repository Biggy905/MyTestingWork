<?php


namespace app\forms;

use ReflectionClass;
use ReflectionProperty;

abstract class AbstractForm implements FormInterface
{
    public $errorsValidate;

    public function __construct()
    {
        $this->validate();
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

    public function getErrors()
    {
        return $this->errorsValidate;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errorsValidate);
    }
}