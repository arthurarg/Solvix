/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    init();
    
    $(".choix").click(function(){
       var choice=confirm("Etes-vous sur ?");
       if(choice==true){
           
           location.replace($(this).attr("value")+"&da="+$(this).parent().parent().attr('id'));
       }
           
   });
});

    function init(){    
        $(".alerts_item_close").click(function(){
            $.post("index.php?page=alerts&da="+$(this).attr("id"),'', function(rep){
                $("#alerts_list").html(rep);
                if(rep==""){
                    $("#image_alert").attr("src","images/no_alert.png");
                }
                
                init();
            });
        });
    }