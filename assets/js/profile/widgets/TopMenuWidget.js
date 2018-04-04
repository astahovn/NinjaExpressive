class TopMenuWidget extends React.Component {
    constructor(props) {
        super(props);

        this.onLogout = this.onLogout.bind(this);
    }

    onLogout() {
        sessionStorage.clear();
        window.location.href = '/logout';
        event.preventDefault();
    }

    render() {
        return [
            <ul className="nav navbar-nav float-right">
                <li className="dropdown">
                    <a href="#" className="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{this.props.userName} <span className="caret"></span></a>
                    <ul className="dropdown-menu">
                        <li><a className="dropdown-item" href="#" onClick={this.onLogout}>Logout</a></li>
                    </ul>
                </li>
            </ul>
        ];
    }
}
