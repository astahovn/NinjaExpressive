class ProfileStatusWidget extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let OpenKey = this.props.hasOpenKey
            ? <span class="zf-green">Ok</span>
            : <span><a class="red" href="/profile/edit">empty</a></span>;

        let PrivateKey;
        if (!this.props.hasOpenKey) {
            PrivateKey = <span><a class="red" href="/profile/edit">the open key is needed</a></span>;
        } else {
            PrivateKey = sessionStorage.getItem('private_key')
                ? <span class="zf-green">Ok</span>
                : <span><a class="red" href="/profile">Not selected</a></span>;
        }

        return [
            <div>Nick: {this.props.nick}</div>,
            <div>Open key: {OpenKey}</div>,
            <div>Private key: {PrivateKey}</div>
        ];
    }
}
