class ProfileEditForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            nick: this.props.nick,
            open_key: this.props.open_key,
            errors: ''
        };

        this.onChangeNick = this.onChangeNick.bind(this);
        this.onChangeOpenKey = this.onChangeOpenKey.bind(this);
        this.onCreate = this.onCreate.bind(this);
    }

    onCancel() {
        window.location.href = '/profile';
    }

    onCreate(event) {
        event.preventDefault();

        // Get conversation theme
        if (!this.state.nick.trim()) {
            this.setState({errors: 'The nick is empty'});
            return;
        }
        // Encrypt check word with open key, for further checking
        let privateKeyCheck = ninjaCrypto.encryptRsa('private_key_check', this.state.open_key);
        if (!privateKeyCheck) {
            this.setState({errors: 'The open key is wrong'});
            return;
        }

        let actionData = {
            nick: this.state.nick,
            open_key: this.state.open_key,
            private_key_check: privateKeyCheck
        };

        $.post("/profile/edit", actionData)
            .done(function(data) {
                if (data.success) {
                    window.location.href = '/profile';
                }
            });
    }

    onChangeNick(event) {
        this.setState({nick: event.target.value});
    }

    onChangeOpenKey(event) {
        this.setState({open_key: event.target.value});
    }

    render() {
        return (
            <div className="row">
                <div className="col-sm-6">
                    <div className="panel panel-primary">
                        <div className="panel-heading">Profile</div>
                        <div className="panel-body">
                            <form action="/profile/edit" method="post" id="profile_edit_form">
                                <div className="form-group">
                                    <label>Nick</label>
                                    <input type="text" className="form-control" placeholder="Nick" value={this.state.nick} onChange={this.onChangeNick} />
                                </div>
                                <div className="form-group">
                                    <label for="openKey">Open key</label>
                                    <textarea name="open_key" rows="10" className="form-control" value={this.state.open_key} onChange={this.onChangeOpenKey} />
                                </div>
                                <div className={!!this.state.errors ? "alert alert-danger" : "alert alert-danger hidden"}>{this.state.errors}</div>
                                <div className="btn-toolbar" role="toolbar">
                                    <div className="btn-group float-right" role="group">
                                        <button type="button" className="btn btn-primary" onClick={this.onCancel}>Cancel</button>
                                    </div>
                                    <div className="btn-group float-right" role="group">
                                        <button type="submit" className="btn btn-primary" onClick={this.onCreate}>Save</button>
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
