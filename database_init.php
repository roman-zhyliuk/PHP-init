<?php 

$host = 'localhost';
$dbname = 'php_demo';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected succesfully <br>";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

try {
    $stmt = $pdo->query("SELECT * FROM users");

    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($users as $user) {
        echo "ID: " . $user['id'] . ", Username: " . $user['username'] . ", Email: " . $user['email'] . "<br>";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $username_p = 'john_doe';
    $email_p = 'john@example.com';
    $password_p = password_hash('password123', PASSWORD_DEFAULT);

    $stmt1 = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt1->execute([$username, $email, $password]);
    echo "New record created successfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $username_new = "new_username";
    $email_new = 'new_email@example.com';
    $id = 2;

    $stmt2 = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
    $stmt2->execute([$username, $email, $id]);
    echo "Record updated succesfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

try {
    $id = 3;

    $stmt3 = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt3->execute([$id]);
    echo "Record deleted succesfully";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

?>