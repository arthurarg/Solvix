<div class='faire_operation'>
    <a href='index.php?page=operations&action=newz'> Recharger de l'argent </a>
    <a href='index.php?page=operations&action=new'> Retirer de l'argent </a>
    <form class='formulaire_deal' action="index.php?page=operations&action=create" method="post">
        <p>Bénéficiaire : 
            <select name="receveur">
                <?php foreach ($tabamis as $ami) { echo('<option value=' . $ami->id . '> ' . $ami->prenom . ' '. $ami->nom); } ?>
            </select>
        </p>
        <p>Montant : <input type="text" name="montant" /></p>
        <p>Libellé : <input type="libelle" name="libelle" /></p>
        <p><input type="submit" value="Verser l'argent"></p>
    </form>
</div>

