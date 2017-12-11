$.when( $.ready ).then(function() {
    $('#button_cancel').click(function() {
        window.location.href = '/profile';
    });

    $('#conversation_create_form').submit(function(event) {
        event.preventDefault();
        var
            $themeError = $('#theme-error'),
            $theme = $('#theme'),
            $openKey = $('#active-user-open-key');

        // Get chat theme
        var theme = $theme.val();
        if (!theme.trim()) {
            $themeError.html('The theme is empty').removeClass('hidden');
            return;
        }
        // Generate chat key
        var key = ninjaCrypto.createKey();
        // Encrypt chat theme with the key
        var encTheme = ninjaCrypto.encryptTripleDES(theme, key);
        // Encrypt chat key with open key of current user
        var openKey = $openKey.html();
        var encKey = ninjaCrypto.encryptRsa(key, openKey);

        $.post("/conversation/create", {theme: encTheme, key: encKey})
            .done(function(data) {
                if (data.success) {
                    window.location.href = '/profile';
                    return;
                }
                $themeError.html(data.error).removeClass('hidden');
            });
    });
});
