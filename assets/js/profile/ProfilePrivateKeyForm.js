class ProfilePrivateKeyForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            error: '',
            user_private_key_check: this.props.user_private_key_check
        };

        this.onFileChange = this.onFileChange.bind(this);
    }

    onCancel() {
        window.location.href = '/profile';
    }

    onFileChange(event) {
        let me = this;
        let file = event.target.files[0];
        let textType = /.*-x509-ca-cert/;

        if (file.type.match(textType)) {
            let reader = new FileReader();

            reader.onload = function() {
                let checkWord = ninjaCrypto.decryptRsa(me.state.user_private_key_check, reader.result);
                if ('private_key_check' === checkWord) {
                    sessionStorage.setItem('private_key', reader.result);
                    window.location.assign('/profile');
                } else {
                    me.setState({error: 'The private key is not corresponded to open key!'});
                }
            };

            reader.readAsText(file);
        } else {
            me.setState({error: 'File not supported!'});
        }
    }

    render() {
        return (
            <div className="row">
                <div className="col-sm-6">
                    <div className="panel panel-primary">
                        <div className="panel-heading">Private key</div>
                        <div className="panel-body">
                            <div className="form-group">
                                <label>Please, select private key file</label>
                                <input type="file" id="private_selector_file_input" onChange={this.onFileChange}/><br />
                                <div className="red">{this.state.error}</div>
                            </div>
                            <div className="btn-toolbar" role="toolbar">
                                <div className="btn-group float-right" role="group">
                                    <button type="button" className="btn btn-primary" onClick={this.onCancel}>Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}
