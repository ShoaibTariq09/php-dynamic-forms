<?php
/**
 * Created by Shoaib Tariq.
 * User: shoaib
 * Date: 02.11.2023
 * Time: 11:15
 */

namespace DynamicForm\Fields\Validators;

use DynamicForm\Field;
use DynamicForm\Fields\Validator;

/**
 * Class Email
 * @package DynamicForm\Fields\Validators
 */
class Email extends Validator
{
    /**
     * Email constructor.
     * @param string $message
     */
    public function __construct($message = '')
    {
        parent::__construct();
        $this
            ->setMessage((string)$message);
    }

    /**
     * @param $value
     * @param null|Field $field
     * @return bool
     */
    public function isValid($value, $field = null): bool
    {
        return (bool) filter_var($value, FILTER_VALIDATE_EMAIL);
    }
}