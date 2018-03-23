Application.modules.profileEdit = (function(self) {
    var
        _addEvents = function() {
            $(document)
                .on('click', '#button_cancel', function() {
                    window.location.href = '/profile';
                })

                .on('submit', '#profile_edit_form', function(event) {
                    event.preventDefault();
                    var
                        $nick = $('#nick'),
                        $openKey = $('#openKey'),
                        $errors = $('#errors');

                    // Get conversation theme
                    var nick = $nick.val();
                    if (!nick.trim()) {
                        $errors.html('The nick is empty').removeClass('hidden');
                        return;
                    }
                    // Encrypt check word with open key, for further checking
                    var privateKeyCheck = ninjaCrypto.encryptRsa('private_key_check', $openKey.val());
                    if (!privateKeyCheck) {
                        $errors.html('The open key is wrong').removeClass('hidden');
                        return;
                    }

                    var actionData = {
                        nick: $nick.val(),
                        open_key: $openKey.val(),
                        private_key_check: privateKeyCheck
                    };

                    $.post("/profile/edit", actionData)
                        .done(function(data) {
                            if (data.success) {
                                window.location.href = '/profile';
                            }
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
