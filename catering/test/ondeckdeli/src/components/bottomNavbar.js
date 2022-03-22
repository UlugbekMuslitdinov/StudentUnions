import React, { Component } from 'react';
import { Link } from 'react-router-dom';
import { connect } from "react-redux";
import { ROUTES } from '../routes';

class BottomNavbar extends Component {

  summaryPage = () => {
    return (
      <div className="bottom-panel d-flex justify-content-between">
        <div className="p-2"></div>
        <div className="p-2">
          <div className="display-4">
            <span>Total: ${this.props.state.orderTotal}</span>
          </div>
        </div>
        <div className="p-2"></div>
      </div>
    );
  }

  render() {

    let currentIndex = this.props.state.navIndex;

    if (currentIndex >= 8) {
      return null;
    }

    let prev = "#", next = "#";

    if (currentIndex !== 0) {
      if (this.props.state.error){ prev = ROUTES[currentIndex].link; }
      else{ 
        this.props.state.error = null;
        prev = ROUTES[currentIndex - 1].link; 
      }
    }

    if (currentIndex !== 8) {
      if (this.props.state.error){ next = ROUTES[currentIndex].link; }
      else{ 
        this.props.state.error = null;
        next = ROUTES[currentIndex + 1].link; 
      }
    }

    return (
      <div className="bottom-panel d-flex justify-content-between">
        <div className="p-2">
          <div className="nav-buttons">
            <Link
              className={"btn btn-orange" + (this.props.state.navIndex === 0 ? ' disabled' : '')}
              to={prev}>Prev
              </Link>
          </div>
        </div>

        <div className="p-2">
          <div className="display-4">
            <span>Total: ${this.props.state.orderTotal}</span>
          </div>
        </div>

        <div className="p-2">
          <div className="nav-buttons">
            <Link className="btn btn-orange" to={next}>Next</Link>
          </div>
        </div>
      </div>
    );
  }
}

const mapStateToProps = (state) => ({
  state: state
});

export default connect(mapStateToProps)(BottomNavbar);