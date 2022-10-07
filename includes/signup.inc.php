<?php

if ( isset($_POST['submit']) ) {

    # grabbing the data from form
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];
    $pwdrepeat = $_POST['pwdrepeat'];
    $email = $_POST['email'];


    # instantiate SignupContr class
    include '../includes/autoLoader.inc.php';
    $signup = new SignupContr( $uid, $pwd, $pwdrepeat, $email );

    # running error handlers and user signup
    $signup->signupUser();

    # going back to front page
    header('location: ../index.php?error=none');
}
