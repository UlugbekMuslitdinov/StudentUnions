import React, { Component } from 'react';
import { connect } from "react-redux";
import {MINUTEMAID_PRICE
    ,BOTTLEDDRINKS_PRICE
    ,DASANI_PRICE
    ,COFFEEBOX_PRICE}
    from '../pricing';

const roundTo = require('roundto');

class Beverages extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 1
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

    minuteMaidTotal() {
        let quantity = Number(this.props.beverages.apple) + Number(this.props.beverages.orange) + Number(this.props.beverages.cranberry);
        return roundTo(quantity * MINUTEMAID_PRICE, 2);
    }

    
    bottledDrinksTotal() {
        let quantity = Number(this.props.beverages.coke) + Number(this.props.beverages.dietCoke) + Number(this.props.beverages.sprite);
        return roundTo(quantity * BOTTLEDDRINKS_PRICE, 2);
    }

    coffeeBoxTotal() {
        let quantity = Number(this.props.beverages.neighborhood) + Number(this.props.beverages.vanillaHazelnut) + Number(this.props.beverages.decaf);
        return roundTo(quantity * COFFEEBOX_PRICE, 2);
    }

    render() {
        return (
            <div className="white-table">
                <form className="needs-validation" noValidate="">
                    <table className="table table-bordered">
                        <thead className="thead-orange">
                            <tr>
                                <th scope="col">Beverages</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Minute Maid Juices
                                <br /><br />
                                    <div className="row">
                                        <div className="col">
                                            <label htmlFor="apple">Apple</label>
                                            <input
                                                name="apple"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Apple"
                                                value={this.props.beverages.apple}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="orange">Orange</label>
                                            <input
                                                name="orange"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Orange"
                                                value={this.props.beverages.orange}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="cranberry">Cranberry-Apple</label>
                                            <input
                                                name="cranberry"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Cranberry"
                                                value={this.props.beverages.cranberry}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                    </div>
                                </th>
                                <td>${MINUTEMAID_PRICE} ea.</td>
                                <td>${this.minuteMaidTotal()}</td>
                            </tr>
                            <tr>
                                <th scope="row">Sodas
                                <br /><br />
                                    <div className="row">
                                        <div className="col">
                                            <label htmlFor="coke">Coke</label>
                                            <input
                                                name="coke"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Coke"
                                                value={this.props.beverages.coke}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="dietCoke">Diet Coke</label>
                                            <input
                                                name="dietCoke"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Diet Coke"
                                                value={this.props.beverages.dietCoke}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="sprite">Sprite</label>
                                            <input
                                                name="sprite"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Sprite"
                                                value={this.props.beverages.sprite}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                    </div>
                                </th>
                                <td>${BOTTLEDDRINKS_PRICE} ea.</td>
                                <td>${this.bottledDrinksTotal()}</td>
                            </tr>
                            <tr>
                                <th scope="row">Dasani Water<br /><br />
                                <div className="col-sm-3">
                                    <input
                                        name="dasani"
                                        type="number"
                                        className="form-control"
                                        aria-label="Dasani Water"
                                        value={this.props.beverages.dasani}
                                        onChange={this.handleInputChange}
                                    />
                                </div>
                                </th>
                                <td>${DASANI_PRICE} ea.</td>
                                <td>${Math.round(this.props.beverages.dasani * DASANI_PRICE * 100) / 100}</td>
                            </tr>
                            <tr>
                                <th scope="row">Einsteins 96oz. Coffee Box
                                <br />
                                <br />
                                    <div className="row">
                                        <div className="col">
                                            <label htmlFor="neighborhood">Neighborhood Blend</label>
                                            <input
                                                name="neighborhood"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Neighborhood Blend"
                                                value={this.props.beverages.neighborhood}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="vanillaHazelnut">Vanilla Hazelnut</label>
                                            <input
                                                name="vanillaHazelnut"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Vanilla Hazelnut"
                                                value={this.props.beverages.vanillaHazelnut}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                        <div className="col">
                                            <label htmlFor="decaf">Decaf</label>
                                            <input
                                                name="decaf"
                                                type="number"
                                                min={0}
                                                className="form-control"
                                                aria-label="Decaf"
                                                value={this.props.beverages.decaf}
                                                onChange={this.handleInputChange}
                                            />
                                        </div>
                                    </div>

                                    <br />
                                    <p className="text-muted">
                                    Your choice of one of our 4 Fresh-Brewed Coffee Blends
                                    conveniently served in a portable &amp; pourable box
                                    (includes cups, lids, half &amp; half, sweeteners &amp; stir sticks).
                                    Choose from Neighborhood Blend, Neighborhood Decaf,
                                    Vanilla Hazelnut or Seasonal.
                                    </p>
                                </th>
                                <td>${COFFEEBOX_PRICE} ea.</td>
                                <td>${this.coffeeBoxTotal()}</td>
                            </tr>
                            <tr>
                                <td colSpan="2"></td>
                                <td>${this.props.beverages.beverageTotal}</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        );
    }
}


const mapStateToProps = (state) => ({
    beverages: state
});

export default connect(mapStateToProps)(Beverages);
