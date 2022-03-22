import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    DESSERT_REGULAR_PRICE
    , DESSERT_LARGE_PRICE
    , BATTINGAVG_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class DessertCard extends Component {

    rowElement = (item, error, i) => {

        if (item.quantity === 0) {
            return null;
        }

        let errorClass = error ? 'table-danger' : '';

        return (
            <tr className={errorClass} key={i}>
                <td>{item.desc}</td>
                <td>{item.size}</td>
                <td>{item.qty}</td>
                <td className="text-right">${roundTo(item.total, 2)}</td>
            </tr>
        );
    }


    calculateTotal = (items) => {
        let total = 0;

        items.forEach(item => {
            total += item.total;
        });

        return total;
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
                        <th scope="col">Size</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" className="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        items.map((item, i) => {
                            if (item.qty > 0) {
                                return this.rowElement(item, false, i)
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

        if (this.props.state.dessertTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/Dessert">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Dessert</h3>
                    {
                        this.orangeTable(`ERA CRISPY TREATS - Regular - ${DESSERT_REGULAR_PRICE} / Large - ${DESSERT_LARGE_PRICE}`, [
                            {
                                desc: `Regular Crispy Treat - ${this.props.state.crispyTreat.size}`,
                                qty: this.props.state.crispyTreat.quantity,
                                total: this.props.state.crispyTreat.total,
                                size: this.props.state.crispyTreat.size
                            },
                            {
                                desc: `Fruity Pebble - ${this.props.state.fruityPebble.size}`,
                                qty: this.props.state.fruityPebble.quantity,
                                total: this.props.state.fruityPebble.total,
                                size: this.props.state.fruityPebble.size
                            },
                            {
                                desc: `Peanut Butter Chocolate - ${this.props.state.pbChocolate.size}`,
                                qty: this.props.state.pbChocolate.quantity,
                                total: this.props.state.pbChocolate.total,
                                size: this.props.state.pbChocolate.size
                            }
                        ])
                    }

                    
                    {
                        this.orangeTable(`RBI CHIPPER COOKIES - Regular - ${DESSERT_REGULAR_PRICE} / Large - ${DESSERT_LARGE_PRICE}`, [
                            {
                                desc: `Chocolate Chunk - ${this.props.state.chocolateChunkCookie.size}`,
                                qty: this.props.state.chocolateChunkCookie.quantity,
                                total: this.props.state.chocolateChunkCookie.total,
                                size: this.props.state.chocolateChunkCookie.size
                            },
                            {
                                desc: `Sugar - ${this.props.state.sugarCookie.size}`,
                                qty: this.props.state.sugarCookie.quantity,
                                total: this.props.state.sugarCookie.total,
                                size: this.props.state.sugarCookie.size
                            },
                            {
                                desc: `Oatmeal Cranberry - ${this.props.state.cranberryRaisin.size}`,
                                qty: this.props.state.cranberryRaisin.quantity,
                                total: this.props.state.cranberryRaisin.total,
                                size: this.props.state.cranberryRaisin.size
                            }
                        ])
                    }
                    
                    {
                        this.orangeTable(`BATTING AVG MINI CUPCAKES - ${BATTINGAVG_PRICE}`, [
                            {
                                desc: `1 dozen`,
                                qty: this.props.state.battingAverageCupcake.quantity,
                                total: this.props.state.battingAverageCupcake.total,
                                size: this.props.state.battingAverageCupcake.size
                            }
                        ])
                    }

                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.dessertTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(DessertCard);