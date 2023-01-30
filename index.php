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
    <form>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required minlength="2" maxlength="255">
        <br>
        <label for="firstname">Firstname:</label>
        <input type="text" id="firstname" name="firstname" required minlength="2" maxlength="255">
        <br>
        <label for="email">Email Address:</label>
        <input type="email" id="email" name="email" required minlength="2" maxlength="255">
        <br>
        <label for="comment">Comment:</label>
        <textarea id="comment" name="comment" required minlength="2" maxlength="1000"></textarea>
        <br>
        <input type="submit" value="Submit">
    </form>

</body>

</html>