$(document).ready(function() {
    $(".formulaire_edition .password").hide();
    $(".formulaire_edition .new_password").hide();
    $(".formulaire_edition .new_confirmation").hide();
    $(".formulaire_edition .email").hide();
    $(".formulaire_edition .iban").hide();
    $(".formulaire_edition #submit").hide();

    
    $(".infos_personnelles .modifier_password").click(function() {
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").show();
        $(".formulaire_edition .new_confirmation").show();
        $(".formulaire_edition .email").hide();
        $(".formulaire_edition .iban").hide();
        $(".formulaire_edition #submit").show();
    });
    
    $(".infos_personnelles .modifier_iban").click(function() {
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").hide();
        $(".formulaire_edition .new_confirmation").hide();
        $(".formulaire_edition .email").hide();
        $(".formulaire_edition .iban").show();
        $(".formulaire_edition #submit").show();
    });
        
    $(".infos_personnelles .modifier_email").click(function() {
        $(".formulaire_edition .password").show();
        $(".formulaire_edition .new_password").hide();
        $(".formulaire_edition .new_confirmation").hide();
        $(".formulaire_edition .email").show();
        $(".formulaire_edition .iban").hide();
        $(".formulaire_edition #submit").show();
    });
});