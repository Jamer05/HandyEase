<?php
session_start();
if (!isset($_SESSION['sess_user'])) {
    header('Location: authorizer.php');
    exit;
}
include '../dbconn.php';

if (isset($_GET['tableData'])) {
    $rowdata = json_decode($_GET['tableData']);
    $id = $rowdata[0];

    $query = "SELECT types, dateofreq, brand, technology, info FROM service WHERE id = '$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);

        $response = array('types' => $row['types'], 'dateofreq' => $row['dateofreq'], 'brand' => $row['brand'], 'technology' => $row['technology'],'info'=> $row['info'] );
        echo json_encode($response);
    } else {
        $response = array('error' => 'Database error');
        echo json_encode($response);
    }
} else {
    $response = array('error' => 'tableData missing parameter');
    echo json_encode($response);
}
?>