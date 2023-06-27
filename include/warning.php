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
				title: 'Missing Required Information',
				text: 'Complete the field items to get a request',
				icon: 'warning',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.history.back();
				}
			});
		}
	</script>
	<script>
		function noData() {
			Swal.fire({
				title: 'No data found',
				text: 'Search another name',
				icon: 'warning',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "adminworkcheck.php";
				}
			});
		}
	</script>
	<script>
		function showAlert1() {
			Swal.fire({
				title: 'Missing Required Information',
				text: 'Complete the field items to get a request',
				icon: 'warning',
				confirmButtonText: 'Continue'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "customer.php";
				}
			});
		}
	</script>
	<script>
		function unavailableService() {
			Swal.fire({
				title: 'Cannot Book!',
				text: 'Service unavailable with your service request',
				icon: 'warning',
				confirmButtonText: 'Try another'
			}).then((result) => {
				if (result.isConfirmed) {
					window.location.href = "customer.php";
				}
			});
		}
	</script>
	<script>
		function invalidImage() {
			Swal.fire({
				title: 'Invalid format',
				text: 'Only .JPG, .JPEG will accept',
				icon: 'warning',
				confirmButtonText: 'Try again'
			}).then((result) => {
				if (result.isConfirmed) {
					window.history.back();
				}
			});
		}
	</script>
	<script>
		function exist() {
			Swal.fire({
				title: 'Cannot proceed',
				text: 'Data already exist',
				icon: 'warning',
				confirmButtonText: 'Try again'
			}).then((result) => {
				if (result.isConfirmed) {
					window.history.back();
				}
			});
		}
	</script>
	<script>
		function wrong() {
			Swal.fire({
				title: 'Cannot proceed',
				text: 'Something is wrong with data',
				icon: 'warning',
				confirmButtonText: 'Try again'
			}).then((result) => {
				if (result.isConfirmed) {
					window.history.back();
				}
			});
		}
	</script>
</body>

</html>