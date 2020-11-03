1 creer une page d'accueil avec lien vers spage de connexion
2 creer une connexion à la base de données (avec PDO) dans un config.php dans le
dossier includes, qui contient tous les fichiers qui seront inclus sur des pages
3 creer une base de données qui représente la structure de notre projet
4 creer un formulaire pour l'inscription des utilisateurs qui reprend les informations
de connexion
-> ne pas oublier l'action et la méthode du POST du formulaire
-> ne pas oublier les name sur les inputs (pour les appeler)
-> rajouter des verifications en front
5 récuperer les données du formulaire en prenant soin de les sécuriser
->htmlspecialchars sur nos variables POST (ou strip_tags)
6 creer une logique pour l'ajout d'utilisateur dans la base de données
-> un utilisateur doit forcément posséder password & username & email (avec !empty)
-> il ne peut pas avoir le même username ou email que quelqu'un d'autre (!$count)
-> l'utilisateur doit vérifier son mot de passe (pas1===pas2)
-> le mdp DOIT TOUJOURS ETRE CRYPTE DANS LA BASE DE DONNEE (RGPD 2018) 
    avec ($mdp=password_hash($mdp,PASSWORD_DEFAULT)) (md5/sha1 à éviter)
-> creer une requete d'insertion de la requete en PDO avec des marqueurs nommés (bindValues)
7 Factoriser le conde en créant une fonction qui réalise l'ajout d'utilisateurs dans un functions.php à partir de variables