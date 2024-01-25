import React, { Component } from 'react';
import { connect } from 'react-redux';
import {
  Navbar,
  NavbarBrand,
  NavbarToggler,
  Nav,
  NavItem,
  Container,
  Collapse,
} from 'reactstrap';
import { Link } from 'react-router-dom';
import { withRouter } from 'react-router-dom';
import api from '../../../api';
import './index.scss';
import Logo from '../../../assets/imgs/mah.svg';

const mapStateToProps = (state) => ({
  mainMenu: state.api.menus.main,
});

const mapDispatchToProps = (dispatch) => ({
  loadMenu: (menu) => dispatch({ type: 'LOAD_MENU', payload: menu }),
});
console.log(api.menus);
class Header extends Component {
  constructor(props) {
    super(props);

    this.props.loadMenu(api.Menus.bySlug('main'));
    this.buildMenu = this.buildMenu.bind(this);

    this.toggle = this.toggle.bind(this);
    this.state = {
      isOpen: false,
    };
  }
  toggle() {
    this.setState({
      isOpen: !this.state.isOpen,
    });
  }

  buildMenu() {
    if (this.props.mainMenu) {
      return this.props.mainMenu.map((item, i) => {
        const pageURI = this.props.location.pathname;

        return (
          <NavItem key={item.ID}>
            <Link
              to={item.url}
              className={`nav-link${item.url === pageURI ? ' active' : ''}`}>
              {item.title}
            </Link>
          </NavItem>
        );
      });
    }
    console.log(this.props);
    return null;
  }

  render() {
    return (
      <header className="header-main">
        <Navbar expand="md" color="dark" dark>
          <NavbarBrand href="/">
            <img src={Logo} alt="Mary A. Hayne" width={85} />
          </NavbarBrand>
          <NavbarToggler
            onClick={this.toggle}
            aria-controls="responsive-navbar-nav"
          />
          <Collapse isOpen={this.state.isOpen} navbar>
            <Container fluid={true} className="mah-nav">
              <Nav
                className="navbar"
                fill
                // activeKey={this.selectedKey}
                // onSelect={this._onSelect}
              >
                {this.buildMenu()}
              </Nav>
            </Container>
          </Collapse>
        </Navbar>
      </header>
    );
  }
}

export default withRouter(connect(mapStateToProps, mapDispatchToProps)(Header));
