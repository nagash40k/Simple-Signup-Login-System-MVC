<?php

session_start();

include 'includes/autoLoader.inc.php';


if ( isset($_SESSION['userid']) ) {
    echo 'Zalogowanio ' . $_SESSION['userid'] . ' ' . $_SESSION['uid'];
    echo '<br/>';
    echo '<a href="includes/logout.inc.php">LOGOUT</a>';
}

?>


<?php 
    if ( !isset($_SESSION['userid']) )
    {
?>
    <h1>Login</h1>
    <form action="includes/login.inc.php" method="POST">
        <input type="text" name="uid" placeholder="Username">
        <br/>
        <input type="password" name="pwd" placeholder="Password">
        <br/>
        <button type="submit" name="submit">Login</button>
    </form>

    <h1>Signup</h1>
    <form action="includes/signup.inc.php" method="POST">
        <input type="text" name="uid" placeholder="Username">
        <br/>
        <input type="password" name="pwd" placeholder="Password">
        <br/>
        <input type="password" name="pwdrepeat" placeholder="Repeat Password">
        <br/>
        <input type="text" name="email" placeholder="E-Mail">
        <br/>
        <button type="submit" name="submit">Sign Up</button>
    </form>
<?php
    }
?>
