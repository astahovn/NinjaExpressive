$.when( $.ready ).then(function() {
    if (sessionStorage.getItem('private_key')) {
        $('#private_key_selector').hide();
        $('#private_key_ok').show();
    } else {
        $('#private_key_selector').show();
        $('#private_key_ok').hide();
    }

    var fileInput = document.getElementById('fileInput');
    var fileDisplayArea = document.getElementById('fileDisplayArea');

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

    var privateKey = sessionStorage.getItem('private_key');
    if (!privateKey) {
        $('#conversations_list').html('You should load a private key');
        return;
    }

    var conversationsRaw = $('#conversations').html();
    var conversations = JSON.parse(conversationsRaw);
    var resultConversations = [];
    for (var i = 0; i < conversations.length; i++) {
        var conversation = conversations[i];
        var key = ninjaCrypto.decryptRsa(conversation.key, privateKey);
        var theme = ninjaCrypto.decryptTripleDES(conversation.theme, key);
        resultConversations.push({
            'id': conversation.id,
            'theme': theme
        });
    }

    var list = '';
    $.each(resultConversations, function(key, item) {
        list += '<a href="/conversation/' + item.id + '">' + item.theme + '</a><br>';
    });
    $('#conversations_list').html(list);
});
