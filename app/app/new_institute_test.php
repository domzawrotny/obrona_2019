<?php

foreach ($_POST as $param_name => $param_val) {
    echo "Param: $param_name; Value: $param_val<br />\n";
}


if ( (isSet($_POST['institute_name'])) && isSet($_POST['institute_abbrev'])) {
    if ( (strlen($_POST['institute_name']) > 120 ) || ( strlen($_POST['institute_name'] < 10 )) ) {
        $_SESSION['institute_error'] = 'Nazwa instytutu musi zawierac od 10 do 120 znakow!';
        $validated = false;
    }
    else {
        unset($_SESSION['institute_error']);
    }

    if (strlen($_POST['institute_abbrev']) > 10 || strlen($_POST['institute_abbrev']) < 2 ) {
        $_SESSION['institute_abbrev_error'] = 'Skrocona nazwa instytutu musi zawierac od 3 do 10 znakow';
        $validated = false;
    }
    else {
        unset($_SESSION['institute_abbrev_error']);
        $validated = true;
    }

    if ( $validated == true ) {
        // dodanie instytutu do bazki ;pppp
    }

}


if (isSet($_SESSION['institute_error'])) echo $_SESSION['institute_error'] . "</br>";
if (isSet($_SESSION['institute_abbrev_error'])) echo $_SESSION['institute_abbrev_error'] . "</br>";