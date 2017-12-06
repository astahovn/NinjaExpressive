var ninjaCrypto = ninjaCrypto || (function() {

    var c = {};

    c.createToken = function() {
        var now = new Date();
        var hash = CryptoJS.SHA256(now.getTime().toString());
        return hash.toString();
    };

    return c;
}());