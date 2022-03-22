import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    FASTBALL_PRICE
    , CHANGEUP_PRICE
    , CURVEBALL_REGULAR_PRICE
    , CURVEBALL_LARGE_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class BreakfastCard extends Component {

    rowElement = (name, quantity, price, error) => {

        if (quantity === 0) {
            return null;
        }

        let errorClass = error ? 'table-danger' : '';

        return (
            <tr className={errorClass}>
                <td>{name}</td>
                <td>{quantity}</td>
                <td>${price}</td>
                <td className="text-right">${roundTo(quantity * price, 2)}</td>
            </tr>
        );
    }

    render() {

        if (this.props.state.breakfastTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/Breakfast">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title summary-t-header">- Breakfast</h3>

                    <table className="table">

                        <thead>
                            <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th className="text-right" scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            {
                                this.rowElement('Fastball - turkey sausage, egg, cheese'
                                    , this.props.state.fastball
                                    , FASTBALL_PRICE
                                    , this.props.state.fastball < 8 && this.props.state.fastball !== 0
                                )
                            }

                            {
                                this.rowElement('Change-Up - egg, cheese'
                                    , this.props.state.changeUp
                                    , CHANGEUP_PRICE
                                    , this.props.state.changeUp < 8 && this.props.state.changeUp !== 0
                                )
                            }

                            {
                                this.rowElement('Curveball - assorted baked goods, fruit salad (Regular)'
                                    , this.props.state.curveBallRegular
                                    , CURVEBALL_REGULAR_PRICE
                                    , false
                                )
                            }

                            {
                                this.rowElement('Curveball - assorted baked goods, fruit salad (Large)'
                                    , this.props.state.curveBallLarge
                                    , CURVEBALL_LARGE_PRICE
                                    , false
                                )
                            }
                            <tr className="">
                                <td colSpan={3}></td>
                                <td className="text-right" colSpan={3}>${this.props.state.breakfastTotal}</td>
                            </tr>
                        </tbody>
                    </table>
                    {/* <hr /> */}
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.breakfastTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(BreakfastCard);