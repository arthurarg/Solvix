$(document).ready(function(){
    $(".admin-lock").click(function() {
        $.ajax({
                    method : "POST",
                    url : "lock.php",
                    data : {bol: $(this).attr('value'), id : $(this).attr('id')}
        });
        if ($(this).attr('value')==='1') {
            $(this).html('Déverrouillez');
            $(this).attr('value','0');
        }
        else {
            $(this).html('Verrouillez'); 
            $(this).attr('value','1');
        }
    });
    
    $(".admin-del").click(function() {
        $.ajax({
                    method : "POST",
                    url : "del.php",
                    data : {id1: $('#'+$(this).attr('value') + ' .emetteur').attr('value'),
                            id2: $('#'+$(this).attr('value') + ' .receveur').attr('value'),
                            montant: $('#'+$(this).attr('value') + ' .montant').attr('value')},
                    success : function(data) {$var = data;},
                    async: false
        });
        if (confirm($var + " Etes-vous sur ?")) {
            $.ajax({
                        method : "POST" ,
                        url : "del.php",
                        data : {id: $(this).attr('value')},
            });
            $('#'+$(this).attr('value')).hide();
            }                    
        });

});
