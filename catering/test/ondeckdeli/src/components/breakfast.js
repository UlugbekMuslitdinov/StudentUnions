import React, { Component } from 'react';
import { connect } from "react-redux";

import {
    FASTBALL_PRICE
    , CHANGEUP_PRICE
    , CURVEBALL_REGULAR_PRICE
    , CURVEBALL_LARGE_PRICE
}
    from '../pricing';

class Breakfast extends Component {

    constructor(props) {
        super(props);


        this.props.dispatch({
            type: 'navIndex',
            payload: 0
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

    error = (condition, message) => {
        if (condition){ this.props.breakfast.error = true; }
        else { this.props.breakfast.error = false; }

        return condition
            ? null
            : (<div className="alert alert-danger" role="alert">{message}</div>)
    }

    render() {

        let fastballEight = this.props.breakfast.fastball >= 8 || this.props.breakfast.fastball === 0;
        let changeUpEight = this.props.breakfast.changeUp >= 8 || this.props.breakfast.changeUp === 0;

        let fastballClass = fastballEight ? 'form-control' : 'form-control is-invalid';
        let changeUpClass = changeUpEight ? 'form-control' : 'form-control is-invalid';

        return (
            <div>
                {
                    this.error(fastballEight, 'Fastball: You must select a minimum of 8')
            }
                {
                    this.error(changeUpEight, 'Change Up: You must select a minimum of 8')
                }
                <div className="white-table">
                    <form className="needs-validation" noValidate="">
                        <table className="table table-bordered">
                            <thead className="thead-orange">
                                <tr>
                                    <th scope="col">Breakfast</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    
                                    <th scope="row">Fastball
                                        <p className="text-muted">
                                            (minimum of 8) - buttermilk biscuit, turkey sausage, egg and cheese
                                        </p>
                                    </th>
                                    <td>${FASTBALL_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="fastball"
                                            type="number"
                                            min={0}
                                            className={fastballClass}
                                            aria-label="Quantity"
                                            value={this.props.breakfast.fastball}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.breakfast.fastball * FASTBALL_PRICE * 100) / 100}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Change-up
                                        <p className="text-muted">
                                            (minimum of 8) - whole wheat croissant, egg and cheese
                                        </p>
                                    </th>
                                    <td>${CHANGEUP_PRICE} ea.</td>
                                    <td>
                                        <input
                                            name="changeUp"
                                            type="number"
                                            min={0}
                                            className={changeUpClass}
                                            aria-label="Quantity"
                                            value={this.props.breakfast.changeUp}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.breakfast.changeUp * CHANGEUP_PRICE * 100) / 100}</td>
                                </tr>
                                <tr>
                                    <th scope="row" rowSpan="2">Curveball
                                        <p className="text-muted">
                                            assorted baked goods, fruit salad<br />
                                            reg (serves up to 10)<br />
                                            lg (serves up to 20)
                                        </p>
                                    </th>
                                    <td>${CURVEBALL_REGULAR_PRICE} (Regular)</td>
                                    <td>
                                        <input
                                            name="curveBallRegular"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.breakfast.curveBallRegular}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.breakfast.curveBallRegular * CURVEBALL_REGULAR_PRICE * 100) / 100}</td>
                                </tr>
                                <tr>
                                    <td>${CURVEBALL_LARGE_PRICE} (Large)</td>
                                    <td>
                                        <input
                                            name="curveBallLarge"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.breakfast.curveBallLarge}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.breakfast.curveBallLarge * CURVEBALL_LARGE_PRICE * 100) / 100}</td>
                                </tr>
                                <tr>
                                    <td colSpan="3"></td>
                                    <td>${this.props.breakfast.breakfastTotal}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    breakfast: state
});

export default connect(mapStateToProps)(Breakfast);