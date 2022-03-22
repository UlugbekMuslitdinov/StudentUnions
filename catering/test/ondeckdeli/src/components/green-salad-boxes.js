import React, { Component } from 'react';
import { connect } from "react-redux";
import { SALADBOX_PRICE } from '../pricing';

const roundTo = require('roundto');

class SaladBoxes extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 4
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
        let saladQuantity = (this.props.greenSalad.cobSalad
            + this.props.greenSalad.chefSalad
            + this.props.greenSalad.caesarSalad
            + this.props.greenSalad.veggieSalad);

        let dressingQuantity = (
            this.props.greenSalad.ranch
            + this.props.greenSalad.italian
            + this.props.greenSalad.caesar
        );

        let oneDressingPerSalad = Math.abs(saladQuantity - dressingQuantity) === 0;

        let dressingValidationClass = oneDressingPerSalad ? 'form-control' : 'form-control is-invalid';

        if (saladQuantity !== dressingQuantity){ this.props.greenSalad.error = true; }
        else { this.props.greenSalad.error = false; }

        return (
            <div>

                <div className="alert alert-warning">
                    <p className="lead">
                        Each boxed green salad includes a 6oz. salad,
                        choice of dressing (Ranch, Italian, Caesar), a roll,
                        pickle, cookie, piece of fruit and a unique toy.
                    </p>
                </div>
                {
                    oneDressingPerSalad
                        ? null
                        : (<div className="alert alert-danger" role="alert">You must select 1 dressing per salad ordered.</div>)
                }
                <div className="white-table">
                    <form className="needs-validation" noValidate="">
                        <table className="table table-bordered">
                            <thead className="thead-orange">
                                <tr>
                                    <th scope="col">Green Salad Boxes - ${SALADBOX_PRICE} ea.</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Stolen Base
                                        <p className="text-muted">
                                            chicken, red bell pepper, bacon bits, blue cheese,
                                            boiled egg, grape tomato and romaine lettuce
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="cobSalad"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Quantity"
                                            value={this.props.greenSalad.cobSalad}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.greenSalad.cobSalad * SALADBOX_PRICE, 2)}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Base on Balls
                                        <p className="text-muted">
                                            boiled egg, grape tomato, shredded cheddar, monterey
                                            jack, ham, turkey, black olives and romaine lettuce
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="chefSalad"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Quantity"
                                            value={this.props.greenSalad.chefSalad}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.greenSalad.chefSalad * SALADBOX_PRICE, 2)}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Fowl Ball
                                        <p className="text-muted">
                                            chicken, soy nuts, parmesan cheese, pea sprouts
                                            and romaine lettuce
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="caesarSalad"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Quantity"
                                            value={this.props.greenSalad.caesarSalad}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.greenSalad.caesarSalad * SALADBOX_PRICE, 2)}</td>
                                </tr>

                                <tr>
                                    <th scope="row">Double Play
                                        <p className="text-muted">
                                            grape tomato, broccoli, radish, cucumber, carrot, cabbage
                                            and romaine lettuce
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="veggieSalad"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Quantity"
                                            value={this.props.greenSalad.veggieSalad}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${roundTo(this.props.greenSalad.veggieSalad * SALADBOX_PRICE, 2)}</td>
                                </tr>

                                <tr>
                                    <th scope="row" colSpan="2">Dressing: (select one dressing per salad ordered)
                                <br /><br />
                                        <div className="row">
                                            <div className="col">
                                                <label htmlFor="ranch">Ranch</label>
                                                <input
                                                    name="ranch"
                                                    type="number"
                                                    min={0}
                                                    className={dressingValidationClass}
                                                    aria-label="Ranch"
                                                    value={this.props.greenSalad.ranch}
                                                    onChange={this.handleInputChange}
                                                />
                                            </div>
                                            <div className="col">
                                                <label htmlFor="italian">Italian</label>
                                                <input
                                                    name="italian"
                                                    type="number"
                                                    min={0}
                                                    className={dressingValidationClass}
                                                    aria-label="Italian"
                                                    value={this.props.greenSalad.italian}
                                                    onChange={this.handleInputChange}
                                                />
                                            </div>
                                            <div className="col">
                                                <label htmlFor="caesar">Caesar</label>
                                                <input
                                                    name="caesar"
                                                    type="number"
                                                    min={0}
                                                    className={dressingValidationClass}
                                                    aria-label="Caesar"
                                                    value={this.props.greenSalad.caesar}
                                                    onChange={this.handleInputChange}
                                                />
                                            </div>
                                        </div>
                                    </th>
                                    <td></td>
                                </tr>

                                <tr>
                                    <td colSpan="2"></td>
                                    <td>${this.props.greenSalad.greenSaladTotal}</td>
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
    greenSalad: state
});

export default connect(mapStateToProps)(SaladBoxes);
