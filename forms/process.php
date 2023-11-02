<?php
session_start();

//Databse connection file
include('config.php');

// print_r($_GET['submit']);die;

$data = json_decode(file_get_contents('php://input'), true);

if (!empty($data) && isset($data['requestType']) && $data['requestType'] == 'formCreation') {
    unset($data['requestType']);
    $data = json_encode($data);

    $sql = mysqli_query($con, "INSERT INTO dynamic_forms(request) VALUES('$data')");
    echo $con->insert_id;
    exit;
}

if (isset($_GET['submit'])) {

    $id = $_GET['formID'];

    $sql = mysqli_query($con, "SELECT * FROM dynamic_forms WHERE id = $id  ");

    $result = mysqli_fetch_array($sql);

    $formData = json_decode($result['request'], true);
    $data = json_decode($result['request_data'], true);

//     print_r($request);

// die;
    foreach ($formData['fields'] as $key => $field) {
        if (is_array($field)) {
            $formData['fields'][$key]['name'] = generateFieldName($field['label']);
            $formData['fields'][$key]['value'] = $_POST[generateFieldName($field['label'])];
            if ($field['type'] == 'Radio' || $field['type'] == 'Select' || $field['type'] == 'CheckBox') {
                if ($field['type'] == 'Radio' || $field['type'] == 'CheckBox') {
                    $check = 'checked';
                } else {
                    $check = 'selected';
                }

                foreach ($field['values'] as $key2 => $value) {

                    if ($value['value'] == $formData['fields'][$key]['value']) {
                        $formData['fields'][$key]['values'][$key2][$check] = true;
                    } else {
                        $formData['fields'][$key]['values'][$key2][$check] = false;
                    }
                }
            }
        }
    }

    $data = json_encode($formData);

    $sql = mysqli_query($con, "UPDATE dynamic_forms SET request_data = '$data'");
}


function generateFieldName($name)
{
    return preg_replace('/\s+/', '_', strtolower($name));
}

