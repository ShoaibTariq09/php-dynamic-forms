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
 * Class Regex
 * @package DynamicForm\Fields\Validators
 */
class Regex extends Validator
{
    /**
     * @var string
     */
    protected $pattern;

    /**
     * Regex constructor.
     * @param $pattern
     * @param string $message
     */
    public function __construct($pattern, $message = '')
    {
        parent::__construct();
        $this
            ->setPattern($pattern)
            ->setMessage((string)$message);
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param mixed $pattern
     * @return static
     */
    public function setPattern($pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @param $value
     * @param null|Field $field
     * @return bool
     */
    public function isValid($value, $field = null): bool
    {
        $matches = null;

        if (preg_match($this->getPattern(), (string)$value,$matches )){
            return true;
        }

        return false;
    }
}