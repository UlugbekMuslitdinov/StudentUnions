import React, { Component } from 'react';
import { connect } from "react-redux";
import {
    REGULAR_SALAD_PRICE
    , LARGE_SALAD_PRICE
    , ASTAR_REGULAR_SALAD_PRICE
    , ASTAR_LARGE_SALAD_PRICE
}
    from '../pricing';

class SaladSides extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 3
        })

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSizeChange = this.handleSizeChange.bind(this);
    }

    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const salad = target.name;
        const size = this.props.saladSides[salad].size;

        this.props.dispatch({
            type: "SALAD_SIDES",
            payload: {
                salad: salad,
                quantity: value,
                size: size
            }
        });
    }

    handleSizeChange(event) {
        const target = event.target;
        const size = target.value;
        const salad = target.id;
        const quantity = this.props.saladSides[salad].quantity;

        this.props.dispatch({
            type: "SALAD_SIDES",
            payload: {
                salad: salad,
                quantity: quantity,
                size: size
            }
        });
    }

    render() {
        return (
                <div className="white-table">
                    <form className="needs-validation" noValidate="">
                        <table className="table table-bordered">
                            <thead className="thead-orange">
                                <tr>
                                    <th scope="col">Salad Sides</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Size</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <thead className="thead-dark">
                                <tr colSpan="4">
                                    <th scope="col" colSpan="4">
                                        REGULAR SEASON: Regular - ${REGULAR_SALAD_PRICE} or Large - ${LARGE_SALAD_PRICE}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <th scope="row">Potato Salad</th>
                                    <td>
                                        <input
                                            name="potatoSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.potatoSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.potatoSalad.size}
                                            className="form-control"
                                            id="potatoSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>

                                    <td>
                                        ${this.props.saladSides.potatoSalad.total}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Pasta Salad</th>
                                    <td>
                                        <input
                                            name="pastaSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.pastaSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.pastaSalad.size}
                                            className="form-control"
                                            id="pastaSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.pastaSalad.total}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Macaroni Salad</th>
                                    <td>
                                        <input
                                            name="macaroniSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.macaroniSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.macaroniSalad.size}
                                            className="form-control"
                                            id="macaroniSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.macaroniSalad.total}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Romaine &amp; Kale Salad</th>
                                    <td>
                                        <input
                                            name="romaineSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.romaineSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.romaineSalad.size}
                                            className="form-control"
                                            id="romaineSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>

                                    <td>
                                        ${this.props.saladSides.romaineSalad.total}
                                    </td>
                                </tr>

                                <tr>
                                    <th scope="row">Black Bean Salad</th>
                                    <td>
                                        <input
                                            name="blackBeanSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.blackBeanSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.blackBeanSalad.size}
                                            className="form-control"
                                            id="blackBeanSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.blackBeanSalad.total}
                                    </td>
                                </tr>



                                <tr colSpan="4" className="thead-dark">
                                    <th scope="col" colSpan="4">
                                        ALL-STAR: Regular - ${ASTAR_REGULAR_SALAD_PRICE} or Large - ${ASTAR_LARGE_SALAD_PRICE}
                                    </th>
                                </tr>

                                <tr>
                                    <th scope="row">Ancient Grain Salad</th>
                                    <td>
                                        <input
                                            name="ancientGrainSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.ancientGrainSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.ancientGrainSalad.size}
                                            className="form-control"
                                            id="ancientGrainSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.ancientGrainSalad.total}
                                    </td>
                                </tr>



                                <tr>
                                    <th scope="row">Fruit Salad</th>
                                    <td>
                                        <input
                                            name="fruitSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.fruitSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.fruitSalad.size}
                                            className="form-control"
                                            id="fruitSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.fruitSalad.total}
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="row">Greek Couscous Salad</th>
                                    <td>
                                        <input
                                            name="greekSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.greekSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.greekSalad.size}
                                            className="form-control"
                                            id="greekSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.greekSalad.total}
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="row">Chickpea Salad</th>
                                    <td>
                                        <input
                                            name="chickpeaSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.chickpeaSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.chickpeaSalad.size}
                                            className="form-control"
                                            id="chickpeaSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.chickpeaSalad.total}
                                    </td>
                                </tr>


                                <tr>
                                    <th scope="row">Asian Noodle Salad</th>
                                    <td>
                                        <input
                                            name="asianSalad"
                                            type="number"
                                            min={0}
                                            className="form-control"
                                            aria-label="Quantity"
                                            value={this.props.saladSides.asianSalad.quantity}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>
                                        <select
                                            value={this.props.saladSides.asianSalad.size}
                                            className="form-control"
                                            id="asianSalad"
                                            onChange={this.handleSizeChange}
                                        >
                                            <option>Regular</option>
                                            <option>Large</option>
                                        </select>
                                    </td>
                                    <td>
                                        ${this.props.saladSides.asianSalad.total}
                                    </td>
                                </tr>


                                <tr>
                                    <td colSpan="3"></td>
                                    <td>${this.props.saladSides.saladSidesTotal}</td>
                                </tr>
                            </tbody>
                        </table>
                    </form>
                </div>
        );
    }
}

const mapStateToProps = (state) => ({
    saladSides: state
});

export default connect(mapStateToProps)(SaladSides);
