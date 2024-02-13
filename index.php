<?php

$errors = [];
$email = $password = '';

$mysqli = new mysqli('localhost', 'root', '', 'php_demo');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = test_input($_POST['email']);
        $password = test_input($_POST['password']);
        
        $stmt = "SELECT email, password FROM users WHERE email = ?";
        $result = $mysqli->execute_query($stmt, [$email]);
        foreach ($result as $res) {
            if ($res['email'] != $email || !password_verify($password, $res['password'])) {
                $errors['password'] = 'Wrong email or password';
            } 
        }

    } else {
        $errors['email'] = 'Please fill out both fields';
    }

    if (empty($errors)) {
        $errors['success'] = 'Logged in successfully';
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

        <button type='submit'>Sign up</button><br>
        <span class="error"><?php echo (array_key_exists('success', $errors) ? $errors['success'] : ''); ?></span>
    </form>
</body>
</html>