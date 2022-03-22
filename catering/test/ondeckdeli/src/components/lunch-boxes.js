import React, { Component } from 'react';
import { connect } from "react-redux";
import { LUNCHBOX_PRICE } from '../pricing';

class LunchBoxes extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 5
        })

        this.handleInputChange = this.handleInputChange.bind(this);
    }primary

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

                <div className="alert alert-warning">
                    <p className="lead">
                        Each boxed lunch includes a 6” Sub, bag of
                        chips, condiments, pickle, cookie, piece of fruit
                        and a unique toy.
                </p>
                </div>
                <div className="white-table">
                    <form className="needs-validation" noValidate="">
                        <table className="table table-bordered">
                            <thead className="thead-orange">
                                <tr>
                                    <th scope="col">Lunch Boxes - ${LUNCHBOX_PRICE} ea.</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">Batter Up
                                        <p className="text-muted">
                                            roasted turkey breast, provolone, lettuce and tomato
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="batterUp"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Batter Up Quantity"
                                            value={this.props.lunchBox.batterUp}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.batterUp * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>


                                <tr>
                                    <th scope="row">Infield Fly
                                        <p className="text-muted">
                                            chunky chicken salad, lettuce and tomato
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="infieldFly"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Infield Fly Up Quantity"
                                            value={this.props.lunchBox.infieldFly}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.infieldFly * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>


                                <tr>
                                    <th scope="row">Safe Call
                                        <p className="text-muted">
                                            albacore tuna salad, lettuce and tomato
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="safeCall"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Safe Call Quantity"
                                            value={this.props.lunchBox.safeCall}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.safeCall * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>


                                <tr>
                                    <th scope="row">Fair Ball
                                        <p className="text-muted">
                                            baked ham, swiss, lettuce and tomato
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="fairBall"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Fair Ball Quantity"
                                            value={this.props.lunchBox.fairBall}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.fairBall * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>


                                <tr>
                                    <th scope="row">Outfielder
                                        <p className="text-muted">
                                            roast beef, provolone, lettuce and tomato
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="outfielder"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Outfielder Quantity"
                                            value={this.props.lunchBox.outfielder}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.outfielder * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>



                                <tr>
                                    <th scope="row">Ground Rule
                                        <p className="text-muted">
                                            avocado, hummus, tomato, sprouts, cucumber, lettuce and carrots
                                        </p>
                                    </th>
                                    <td>
                                        <input
                                            name="groundRule"
                                            type="number"
                                            min={0}
                                            className='form-control'
                                            aria-label="Ground Rule Quantity"
                                            value={this.props.lunchBox.groundRule}
                                            onChange={this.handleInputChange}
                                        />
                                    </td>
                                    <td>${Math.round(this.props.lunchBox.groundRule * LUNCHBOX_PRICE * 100) / 100}</td>
                                </tr>


                                <tr>
                                    <td colSpan="2"></td>
                                    <td>${this.props.lunchBox.lunchBoxTotal}</td>
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
    lunchBox: state
});

export default connect(mapStateToProps)(LunchBoxes);
