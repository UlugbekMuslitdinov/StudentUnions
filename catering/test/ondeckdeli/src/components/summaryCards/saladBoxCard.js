import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    SALADBOX_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class SaladBoxCard extends Component {

    constructor(props) {
        super(props);
        this.dressings = this.dressings.bind(this);
    }

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
            total += (SALADBOX_PRICE * item.qty);
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
                        <th className="" colSpan={4}>Salads</th>
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
                                return this.rowElement(item.desc, item.qty, SALADBOX_PRICE, false, i)
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

    dressingElement = (name, qty, error) => {
        if (qty === 0) return null;

        return (
            <tr className={error ? 'table-danger' : ''}>
                <td>{name}</td>
                <td>{qty}</td>
            </tr>
        );
    }

    dressings = (error) => {

        let total = (
            this.props.state.ranch
            + this.props.state.italian
            + this.props.state.caesar
        );

        if(total === 0) return null;

        return (
            <table className="table" style={{ marginTop: '15px' }}>
                <thead>
                    <tr>
                        <th scope="col" className="" colSpan={3}>Dressings</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Quantity</th>
                    </tr>
                    {
                        this.dressingElement("Ranch", this.props.state.ranch, error)
                    }
                    {
                        this.dressingElement("Italian", this.props.state.italian, error)
                    }
                    {
                        this.dressingElement("Caesar", this.props.state.caesar, error)
                    }
                </tbody>
            </table>
        );
    }


    render() {

        let salads = (
            this.props.state.cobSalad
            + this.props.state.chefSalad
            + this.props.state.caesarSalad
            + this.props.state.veggieSalad
        );

        let dressings = (
            this.props.state.ranch
            + this.props.state.italian
            + this.props.state.caesar
        );

        if (this.props.state.greenSaladTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/SaladBoxes">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Salad Boxes</h3>

                    {
                        salads !== dressings
                            ? <div class="alert alert-danger" role="alert">You must select 1 dressing per salad ordered.</div>
                            : null
                    }

                    {
                        this.whiteTable([
                            {
                                desc: `Stolen Base - Cobb Salad`,
                                qty: this.props.state.cobSalad
                            },
                            {
                                desc: `Base on Balls - Chef Salad`,
                                qty: this.props.state.chefSalad
                            },
                            {
                                desc: `Fowl Ball - Caesar Salad`,
                                qty: this.props.state.caesarSalad
                            },
                            {
                                desc: `Double Play - Veggie Salad`,
                                qty: this.props.state.veggieSalad
                            }
                        ])
                    }

                    {
                        this.dressings(salads !== dressings)
                    }

                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.greenSaladTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(SaladBoxCard);