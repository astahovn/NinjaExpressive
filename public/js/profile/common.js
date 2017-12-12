$.when( $.ready ).then(function() {
    $('#button_logout').click(function(event) {
        sessionStorage.clear();
        window.location.href = '/logout';
        event.preventDefault();
    });
});
