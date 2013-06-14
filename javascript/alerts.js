/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
    
    init();
});

    function init(){    
        $(".close").click(function(){
            $.post("controleur/alerts.php?action=print&id="+$(this).attr("id"),'', function(rep){
                $("#alerts").html(rep);
                init();
            });
        });
    }