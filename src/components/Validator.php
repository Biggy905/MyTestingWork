<?php

namespace app\components;

use yii\base\NotSupportedException;
use yii\validators\DateValidator;
use Yii;

final class Validator
{
    public static $builtInValidators = [
        'boolean' => 'yii\validators\BooleanValidator',
        'captcha' => 'yii\captcha\CaptchaValidator',
        'compare' => 'yii\validators\CompareValidator',
        'date' => 'yii\validators\DateValidator',
        'datetime' => [
            'class' => 'yii\validators\DateValidator',
            'type' => DateValidator::TYPE_DATETIME,
        ],
        'time' => [
            'class' => 'yii\validators\DateValidator',
            'type' => DateValidator::TYPE_TIME,
        ],
        'default' => 'yii\validators\DefaultValueValidator',
        'double' => 'yii\validators\NumberValidator',
        'each' => 'yii\validators\EachValidator',
        'email' => 'yii\validators\EmailValidator',
        'exist' => 'yii\validators\ExistValidator',
        'file' => 'yii\validators\FileValidator',
        'filter' => 'yii\validators\FilterValidator',
        'image' => 'yii\validators\ImageValidator',
        'in' => 'yii\validators\RangeValidator',
        'integer' => [
            'class' => 'yii\validators\NumberValidator',
            'integerOnly' => true,
        ],
        'match' => 'yii\validators\RegularExpressionValidator',
        'number' => 'yii\validators\NumberValidator',
        'required' => 'yii\validators\RequiredValidator',
        'safe' => 'yii\validators\SafeValidator',
        'string' => 'yii\validators\StringValidator',
        'trim' => [
            'class' => 'yii\validators\TrimValidator',
            'skipOnArray' => true,
        ],
        'unique' => 'yii\validators\UniqueValidator',
        'url' => 'yii\validators\UrlValidator',
        'ip' => 'yii\validators\IpValidator',
    ];

    public $attributes = [];

    public $message;

    public $on = [];

    public $except = [];

    public $skipOnError = true;

    public $skipOnEmpty = true;

    public $enableClientValidation = true;

    public $isEmpty;

    public $when;

    public $whenClient;

    public static function createValidator($type, $class, $attributes, $params = [])
    {
        $params['attributes'] = $attributes;

        if ($type instanceof \Closure) {
            $params['class'] = __NAMESPACE__ . '\InlineValidator';
            $params['method'] = $type;
        } elseif (!isset(static::$builtInValidators[$type]) && $class->hasMethod($type)) {
            // method-based validator
            $params['class'] = __NAMESPACE__ . '\InlineValidator';
            $params['method'] = [$class, $type];
        } else {
            unset($params['current']);
            if (isset(static::$builtInValidators[$type])) {
                $type = static::$builtInValidators[$type];
            }
            if (is_array($type)) {
                $params = array_merge($type, $params);
            } else {
                $params['class'] = $type;
            }
        }

        return Yii::createObject($params);
    }

    public function init(): void
    {
        $this->attributes = (array) $this->attributes;
        $this->on = (array) $this->on;
        $this->except = (array) $this->except;
    }

    public function validateAttributes(array $attributes = null): void
    {
        $attributes = $this->getValidationAttributes($attributes);

        foreach ($attributes as $attribute) {
            $skip = $this->skipOnError
                || $this->skipOnEmpty && $this->isEmpty($attributes);
            if (!$skip) {
                if ($this->when === null || call_user_func($this->when, $model, $attribute)) {
                    $this->validateAttribute($model, $attribute);
                }
            }
        }
    }

    public function getValidationAttributes($attributes = null)
    {
        if ($attributes === null) {
            return $this->getAttributeNames();
        }

        if (is_scalar($attributes)) {
            $attributes = [$attributes];
        }

        $newAttributes = [];
        $attributeNames = $this->getAttributeNames();
        foreach ($attributes as $attribute) {
            if (in_array($attribute, $attributeNames, false)) {
                $newAttributes[] = $attribute;
            }
        }
        return $newAttributes;
    }

    public function validateAttribute($model, $attribute)
    {
        $result = $this->validateValue($model->$attribute);
        if (!empty($result)) {
            $this->addError($model, $attribute, $result[0], $result[1]);
        }
    }

    public function validate($value, &$error = null)
    {
        $result = $this->validateValue($value);
        if (empty($result)) {
            return true;
        }

        list($message, $params) = $result;
        $params['attribute'] = Yii::t('yii', 'the input value');
        if (is_array($value)) {
            $params['value'] = 'array()';
        } elseif (is_object($value)) {
            $params['value'] = 'object';
        } else {
            $params['value'] = $value;
        }
        $error = $this->formatMessage($message, $params);

        return false;
    }

    protected function validateValue($value)
    {
        throw new NotSupportedException(get_class($this) . ' does not support validateValue().');
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        return null;
    }

    public function getClientOptions($model, $attribute)
    {
        return [];
    }

    public function isActive($scenario)
    {
        return !in_array($scenario, $this->except, true) && (empty($this->on) || in_array($scenario, $this->on, true));
    }

    public function addError($model, $attribute, $message, $params = [])
    {
        $params['attribute'] = $model->getAttributeLabel($attribute);
        if (!isset($params['value'])) {
            $value = $model->$attribute;
            if (is_array($value)) {
                $params['value'] = 'array()';
            } elseif (is_object($value) && !method_exists($value, '__toString')) {
                $params['value'] = '(object)';
            } else {
                $params['value'] = $value;
            }
        }
        $model->addError($attribute, $this->formatMessage($message, $params));
    }

    public function isEmpty($value)
    {
        if ($this->isEmpty !== null) {
            return call_user_func($this->isEmpty, $value);
        }

        return $value === null || $value === [] || $value === '';
    }

    protected function formatMessage($message, $params)
    {
        if (Yii::$app !== null) {
            return \Yii::$app->getI18n()->format($message, $params, Yii::$app->language);
        }

        $placeholders = [];
        foreach ((array) $params as $name => $value) {
            $placeholders['{' . $name . '}'] = $value;
        }

        return ($placeholders === []) ? $message : strtr($message, $placeholders);
    }

    public function getAttributeNames()
    {
        return array_map(function ($attribute) {
            return ltrim($attribute, '!');
        }, $this->attributes);
    }
}
