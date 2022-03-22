import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    POWERHITTER_REGULAR_PRICE
    , POWERHITTER_LARGE_PRICE
    , PERFECTGAME_PRICE
    , TRIPLECROWN_PRICE
    , QUALITYSTART_PRICE
    , PLAYBALL_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class DeliTrayCard extends Component {

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
                <td className="text-right">${roundTo(quantity * price, 2)}</td>
            </tr>
        );
    }


    calculateTotal = (items) => {
        let total = 0;

        items.forEach(item => {
            total += (item.price * item.qty);
        });

        return total;
    }

    freeSaladSides = (salads) => {
        if (salads.length === 0) return null;

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th className="" colSpan="4">Free Salad Sides</th>
                    </tr>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Size</th>
                    </tr>
                </thead>
                <tbody>
                    {salads.map((salad, i) => {
                        return (
                            <tr key={i}>
                                <td>{salad}</td>
                                <td>Large</td>
                            </tr>
                        );
                    })}
                </tbody>
            </table>

        );
    }


    orangeTable = (name, items) => {
        let total = this.calculateTotal(items);

        if (total === 0) return null;

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th className="" colSpan="4">{name}</th>
                    </tr>
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
                                return this.rowElement(item.desc, item.qty, item.price, false, i)
                            }
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

        if (this.props.state.deliTraysTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/DeliTrays">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Deli Trays</h3>

                    {
                        this.orangeTable('MEAT AND CHEESE TRAY', [
                            {
                                desc: 'Power Hitter Regular',
                                qty: this.props.state.powerHitterRegular,
                                price: POWERHITTER_REGULAR_PRICE
                            },
                            {
                                desc: 'Power Hitter Large',
                                qty: this.props.state.powerHitterLarge,
                                price: POWERHITTER_LARGE_PRICE
                            }
                        ])
                    }

                    {
                        this.orangeTable('ANTIPASTO TRAYS', [
                            {
                                desc: 'Perfect Game',
                                qty: this.props.state.perfectGame,
                                price: PERFECTGAME_PRICE
                            },
                            {
                                desc: 'Triple Crown',
                                qty: this.props.state.tripleCrown,
                                price: TRIPLECROWN_PRICE
                            }
                        ])
                    }

                    {
                        this.orangeTable('SANDWICH TRAYS', [
                            {
                                desc: 'Quality Start',
                                qty: this.props.state.qualityStart,
                                price: QUALITYSTART_PRICE
                            },
                            {
                                desc: 'Play Ball',
                                qty: this.props.state.playBall,
                                price: PLAYBALL_PRICE
                            }
                        ])
                    }

                    {
                        this.freeSaladSides(this.props.state.freeSalads)
                    }

                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.deliTraysTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(DeliTrayCard);