<?php
if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['comment'])) {
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $valid = true;

    if (empty($name) || strlen($name) < 2) {
        $valid = false;
        echo 'The name must be more than 2 characters long.<br>';
    }

    if (empty($firstname) || strlen($firstname) < 2) {
        $valid = false;
        echo 'The firstname must be more than 2 characters long.<br>';
    }

    if (empty($comment) || strlen($comment) < 250) {
        $valid = false;
        echo 'The comment must be between 250 and 1000 characters long.<br>';
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $valid = false;
        echo 'The email is not valid.';
    }

    if ($valid) {
        try {
            $db = new PDO('mysql:host=localhost;dbname=hackers_poulette;charset=utf8', 'root', '');

            $insertValue = "INSERT INTO form (name, firstname, email, comment) VALUES (?, ?, ?, ?)";

            $insert = $db->prepare($insertValue);

            $insert->execute([$name, $firstname, $email, $comment]);
        } catch (\Throwable $th) {
            echo 'error' . $th->getMessage();
        }

        header("location: index.php");
    }
}

if (isset($_POST['submit'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $secret = "6Lebcj4kAAAAAE-W2JVaT5XaoqZMIaCx0pdzDEEB";
    $verify = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$captcha}");
    $response = json_decode($verify);
    if (!$response->success) {
        echo "CAPTCHA verification failed.";
        return;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Hackers Poulette Form</title>
</head>

<body>
    <h1>Contactez nous</h1>
    <form method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required minlength="2" maxlength="255" placeholder="ex. Doe">
        <br>
        <label for="firstname">Firstname:</label>
        <input type="text" id="firstname" name="firstname" required minlength="2" maxlength="255" placeholder="ex. John">
        <br>
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required minlength="2" maxlength="255" placeholder="ex. john.doe@example.com">
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" minlength="250" maxlength="1000" required></textarea>
        <br>
        <div class="g-recaptcha" data-sitekey="6Lebcj4kAAAAAIcHObIdIlgSgvHkNTQZkaCGP8NF">
        </div>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>