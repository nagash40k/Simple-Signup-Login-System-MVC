<?php

class Login extends Dbh {

    protected function getUser($uid, $pwd){
        $sql = 'SELECT 
                    `users_pwd` 
                FROM 
                    `users` 
                WHERE 
                    `users_uid` = ?
                OR
                    `users_email` = ?
        ;';
        $stmt = $this->connect()->prepare($sql);

        

        if ( !$stmt->execute([$uid, $pwd]) ){
            $stmt = NULL;
            header("location: ../index.php?error=stmtfailed");
            exit();
        } 

        if ($stmt->rowCount() == 0 ) {
            $stmt = NULL;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $pwdHashed = $stmt->fetchAll();

        $checkPwd = password_verify($pwd, $pwdHashed[0]['users_pwd']);


        if (  $checkPwd == false ) {

            $stmt = NULL;
            header("location: ../index.php?error=usernotfound");
            exit();

        } elseif ( $checkPwd == true ) {

            $sql = 'SELECT 
                    * 
                FROM 
                    `users` 
                WHERE 
                        `users_uid` = ?
                    OR
                        `users_email` = ?
                    AND
                        `users_pwd` = ?

            ;';
            $stmt = $this->connect()->prepare($sql);

            if ( !$stmt->execute([$uid, $uid, $pwd]) ){
                $stmt = NULL;
                header("location: ../index.php?error=stmtfailed");
                exit();
            } 

            if ($stmt->rowCount() == 0 ) {
                $stmt = NULL;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user = $stmt->fetchAll();

            session_start();
            $_SESSION["userid"] = $user[0]['users_id'];
            $_SESSION["uid"] = $user[0]['users_uid'];

            $stmt = NULL;

        }

        $stmt = NULL;

    }


}