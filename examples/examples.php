<?php
session_start();

include('config.php');

/**
 * Created by IntelliJ IDEA.
 * User: erdal
 * Date: 08.02.2018
 * Time: 14:11
 */
//header('Content-Type: application/json; charset=UTF-8');

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('BASE_PATH', realpath(dirname(__FILE__)));

spl_autoload_register(function ($class) {
    $filename = BASE_PATH . '/../src/' . str_replace('\\', '/', $class) . '.php';
    require_once '' . $filename;
});
/*------------config for test-------------*/
// echo '<pre>';

// print_r($_POST) ;die;

// $data = json_decode(file_get_contents('php://input'), true);
// // print_r($data);
// $request = [];

// if ($data != '') {
//     $_SESSION['form-data'] = $data;
//     // header('location:examples.php');  //reload preview.php with the `my_data`
//     // echo 'heeeee';
// }

// $request = $_SESSION['form-data'];
// print_r($request);

// $outputData = isset($_SESSION['output-data']) ? $_SESSION['output-data'] : [];


if (isset($_GET['formID'])) {
    $id = $_GET['formID'];

    $sql = mysqli_query($con, "SELECT * FROM dynamic_forms WHERE id = $id  ");

    $result = mysqli_fetch_array($sql);

    $request = json_decode($result['request'], true);
    $data = json_decode($result['request_data'], true);
}

error_reporting(E_ALL ^ E_WARNING);


require_once 'TestForm.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=UTF-8');

    if (isset($_GET['form'])) {
        $form = new TestForm($request);
        echo json_encode($form);
        exit;
    } elseif (isset($_GET['valid'])) {
        $form = new TestForm($request);
        var_dump($form->isValid($_POST));
        exit;
    } elseif (isset($_GET['messages'])) {
        $form = new TestForm($request);
        echo json_encode($form->getErrorMessages($_POST));
        // $errorMessages = json_encode($form->getErrorMessages($_POST));
        exit;
    } elseif (isset($_GET['submit'])) {
        $form = new TestForm($data);
        echo json_encode($form);
        exit;
    }
}


?>
<html lang="tr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/css/bootstrap-slider.min.css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.0.0/bootstrap-slider.min.js"></script>
</head>

<body>


    <div id="form-wrapper" class="container"></div>

    <div class="btn-row">

        <button class="btn get">Get Data</button>
        <!-- <button class="btn test-data">Test </button> -->
        <button class="btn output">Submit</button>
    </div>
    <script>
        $(document).ready(function(e) {

            $(".get").click(function() {
                // alert("Hi");
            });

            $('.get').click();


        });
        var request = 'form=1'

        window.onload = function() {
            <?php if (isset($_GET['submit'])) { ?>
                $("#target :input").prop("disabled", true);
                $(".btn").attr('disabled', 'disabled'); //or $("#Button1Id").prop('disabled',true);

            <?php } ?>
        }

        $(".get").click(function() {
            // alert('sssssssssssss');
            var requet = 'form';
            <?php if (isset($_GET['submit'])) { ?>
                requet = 'submit';
            <?php } ?>


            var wrapper = $("#form-wrapper");
            wrapper.html("");
            $.post("examples.php?" + requet + "=1&formID=<?php echo $_GET['formID']; ?>", function(res) {
                console.log(res)
                var wrapper = $("#form-wrapper");
                wrapper.append("<h1 align='center'>" + res.title + "</h1>");
                var form = $("<form class='' id='target'></form>").appendTo(wrapper);
                res.fields.forEach(function(item, index) {

                    if (item.type == 'Text') {
                        var row = $("<div class='form-group'></div>").appendTo(form);
                        row.append("<label for='" + item.name + index + "'><h3>" + item.label + "</h3></label>");
                        row.append("<input class='form-control' type='text' name='" + item.name + "' data-sent-by-mail='" + item.sentbyemail + "' id='" + item.name + index + "' value='" + item.value + "' />");

                    }
                    if (item.type == 'TextArea') {
                        var row = $("<div class='form-group'></div>").appendTo(form);
                        row.append("<label for='" + item.name + index + "'><h3>" + item.label + "</h3></label>");
                        row.append("<textarea class='form-control' name='" + item.name + "' data-sent-by-mail='" + item.sentbyemail + "' id='" + item.name + index + "'>" + item.value + "</textarea>");
                    }
                    if (item.type == 'CheckBox') {
                        form.append("<h3>" + item.label + "</h3>");
                        item.values.forEach(function(subItem, index) {
                            var row = $("<div class='form-check'></div>").appendTo(form);
                            row.append("<input class='form-check-input' type='checkbox' name='" + item.name + "' data-sent-by-mail='" + item.sentbyemail + "[]' id='" + item.name + index + "' value='" + subItem.value + "' " + subItem.checked + " />");
                            row.append("<label class='form-check-label' for='" + item.name + index + "'>" + subItem.text + "</label>");
                        });
                    }
                    if (item.type == 'Radio') {
                        form.append("<h3>" + item.label + "</h3>");
                        item.values.forEach(function(subItem, index) {
                            var row = $("<div class='form-check'></div>").appendTo(form);
                            row.append("<input class='form-check-input' type='radio' name='" + item.name + "' data-sent-by-mail='" + item.sentbyemail + "' id='" + item.name + index + "' value='" + subItem.value + "' " + subItem.checked + " />");
                            row.append("<label class='form-check-label' for='" + item.name + index + "'>" + subItem.text + "</label>");
                        });
                    }
                    if (item.type == 'Select') {
                        form.append("<h3>" + item.label + "</h3>");
                        var row = $("<div class='form-group'></div>").appendTo(form);
                        var select = $("<select name='" + item.name + "' data-sent-by-mail='" + item.sentbyemail + "'></select>").appendTo(row);
                        item.values.forEach(function(subItem, index) {
                            select.append("<option value='" + subItem.value + "' " + subItem.selected + ">" + subItem.text + "</option>")
                        });
                    }


                });
            });
        });
        $(".test-data").click(function() {
            $.post("examples.php?valid=1", getFormData(), function(res) {

            });
        });
        $(".output").click(function() {
            // alert('heeeeeeee')
            $.post("examples.php?messages=1&formID=<?php echo $_GET['formID']; ?>", getFormData(), function(res) {
                // console.log(res)
                $.each(res, function(index, value) {
                    alert(value.text);
                    return false;
                });
                // console.log(res)
                if (res.length === 0) {
                    submitForm();

                }


            });
        });
        var submitForm = function() {
            $.post("process.php?submit=1&formID=<?php echo $_GET['formID']; ?>", getFormData(), function(res) {

                window.location.href = "examples.php?submit=1&formID=<?php echo $_GET['formID']; ?>";


            });
            // alert('submit form')
        }
        var getFormData = function() {
            var data = $("form").serializeArray();
            $("[data-type=range]").each(function() {

                data.push({
                    name: $(this).attr("id") + "[]",
                    value: $(this).val().split(",")[0]
                });
                data.push({
                    name: $(this).attr("id") + "[]",
                    value: $(this).val().split(",")[1]
                });
            });

            return data;
        }
        // $(document).ready(function() {
        // console.log('new')
        // });
    </script>
    <style>
        select {
            width: 100%;
        }

        .btn-row {
            text-align: center;
            padding: 5px;
        }
    </style>
</body>

</html>