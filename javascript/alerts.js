/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    init();
});

    function init(){    
        $(".alerts_item").click(function(){
            $.post("index.php?page=alerts&da="+$(this).attr("id"),'', function(rep){
                $("#alerts_list").html(rep);
                if(rep==""){
                    $("#image_alert").attr("src","images/no_alert.png");
                }
                
                init();
            });
        });
    }