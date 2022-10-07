<?php

if ( isset($_POST['submit']) ) {

    # grabbing the data from form
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
   
    # instantiate SignupContr class
    include '../includes/autoLoader.inc.php';
    $login = new LoginContr( $uid, $pwd );

    # running error handlers and user signup
    $login->loginUser();

    # going back to front page
    header('location: ../index.php?error=none');
    
}