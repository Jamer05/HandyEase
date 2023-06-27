<?php include '../dbconn.php';?>
<?php
$errors = array(); 
if (isset($_POST['sub'])) {
		// receive all input values from the form
		$transid=mysqli_real_escape_string($conn,$_POST['tid']);
		$amount = mysqli_real_escape_string($conn,$_POST['amount']);
		$payee = mysqli_real_escape_string($conn,$_POST['payee']);
		$payer = mysqli_real_escape_string($conn,$_POST['payer']);
		$req = mysqli_real_escape_string($conn,$_POST['service']);
		$wage = mysqli_real_escape_string($conn,$_POST['wage']);
		$authorizer= mysqli_real_escape_string($conn,$_POST['authorizer']);
		$cusid = mysqli_real_escape_string($conn,$_POST['cid']);
		$authid = mysqli_real_escape_string($conn,$_POST['aid']);
		$workerid = mysqli_real_escape_string($conn,$_POST['wid']);
		$date=mysqli_real_escape_string($conn,$_POST['tdate']);


		if (empty($payee) || empty($authorizer) || empty($amount) || empty($wage)) {
	        include '../include/warning.php';
       		 echo '<script>showAlert();</script>';
			}
		else{
			if (count($errors) == 0) {

			$query="INSERT INTO finance (transno,cid,amount,wid,wage,aid,request,cust_name,auth_name,worker_name,tdate) VALUES ('$transid','$cusid','$amount','$workerid','$wage','$authid','$req','$payer','$authorizer','$payee','$date')";
			if (mysqli_query($conn, $query)) {
			$result="Created successfully";
			$q="UPDATE service set transflag=1 where id='".$cusid."'";
			mysqli_query($conn,$q);
	        include '../include/success.php';
       		 echo '<script>trans();</script>';
			} 
			else {
				include '../include/warning.php';
       		 echo '<script>wrong();</script>';
			}
		}	
	}
}
mysqli_close($conn);
?>



