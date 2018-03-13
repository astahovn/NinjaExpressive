class ConversationsWidget extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let privateKey = sessionStorage.getItem('private_key');
        if (!privateKey) {
            return <div>You should load a private key</div>;
        }
        let conversations = JSON.parse(this.props.conversations);
        let resultConversations = [];
        for (let i = 0; i < conversations.length; i++) {
            let conversation = conversations[i];
            let key = ninjaCrypto.decryptRsa(conversation.key, privateKey);
            let theme = ninjaCrypto.decryptTripleDES(conversation.theme, key);
            resultConversations.push({
                'url': '/conversation/chat/' + conversation.id,
                'theme': theme
            });
        }

        return (
            <div>
                {resultConversations.map((item) => [<a href={item.url}>{item.theme}</a>, <br />])}
            </div>
        );
    }
}
