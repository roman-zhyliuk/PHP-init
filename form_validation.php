<?php
$name = $email = '';
$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!empty($_POST['name'])) {
        $name = test_input($_POST["name"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $errors['name'] = "Only letters and white space allowed";
        }
    } else {
        $errors['name'] = 'Name is required';
    }

    if (!empty($_POST['email'])) {
        $email = test_input($_POST['name']);
        if (filter_var('email', FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }
    } else {
        $errors['email'] = 'Email is required';
    }
    if (empty($errors)) {
        $errors['success'] = 'Form is successfully validated';
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripcslashes($data);
    return htmlspecialchars($data);
}
{

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form validation</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>">
    <span class="error"><?php echo (array_key_exists('name', $errors) ? $errors['name'] : ''); ?></span><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>">
    <span class="error"><?php echo (array_key_exists('email', $errors) ? $errors['email'] : ''); ?></span><br>

    <button type="submit">Submit</button> <br>
    <span class="error"><?php echo (array_key_exists('success', $errors) ? $errors['success'] : ''); ?></span>
</form>
</body>
</html>