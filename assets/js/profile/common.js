Application.modules.profileCommon = (function(self) {
    var
        _autoCheckPrivateKey = function() {
            var openKey = $('#active_user_open_key').html();
            if (!openKey) {
                return;
            }
            if (sessionStorage.getItem('private_key')) {
                return;
            }
            var fileInput = document.getElementById('private_selector_file_input');
            var fileDisplayArea = document.getElementById('private_selector_error');

            fileInput.addEventListener('change', function(e) {
                var file = fileInput.files[0];
                var textType = /.*-x509-ca-cert/;

                if (file.type.match(textType)) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        var privateKeyCheck = $('#active_user_private_key_check').html();
                        var checkWord = ninjaCrypto.decryptRsa(privateKeyCheck, reader.result);
                        if ('private_key_check' === checkWord) {
                            sessionStorage.setItem('private_key', reader.result);
                            window.location.reload(false);
                        } else {
                            fileDisplayArea.innerText = "The private key is not corresponded to open key!"
                        }
                    };

                    reader.readAsText(file);
                } else {
                    fileDisplayArea.innerText = "File not supported!"
                }
            });

            $('#private_selector').modal({
                backdrop: false
            });
        }
    ;

    self.load = function() {
        _autoCheckPrivateKey();
    };

    return self;
}({}));
