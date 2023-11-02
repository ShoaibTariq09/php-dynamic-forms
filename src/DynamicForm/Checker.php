<?php
/**
 * Created by Shoaib Tariq.
 * User: shoaib
 * Date: 02.11.2023
 * Time: 09:53
 */

namespace DynamicForm;

/**
 * Interface Checker
 * @package DynamicForm
 */
interface Checker
{
    /**
     * @param $value
     * @return bool
     */
    public function contain($value): bool ;
}