<?php



if (!isset($_GET['action'])) {
    header("Location: index.php");
}

switch ($_GET['action']) {
    case 'create':
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $id = User::verifierMotDePasse($_POST['email'],$_POST['password']);
            if ($id != null) {
                $_SESSION['id'] = $id; 
                User::maj();
            }
        }
 
        header('Location: index.php');
        return;
    
    case 'destroy':
        session_destroy();
        header('Location: index.php');
        return;
}

?>