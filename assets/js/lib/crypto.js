var ninjaCrypto = ninjaCrypto || (function() {

    var c = {};

    c.createKey = function() {
        var now = new Date();
        var hash = CryptoJS.SHA256(now.getTime().toString());
        return hash.toString();
    };

    c.encryptTripleDES = function(message, key) {
        var encrypted = CryptoJS.TripleDES.encrypt(message, key);
        return encrypted.toString();
    };

    c.decryptTripleDES = function(encrypted, key) {
        var decrypted = CryptoJS.TripleDES.decrypt(encrypted, key);
        return decrypted.toString(CryptoJS.enc.Utf8);
    };

    c.encryptRsa = function(message, openKey) {
        var encrypt = new JSEncrypt();
        encrypt.setPublicKey(openKey);
        return encrypt.encrypt(message);
    };

    c.decryptRsa = function(encrypted, privateKey) {
        var decrypt = new JSEncrypt();
        decrypt.setPrivateKey(privateKey);
        return decrypt.decrypt(encrypted);
    };

    return c;
}());