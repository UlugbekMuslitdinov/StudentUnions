import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    SUBSANDWICH_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class SubSandwichCard extends Component {

    rowElement = (name, quantity, price, error, i) => {

        if (quantity === 0) {
            return null;
        }

        let errorClass = error ? 'table-danger' : '';

        return (
            <tr className={errorClass} key={i}>
                <td>{name}</td>
                <td>{quantity}</td>
                <td>{price}</td>
                <td className="text-right">${roundTo(price * quantity, 2)}</td>
            </tr>
        );
    }


    calculateTotal = (items) => {
        let total = 0;

        items.forEach(item => {
            total += (SUBSANDWICH_PRICE * item.qty);
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
                                return this.rowElement(item.desc, item.qty, SUBSANDWICH_PRICE, false, i)                            }
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

        if (this.props.state.subSandwichTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/SubSandwiches">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- 18" Sub Sandwiches</h3>

                    {
                        this.whiteTable([
                            {
                                desc: `Leadoff - peppered turkey`,
                                qty: this.props.state.leadOff
                            },
                            {
                                desc: `On Deck - salami, pepperoni`,
                                qty: this.props.state.onDeck
                            },
                            {
                                desc: `In The Hole - veggie`,
                                qty: this.props.state.inTheHole
                            }
                        ])
                    }

                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.subSandwichTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(SubSandwichCard);