import React, {Component} from 'react';
import {connect} from 'react-redux';

const roundTo = require('roundto');

class TotalCard extends Component {

    render() {
        return (
            <div className="card text-center">
                <div className="card-body">
                    <hr />

                    <div className="col-lg-4 col-sm-5 ml-auto">
                        <table className="table table-clear">
                            <tbody>

                                <tr>
                                    <td className="left text-right">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td className="right text-right">$ { this.props.state.orderTotal }</td>
                                </tr>

                                <tr>
                                    <td className="left text-right">
                                        <strong>Tax (10%)</strong>
                                    </td>
                                    <td className="right text-right">$ { roundTo(this.props.state.orderTotal * 0.10,2) }</td>
                                </tr>
                            
                                <tr>
                                    <td className="left text-right">
                                        <strong>Total</strong>
                                    </td>
                                    <td className="right text-right">
                                        <strong>$ { roundTo(this.props.state.orderTotal + this.props.state.orderTotal * 0.10,2) }</strong>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        )
    }

}

const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(TotalCard);