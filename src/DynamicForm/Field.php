<?php
/**
 * Created by Shoaib Tariq.
 * User: shoaib
 * Date: 02.11.2023
 * Time: 10:54
 */

namespace DynamicForm;

use DynamicForm\Fields\Validator;
use DynamicForm\Fields\Validators\Message;
use DynamicForm\Fields\Validators\Required;

/**
 * Class Field
 * @package DynamicForm
 */
abstract class Field implements \JsonSerializable, Validation, Checker
{

    /**
     * @var string
     */
    protected $type;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $label;
    /**
     * @var bool
    */
    protected $disabled = false;
    protected $sentbyemail = false;
    /**
     * @var Validator[]
     */
    protected $validators = [];

    /**
     * Field constructor.
     */
    public function __construct()
    {
        $this->type = self::getClassName();
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return static
     */
    public function setLabel(string $label): self
    {
        $this->label = $label;
        return $this;
    }

        /**
     * @return string
     */
    public function getSentByEmail(): bool
    {
        return $this->sentbyemail;
    }

    /**
     * @param string $name
     * @return static
     */
    public function setSentByEmail(bool $sendByEmail): self
    {
        $this->sentbyemail = $sendByEmail;
        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * @param bool $disabled
     * @return static
     */
    public function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    /**
     * @return Validator[]
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param Validator[] $validators
     * @return static
     */
    public function setValidators(array $validators): self
    {
        $this->validators = $validators;
        return $this;
    }

    /**
     * @param Validator $validator
     * @return static
     */
    public function addValidator(Validator $validator): self
    {
        $this->validators[] = $validator;
        return $this;
    }

    /**
     * @param Validator[] $validators
     * @return static
     */
    public function addValidators(array $validators): self
    {
        $this->validators = array_merge($this->validators, $validators);
        return $this;
    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        foreach ($this->getValidators() as $validator) {

            if($validator instanceof Required) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param array $value ['a'=>1, 'b'=> 2]
     * @return bool
     */
    public function isValid(array $value): bool
    {
        $key_exist = array_key_exists($this->getName(), $value);

        foreach ($this->getValidators() as $validator) {

            if(!$key_exist){
                if($validator instanceof Required){
                    return false;
                }
            }else{
                if( !$validator->isValid($value[$this->getName()], $this) ) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * @param array $value ['a'=>1, 'b'=> 2]
     * @return Message[]
    */
    public function getErrorMessages(array $value)
    {
        $messages = [];

        $key_exist = array_key_exists($this->getName(), $value);

        foreach ($this->getValidators() as $validator) {

            if(!$key_exist){
                if($validator instanceof Required){
                    $messages[] = new Message($this->getName(), $validator->getMessage());
                }
            }else{
                if($validator instanceof Required && $value[$this->getName()] == ''){
                    $messages[] = new Message($this->getName(), $validator->getMessage());
                }
                if( !$validator->isValid($value[$this->getName()], $this) ) {
                    $messages[] = new Message($this->getName(), $validator->getMessage());
                }
            }
        }

        return $messages;
    }

    /**
     * @return bool|string
     */
    public static function getClassName()
    {
        return substr(strrchr(static::class, "\\"), 1) ;
    }
}
