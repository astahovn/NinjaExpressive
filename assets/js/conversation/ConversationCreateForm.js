class ConversationCreateForm extends React.Component {
    constructor(props) {
        super(props);
    }

    onCancel() {
        window.location.href = '/profile';
    }

    onCreate(event) {
        event.preventDefault();

        let
            $themeError = $('#theme-error'),
            $theme = $('#theme'),
            $openKey = $('#active_user_open_key');

        // Get conversation theme
        let theme = $theme.val();
        if (!theme.trim()) {
            $themeError.html('The theme is empty').removeClass('hidden');
            return;
        }
        // Generate conversation key
        let key = ninjaCrypto.createKey();
        // Encrypt conversation theme with the key
        let encTheme = ninjaCrypto.encryptTripleDES(theme, key);
        // Encrypt conversation key with open key of current user
        let openKey = $openKey.html();
        let encKey = ninjaCrypto.encryptRsa(key, openKey);

        $.post("/conversation/create", {theme: encTheme, key: encKey})
            .done(function(data) {
                if (data.success) {
                    window.location.href = '/profile';
                    return;
                }
                $themeError.html(data.error).removeClass('hidden');
            });
    }

    render() {
        return (
            <div className="row">
                <div className="col-sm-6">
                    <div className="panel panel-primary">
                        <div className="panel-heading">New Conversation</div>
                        <div className="panel-body">
                            <form id="conversation_create_form">
                                <div className="form-group">
                                    <label for="theme">Theme</label>
                                    <input type="text" name="theme" id="theme" className="form-control" />
                                </div>
                                <div className="alert alert-danger hidden" id="theme-error" />
                                <div className="form-group float-right">
                                    <button type="button" className="btn btn-primary" onClick={this.onCancel}>Cancel</button>
                                    <button type="submit" className="btn btn-primary" onClick={this.onCreate}>Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
