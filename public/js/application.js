$.when( $.ready ).then(function() {
    if (!Application.modules) {
        return false;
    }

    for (var item in Application.modules) {
        if (Application.modules.hasOwnProperty(item) && Application.modules[item].load) {
            Application.modules[item].load();
        }
    }
});
