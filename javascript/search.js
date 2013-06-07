/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready( function() {
    
    var content=$("article").html();
    
    $("#barre_recherche").keyup( function(){
        
        $.post("index.php?page=users&action=search&type=dynamic",$("#form_search").serialize(), function(rep){
            
            if($("#barre_recherche").val()==""){
                $("article").c.html(content);
            }else{
                $("article").html(rep);
            }
                
        });
        
    });
});