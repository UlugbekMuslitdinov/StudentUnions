import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    REGULAR_SALAD_PRICE
    , LARGE_SALAD_PRICE
    , ASTAR_REGULAR_SALAD_PRICE
    , ASTAR_LARGE_SALAD_PRICE
} from '../../pricing.js';

import { Link } from "react-router-dom";

const roundTo = require('roundto');

class SaladSidesCard extends Component {

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

        if (this.props.state.saladSidesTotal === 0)
            return null;

        return (
            <div className="card text-left summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills">
                        <li className="nav-item">
                            <Link className="nav-link" to="/SaladSides">Edit</Link>
                        </li>
                    </ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">- Salad Sides</h3>
                    {
                        this.orangeTable(`REGULAR SEASON: Regular - ${REGULAR_SALAD_PRICE} / Large - ${LARGE_SALAD_PRICE}`, [
                            {
                                desc: `Potato Salad`,
                                qty: this.props.state.potatoSalad.quantity,
                                total: this.props.state.potatoSalad.total,
                                size: this.props.state.potatoSalad.size
                            },
                            {
                                desc: `Pasta Salad`,
                                qty: this.props.state.pastaSalad.quantity,
                                total: this.props.state.pastaSalad.total,
                                size: this.props.state.pastaSalad.size
                            },
                            {
                                desc: `Macaroni Salad`,
                                qty: this.props.state.macaroniSalad.quantity,
                                total: this.props.state.macaroniSalad.total,
                                size: this.props.state.macaroniSalad.size
                            },
                            {
                                desc: `Romaine Salad`,
                                qty: this.props.state.romaineSalad.quantity,
                                total: this.props.state.romaineSalad.total,
                                size: this.props.state.romaineSalad.size
                            },
                            {
                                desc: `Black Bean Salad`,
                                qty: this.props.state.blackBeanSalad.quantity,
                                total: this.props.state.blackBeanSalad.total,
                                size: this.props.state.blackBeanSalad.size
                            }
                        ])
                    }

                    {
                        this.orangeTable(`ALL-STAR: Regular - ${ASTAR_REGULAR_SALAD_PRICE} / Large - ${ASTAR_LARGE_SALAD_PRICE}`, [
                            {
                                desc: `Ancient Greek Salad`,
                                qty: this.props.state.ancientGrainSalad.quantity,
                                total: this.props.state.ancientGrainSalad.total,
                                size: this.props.state.ancientGrainSalad.size
                            },
                            {
                                desc: `Fruit Salad`,
                                qty: this.props.state.fruitSalad.quantity,
                                total: this.props.state.fruitSalad.total,
                                size: this.props.state.fruitSalad.size
                            },
                            {
                                desc: `Greek Couscous Salad`,
                                qty: this.props.state.greekSalad.quantity,
                                total: this.props.state.greekSalad.total,
                                size: this.props.state.greekSalad.size
                            },
                            {
                                desc: `Chickpea Salad`,
                                qty: this.props.state.chickpeaSalad.quantity,
                                total: this.props.state.chickpeaSalad.total,
                                size: this.props.state.chickpeaSalad.size
                            },
                            {
                                desc: `Asian Noodle Salad`,
                                qty: this.props.state.asianSalad.quantity,
                                total: this.props.state.asianSalad.total,
                                size: this.props.state.asianSalad.size
                            }
                        ])
                    }
                    <hr />
                    {/* <h3 className="card-title">Sub Total: ${this.props.state.saladSidesTotal}</h3> */}
                </div>
            </div>
        )
    }
}


const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(SaladSidesCard);