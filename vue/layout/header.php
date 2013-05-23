<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" type="text/css" />
        </head>
    <body>
        <div class='header'>
            <div id='logo'> <p>Logo</p> </div>
            <?php if (isset($_SESSION['id'])) { ?>
            <div class='welcome'> <p> Welcome <?php echo ($_SESSION['prenom']. ' ' . $_SESSION['nom']);?> </p></div>
            <ul>
                <li> <a href='index.php'> Accueil</a> </li>
                <li> <a href='index.php?page=users&action=show'>Mon profil</a> </li>
                <li> <a href='index.php?page=operation&action=new'>Recharge</a> </li>
                <li> <a href='index.php?page=sessions&action=destroy'>Se deconnecter</a></li>
            </ul>
            <?php } ?>
        </div>
        <article>
        