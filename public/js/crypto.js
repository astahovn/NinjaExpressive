var ninjaCrypto = ninjaCrypto || (function() {

    var c = {};

    c.createKey = function() {
        var now = new Date();
        var hash = CryptoJS.SHA256(now.getTime().toString());
        return hash.toString();
    };

    c.encryptText = function(message, key) {
        var encrypted = CryptoJS.TripleDES.encrypt(message, key);
        return encrypted.toString();
    };

    c.decryptText = function(encrypted, key) {
        var decrypted = CryptoJS.TripleDES.decrypt(encrypted, key);
        return decrypted.toString(CryptoJS.enc.Utf8);
    };

    return c;
}());