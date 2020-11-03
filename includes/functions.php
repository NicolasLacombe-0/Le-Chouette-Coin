<?php

require 'includes/config.php';
function inscription($email, $username, $password1, $password2)
{
    global $conn;

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
                    echo '<div class="alert alert-success mt-2">Votre compte a été enregistré, vous pouvez maintenant vous connecter !</div>';
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

function login($email_login, $password_login)
{
    global $conn;

    try {
        $sql = "SELECT * FROM users WHERE email = '{$email_login}'";
        $res = $conn->query($sql);
        $user = $res->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $db_password = $user['password'];
            if (password_verify($password_login, $db_password)) {
                $_SESSION['email'] = $user['email'];
                $_SESSION['id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                //echo 'Bienvenue, '.$_SESSION['username'].' !';
                header('Location: index.php');
            } else {
                echo '<div>Mot de passe incorrecte</div>';
                unset($_POST);
            }
        } else {
            echo 'Email incorrecte';
            unset($_POST);
        }
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
}

function affichage()
{
    global $conn;
    $sth = $conn->prepare('SELECT * FROM users');
    $sth->execute();
    $users = $sth->fetchAll(PDO::FETCH_ASSOC);
    foreach ($users as $user) { ?>
<tr>
    <th scope="row">
        <?php echo $user['id']; ?>
    </th>
    <td>
        <?php echo $user['email']; ?>
    </td>
    <td>
        <?php echo $user['username']; ?>
    </td>
    <td>
        <?php echo $user['password']; ?>
    </td>
</tr>
<?php
    }
}
