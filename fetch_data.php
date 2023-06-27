<?php
include "dbconn.php";
$query = "SELECT transno,cust_name,amount,auth_name,worker_name,wage,finance.request,tdate FROM finance           
JOIN authoriser ON finance.aid = authoriser.id
JOIN worker ON finance.wid = worker.id
WHERE finance.request = '" . $_POST['service'] . "' AND worker.area = '" . $_POST['city'] . "'";
$myArray = [];
$output = '';
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_row($result)) {
	$myArray[] = $row;
	$output .= '
			<tr>
				<td>' . $row[0] . '</td>
				<td>' . $row[1] . '</td>
				<td>' . $row[2] . '</td>
				<td>' . $row[3] . '</td>
				<td>' . $row[4] . '</td>
				<td>' . $row[5] . '</td>
				<td>' . $row[6] . '</td>
				<td>' . $row[7] . '</td></tr>
			';
}
//echo json_encode($myArray);
echo $output;
?>