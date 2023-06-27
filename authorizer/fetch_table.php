<?php
session_start();
error_reporting(0);
if (!isset($_SESSION['sess_user'])) {
    header('Location: authorizer.php');
}

include '../dbconn.php';

$user = $_SESSION['sess_user'];
$query = "SELECT * FROM authoriser WHERE username='" . $user . "'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_array($result);
    $id = $row[0];
    $q = "SELECT * FROM customer JOIN service WHERE customer.id=service.id AND service.authid='" . $id . "' AND (service.aflag=0 OR service.transflag=0)";
    $res = mysqli_query($conn, $q);

    // Start building the HTML content for the table rows
    $tableData = '';

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_array($res)) {
            if ($row[10] == '0' || $row[11] == 0) {
                $tableData .= "<tr>";
                $tableData .= "<td name='cid'>" . $row[0] . "</td>";
                $tableData .= "<td name='fname'>" . $row[1] . "</td>";
                $tableData .= "<td name='lname'>" . $row[2] . "</td>";
                $tableData .= "<td name='phone'>" . $row[3] . "</td>";
                $tableData .= "<td name='email'>" . $row[4] . "</td>";
                $tableData .= "<td name='area'>" . $row[5] . "</td>";
                $tableData .= "<td name='location'>" . $row[6] . "</td>";
                $tableData .= "<td name='service'>" . $row[8] . "</td>";

                if ($row[10] == '0') {
                    $tableData .= "<td><input type='button' value='Assign' onclick='val1()' style='background-color:green;color:white;border-radius:25px;'></td>";
                } else {
                    $tableData .= "<td name='worker'>" . $row[10] . "</td>";
                }

                if ($row[11] == 0) {
                    $tableData .= "<td><input type='button' value='Enter' onclick='val2()' style='background-color:green;color:white;border-radius:25px;'></td>";
                }

                $tableData .= "<td><input type='button' value='Delete' onclick='val3()' style='background-color:red;color:white;border-radius:25px;'></td>";
                $tableData .= "</tr>";
            }
        }
    }

    // If no rows found, display "No Data"
    if ($tableData === '') {
        $tableData = "<tr><td colspan='11'>No Data</td></tr>";
    }

    // Echo the HTML content for the table rows
    echo $tableData;
} else {
    echo "<tr><td colspan='11'>No Data</td></tr>";
}

mysqli_close($conn);
?>