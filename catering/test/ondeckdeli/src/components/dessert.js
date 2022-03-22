import React, { Component } from 'react';
import { connect } from "react-redux";
import { DESSERT_LARGE_PRICE, DESSERT_REGULAR_PRICE, BATTINGAVG_PRICE } from '../pricing';

class Desserts extends Component {
    
    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 6
        })

        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleSizeChange = this.handleSizeChange.bind(this);
    }

    
    handleInputChange(event) {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;
        const name = target.name;
    
        this.props.dispatch({
          type: 'DESSERT',
          payload: {
              dessert: name,
              size: this.props.desserts[name].size,
              quantity: Number(value)
          }
        });
    }

    handleSizeChange(event) {
        const target = event.target;
        const value = target.value;
        const dessert = target.id;

    
        this.props.dispatch({
          type: "DESSERT",
          payload: {
              dessert: dessert,
              size: value,
              quantity: this.props.desserts[dessert].quantity
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
                                <th scope="col">Dessert - Regular - ${DESSERT_REGULAR_PRICE} or Large - ${DESSERT_LARGE_PRICE} </th>
                                <th scope="col" rowSpan="2">Quantity</th>
                                <th scope="col" rowSpan="2">Size</th>
                                <th scope="col" rowSpan="2">Total</th>
                            </tr>
                        </thead>
                        <thead className="thead-dark">
                            <tr colSpan="4">
                                <th scope="col" colSpan="4">ERA CRISPY TREATS</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">Regular</th>
                            <td>
                                <input
                                    name="crispyTreat"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Regular Crispy Treats"
                                    value={this.props.desserts.crispyTreat.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.crispyTreat.size}
                                    className="form-control"
                                    id="crispyTreat"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.crispyTreat.total}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Fruity Pebble</th>
                            <td>
                                <input
                                    name="fruityPebble"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Fruity Pebble Crispy Treats"
                                    value={this.props.desserts.fruityPebble.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.fruityPebble.size}
                                    className="form-control"
                                    id="fruityPebble"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.fruityPebble.total}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Peanut Butter Chocolate</th>
                            <td>
                                <input
                                    name="pbChocolate"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Peanut Butter Chocolate Crispy Treats"
                                    value={this.props.desserts.pbChocolate.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.pbChocolate.size}
                                    className="form-control"
                                    id="pbChocolate"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.pbChocolate.total}</td>
                        </tr>
                        

                        <tr colSpan="4" className="thead-dark">
                            <th scope="col" colSpan="4">RBI CHIPPER COOKIES</th>
                        </tr>

                        
                        <tr>
                            <th scope="row">Chocolate Chunk</th>
                            <td>
                                <input
                                    name="chocolateChunkCookie"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Chocolate Chunk cookie quantity"
                                    value={this.props.desserts.chocolateChunkCookie.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.chocolateChunkCookie.size}
                                    className="form-control"
                                    id="chocolateChunkCookie"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.chocolateChunkCookie.total}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Sugar</th>
                            <td>
                                <input
                                    name="sugarCookie"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Sugar cookie quantity"
                                    value={this.props.desserts.sugarCookie.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.sugarCookie.size}
                                    className="form-control"
                                    id="sugarCookie"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.sugarCookie.total}</td>
                        </tr>
                        
                        <tr>
                            <th scope="row">Oatmeal Cranberry</th>
                            <td>
                                <input
                                    name="cranberryRaisin"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Sugar cookie quantity"
                                    value={this.props.desserts.cranberryRaisin.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td>
                            <select
                                    value={this.props.desserts.cranberryRaisin.size}
                                    className="form-control"
                                    id="cranberryRaisin"
                                    onChange={this.handleSizeChange}
                                >
                                    <option>Regular</option>
                                    <option>Large</option>
                                </select>
                            </td>
                            <td>${this.props.desserts.cranberryRaisin.total}</td>
                        </tr>
                        
                        <tr colSpan="4" className="thead-dark">
                            <th scope="col" colSpan="4">BATTING AVG MINI CUPCAKES</th>
                        </tr>
                        <tr>
                            <th scope="row">1 dozen - ${BATTINGAVG_PRICE}</th>
                            <td>
                                <input
                                    name="battingAverageCupcake"
                                    type="number"
                                    min={0}
                                    className="form-control"
                                    aria-label="Batting average mini cupcakes quantity"
                                    value={this.props.desserts.battingAverageCupcake.quantity}
                                    onChange={this.handleInputChange}
                                />
                            </td>
                            <td></td>
                            <td>${this.props.desserts.battingAverageCupcake.total}</td>
                        </tr>

                        <tr>
                            <td colSpan="3"></td>
                            <td>${this.props.desserts.dessertTotal}</td>
                        </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    desserts: state
});

export default connect(mapStateToProps)(Desserts);