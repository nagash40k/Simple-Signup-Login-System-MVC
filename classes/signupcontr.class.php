<?php

class SignupContr extends Signup {

    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    public function __construct( $uid, $pwd, $pwdrepeat, $email ){

        $this->uid = $uid;
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;
        
    }

    public function signupUser(){
        if ( $this->emptyInput() == false ){
            # Empty input
            header("location: ../index.php?error=emptyinput");
            exit();
        }

        if ( $this->invalidUid() == false ){
            # Invalid Uid
            header("location: ../index.php?error=invaliduid");
            exit();
        }

        if ( $this->invalidEmail() == false ){
            # Invalid E-Mail adress
            header("location: ../index.php?error=invalidemail");
            exit();
        }

        if ( $this->pwdMatch() == false ){
            # Password doesn't match
            header("location: ../index.php?error=passwordmatch");
            exit();
        }

        if ( $this->uidTakenCheck() == false ){
            # Username or Email Taken
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }
        
        $this->setUser($this->uid, $this->pwd, $this->email);
    }











    # wszelkie sprawdzanie błędów
    # empty input i uidtaken można rozbić na poszczegółne testy aby podświetlić czego dokładnie brakuje 
    # albo co jest zajęte
    private function errorHandling(){   }


    private function emptyInput(){
        $result = NULL;
        if ( empty($this->uid) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email) ){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUid(){
        $result = NULL;
        # sprawdzanie czy username zawiera tylko dozwolone znaki alfanumeryczne
        if ( !preg_match("/^[a-zA-z0-9]*$/", $this->uid) ){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result = NULL;
        # sprawdzanie czy wpisano poprawny email, funkcja ma różne flagi 
        if ( !filter_var($this->email, FILTER_VALIDATE_EMAIL) ){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result = NULL;
        if ( $this->pwd !== $this->pwdrepeat ){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result = NULL;
        if ( !$this->checkUser($this->uid, $this->email) ){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

}