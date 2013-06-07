
$(document).ready(function(){
   $("nav .montant").hide();
   $("nav #libelle").hide();
   $("nav #valider").hide();
   
   $("nav #receveur").click() (function(){
                $("nav .montant").show();
                $("nav #libelle").show();
                $("nav #valider").show();
   });
   
});


