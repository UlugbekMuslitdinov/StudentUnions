import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    MINUTEMAID_PRICE
    , BOTTLEDDRINKS_PRICE
    , DASANI_PRICE
    , COFFEEBOX_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class BeverageCard extends Component {

    rowElement = (name, quantity, price) => {
        return (
            <tr>
                <td>{name}</td>
                <td>{quantity}</td>
                <td className="text-right">${roundTo(quantity * price, 2)}</td>
            </tr>
        );
    }

    bottledDrinks = () => {
        let bottledDrinks = (
            this.props.state.coke
            + this.props.state.dietCoke
            + this.props.state.sprite
        );

        if (bottledDrinks === 0)
            return null;

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th className="" colSpan="3">Sodas - ${BOTTLEDDRINKS_PRICE}</th>
                    </tr>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        this.props.state.coke > 0
                            ? this.rowElement('Apple', this.props.state.coke, BOTTLEDDRINKS_PRICE)
                            : null
                    }
                    {
                        this.props.state.dietCoke > 0
                            ? this.rowElement('Diet Coke', this.props.state.dietCoke, BOTTLEDDRINKS_PRICE)
                            : null
                    }
                    {
                        this.props.state.sprite > 0
                            ? this.rowElement('Sprite', this.props.state.sprite, BOTTLEDDRINKS_PRICE)
                            : null
                    }
                    <tr>
                        <td colSpan="2" className=""></td>
                        <th className="text-right">${roundTo(bottledDrinks * BOTTLEDDRINKS_PRICE, 2)}</th>
                    </tr>
                </tbody>
            </table>
        );
    }

    einsteinCoffeeBox = () => {

        let total = this.props.state.neighborhood
        + this.props.state.vanillaHazelnut
        + this.props.state.decaf;

        if(total === 0) {
            return null;
        }

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th className="" colSpan="3">Einsteins 96oz. Coffee Box - ${COFFEEBOX_PRICE}</th>
                    </tr>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" className="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        this.props.state.neighborhood > 0
                            ? this.rowElement('Neighborhood Blend', this.props.state.neighborhood, COFFEEBOX_PRICE)
                            : null
                    }
                    {
                        this.props.state.vanillaHazelnut > 0
                            ? this.rowElement('Vanilla Hazelnut', this.props.state.vanillaHazelnut, COFFEEBOX_PRICE)
                            : null
                    }
                    {
                        this.props.state.decaf > 0
                            ? this.rowElement('Decaf', this.props.state.decaf, COFFEEBOX_PRICE)
                            : null
                    }
                    <tr>
                        <td colSpan="2" className=""></td>
                        <th className="text-right">${roundTo(total * COFFEEBOX_PRICE, 2)}</th>
                    </tr>
                </tbody>
            </table>
        );
    }

    minuteMaid = () => {
        let minuteMaid = (
            this.props.state.apple
            + this.props.state.orange
            + this.props.state.cranberry
        );

        if (minuteMaid === 0)
            return null;

        return (
            <table className="table">
                <thead>
                    <tr>
                        <th className="" colSpan="3">Minute Maid Juices - ${MINUTEMAID_PRICE}</th>
                    </tr>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                        <th scope="col" className="text-right">Total</th>
                    </tr>
                </thead>
                <tbody>
                    {
                        this.props.state.apple > 0
                            ? this.rowElement('Apple', this.props.state.apple, MINUTEMAID_PRICE)
                            : null
                    }
                    {
                        this.props.state.orange > 0
                            ? this.rowElement('Orange', this.props.state.orange, MINUTEMAID_PRICE)
                            : null
                    }
                    {
                        this.props.state.cranberry > 0
                            ? this.rowElement('Cranberry-Apple', this.props.state.cranberry, MINUTEMAID_PRICE)
                            : null
                    }
                    <tr>
                        <td colSpan="2" className=""></td>
                        <th className="text-right">${roundTo(minuteMaid * MINUTEMAID_PRICE, 2)}</th>
                    </tr>
                </tbody>
            </table>
        );
    }

    render() {

        if (this.props.state.beverageTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/Beverages">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Beverages</h3>
                    {
                        this.minuteMaid()
                    }
                    {
                        this.bottledDrinks()
                    }
                    {
                        this.props.state.water > 0
                            ? this.rowElement('Dasani Water', this.props.state.water, DASANI_PRICE)
                            : null
                    }
                    {
                        this.einsteinCoffeeBox()
                    }
                    
                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.beverageTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(BeverageCard);