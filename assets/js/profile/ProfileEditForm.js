class ProfileEditForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            nick: this.props.nick
        };

        this.onChangeNick = this.onChangeNick.bind(this);
        this.onCreate = this.onCreate.bind(this);
    }

    onCancel() {
        window.location.href = '/profile';
    }

    onCreate(event) {
        event.preventDefault();
        let
            $openKey = $('#openKey'),
            $errors = $('#errors');

        // Get conversation theme
        if (!this.state.nick.trim()) {
            $errors.html('The nick is empty').removeClass('hidden');
            return;
        }
        // Encrypt check word with open key, for further checking
        let privateKeyCheck = ninjaCrypto.encryptRsa('private_key_check', $openKey.val());
        if (!privateKeyCheck) {
            $errors.html('The open key is wrong').removeClass('hidden');
            return;
        }

        let actionData = {
            nick: this.state.nick,
            open_key: $openKey.val(),
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
        this.state.nick = event.target.value;
        this.setState(this.state);
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
                                    <textarea name="open_key" id="openKey" rows="10" className="form-control">{this.props.open_key}</textarea>
                                </div>
                                <div className="alert alert-danger hidden" id="errors" />
                                <div className="form-group float-right">
                                    <button type="button" className="btn btn-primary" onClick={this.onCancel}>Cancel</button>
                                    <button type="submit" className="btn btn-primary" onClick={this.onCreate}>Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
