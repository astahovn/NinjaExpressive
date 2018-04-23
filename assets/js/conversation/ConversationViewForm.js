class ConversationViewForm extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            conversation_key: this.props.conversation_key,
            theme: this.props.theme
        };
    }

    render() {
        let privateKey = sessionStorage.getItem('private_key');
        if (!privateKey) {
            return <div>You should load a private key</div>;
        }
        let key = ninjaCrypto.decryptRsa(this.state.conversation_key, privateKey);
        let theme = ninjaCrypto.decryptTripleDES(this.state.theme, key);

        return (
            <div className="row">
                <div className="col-sm-6">
                    <div className="panel panel-primary">
                        <div className="panel-heading">{theme}</div>
                    </div>
                </div>
            </div>
        );
    }
}
