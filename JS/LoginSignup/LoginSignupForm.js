
$(document).ready(
    function () {
        if (!!$.cookie("PHPSESSID")) {
            logIn("");
        }
        setFormsActions();
        setRolesRadio();
        setFormsControls();
        setFormsAction();
        updateRolesFields();
    }
);

function setFormsActions(){
    const container = document.getElementById('container');

    $("#signUp").on('click', () => {
        container.classList.add("right-panel-active");
    });

    $("#signIn").on('click', () => {
        container.classList.remove("right-panel-active");
    });
}

function setRolesRadio(){
    $("input[type=radio][name=role]").on('change', ()=>{
        updateRolesFields();
    });
}

function updateRolesFields(){
    var selected = $('input[type="radio"]:checked').val();
    if(selected === "Medico"){
        $("#datiFarmacisti").css("display", "none");
        $(".datiFarmacisti").attr("required",false);
        $(".datiFarmacisti").val(null);
        $("#datiMedici").css("display", "initial");
        $(".datiMedici").attr("required",true);
    }else if(selected === "Farmacista"){
        $("#datiFarmacisti").css("display", "initial");
        $(".datiFarmacisti").attr("required",true);
        $("#datiMedici").css("display", "none");
        $(".datiMedici").attr("required",false);
        $(".datiMedici").val(null);
    }else {
        $("#datiFarmacisti").css("display", "none");
        $(".datiFarmacisti").attr("required",false);
        $(".datiFarmacisti").val(null);
        $("#datiMedici").css("display", "none");
        $(".datiMedici").attr("required",false);
        $(".datiMedici").val(null);
    }
}

function setFormsControls(){
    var regexOnlyText = "^[a-zA-Z ]*$";
    var regexAtLeastOneText = ".*[a-zA-Z0-9].*";

    //SignUp form
    $("#Nome").attr("pattern",regexOnlyText);
    $("#Cognome").attr("pattern",regexOnlyText);
    $("#Codice_fiscale").attr("pattern", "^[a-zA-Z]{6}[0-9]{2}[abcdehlmprstABCDEHLMPRST]{1}[0-9]{2}([a-zA-Z]{1}[0-9]{3})[a-zA-Z]{1}$");
    $("#Città_residenza").attr("pattern",regexOnlyText);
    $("#Indirizzo_residenza").attr("pattern",regexAtLeastOneText);
    $("#Città_nascita").attr("pattern",regexOnlyText);
    $("#PasswordSignIn").attr("pattern","^(?=.*?[A-Z])(?=(.*[a-z]){1,})(?=(.*[\\d]){1,})(?=(.*[\\W]){1,})(?!.*\\s).{8,30}$");

    $("#Nome_farmacia").attr("pattern",regexAtLeastOneText);
    $("#Città_farmacia").attr("pattern",regexOnlyText);
    $("#Indirizzo_farmacia").attr("pattern",regexAtLeastOneText);
}

function setFormsAction(){
    $("#formLogin").submit(function(e){
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/Login/LoginEvaluator.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data){
                if(data == 1){
                    $("#loginErrorMessage").css("display", "none");
                    logIn(form.serialize());
                }else{
                    $("#loginErrorMessage").css("display", "initial");
                    $("#loginErrorMessage").text("Errore: le credenziali immesse non sono valide")
                }
            },
            error: function(xhr, status, error){
                $("#loginErrorMessage").css("display", "initial");
                $("#loginErrorMessage").text("Errore: non è stato possibile contattare il server per l'autenticazione, riprova più tardi")
            }
        })
    })

    $("#formRegistrazione").submit(function(e){
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/SignUp/SignUp.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data){
                if(data == 1){
                    $("#signUpErrorMessage").css("display", "none");
                    logIn(form.serialize());
                }else{
                    $("#signUpErrorMessage").css("display", "initial");
                    $("#signUpErrorMessage").html(data);
                }
            },
            error: function(xhr, status, error){
                $("#signUpErrorMessage").css("display", "initial");
                $("#signUpErrorMessage").text("Errore: non è stato possibile contattare il server per la registrazione, riprova più tardi")
            }
        })
    })

}

function logIn(data){
    window.location.href = "/PHP/ChooseRole/ChooseRole.php?" + data;
}




