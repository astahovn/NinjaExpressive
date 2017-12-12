Application.modules.profileCommon = (function(self) {
    var
        _addEvents = function() {
            $(document)
                .on('click', '#button_logout', function(event) {
                    sessionStorage.clear();
                    window.location.href = '/logout';
                    event.preventDefault();
                });
        },

        _autoCheckPrivateKey = function() {
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
                        sessionStorage.setItem('private_key', reader.result);
                        window.location.reload(false);
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
        _addEvents();
        _autoCheckPrivateKey();
    };

    return self;
}({}));
