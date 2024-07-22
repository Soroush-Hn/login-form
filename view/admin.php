<body>
<?php

echo "<table style='border: solid 1px black;'>";
echo "<tr><th>User-id</th><th>Username</th><th>Passwrod</th><th>Email</th><th>Access</th></tr>";

class TableRows extends RecursiveIteratorIterator {
	function __construct($it) {
		parent::__construct($it, self::LEAVES_ONLY);
	}

	function current(): string
	{
		return "<td style='width:150px;border:1px solid black;'>" . parent::current(). "</td>";
	}

	function beginChildren(): void
	{
		echo "<tr>";
	}

	function endChildren():void {
		echo "</tr>" . "\n";
	}
}
global $sql;
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mydb";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$stmt = $conn->prepare("SELECT * FROM `users`");
	$stmt->execute();
	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
	foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
		echo $v;
	}
} catch(PDOException $e) {
	echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>
</body>