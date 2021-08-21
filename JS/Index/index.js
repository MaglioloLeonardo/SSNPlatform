(function($){
    $(document).ready(function() {

        var consent = localStorage.getItem('cookie-consent');

        if(consent != 'true'){
            $('#cookie').fadeIn();
        }

        $('#cookie-ok').click(function(event){
            localStorage.setItem('cookie-consent', 'true');
            $('#cookie').fadeOut();
        });

    });
})(jQuery);