import React, { Component } from 'react';

import {
  BrowserRouter as Router,
  Route,
  Link
} from 'react-router-dom'
import { connect } from 'react-redux';

import './App.css'

import Beverages from './components/beverages';
import Breakfast from './components/breakfast';
import DeliTrays from './components/deli-trays';
import Dessert from './components/dessert';
import SaladBoxes from './components/green-salad-boxes';
import LunchBoxes from './components/lunch-boxes';
import SaladSides from './components/salad-sides';
import SubSandwiches from './components/sub-sandwiches';
import Summary from './components/summary';
import BottomNavbar from './components/bottomNavbar';
import Confirmation from './components/confirmation';
import banner from './assets/banner.jpg';

import { ROUTES } from './routes';


class App extends Component {

  constructor(props) {
    super(props);
    this.navbar = this.navbar.bind(this);
  }

  navbar = () => {

    let error = false;
    let disabledRoute = "";

    // Check Salad Box
    if (this.props.nav.navIndex === 0)
    {
      let fastballEight = this.props.nav.fastball >= 8 || this.props.nav.fastball === 0;
      let changeUpEight = this.props.nav.changeUp >= 8 || this.props.nav.changeUp === 0;

      if (fastballEight === false || changeUpEight === false)
      {
        error = true;
        disabledRoute = 'Breakfast';
      }
    }
    else if (this.props.nav.navIndex === 4)
    {
      let saladQuantity = (this.props.nav.cobSalad
        + this.props.nav.chefSalad
        + this.props.nav.caesarSalad
        + this.props.nav.veggieSalad);

      let dressingQuantity = (
          this.props.nav.ranch
          + this.props.nav.italian
          + this.props.nav.caesar
      );

      if (saladQuantity !== dressingQuantity){ 
        error = true; 
        disabledRoute = "SaladBoxes";
      }
    }

    return (
      <nav aria-label="breadcrumb">
      <ol className="breadcrumb">
        {
          ROUTES.map((route, index) => {
            return (
              <li key={index}
                className={"breadcrumb-item active"}
                aria-current='page'>

                {
                  (index === this.props.nav.navIndex
                    ? <span>{route.name}</span>
                    : (
                        error === true
                        ? <Link
                            className="nav-items"
                            to={disabledRoute}
                          >
                            {route.name}
                          </Link>
                        : <Link
                        className="nav-items"
                        to={route.link}
                      >
                        {route.name}
                      </Link>
                      )
                  )
                }
              </li>
            )
          })
        }
      </ol>
    </nav>
    );
  }

  render() {

    return (
      <Router basename={'/catering/online/ondeckdeli'}>
        <div>

          <div className="py-3 text-center">
            <img className="d-block mx-auto mb-4" src={banner} alt="" width="100%" />
            <h2 className="display-5 title-banner">On Deck Deli Catering Form</h2>
          </div>

          {
            this.props.nav.navIndex !== 9
            ? this.navbar()
            : null
          }

          <Route exact path="/" component={Breakfast} />
          <Route path="/Breakfast" component={Breakfast} />
          <Route path="/Beverages" component={Beverages} />
          <Route path="/DeliTrays" component={DeliTrays} />
          <Route path="/Dessert" component={Dessert} />
          <Route path="/SaladBoxes" component={SaladBoxes} />
          <Route path="/LunchBoxes" component={LunchBoxes} />
          <Route path="/SaladSides" component={SaladSides} />
          <Route path="/SubSandwiches" component={SubSandwiches} />
          <Route path="/Summary" component={Summary} />
          <Route path="/Confirmation" component={Confirmation} />

          <BottomNavbar />

        </div>
      </Router>
    );
  }
}


const mapStateToProps = (state) => ({
  nav: state
});

export default connect(mapStateToProps)(App);
