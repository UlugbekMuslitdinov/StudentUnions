import React, { Component } from 'react';
import { connect } from "react-redux";
import { CHIPS_PRICE } from '../../pricing';

class ExtraChips extends Component {

    handleClick = (event) => {
        const target = event.target;
        const value = target.type === 'checkbox' ? target.checked : target.value;

        this.props.dispatch({
            type: 'EXTRA_CHIPS',
            payload: value
        });
    }

    sendQuantity = (e) => {
        this.props.dispatch({
            type: "EXTRA_CHIPS",
            qty: e.target.value
        });
    }

    chipsTable = () => {
        return (
            <div>
                <table className="table">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Extra Chips</td>
                            <td>${CHIPS_PRICE}</td>
                            <td>
                                <input
                                    type="number"
                                    value={this.props.state.extraChips.qty}
                                    className="form-control"
                                    onChange={this.sendQuantity}
                                />
                            </td>
                        </tr>
                        <tr className="">
                            <td colSpan={2}></td>
                            <td>${this.props.state.extraChips.qty * CHIPS_PRICE}</td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                {/* <h3 className="card-title">Sub Total: ${this.props.state.extraChips.qty * CHIPS_PRICE}</h3> */}
            </div>
        );
    }

    render() {

        let content = this.chipsTable();

        if (!this.props.state.extraChips.state) {
            content = (
                <div>
                    <p className="lead">Would you like to add extra chips?</p>
                    <div className="container-fluid">
                        <button className="btn btn-success" value="Yes" onClick={this.handleClick} style={{ margin: '10px' }}>Yes</button>
                        <button className="btn btn-danger" value="No" onClick={this.handleClick} style={{ margin: '10px' }}>No</button>
                    </div>
                </div>
            );
        }


        return (
            <div className="card text-center summary-cards">
                <div className="card-header">
                    <ul className="nav nav-pills card-header-pills"></ul>
                </div>
                <div className="card-body">
                    <h3 className="card-title">Extra Chips</h3>
                    {content}
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(ExtraChips);