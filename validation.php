<?php
session_start();
function clearing_input(string $input): string
{
	return htmlspecialchars(stripslashes(trim($input)));
}

function login(): void
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
	if (strlen($password) < 8) {
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
	} catch (PDOException $e) {
		echo json_encode([
			'success' => FALSE,
			'message' => $e->getMessage(),
			'status' => 200
		]);
		exit();
	}
	$stmt = $conn->prepare("SELECT username, password, access FROM users WHERE username='$username' AND password='$password'");
	$stmt->execute();
	$result = $stmt->fetchAll(pdo::FETCH_ASSOC);
	if (count($result) !== 1) {
		echo json_encode([
			'success' => FALSE,
			"message" => "invalid username or password",
			'status' => 200
		]);
		exit();
	}
	$access = $result[0]['access'];
	echo json_encode([
		'success' => TRUE,
		"message" => "login success",
		'status' => 200,
		'access' => $access
	]);
	$conn = NULL;
	$_SESSION['loggedin'] = TRUE;
	$_SESSION['access'] = $access;
	$_SESSION['username'] = $username;
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