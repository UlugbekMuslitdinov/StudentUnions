import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    LUNCHBOX_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class LunchBoxCard extends Component {
    
    rowElement = (name, quantity, price, error, i) => {

        if (quantity === 0) {
            return null;
        }

        let errorClass = error ? 'table-danger' : '';

        return (
            <tr className={errorClass} key={i}>
                <td>{name}</td>
                <td>{quantity}</td>
                <td>${price}</td>
                <td className="text-right">${roundTo(price * quantity, 2)}</td>
            </tr>
        );
    }


    calculateTotal = (items) => {
        let total = 0;

        items.forEach(item => {
            total += (LUNCHBOX_PRICE * item.qty);
        });

        return total;
    }


    whiteTable = (items) => {
        let total = this.calculateTotal(items);

        if (total === 0) return null;

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col" className="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        items.map((item, i) => {
                            if (item.qty > 0) {
                                return this.rowElement(item.desc, item.qty, LUNCHBOX_PRICE, false, i)                            }
                            return null;
                        })
                    }
                    <tr>
                        <td colSpan="3" className=""></td>
                        <th className="text-right">${roundTo(total, 2)}</th>
                    </tr>
                </tbody>
            </table>
        );
    }

    render() {

        if (this.props.state.lunchBoxTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/LunchBoxes">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Lunch Boxes</h3>

                    {
                        this.whiteTable([
                            {
                                desc: `Batter Up - roasted turkey breast`,
                                qty: this.props.state.batterUp
                            },
                            {
                                desc: `Infield Fly - chicken salad`,
                                qty: this.props.state.infieldFly
                            },
                            {
                                desc: `Safe Call - albacore tuna salad	`,
                                qty: this.props.state.safeCall
                            },
                            {
                                desc: `Fair Ball - baked ham`,
                                qty: this.props.state.fairBall
                            },
                            {
                                desc: `Outfielder - roast beef`,
                                qty: this.props.state.outfielder
                            },
                            {
                                desc: `Ground Rule - veggie`,
                                qty: this.props.state.groundRule
                            }
                        ])
                    }

                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.lunchBoxTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(LunchBoxCard);