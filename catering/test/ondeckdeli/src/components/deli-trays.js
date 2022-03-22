import React, { Component } from 'react';
import { connect } from "react-redux";
import {
    POWERHITTER_REGULAR_PRICE
    , POWERHITTER_LARGE_PRICE
    , PERFECTGAME_PRICE
    , TRIPLECROWN_PRICE
    , QUALITYSTART_PRICE
    , PLAYBALL_PRICE
}
    from '../pricing';

import FreeSaladSides from './freeSaladSides';

const roundTo = require('roundto');

class DeliTrays extends Component {

    constructor(props) {
        super(props);


        this.props.dispatch({
            type: 'navIndex',
            payload: 2
        })


        this.handleInputChange = this.handleInputChange.bind(this);
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;

        this.props.dispatch({
            type: name,
            payload: Number(value)
        });
    }


    render() {
        return (
            <div>
                <div className="white-table">
                    <form className="needs-validation" noValidate="">
                        <table className="table table-bordered">
                            <thead className="thead-orange">
                                <tr>
                                    <th scope="col">Deli Trays</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <thead className="thead-dark">
                                <tr colSpan="4">
                                    <th scope="col" colSpan="4">Meat and Cheese Tray</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row" rowSpan="2">Power Hitter
                                        <p className="text-muted">
                                            ham, turkey, chicken, roast beef,
                                            cheddar, swiss, provolone, pepper jack, pepperoncini, cherry peppers and egg salad.
                                            Comes with an assorted bread roll tray and a lettuce, tomato and onion tray
                                        </p>
                                    </th>
                                    <td>${POWERHITTER_REGULAR_PRICE} (Regular)</td>
                                    <td>
                                        <input
                                            name="powerHitterRegular"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.powerHitterRegular}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        ${
                                            roundTo(this.props.deliTrays.powerHitterRegular
                                                * POWERHITTER_REGULAR_PRICE, 2)
                                        }
                                    </td>
                                </tr>
                                <tr>
                                    <td>${POWERHITTER_LARGE_PRICE} (Large)</td>
                                    <td>
                                        <input
                                            name="powerHitterLarge"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.powerHitterLarge}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        ${
                                            roundTo(this.props.deliTrays.powerHitterLarge
                                                * POWERHITTER_LARGE_PRICE, 2)
                                        }
                                    </td>
                                </tr>

                                <tr colSpan="4" className="thead-dark">
                                    <th scope="col" colSpan="4">Antipasto Trays</th>
                                </tr>
                                <tr>
                                    <th scope="row">Perfect Game
                                        <p className="text-muted">
                                            salami, pepperoni, mortadella, mozzarella balls,
                                            roasted garlic, kalamata olives, cured tomatoes,
                                            roasted artichoke hearts, cherry peppers and
                                            pita chips
                                        </p>
                                    </th>
                                    <td>${PERFECTGAME_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="perfectGame"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.perfectGame}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.deliTrays.perfectGame * PERFECTGAME_PRICE, 2)}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Triple Crown
                                        <p className="text-muted">
                                            salami, pepperoni, mortadella, provolone,
                                            cured tomatoes, roasted garlic, roasted
                                            artichoke hearts, grilled asparagus,
                                            spanish queen olives and mozzarella balls,
                                            lipstick peppers and pita chips
                                        </p>
                                    </th>
                                    <td>${TRIPLECROWN_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="tripleCrown"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.tripleCrown}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.deliTrays.tripleCrown * TRIPLECROWN_PRICE, 2)}</td>
                                </tr>


                                <tr colSpan="4" className="thead-dark">
                                    <th scope="col" colSpan="4">Sandwich Trays</th>
                                </tr>
                                <tr>

                                    <th scope="row">Quality Start
                                        <p className="text-muted">
                                            20 assorted mini sandwiches,
                                            10 bags of chips,
                                            10 pickle spears
                                        </p>
                                    </th>
                                    <td>${QUALITYSTART_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="qualityStart"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.qualityStart}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.deliTrays.qualityStart * QUALITYSTART_PRICE, 2)}</td>
                                </tr>
                                <tr>

                                    <th scope="row">Play Ball
                                        <p className="text-muted">
                                            10 assorted mini sandwiches,
                                            choice of large salad side,
                                            5 bags of chips,
                                            5 pickle spears,
                                            5 cookies
                                        </p>
                                    </th>

                                    <td>${PLAYBALL_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="playBall"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.deliTrays.playBall}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.deliTrays.playBall * PLAYBALL_PRICE, 2)}</td>
                                </tr>


                                <tr>
                                    <td colSpan="3"></td>
                                    <td>${this.props.deliTrays.deliTraysTotal}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>

                {
                    this.props.deliTrays.playBall > 0
                        ? <FreeSaladSides />
                        : null
                }

            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    deliTrays: state
});

export default connect(mapStateToProps)(DeliTrays);