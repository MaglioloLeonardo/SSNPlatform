$(document).ready(
    function () {

        $("#viewPrescriptions").on("click", ()=>{
            $("#prescriptions").css("display", "initial");
            $("#purchases").css("display", "none");
        });

        $("#viewPurchases").on("click", ()=>{
            $("#prescriptions").css("display", "none");
            $("#purchases").css("display", "initial");
        });
    }
);


