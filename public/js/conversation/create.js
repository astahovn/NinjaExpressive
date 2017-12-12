Application.modules.conversationCreate = (function(self) {
    var
        _addEvents = function() {
            $(document)
                .on('click', '#button_cancel', function() {
                    window.location.href = '/profile';
                })

                .on('submit', '#conversation_create_form', function(event) {
                    event.preventDefault();
                    var
                        $themeError = $('#theme-error'),
                        $theme = $('#theme'),
                        $openKey = $('#active-user-open-key');

                    // Get conversation theme
                    var theme = $theme.val();
                    if (!theme.trim()) {
                        $themeError.html('The theme is empty').removeClass('hidden');
                        return;
                    }
                    // Generate conversation key
                    var key = ninjaCrypto.createKey();
                    // Encrypt conversation theme with the key
                    var encTheme = ninjaCrypto.encryptTripleDES(theme, key);
                    // Encrypt conversation key with open key of current user
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
                })
            ;
        }
    ;

    self.load = function() {
        _addEvents();
    };

    return self;
}({}));
