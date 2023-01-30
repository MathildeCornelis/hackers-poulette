<?php
if (isset($_POST['name']) && isset($_POST['firstname']) && isset($_POST['email']) && isset($_POST['comment'])) {
    $name = $_POST['name'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <textarea id="comment" name="comment" required minlength="1" maxlength="1000"></textarea>
        <br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>

</html>