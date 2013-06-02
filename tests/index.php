<form class="searchForm" action="/recherche/" method="get">
<input type="submit" value=""/>
<input type="search" placeholder="Recherche" name="q" value=""/>
</form>
<?php
if(mail("arthur.argenson@gmail.com", "test_php", "test_php"))
        echo "check";
else echo "merde";
mail("arthur.argenson@gmail.com", "test2_php", "test2_php");
?>