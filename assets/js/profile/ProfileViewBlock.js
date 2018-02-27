class ProfileViewBlock extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        let OpenKey = this.props.hasOpenKey
            ? <span class="zf-green">Ok</span>
            : <span class="red">empty</span>;
        let PrivateKey = sessionStorage.getItem('private_key')
            ? <span class="zf-green">Ok</span>
            : <span><a class="red" href="/profile">Not selected</a></span>;

        return [
            <div>Nick: {this.props.nick}</div>,
            <div>Open key: {OpenKey}</div>,
            <div>Private key: {PrivateKey}</div>
        ];
    }
}
