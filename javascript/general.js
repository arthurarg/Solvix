
$(document).ready(function(){
   $("nav .montant").hide();
   $("nav #libelle").hide();
   $("nav #valider").hide();
   
   $("nav #receveur").change(function(){
       
       if($("nav #receveur").val()!=-1){
                $("nav .montant").show();
                $("nav #libelle").show();
                $("nav #valider").show();
       }
       else{
           $("nav .montant").hide();
            $("nav #libelle").hide();
            $("nav #valider").hide();
       }
   });
   
   $("#flash").click(function(){
       $("#flash").hide();
   });
   
   $(".confirmation").click(function(){
       var choice=confirm("Etes-vous sur ?");
       if(choice==true)
           location.replace('index.php?page=relationships&action=destroy&id='+$(".confirmation").attr("value"));
   });
   
   
   //$("#menu_alerts").click($("#alerts").toggle());
   
   $("#alerts").toggle();
    $("#menu_alerts").click(function(){
        $("#alerts").slideToggle("fast");
    });
$("#alerts").hide();
});


