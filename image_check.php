<?php

$uploadOk = true;
$targetDir = 'uploads/'; // Remove leading slash
$targetFile = $targetDir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$messages = [];

if (isset($_POST['submit'])) {
    echo "Form submitted"; // Debugging statement

    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check !== false) {
        $messages['success'] = "File is an image - " . $check["mime"] . ".";
        $uploadOk = true;
    } else {
        $messages['notImage'] = 'File is not an image';
        $uploadOk = false;
    }

    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $messages['tooLargeFile'] = "Sorry, your file is too large.";
        $uploadOk = false;
    }

    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        $messages['wrongExtension'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = false;
    }

    if ($uploadOk === false) {
        $messages['error'] = "Sorry, your file was not uploaded.";
    } else {
        // if everything is ok, try to upload file
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            $messages['fileUploaded'] = "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            $messages['error'] = "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image validation</title>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <button type="submit" name="submit">Upload</button>
    <span class="message">
            <?php
            if (!empty($messages)) {
                foreach ($messages as $key => $value) {
                    echo $value . "<br>";
                }
            }
            ?>
        </span>
</form>
</body>
</html>
