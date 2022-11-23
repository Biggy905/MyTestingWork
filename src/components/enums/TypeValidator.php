<?php

namespace app\components\enums;

enum TypeValidator: string
{
    const BOOLEAN = 'boolean';
    const CAPTCHA = 'captcha';
    const COMPARE = 'compare';
    const DATE = 'date';
    const DATETIME = 'datetime';
    const TIME = 'time';
    const DEFAULT = 'default';
    const DOUBLE = 'double';
    const EACH = 'each';
    const EMAIL = 'email';
    const EXIST = 'exist';
    const FILE = 'file';
    const FILTER = 'filter';
    const IMAGE = 'image';
    const IN = 'in';
    const INTEGER = 'integer';
    const MATCH = 'match';
    const NUMBER = 'number';
    const REQUIRED = 'required';
    const SAFE = 'safe';
    const STRING = 'string';
    const TRIM = 'trim';
    const UNIQUE = 'unique';
    const URL = 'url';
    const IP = 'ip';
}
