<?php
function clearing_input(string $input): string
{
	return htmlspecialchars(stripslashes(trim($input)));
}
function login():void
{
	if (empty($_POST['username']) || empty($_POST['password'])) {
		echo json_encode([
			'success' => FALSE,
			'message' => "username or password is empty",
			'status' => 200
		]);
		exit();
	}
	$username = clearing_input($_POST['username']);
	$password = clearing_input($_POST['password']);
	if (!preg_match("/^[a-zA-Z0-9_]*$/", $username)) {
		echo json_encode([
			'success' => FALSE,
			'message' => "Only alphabets, numbers, and underscores are allowed for User Name",
			'status' => 200
		]);
		exit();
	}
	if (strlen($password) < 8){
		echo json_encode([
			'success' => FALSE,
			'message' => "password should be at least 8 character",
			'status' => 200
		]);
		exit();
	}
	global $sql;
	$servername = "localhost";
	$dbUserName = "root";
	$dbPassword = "";
	$dbname = "mydb";

	try {
		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbUserName, $dbPassword);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT username, password FROM users WHERE username='$username' AND password='$password'");
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
		if (count($stmt->fetchAll()) === 1){
			echo json_encode([
				'success' => TRUE,
				"message" => "login success",
				'status' => 200
			]);
			exit();
		}
		echo json_encode([
			'success' => FALSE,
			"message" => "invalid username or password",
			'status' => 200
		]);
		exit();
	} catch(PDOException $e) {
		echo json_encode([
			'success' => FALSE,
			'message' => $e->getMessage(),
			'status' => 200
		]);
		exit();
	}
	$conn = null;
}

if (!empty($_POST['action']) && function_exists($_POST['action'])) {
	if ($_POST['action'] == 'login') {
		login();
	}
} else {
	echo json_encode([
		'success' => FALSE,
		'message' => "An error has occurred",
		'status' => 404
	]);
}