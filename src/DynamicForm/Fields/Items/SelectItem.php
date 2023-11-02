<?php
/**
 * Created by Shoaib Tariq.
 * User: shoaib
 * Date: 02.11.2023
 * Time: 12:14
 */

namespace DynamicForm\Fields\Items;

use DynamicForm\Fields\Item;

/**
 * Class SelectItem
 * @package DynamicForm\Fields\Items
 */
class SelectItem implements Item
{
    /**
     * @var string;
     */
    protected $text;
    /**
     * @var mixed
     */
    protected $value;
    /**
     * @var bool
     */
    protected $selected = false;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return static
     */
    public function setText(string $text): self
    {
        $this->text = $text;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     * @return static
     */
    public function setValue($value) : self
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSelected(): bool
    {
        return $this->selected;
    }

    /**
     * @param bool $selected
     * @return static
     */
    public function setSelected(string $selected): self
    {
        $this->selected = $selected;
        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize():mixed
    {
        return get_object_vars($this);
    }
}
