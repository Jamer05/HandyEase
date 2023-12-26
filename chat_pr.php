<?php
session_start();

if (isset($_SESSION['username'])) {
	# database connection file
	include 'app/dbconn.php';

	include 'app/helpers/user.php';
	include 'app/helpers/chat.php';
	include 'app/helpers/opened.php';

	include 'app/helpers/timeAgo.php';

	if (!isset($_GET['user'])) {
		header("Location: chat_real.php");
		exit;
	}

	# Getting User data data
	$chatWith = getUser($_GET['user'], $conn);

	if (empty($chatWith)) {
		header("Location: chat_real.php");
		exit;
	}

	$chats = getChats($_SESSION['user_id'], $chatWith['user_id'], $conn);

	opened($chatWith['user_id'], $conn, $chats);
	?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Chat App</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
		<link rel="stylesheet" href="css/style.css">
		<link rel="icon" href="img/logo.png">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="css/style_client.css" rel="stylesheet" type="text/css" />
		<link rel="icon" href="../images/user.png">

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link
			href='//fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic'
			rel='stylesheet' type='text/css'>
		<link href='//fonts.googleapis.com/css?family=Lobster+Two:400,400italic,700,700italic' rel='stylesheet'
			type='text/css'>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			.image-container {
				background-color: black;
				display: flex;
				align-items: center;
				justify-content: center;

			}

			.menu-bar-image {
				width: 400px;
				/* Adjust the width as per your requirement */
				height: auto;
				/* Maintain the aspect ratio */
				object-fit: contain;
			}
		</style>

	</head>

	<body class="application">
		<div class="image-container">
			<img src="images/home1.png" alt="Home" class="menu-bar-image">
		</div>

		<div class="menu-bar">
			<div class="container">
				<div class="top-menu">

					<ul>
						<li><a href="service.php">Book</a></li>
						<li><a href="appointment.php">Updates</a></li>
						<li><a href="completed.php">Completed</a></li>
						<li><a href="logout.php">Signout</a></li>
						<div class="clearfix"></div>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<br>
		<div class="container d-flex justify-content-center align-items-center ">
			<div class="w-400 shadow p-4 rounded">
				<a href="chat_real.php" class="fs-4 link-dark">&#8592;</a>

				<div class="d-flex align-items-center">
					<img src="uploads/<?= $chatWith['p_p'] ?>" class="w-15 rounded-circle">

					<h3 class="display-4 fs-sm m-2">
						<?= $chatWith['name'] ?> <br>
						<div class="d-flex
								 align-items-center" title="online">
							<?php
							if (last_seen($chatWith['last_seen']) == "Active") {
								?>
								<div class="online"></div>
								<small class="d-block p-1">Online</small>
							<?php } else { ?>
								<small class="d-block p-1">
									Last seen:
									<?= last_seen($chatWith['last_seen']) ?>
								</small>
							<?php } ?>
						</div>
					</h3>
				</div>

				<div class="shadow p-4 rounded
					   d-flex flex-column
					   mt-2 chat-box" id="chatBox">
					<?php
					if (!empty($chats)) {
						foreach ($chats as $chat) {
							if ($chat['from_id'] == $_SESSION['user_id']) { ?>
								<p class="rtext align-self-end
								border rounded p-2 mb-1">
									<?= $chat['message'] ?>
									<small class="d-block">
										<?= $chat['created_at'] ?>
									</small>
								</p>
							<?php } else { ?>
								<p class="ltext border 
							 rounded p-2 mb-1">
									<?= $chat['message'] ?>
									<small class="d-block">
										<?= $chat['created_at'] ?>
									</small>
								</p>
							<?php }
						}
					} else { ?>
						<div class="alert alert-info 
								text-center">
							<i class="fa fa-comments d-block fs-big"></i>
							No messages yet, Start the conversation
						</div>
					<?php } ?>
				</div>
				<div class="input-group mb-3">
					<textarea cols="3" id="message" class="form-control"></textarea>
					<button class="btn btn-primary" id="sendBtn">
						<i class="fa fa-paper-plane"></i>
					</button>
				</div>

			</div>


			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

			<script>
				var scrollDown = function () {
					let chatBox = document.getElementById('chatBox');
					chatBox.scrollTop = chatBox.scrollHeight;
				}

				scrollDown();

				$(document).ready(function () {

					$("#sendBtn").on('click', function () {
						message = $("#message").val();
						if (message == "") return;

						$.post("app/ajax/insert.php",
							{
								message: message,
								to_id: <?= $chatWith['user_id'] ?>
							},
							function (data, status) {
								$("#message").val("");
								$("#chatBox").append(data);
								scrollDown();
							});
					});

					/** 
					auto update last seen 
					for logged in user
					**/
					let lastSeenUpdate = function () {
						$.get("app/ajax/update_last_seen.php");
					}
					lastSeenUpdate();
					/** 
					auto update last seen 
					every 10 sec
					**/
					setInterval(lastSeenUpdate, 10000);



					// auto refresh / reload
					let fechData = function () {
						$.post("app/ajax/getMessage.php",
							{
								id_2: <?= $chatWith['user_id'] ?>
							},
							function (data, status) {
								$("#chatBox").append(data);
								if (data != "") scrollDown();
							});
					}

					fechData();
					/** 
					auto update last seen 
					every 0.5 sec
					**/
					setInterval(fechData, 500);

				});
			</script>
		</div>
	</body>

	</html>
	<?php
} else {
	header("Location: index.php");
	exit;
}
?>