<?php
/**
 * Created by Shoaib Tariq.
 * User: shoaib
 * Date: 02.11.2023
 * Time: 09:35
 */

namespace DynamicForm;


/**
 * Interface Validation
 * @package DynamicForm\Fields
 */
interface Validation
{
    /**
     * @param array
     * @return bool
     */
    public function isValid(array $value): bool;

}