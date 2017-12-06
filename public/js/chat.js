$.when( $.ready ).then(function() {
    $('#button_cancel').click(function() {
        window.location.href = '/profile';
    });

    $('#chat_create_form').submit(function(event) {
        // Get chat theme
        var theme = $('#theme').val();
        // Generate chat key
        var key = ninjaCrypto.createKey();
        // Encrypt chat theme with the key
        var encTheme = ninjaCrypto.encryptText(theme, key);
        // Encrypt chat key with open key of current user
        // ...
        event.preventDefault();
    });
});
