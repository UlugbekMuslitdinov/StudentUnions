import React, { Component } from 'react';
import { connect } from "react-redux";

import BreakfastCard from './summaryCards/breakfastCard';
import BeverageCard from './summaryCards/beverageCard';
import DeliTrayCard from './summaryCards/deliTrayCard';
import SaladSidesCard from './summaryCards/saladSidesCard';
import SaladBoxCard from './summaryCards/saladBoxCard';
import LunchBoxCard from './summaryCards/lunchBoxCard';
import DessertCard from './summaryCards/dessertCard';
import SubSandwichCard from './summaryCards/subSandwichCard';
import ExtraChips from './summaryCards/extraChips';
import TotalCard from './summaryCards/totalCard';

class Summary extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 8
        })

    }

    handleSubmit = () => {
        this.props.history.push('/Confirmation');
    }

    render() {

        if (this.props.state.orderTotal === 0) {
            return (
                <div className="card text-center summary-cards">
                    <div className="card-header">
                        <ul className="nav nav-pills card-header-pills"></ul>
                    </div>
                    <div className="card-body">
                        <p className="lead">There are no items in your shopping cart.</p>
                    </div>
                </div>
            );
        }

        let content = (<ExtraChips />);

        if (!this.props.state.extraChips.firstRender) {
            content = (
                <div>
                    {
                        this.props.state.extraChips.qty > 0
                            ? <ExtraChips />
                            : null
                    }
                    <BreakfastCard />
                    <BeverageCard />
                    <DeliTrayCard />
                    <SaladSidesCard />
                    <SaladBoxCard />
                    <LunchBoxCard />
                    <DessertCard />
                    <SubSandwichCard />
                    <TotalCard />

                    <div className="text-center" style={{ paddingBottom: "10px", paddingTop: "10px" }}>
                        <button className="btn btn-lg btn-orange" onClick={() => this.handleSubmit()}>Submit</button>
                    </div>
                </div>
            );
        }

        return (
            <div>
                {content}
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(Summary);
