<?php

/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 14.01.2019
 * Time: 11:03
 */


use \DynamicForm\Form,
    \DynamicForm\Fields\CheckBox,
    \DynamicForm\Fields\Radio,
    \DynamicForm\Fields\Select,
    \DynamicForm\Fields\Range,
    \DynamicForm\Fields\Text,
    \DynamicForm\Fields\TextArea;

use \DynamicForm\Fields\Items\CheckBoxItem,
    \DynamicForm\Fields\Items\RadioItem,
    \DynamicForm\Fields\Items\SelectItem;

use \DynamicForm\Fields\Validators\Required,
    \DynamicForm\Fields\Validators\Email,
    \DynamicForm\Fields\Validators\Date,
    \DynamicForm\Fields\Validators\Regex;

class TestForm extends Form
{
    public function __construct($array)
    {
        // echo $array['title'];
        function generateFieldName($name)
        {
            return preg_replace('/\s+/', '_', strtolower($name));
        }

        $this->setName(generateFieldName($array['title']))
            ->setTitle($array['title']);

        foreach ($array['fields'] as $key => $field) {
            if (is_array($field)) {


                /**
                 * Input Type Text
                 */
                if ($field['type'] == 'Text') {
                    ##Text fields
                    $newField = (new Text())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email'])
                        ->setValue(isset($field['value']) ? $field['value'] : '');
                    if (!empty($field['validators'])) {
                        foreach ($field['validators'] as $validator) {
                            if ($validator['type'] == 'Required') {
                                $newField->addValidator(new Required($field['label'] . " is required"));
                            }
                            if ($validator['type'] == 'Regex' && isset($validator['pattern'])) {
                                $newField->addValidator(new Regex(($validator['pattern']), $field['label'] . " pattern error"));
                            }
                        }
                    }

                    $this->add($newField);
                }
                /**
                 * Input Type TextArea
                 */
                if ($field['type'] == 'TextArea') {
                    ##TextArea fields
                    $newField = (new TextArea())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email'])
                        ->setValue(isset($field['value']) ? $field['value'] : '');
                    if (!empty($field['validators'])) {
                        foreach ($field['validators'] as $validator) {
                            if ($validator['type'] == 'Required') {
                                $newField->addValidator(new Required($field['label'] . " is required"));
                            }
                            if ($validator['type'] == 'Regex' && isset($validator['pattern'])) {
                                $newField->addValidator(new Regex(($validator['pattern']), $field['label'] . " pattern error"));
                            }
                        }
                    }

                    $this->add($newField);
                }
                /**
                 * Input Type Date
                 */
                if ($field['type'] == 'Date') {
                    ##Date fields
                    $newField = (new Text())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email'])
                        ->setValue(isset($field['value']) ? $field['value'] : '');

                    if (!empty($field['validators'])) {
                        foreach ($field['validators'] as $validator) {
                            if ($validator['type'] == 'Required') {
                                $newField->addValidator(new Required($field['label'] . " is required"));
                            }
                            if ($validator['type'] == 'Regex' && isset($validator['pattern'])) {
                                $newField->addValidator(new Regex(($validator['pattern']), $field['label'] . " pattern error"));
                            }
                        }
                    }
                    $newField
                        ->addValidator(new Date("-35 year", "-18 year", "year error"))
                        ->addValidator(new Regex("/^[0-9]{4}-[0-9]{2}-[0-9]{2}$/", "pattern error"));

                    $this->add($newField);
                }

                /**
                 * Input Type Email
                 */
                if ($field['type'] == 'Email') {
                    ##Email fields
                    $newField = (new Text())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email'])
                        ->setValue(isset($field['value']) ? $field['value'] : '');

                    if (!empty($field['validators'])) {
                        foreach ($field['validators'] as $validator) {
                            if ($validator['type'] == 'Required') {
                                $newField->addValidator(new Required($field['label'] . " is required"));
                            }
                            if ($validator['type'] == 'Regex' && isset($validator['pattern'])) {
                                $newField->addValidator(new Regex(($validator['pattern']), $field['label'] . " pattern error"));
                            }
                        }
                    }
                    $newField->addValidator(new Email("error email"));

                    $this->add($newField);
                }
                /**
                 * Input Type CheckBox
                 */
                if ($field['type'] == 'CheckBox') {
                    ##CheckBox fields
                    $newField = (new CheckBox())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email']);

                    foreach ($field['validators'] as $validator) {
                        if ($validator['type'] == 'Required') {
                            $newField->addValidator(new Required($field['label'] . " is required"));
                        }
                    }

                    if (!empty($field['values'])) {
                        foreach ($field['values'] as $value) {
                            $checkBoxValue = (new CheckBoxItem())
                                ->setText($value['text'])
                                ->setValue($value['value']);
                                if(isset($value['checked']) && $value['checked'] == true){
                                    $checkBoxValue->setChecked('checked');
                                }
                            $newField->add($checkBoxValue);
                        }
                    }

                    $this->add($newField);
                }

                /**
                 * Input Type Radio
                 */
                if ($field['type'] == 'Radio') {
                    ##Radio fields
                    $newField = (new Radio())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email']);

                    foreach ($field['validators'] as $validator) {
                        if ($validator['type'] == 'Required') {
                            $newField->addValidator(new Required($field['label'] . " is required"));
                        }
                    }

                    if (!empty($field['values'])) {
                        foreach ($field['values'] as $value) {
                            $RadioValue = (new RadioItem())
                                ->setText($value['text'])
                                // ->setChecked(isset($value['checked']) ? $value['checked'] : false)
                                ->setValue($value['value']);
                                if(isset($value['checked']) && $value['checked'] == true){
                                    $RadioValue->setChecked('checked');
                                }
                            $newField->add($RadioValue);
                        }
                    }

                    $this->add($newField);
                }

                /**
                 * Input Type Radio
                 */
                if ($field['type'] == 'Select') {
                    ##Select fields
                    $newField = (new Select())
                        ->setName(generateFieldName($field['label']))
                        ->setLabel($field['label'])
                        ->setSentByEmail($field['sent-in-email']);

                    foreach ($field['validators'] as $validator) {
                        if ($validator['type'] == 'Required') {
                            $newField->addValidator(new Required($field['label'] . " is required"));
                        }
                    }

                    if (!empty($field['values'])) {
                        foreach ($field['values'] as $value) {
                            $SelectValue = (new SelectItem())
                                ->setText($value['text'])
                                ->setValue($value['value']);
                                if(isset($value['checked']) && $value['checked'] == true){
                                    $SelectValue->setSelected('checked');
                                }
                            $newField->add($SelectValue);
                        }
                    }

                    $this->add($newField);
                }
            }
        }
    }
}
