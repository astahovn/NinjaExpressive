$.when( $.ready ).then(function() {
    $('#button_cancel').click(function() {
        window.location.href = '/profile';
    });

    $('#chat_create_form').submit(function(event) {
        event.preventDefault();
    });
});
