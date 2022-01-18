<?php

/*  Autor: Matthias Hollenstein
    Datum: 17.01.2022
    sourcecode: indx.php

    Beschreibung:
    Formular um Sachen zu bestellen
*/
$test= "";
function validate_form(){
    global $test;
    $test = "abc";
    $error_messages = array();
    $error_messages['firstname'] = "";
    $error_messages['lastname'] = "";
    $error_messages['email'] = "";

    $regex_name = '/^[a-z]{1,30}$/';
    $regex_email = '/^[a-z0-9]{2,30}@[a-z0-9]{1,30}\.[a-z]{2,6}$/';

    if(! preg_match($regex_name, htmlspecialchars($_POST['firstname']))){
        $error_messages['firstname'] = '<div class="error">Falscher Vorname</div>' . "<br>";
    }
    if(! preg_match($regex_name, htmlspecialchars($_POST['lastname']))){
        $error_messages['lastname'] = '<div class="error">Falscher Nachname</div>' . "<br>";
    }

    if(! preg_match($regex_email, htmlspecialchars($_POST['email']))){
        $error_messages['email'] = '<div class="error">Falsche Email</div>' . "<br>";
    }

    return $error_messages;

}

function show_form(){
    $errorform = null;
    global $test;
    // validate the form and get some errors if there are
    $error_messages = validate_form();

    foreach ($error_messages as $error){
        if ($error != ''){
            $errorform = true;
            break;
        }
        $errorform = false;
    }

    if($errorform){
        echo '<form method="post" action="'. $_SERVER['PHP_SELF'] . '" id="contact_form">';
        echo '<label><p>*Name:</p><input type="text" name="firstname" value="'. htmlspecialchars($_POST['firstname']).'"></label>';
        echo $error_messages['firstname'];
        echo '<label><p>*Nachname:</p><input type="text" name="lastname" value="'.htmlspecialchars($_POST['lastname']).'"></label>';
        echo $error_messages['lastname'];
        echo '<label><p>*Email:</p><input type="text" name="email" value="'.htmlspecialchars($_POST['email']).'"></label>';
        echo $error_messages['email'];

        // check if sex radio is set
        if (isset($_POST['sex'])){
            if (strstr($_POST['sex'], 'maennlich')){
                echo '<input type="radio" name="sex" value="maennlich" checked="checked">Männlich<br>';
            }
            else{
                echo '<input type="radio" name="sex" value="maennlich">Männlich<br>';
            }
            if(strstr($_POST['sex'], 'weiblich')){
                echo '<input type="radio" name="sex" value="weiblich" checked="checked">Weiblich<br>';
            }
            else{
                echo '<input type="radio" name="sex" value="weiblich">Weiblich<br>';
            }
        }
        else{
            echo '<input type="radio" name="sex" value="maennlich">Männlich<br>';
            echo '<input type="radio" name="sex" value="weiblich">Weiblich<br>';
        }
        echo '<fieldset id="teaching_aids"><legend>Lehrmittel</legend>';
        if(isset($_POST['php'])){
            echo '<label><input type="checkbox" name="php" checked>PHP</label>';
        }
        else{
            echo '<label><input type="checkbox" name="php">PHP</label>';
        }
        if(isset($_POST['python'])){
            echo '<label><input type="checkbox" name="python" checked>Python</label></fieldset>';
        }
        else{
            echo '<label><input type="checkbox" name="python">Python</label></fieldset>';
        }
        echo '<input type="submit" value="Senden" name="send_form">';
        echo '<p>Felder mit * sind obligatorisch</p>';
        echo $test;
        echo '</form>';
    }
    else{
        echo '<h1>Richtige Form</h1>';
    }
}


// send response to client
header('Content-Type: text/html; charset=utf-8');

echo '<!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <title>Formular</title>
                <link href="style.css" rel="stylesheet">
            </head>
            <body><div class="container">';

if (isset($_POST['send_form'])){

    show_form();

}
else{
    include('formular.php');
}

echo '</div></body></html>';