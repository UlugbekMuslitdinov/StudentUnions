import React, { Component } from 'react';
import { connect } from "react-redux";
import { SUBSANDWICH_PRICE } from '../pricing';


class SubSandwiches extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 7
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
            <div className="white-table">
                <form className="needs-validation" noValidate="">
                    <table className="table table-bordered">
                        <thead className="thead-orange">
                            <tr>
                                <th scope="col">18" Sub Sandwiches - ${SUBSANDWICH_PRICE} ea. (serves 3-5)</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Leadoff
                                        <p className="text-muted">
                                        peppered turkey, provolone, pepperoncini and coleslaw
                                        </p>
                                </th>
                                <td>
                                    <input
                                        name="leadOff"
                                        type="number"
                                        min={0}
                                        className="form-control"
                                        aria-label="Leadoff Quantity"
                                        value={this.props.subSandwiches.leadOff}
                                        onChange={this.handleInputChange}
                                    />
                                </td>
                                <td>${Math.round(this.props.subSandwiches.leadOff * SUBSANDWICH_PRICE * 100) / 100}</td>
                            </tr>


                            <tr>
                                <th scope="row">On Deck
                                    <p className="text-muted">
                                        Italian dressing, lettuce, tomato, mortadella, salami,
                                        provolone and pepperoni
                                    </p>
                                </th>
                                <td>
                                    <input
                                        name="onDeck"
                                        type="number"
                                        min={0}
                                        className="form-control"
                                        aria-label="On Deck Quantity"
                                        value={this.props.subSandwiches.onDeck}
                                        onChange={this.handleInputChange}
                                    />
                                </td>
                                <td>${Math.round(this.props.subSandwiches.onDeck * SUBSANDWICH_PRICE * 100) / 100}</td>
                            </tr>


                            <tr>
                                <th scope="row">In The Hole
                                    <p className="text-muted">
                                        avocado, hummus, tomato, sprouts, cucumber,
                                        lettuce and carrots
                                    </p>
                                </th>
                                <td>
                                    <input
                                        name="inTheHole"
                                        type="number"
                                        min={0}
                                        className="form-control"
                                        aria-label="In The Hole Quantity"
                                        value={this.props.subSandwiches.inTheHole}
                                        onChange={this.handleInputChange}
                                    />
                                </td>
                                <td>${Math.round(this.props.subSandwiches.inTheHole * SUBSANDWICH_PRICE * 100) / 100}</td>
                            </tr>


                            <tr>
                                <td colSpan="2"></td>
                                <td>${this.props.subSandwiches.subSandwichTotal}</td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    subSandwiches: state
});

export default connect(mapStateToProps)(SubSandwiches);
