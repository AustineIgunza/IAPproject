<?php
require 'LoadingClass.php';

$layout = new Layouts();

echo $layout->header($conf);
?>

<h2>Sign Up</h2>
<form method="post" action="process_signup.php">
    <label for="name">Name:</label>
    <input type="text" name="name" required><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br><br>

    <button type="submit">Register</button>
</form>

<?php
echo $layout->footer($conf);
