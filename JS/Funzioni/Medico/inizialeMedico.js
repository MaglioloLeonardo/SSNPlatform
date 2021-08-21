$(document).ready(
    function () {
        setButtonsAction();
        setFormsAction();
    }
);

function setButtonsAction(){
    $("#makePrescription").on("click", ()=>{
        $("#containerPrescription").css("display", "initial");
    });
    $("#closeButton").on("click", ()=>{
        $("#containerPrescription").css("display", "none");
    });

    $("#removePrescription").on("click", ()=>{
        $("#containerRemovePrescription").css("display", "initial");
    });
    $("#closeButtonRemove").on("click", ()=>{
        $("#containerRemovePrescription").css("display", "none");
    });
}


function setFormsAction() {
    $("#formPrescription").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/Funzioni/Medico/addPrescription.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                if (data == 1) {
                    $("#prescriptionErrorMessage").css("display", "none");
                    $("#containerPrescription").css("display", "none");
                } else {
                    $("#prescriptionErrorMessage").css("display", "initial");
                    $("#prescriptionErrorMessage").html(data);
                }
            },
            error: function (xhr, status, error) {
                $("#prescriptionErrorMessage").css("display", "initial");
                $("#prescriptionErrorMessage").text("Errore: non è stato possibile contattare il server per l'autenticazione, riprova più tardi")
            }
        })
    });

    $("#formRemovePrescription").submit(function (e) {
        e.preventDefault();

        var form = $(this);
        var url = "/PHP/Funzioni/Medico/removePrescription.php";

        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function (data) {
                if (data == 1) {
                    $("#prescriptionErrorMessage").css("display", "none");
                    $("#containerRemovePrescription").css("display", "none");
                } else {
                    $("#prescriptionRemoveErrorMessage").css("display", "initial");
                    $("#prescriptionRemoveErrorMessage").html(data);
                }
            },
            error: function (xhr, status, error) {
                $("#prescriptionRemoveErrorMessage").css("display", "initial");
                $("#prescriptionRemoveErrorMessage").text("Errore: non è stato possibile contattare il server per l'autenticazione, riprova più tardi")
            }
        })
    });
}