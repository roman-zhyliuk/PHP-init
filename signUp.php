<?php

$errors = [];
$username = '';
$email = '';
$password = '';
$password_repeat = '';

$host = 'localhost';
$dbname = 'php_demo';
$username_db = 'root';
$password_db = '';

$mysqli = new mysqli($host, $username_db, $password_db, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['username'])) {
        $username = test_input($_POST['username']);
        if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
            $errors['username'] = "Only letter and white space allowed";
        } else {
            $stmt = "SELECT username FROM users WHERE username = ?";
            $result = $mysqli->execute_query($stmt, [$username]);
            foreach ($result as $res) {
                if ($username == implode('', $res)) {
                    $errors['username'] = 'User with this username has been already registered, create other username';
                }
            }
        }
    } else {
        $errors['username'] = 'Username is required';
    }

    if (!empty($_POST['email'])) {
        $email = test_input($_POST['email']);
        if (filter_var('email', FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        } else {
            $stmt2 = "SELECT email FROM users WHERE email = ?";
            $result2 = $mysqli->execute_query($stmt2, [$email]);
            foreach ($result2 as $res) {
                if ($email == implode('', $res)) {
                    $errors['email'] = 'User with this email has been already registered, use other email or <a href="">log in</a> to your account';
                }
            }
        }
    } else {
        $errors['email'] = 'Email is required';
    }

    if (!empty($_POST['password']) && !empty($_POST['password_repeat'])) {
        $password = test_input($_POST['password']);
        $password_repeat = test_input($_POST['password_repeat']);
        if ($password !== $password_repeat) {
            $errors['password_repeat'] = 'Passwords are not matching';
        } else {
            test_password($password);
        }
    } else {
        $errors['password'] = 'Password is required';
    }

    if (empty($errors)) {

        $password = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt1 = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $result1 = $mysqli->execute_query($stmt1, [$username, $email, $password]);
        $errors['success'] = "User created successfully";
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    return htmlspecialchars($data);
}

function test_password($pass_test) {
    if (strlen($pass_test) < 8 || !preg_match('`[0-9]+`', $pass_test) || !preg_match('[@_!#$%^&*()<>?/|}{~:]', $pass_test)) {
        $errors['password'] = 'Password must contain 8 or more characters with a mix of letters, numbers & symbols';
        return false;
    } else {
        return true;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User registration</title>
</head>
<body>
    <form name="registration" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $username; ?>">
        <span class="error"><?php echo (array_key_exists('username', $errors) ? $errors['username'] : ''); ?></span><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo (array_key_exists('email', $errors) ? $errors['email'] : ''); ?></span><br>
    
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" value="<?php echo $password; ?>">
        <span class="error"><?php echo (array_key_exists('password', $errors) ? $errors['password'] : '') ?></span><br>

        <label for="password_repeat">Repeat password:</label>
        <input type="password" name="password_repeat" id="password_repeat" value="<?php echo $password_repeat; ?>">
        <span class="error"><?php echo (array_key_exists('password_repeat', $errors) ? $errors['password_repeat'] : '') ?></span><br>

        <button type='submit'>Sign up</button><br>
        <span class="error"><?php echo (array_key_exists('success', $errors) ? $errors['success'] : ''); ?></span>
    </form>
</body>
</html>