class ConversationCreateForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            theme: '',
            open_key: this.props.open_key,
            error: ''
        };

        this.onChangeTheme = this.onChangeTheme.bind(this);
        this.onCreate = this.onCreate.bind(this);
    }

    onChangeTheme(event) {
        this.setState({theme: event.target.value});
    }

    onCancel() {
        window.location.href = '/profile';
    }

    onCreate(event) {
        event.preventDefault();

        // Get conversation theme
        if (!this.state.theme.trim()) {
            this.setState({error: 'The theme is empty'});
            return;
        }
        // Generate conversation key
        let key = ninjaCrypto.createKey();
        // Encrypt conversation theme with the key
        let encTheme = ninjaCrypto.encryptTripleDES(this.state.theme.trim(), key);
        // Encrypt conversation key with open key of current user
        let encKey = ninjaCrypto.encryptRsa(key, this.state.open_key);

        $.post("/conversation/create", {theme: encTheme, key: encKey})
            .done(function(data) {
                if (data.success) {
                    window.location.href = '/profile';
                    return;
                }
                this.setState({error: data.error});
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
                                    <input type="text" className="form-control" value={this.state.theme} onChange={this.onChangeTheme} />
                                </div>
                                <div className={!!this.state.error ? "alert alert-danger" : "alert alert-danger hidden"}>{this.state.error}</div>
                                <div className="btn-toolbar" role="toolbar">
                                    <div className="btn-group float-right" role="group">
                                        <button type="button" className="btn btn-primary" onClick={this.onCancel}>Cancel</button>
                                    </div>
                                    <div className="btn-group float-right" role="group">
                                        <button type="submit" className="btn btn-primary" onClick={this.onCreate}>Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
