<?php
session_start();
//Database connection file
// include('config.php');

// if (isset($_POST['submit'])) {
//     // Counting No fo skilss
//     $count = count($_POST["skill"]);
//     //Getting post values
//     $skill = $_POST["skill"];
//     if ($count > 1) {
//         for ($i = 0; $i < $count; $i++) {
//             if (trim($_POST["skill"][$i] != '')) {
//                 $sql = mysqli_query($con, "INSERT INTO tblskills(skill) VALUES('$skill[$i]')");
//             }
//         }
//         echo "<script>alert('Skills inserted successfully');</script>";
//     } else {
//         echo "<script>alert('Please enter skill');</script>";
//     }
// }

$inputTypes = ["Text", "Date", "Email", "TextArea", "Select", "CheckBox", "Radio"];


?>
<html>

<head>
    <title>PHPGurukul Programmin Blog | Dynamically Add or Remove input fields in PHP with JQuery</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 align="center">Dynamically Add or Remove input fields in PHP with JQuery</h2><br />
        <div class="form-group">
            <form name="add_name" id="add_name" method="post" action="examples/examples.php">
                <div class="table-responsive">
                    <div class="form-control name_list">
                        <label for="form-name">Form Name</label>
                        <input type="text" name="form-name" id="form-name">
                    </div>
                    <table class="table table-bordered" id="dynamic_field">
                        <tr>
                            <th>Enter Field Name</th>
                            <th>Enter Field Type</th>
                            <th>Select Validations</th>
                            <th>Sent By Email</th>
                            <th>Actions</th>
                        </tr>
                        <tr id="1" class="line">
                            <td><input type="text" id="field-name-1" name="field-name-1" placeholder="Enter Label Name" class="form-control name_list" /></td>
                            <!-- <td><input type="text" name="field-name-0" placeholder="Enter Label" class="form-control name_list" /></td> -->

                            <td id="input-types-1"><select class="form-control" id="input-type-1" title="Choose Plan" placeholder="Choose Input type" onChange="inputOptions(1,this)">
                                    <?php foreach ($inputTypes as  $type) { ?>
                                        <option value="<?= $type ?>">
                                            <?= htmlspecialchars($type) ?>
                                        </option>
                                    <?php } ?>
                                </select></td>

                            <td id="validation-1">
                                <label class="checkbox-container">Is required
                                    <input type="checkbox" id="field-required-1">
                                    <span class="checkmark"></span>
                                </label>
                                &nbsp;
                                <label class="checkbox-container">Validation Pattern
                                    <input type="checkbox" id="field-regex-required-1" onclick="regexPattern(1)">
                                    <span class="checkmark"></span>
                                </label>

                            </td>
                            <td>
                                <label class="checkbox-container">Sent via email
                                    <input type="checkbox" id="sent-by-email-1">
                                    <span class="checkmark"></span>
                                </label>
                            </td>
                            <td><button type="button" name="add" id="add" class="btn btn-success">Add More</button></td>
                        </tr>
                    </table>
                    <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
                </div>
            </form>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#dynamic_field').append('<tr class="line" id="' + i + '"><td><input type="text" id="field-name-' + i + '" name="field-name-' + i + '" placeholder="Enter Label Name" class="form-control name_list" /></td><td id="input-types-' +
                i + '"><select class="form-control" title="Choose Plan" placeholder="Choose Input type" id="input-type-' +
                i + '" onChange="inputOptions(' + i + ',this)">'
                <?php foreach ($inputTypes as  $type) { ?> +
                    '<option value=' + "<?= $type ?>" + '>' +
                    "<?= htmlspecialchars($type) ?>" +
                    '</option>'
                <?php } ?> +
                '</select></td><td id="validation-' + i + '"><label class="checkbox-container">Is required<input type="checkbox" id="field-required-' + i +
                '"><span class="checkmark"></span></label>&nbsp;<label class="checkbox-container">Validation Pattern' + '<input type="checkbox" id="field-regex-required-' + i +
                '" onclick="regexPattern(' + i + ')"><span class="checkmark"></span></label></td>' +
                '<td><label class="checkbox-container">Sent via email<input type="checkbox" id="sent-by-email-' + i + '"><span class="checkmark"></span>' +
                '</label></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#' + button_id + '').remove();
        });

        $('#add_name').on('submit', function(e) {
            var result = {};
            result['title'] = $('#form-name').val();
            var fields = [];

            e.preventDefault();
            $('.line').each(function() {
                var options = [];
                var validators = [];
                var row_id = $(this).attr("id");

                if ($('#field-required-' + row_id + '').is(':checked') == true) {
                    reqObj = {};
                    reqObj["type"] = "Required";
                    reqObj["message"] = "Required Error";
                    validators.push(reqObj);
                }
                if ($('#field-regex-required-' + row_id + '').is(':checked') == true) {
                    regReqObj = {};
                    regReqObj["type"] = "Regex";
                    regReqObj["pattern"] = $('#regex-pattern-' + row_id + '').val();
                    regReqObj["message"] = "Pattern Error";
                    validators.push(regReqObj);
                }
                if ($('#input-type-' + row_id + '').val() == 'Select' || $('#input-type-' + row_id + '').val() == 'Radio' || $('#input-type-' + row_id + '').val() == 'CheckBox') {
                    var array = $('#options-' + row_id + '').val().split(',');
                    var i;
                    for (i = 0; i < array.length; ++i) {
                        opt = {};
                        opt["text"] = array[i];
                        opt["value"] = i;
                        options.push(opt);
                    }

                }
                obj = {};
                obj["type"] = $('#input-type-' + row_id + '').val();
                obj["label"] = $('#field-name-' + row_id + '').val();
                obj["sent-in-email"] = $('#sent-by-email-' + row_id + '').is(':checked');
                obj["validators"] = validators;
                obj["values"] = options;
                fields.push(obj);

            });
            result['fields'] = fields;
            result['requestType'] = 'formCreation';
            console.log(result)

            $.ajax({
                contentType: 'application/json',
                data: JSON.stringify(result),
                requestType: 'formCreation',
                dataType: 'json',
                processData: false,
                type: 'POST',
                url: 'examples/process.php',
                success: function(data) {
                    window.location.href = "examples/examples.php?form=1&formID=" + data;

                },
                error: function() {
                    console.log("Device control failed");
                },
            });

        });
    });

    function inputOptions(id, selected) {
        if (selected.value == 'Select' || selected.value == 'CheckBox' || selected.value == 'Radio') {
            $('#options-' + id + '').remove();
            $('#input-types-' + id + '').append('<input type="text" id="options-' + id + '" name="options-' + selected.value + '" placeholder="Enter Comma Separated Options" class="form-control" />');
        } else {
            $('#options-' + id + '').remove();
        }


    }

    function regexPattern(id) {
        if ($('#field-regex-required-' + id + '').is(':checked') == true) {
            $('#regex-pattern-' + id + '').remove();
            $('#validation-' + id + '').append('<input type="text" id="regex-pattern-' + id + '" name="regex-pattern-' + id + '" placeholder="Enter Validation Pattern" class="form-control" />');
        } else {
            $('#regex-pattern-' + id + '').remove();

        }
    }

    // function submitRequest() {
    //     alert('submit')
    // }
</script>
<style>
    /* The checkbox-container */
    .checkbox-container {
        font-weight: unset;
        /* display: block; */
        position: relative;
        padding-left: 35px;
        margin-bottom: unset;
        margin-top: 5px;
        cursor: pointer;
        /* font-size: 22px; */
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    /* Hide the browser's default checkbox */
    .checkbox-container input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
        height: 0;
        width: 0;
    }

    /* Create a custom checkbox */
    .checkmark {
        position: absolute;
        top: 0;
        left: 0;
        height: 20px;
        width: 20px;
        background-color: #eee;
    }

    /* On mouse-over, add a grey background color */
    .checkbox-container:hover input~.checkmark {
        background-color: #ccc;
    }

    /* When the checkbox is checked, add a blue background */
    .checkbox-container input:checked~.checkmark {
        background-color: #2196F3;
    }

    /* Create the checkmark/indicator (hidden when not checked) */
    .checkmark:after {
        content: "";
        position: absolute;
        display: none;
    }

    /* Show the checkmark when checked */
    .checkbox-container input:checked~.checkmark:after {
        display: block;
    }

    /* Style the checkmark/indicator */
    .checkbox-container .checkmark:after {
        left: 9px;
        top: 5px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 3px 3px 0;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
</style>

</html>