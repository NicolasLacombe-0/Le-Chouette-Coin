<?php
$title = 'Identification - Le Chouette coin';
require 'includes/header.php';
require 'includes/navbar.php';

//var_dump($_POST);
if (isset($_POST['submit_signup']) && !empty($_POST['email_signup']) && !empty($_POST['password1_signup']) && !empty($_POST['username_signup'])) {
    $email = htmlspecialchars($_POST['email_signup']);
    $password1 = htmlspecialchars($_POST['password1_signup']);
    $password2 = htmlspecialchars($_POST['password2_signup']);
    $username = htmlspecialchars($_POST['username_signup']);

    if (inscription($email, $username, $password1, $password2)) {
        echo 'Votre compte a bien été créé !';
    }
} elseif (isset($_POST['submit_login']) && !empty($_POST['email_login']) && !empty($_POST['password_login'])) {
    $email_login = strip_tags($_POST['email_login']);
    $password_login = strip_tags($_POST['password_login']);

    login($email_login, $password_login);
} elseif (isset($_POST)) {
    unset($_POST);
}
?>
<div class="row">
    <div class="col-6">
        <form
            action="<?php $_SERVER['REQUEST_URI']; ?>"
            method="POST">
            <div class="form-group">
                <label for="InputEmail1">Adresse mail</label>
                <input name="email_signup" type="email" class="form-control" id="InputEmail1"
                    aria-describedby="emailHelp" required>
                <small id="emailHelp" class="form-text text-muted">Nous ne partagerons jamais votre email.</small>
            </div>

            <div class="form-group">
                <label for="InputUsername1">Nom d'utilisateur</label>
                <input name="username_signup" type="text" class="form-control" id="InputUsername1" required>
                <small id="usernameHelp" class="form-text text-muted">Choisissez un nom d'utilisateur, il doit être
                    unique.</small>
            </div>

            <div class="form-group">
                <label for="InputPassword1">Mot de passe</label>
                <input name="password1_signup" type="password" class="form-control" id="InputPassword1" required>
            </div>

            <div class="form-group">
                <label for="InputPassword2">Re-entrez votre mot de passe</label>
                <input name="password2_signup" type="password" class="form-control" id="InputPassword2" required>
            </div>

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="Check1" required>
                <label class="form-check-label" for="Check1">
                    Accepter les <a href="#">termes et conditions</a></label>
            </div>

            <button name="submit_signup" type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
    </div>


    <div class="col-6">
        <form
            action="<?php $_SERVER['REQUEST_URI']; ?>"
            method="POST">
            <div class="form-group">
                <label for="InputEmail2">Adresse mail</label>
                <input name="email_login" type="email" class="form-control" id="InputEmail2" required>
            </div>

            <div class="form-group">
                <label for="InputPassword">Mot de passe</label>
                <input name="password_login" type="password" class="form-control" id="InputPassword" required>
            </div>

            <button name="submit_login" type="submit" class="btn btn-success">Se connecter</button>
        </form>
        </form>
    </div>
</div>




<?php
require 'includes/footer.php';
