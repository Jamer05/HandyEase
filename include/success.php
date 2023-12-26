<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>PHP SweetAlert Example</title>
	<!-- Load SweetAlert library from CDN -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</head>

<body>

	<script>
		function showAlert() {
			Swal.fire({
				title: 'Request has been sent',
				text: 'You request has been pending checkout you email to get a notification',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "landpage.php";
				}
			});
		}
	</script>
	<script>
		function added() {
			Swal.fire({
				title: 'Succesfully Added',
				text: 'Well done!',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "adminauthcheck.php";
				}
			});
		}
		function addedFeedback() {
			Swal.fire({
				title: 'Succesfully Added',
				text: 'Well done!',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "completed.php";
				}
			});
		}
	</script>
	<script>
		function assign() {
			Swal.fire({
				title: 'Succesfully Assigned',
				text: 'Next task is to proceed to the transaction ',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "application.php";
				}
			});
		}
	</script>
	<script>
		function approved() {
			Swal.fire({
				title: 'Accepted',
				text: 'Ride safety',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "application.php";
				}
			});
		}
	</script>
		<script>
		function decline() {
			Swal.fire({
				title: 'Declined',
				text: 'You have beend declined the request',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "application.php";
				}
			});
		}
	</script>
	<script>
		function trans() {
			Swal.fire({
				title: 'Transaction added to the report',
				text: 'Finished!!',
				icon: 'success',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "application.php";
				}
			});
		}
	</script>
</body>

</html>