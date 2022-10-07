<?php

class Signup extends Dbh {

    protected function checkUser( $uid, $email ){
        $sql = 'SELECT  
                    `users_uid`
                FROM 
                    `users` 
                WHERE 
                    `users_uid` = ? 
                OR
                    `users_email` = ?
                ;';
        $stmt = $this->connect()->prepare($sql);

        if ( !$stmt->execute([$uid, $email]) ){
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        } 
        
        $resultCheck = NULL;
        if ( $stmt->rowCount() > 0 ){
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }





    protected function setUser($uid, $pwd, $email):void{
        $sql = 'INSERT INTO `users` 
                    (`users_uid`, `users_pwd`, `users_email`)
                VALUES
                    (?, ?, ?)
        ;';
        $stmt = $this->connect()->prepare($sql);

        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        if ( !$stmt->execute([$uid, $hashedPwd, $email]) ){
        $stmt = NULL;
        header("location: ../index.php?error=setuserfailed");
        exit();
        } 

        $stmt = NULL;

    }


}