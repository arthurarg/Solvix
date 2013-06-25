$(document).ready(function() {
    
    
// -- Gestion update profil -- //
    $(".formulaire_edition .intitule").hide();
    $(".formulaire_edition .password").hide();
    $(".formulaire_edition .new_password").hide();
    $(".formulaire_edition .new_confirmation").hide();
    $(".formulaire_edition .email").hide();
    $(".formulaire_edition .iban").hide();
    $(".formulaire_edition #submit").hide();

    
    $(".infos_personnelles .modifier_password").click(function() {   
        $(".formulaire_edition .intitule").show();        
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").show();
        $(".formulaire_edition .new_confirmation").show();
        $(".formulaire_edition .email").hide();
        $(".formulaire_edition .iban").hide();
        $(".formulaire_edition #submit").show();
    });
    
    $(".infos_personnelles .modifier_iban").click(function() {
        $(".formulaire_edition .intitule").show();        
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").hide();
        $(".formulaire_edition .new_confirmation").hide();
        $(".formulaire_edition .email").hide();
        $(".formulaire_edition .iban").show();
        $(".formulaire_edition #submit").show();
    });
        
    $(".infos_personnelles .modifier_email").click(function() {   
        $(".formulaire_edition .intitule").show();                
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").hide();
        $(".formulaire_edition .new_confirmation").hide();
        $(".formulaire_edition .email").show();
        $(".formulaire_edition .iban").hide();
        $(".formulaire_edition #submit").show();
    });
 });
    
    function valider_edit() {
        var regex_mail = /^[a-z0-9-_.]+@[a-z]{2,}\.[a-z]{2,4}$/;
        var regex_iban = /^[0-9A-Za-z-]{1,34}$/;

        var bol= true;
        if (!regex_mail.test($(".formulaire_edition #email").val())) {
            $(".formulaire_edition #email").css('border','1px solid red');
            bol = false;
        }
        if (!regex_iban.test($(".formulaire_edition #iban").val())) {
            $(".formulaire_edition #iban").css('border','1px solid red');
            bol = false;
        }
        if ($(".formulaire_edition #new_password").val() !== $(".formulaire_edition #new_confirmation").val()) {
            $(".formulaire_edition #new_password").css('border','1px solid red');
            $(".formulaire_edition #new_confirmation").css('border','1px solid red');
            bol = false;
        }
                
                
        if (!bol) {
            alert("Formulaire incorrect");
            return false;
        }        
        else
            return true;
    }
// -- Gestion Log in-- //
    function valider_login() {
        var regex_mail = /^[a-z0-9-_.]+@[a-z]{2,}\.[a-z]{2,4}$/;
        var bol= true;
        if (!regex_mail.test($(".formulaire_connection #email").val())) {
            $(".formulaire_connection #email").css('border','1px solid red');
            bol = false;
        }
                
                
        if (!bol) {
            alert("Formulaire incorrect");
            return false;
        }        
        else
            return true;
    }
    
    
// -- Gestion Inscription -- //
    function valider_inscription() {
        var regex_mail = /^[A-Za-z0-9-_.]+@[A-Za-z]{2,}\.[A-Za-z]{2,4}$/;
        var regex_name = /^[A-Za-zàáâãäåçèéêëìíîïðòóôõöùúûüýÿ-\s]+$/;
        var bol= true;

        if (!regex_name.test($(".formulaire_inscription #nom").val())) {
            $(".formulaire_inscription #nom").css('border','1px solid red');
            bol = false;
        }
        if (!regex_name.test($(".formulaire_inscription #prenom").val())) {
            $(".formulaire_inscription #prenom").css('border','1px solid red');
            bol = false;
        }
        if (!regex_mail.test($(".formulaire_inscription #mail").val())) {
            $(".formulaire_inscription #mail").css('border','1px solid red');
            bol = false;
        }

        if ($(".formulaire_inscription #password").val() !== $(".formulaire_inscription #confirmation").val()) {
            $(".formulaire_inscription #password").css('border','1px solid red');
            $(".formulaire_inscription #confirmation").css('border','1px solid red');
            bol = false;
        }
                
        if (!bol) {
            alert("Formulaire incorrect");
            return false;
        }        
        else
            return true;
    }
    
   // -- Confirmation  -- //
       function confirm_virement() {
           if (confirm("Montant versé : "+$(".formulaire_virement #montant").val() + "€ \n Etes-vous sur ?"))
               return true;
           else
               return false;
       }
 
    
    


