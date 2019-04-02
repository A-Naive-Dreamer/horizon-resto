<?php
    define('HOST', 'localhost');
    define('USERNAME', 'root');
    define('PASSWORD', '');
    define('DATABASE', 'restaurant');

    $conn = new mysqli(HOST, USERNAME, PASSWORD, DATABASE);

    $guest_number = (int) $_POST['guest_number'];
    $length_of_dinner = (int) $_POST['length_of_dinner'];
    $reservation_date = $_POST['reservation_date'];
    $reservation_time = $_POST['reservation_time'];
    $cuisines = json_decode($_POST['cuisines']);

    for($x = 0; $x < count($cuisines); ++$x) {
        $cuisines[$x][0] = (int) $cuisines[$x][0];
        $cuisines[$x][2] = (int) $cuisines[$x][2];
        $fee += $cuisines[$x][0] * $cuisines[$x][2];
    }

    $query = "INSERT INTO `order` VALUES(NULL, 1, $guest_number, $length_of_dinner, DEFAULT, $fee.00 DEFAULT, $fee.00, DEFAULT, CURRENT_DATE(), CURRENT_TIME(), '$reservation_date', '$reservation_time');";

    $conn -> query($query);
