<?php

$forename = $surname = $username = $password = $age = $email = "";

if (isset($_POST['forename']))
    $forename = fix_string($_POST['forename']);
if (isset($_POST['surname']))
    $surname = fix_string($_POST['surname']);
if (isset($_POST['username']))
    $username = fix_string($_POST['username']);
if (isset($_POST['password']))
    $password = fix_string($_POST['password']);
if (isset($_POST['age']))
    $age = fix_string($_POST['age']);
if (isset($_POST['email']))
    $email = fix_string($_POST['email']);


$fail = validate_forename($forename);
$fail .= validate_surname($surname);
$fail .= validate_username($username);
$fail .= validate_password($password);
$fail .= validate_age($age);
$fail .= validate_email($email);


echo "<!DOCTYPE html>\n<html><head><title>An example!</title>";

if ($fail == "") {
    echo "</head><body>FORM DATA SUCCESSFULLY VALIDATED:
$forename, $surname, $username, $password, $age, $email.</body></html>";

exit;
}


echo <<<_END
    <style>
    .signup {
    border: 1px solid #999999;
    font: normal 14px helvetica;
    color: #444444;
    }
</style>

<script>
    function validate(form){
        fail = validateForename(form.forename.value)
        fail += validateSurname(form.surname.value)
        fail += validateUsername(form.username.value)
        fail += validatePassword(form.password.value)
        fail += validateAge(form.age.value)
        fail += validateEmail(form.email.value)
        
        if (fail === "") return true
        else alert(fail); return false
    }
    
    function validateForename(field){
            return (field === "") ? "No forename was entered.\n" : ""
        }

        function validateSurname(field){
            return (field === "") ? "No surname was enetered.\n" : ""
        }

        function validateUsername(field) {
            if (field === "") return "No surname was entered.\n"
            else if (field.length < 5)
                return "Usernames must be at least 5 characters length.\n"
            else if (/[^a-zA-Z0-9_-]/.test(field))
                return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n"
            return ""
        }

        function validatePassword(field){
            if (field == "") return "Password field cannot be empty.\n"
            else if (field.length < 6)
                return "Password should be at least 6 characters long.\n"
            else if (!/[a-z]/.test(field) || !/[A-Z]/.test(field) || !/[0-9]/.test(field))
                return "Password require should contain Upper and lower characters, numbers.\n"
            return ""
        }

        function validateAge(field){
            if (isNaN(field)) return "No age was entered"
            else if (field < 18 || field > 110)
                return "Age must be between 18 and 110.\n"
            return ""
        }

        function validateEmail(field){
            if (field == "") return "No email was entered.\n"
            else if (!((field.indexOf(".") > 0) && (field.indexOf("@") > 0)) || /[^a-zA-Z0-9.@-_]/.test(field))
                return "The email address is invalid"
            return ""
        }
    </script>
</head>
<body>
    <table border="0" cellpadding="2" cellspacing="5" bgcolor="#eeeeee">
        <th colspan="2" align="center">Signup Form</th>
        <form action="adduser.php" method="post" onsubmit="return validate(this)">
            <tr><td>Forename</td>
            <td><input type="text" maxlength="32" name="forename"></td></tr>
            <tr><td>Surname</td>
            <td><input type="text" maxlength="32" name="surname"></td></tr>
            <tr><td>Username</td>
            <td><input type="text" maxlength="16" name="username"></td></tr>
            <tr><td>Password</td>
            <td><input type="text" maxlength="12" name="password"></td></tr>
            <tr><td>Age</td>
            <td><input type="text" maxlength="3" name="age"></td></tr>
            <tr><td>Email</td>
            <td><input type="text" maxlength="64" name="email"></td></tr>
            <tr><td colspan="2" align="center"><input type="submit" value="Signup"></td></tr>
        </form>
    </table>
</body>
</html>

_END;


function validate_forename($field) {
    if ($field == "") return "No forename was entered<br>";
    else return "";
}

function validate_surname($field){
    if ($field == "") return "No surname entered<br>";
    else return "";
}

function validate_username($field){
    if ($field == "") return "Username was not entered<br>";
    else if (strlen($field) < 5 ) return  "Username should be at least 5 characters<br>";
    else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
        return "Only letters, numbers, - and _ allowed in username<br>";
    return "";

}

function validate_password($field){
    if ($field == "") return "No password was entered<br>";
    else if (strlen($field) < 6)
        return "Password must be at least 6 characters<br>";
    else if (!preg_match("/[a-z]/", $field) ||
        !preg_match("/[A-Z]/", $field) ||
        !preg_match("/[0-9]/", $field))
        return "Password should contain upper and lower characters and numbers<br>";
    return "";
}

function validate_age($field){
    if ($field="") return "No age enetered<br>";
    else if ($field < 18 && $field > 110)
        return "Age must be between 18 and 110<br>";
    return "";
}

function validate_email($field){
    if ($field == "") return "No email was entered<br>";
    else if(!((strpos($field, ".") > 0) &&
               strpos($field, "@") > 0) ||
               preg_match("/[a-zA-Z0-9.@_-]/", $field))
        return "The email is invalid<br>";
    return "";

}

function fix_string($string){
    if (get_magic_quotes_gpc()) $string = stripslashes($string);
    return htmlentities($string);
}

if ($fail == "") {
    echo "HIIIIII";
}