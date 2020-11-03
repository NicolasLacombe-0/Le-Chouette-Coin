<?php

require 'includes/config.php';
function inscription($email, $username, $password1, $password2, $conn)
{
    try {
        $sql1 = "SELECT * FROM users WHERE email = '{$email}'";
        $sql2 = "SELECT * FROM users WHERE username = '{$username}'";
        $res1 = $conn->query($sql1);
        $count_email = $res1->fetchColumn();
        if (!$count_email) {
            $res2 = $conn->query($sql2);
            $count_username = $res2->fetchColumn();
            if (!$count_username) {
                if ($password1 === $password2) {
                    $password = password_hash($password1, PASSWORD_DEFAULT);
                    $sth = $conn->prepare('INSERT INTO users (email,username,password) VALUES (:email,:username,:password)');
                    $sth->bindValue(':email', $email);
                    $sth->bindValue(':username', $username);
                    $sth->bindValue(':password', $password);
                    $sth->execute();
                } else {
                    echo 'Les mots de passe ne concordent pas.';
                }
            } elseif ($count_username > 0) {
                echo 'Ce nom d\'utilisateur est déjà pris';
            }
        } elseif ($count_email > 0) {
            echo 'Cette adresse mail est déjà utilisée';
        }
    } catch (PDOException $e) {
        echo'Error'.$e->getMessage();
    }
}

function login($email_login, $password_login, $conn)
{
    $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
    $res = $conn->query($sql);
    $user = $res->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $db_pass = $user['password'];
        if (password_verify($password_login, $db_pass)) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            header('Location:index.php');
        } else {
            echo '<div>Mot de pass incorrecte</div>';
        }
    } else {
        echo 'L\'utilisateur n\'existe pas';
    }
}
