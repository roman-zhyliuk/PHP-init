<?php

session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit;
}

$errors = [];
$email = $password = '';

$mysqli = new mysqli('localhost', 'root', '', 'php_demo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        
        $stmt = "SELECT * FROM users WHERE email = ?";
        $result = $mysqli->execute_query($stmt, [$email]);

        if ($result && $result->num_rows > 0) {
            $res = $result->fetch_assoc();
            if (password_verify($password, $res['password'])) {
                // Login successfull
                $_SESSION['user_id'] = $res['id'];
                $_SESSION['username'] = $res['username'];

                if (!empty($_POST['remember_me'])) {
                    $cookie_value = $res['id'].'|'.$res['username'];
                    setcookie('remember_me', $cookie_value, time() + (86400 * 30), '/');
                }

                header("Location: dashboard.php");
                exit;
            } else {
                $errors['password'] = 'Wrong email or password';
            }
        } else {
            $errors['password'] = 'Wrong email or password';
        }
    } else {
        $errors['email'] = 'Please fill out both fields';
    }
}

function test_input($data) {
    $data  = trim($data);
    $data = stripcslashes($data);
    return htmlspecialchars($data);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login</title>
</head>
<body>
    <form name="login" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo (array_key_exists('email', $errors) ? $errors['email'] : ''); ?></span><br>
    
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>">
        <span class="error"><?php echo (array_key_exists('password', $errors) ? $errors['password'] : '') ?></span><br>

        <button type='submit'>Login</button><br>
        <span class="error"><?php echo (array_key_exists('success', $errors) ? $errors['success'] : ''); ?></span><br>

        <button type='button' onclick="location.href='logout.php'">Logout</button><br>    
    </form>
</body>
</html>