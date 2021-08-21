$(document).ready(
    function () {
        setButtonsAction();
        setFormsAction();
    }
);

function setButtonsAction(){
    $("#makeOrder").on("click", ()=>{
        $("#containerOrder").css("display", "initial");
    });
    $("#closeButton").on("click", ()=>{
        $("#containerOrder").css("display", "none");
    });

    $("#removeOrder").on("click", ()=>{
        $("#containerRemoveOrder").css("display", "initial");
    });
    $("#closeButtonRemove").on("click", ()=>{
        $("#containerRemoveOrder").css("display", "none");
    });
}

function setFormsAction() {
    $("#formOrder").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/Funzioni/Farmacista/addOrder.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                if (data == 1) {
                    $("#orderErrorMessage").css("display", "none");
                    $("#containerOrder").css("display", "none");
                } else {
                    $("#orderErrorMessage").css("display", "initial");
                    $("#orderErrorMessage").html(data);
                }
            },
            error: function (xhr, status, error) {
                $("#orderErrorMessage").css("display", "initial");
                $("#orderErrorMessage").text("Errore: non è stato possibile contattare il server per l'autenticazione, riprova più tardi")
            }
        })
    });

    $("#formRemoveOrder").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/Funzioni/Farmacista/removeOrder.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                if (data == 1) {
                    $("#removeErrorMessage").css("display", "none");
                    $("#containerRemoveOrder").css("display", "none");
                } else {
                    $("#removeErrorMessage").css("display", "initial");
                    $("#removeErrorMessage").html(data);
                }
            },
            error: function (xhr, status, error) {
                $("#removeErrorMessage").css("display", "initial");
                $("#removeErrorMessage").text("Errore: non è stato possibile contattare il server per l'autenticazione, riprova più tardi")
            }
        })
    });
}