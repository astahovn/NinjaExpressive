Application.modules.profileEdit = (function(self) {
    var
        _addEvents = function() {
            $(document)
                .on('click', '#button_cancel', function() {
                    window.location.href = '/profile';
                });
        }
    ;

    self.load = function() {
        _addEvents();
    };

    return self;
}({}));
