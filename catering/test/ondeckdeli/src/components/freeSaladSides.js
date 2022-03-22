import React, { Component } from 'react';
import { connect } from "react-redux";

class FreeSaladSides extends Component {

    constructor(props) {
        super(props);
        this.handleSalad = this.handleSalad.bind(this);

        if (this.props.state.playBall !== this.props.state.freeSalads.length) {
            // dispatch default free salads
            this.props.dispatch({ type: 'INIT_FREE_SALAD' });
        }

    }

    handleSalad(event, index) {
        const target = event.target;
        const salad = target.type === 'checkbox' ? target.checked : target.value;


        this.props.dispatch({
            type: 'UPDATE_FREE_SALAD',
            payload: {
                salad: salad,
                index: index,
            }
        });

    }

    freeSaladSides = () => {

        var freeSalads = [];

        for (let index = 0; index < this.props.state.playBall; index++) {

            let element = (
                <tr key={index}>
                    <td>Free Large Salad {index}</td>
                    <td>
                        <select
                            id={index}
                            className="is-invalid"
                            value={this.props.state.freeSalads[index]}
                            onChange={e => this.handleSalad(e, index)}
                        >
                            <option value="Potato Salad">Potato Salad</option>
                            <option value="Romaine &amp; Kale Salad">Romaine &amp; Kale Salad</option>
                            <option value="Black Bean Salad">Black Bean Salad</option>
                            <option value="Ancient Grain Salad">Ancient Grain Salad</option>
                            <option value="Fruit Salad">Fruit Salad</option>
                            <option value="Greek Couscous Salad">Greek Couscous Salad</option>
                            <option value="Chickpea Salad">Chickpea Salad</option>
                            <option value="Asian Noodle Salad">Asian Noodle Salad</option>
                        </select>
                    </td>
                </tr>
            );

            freeSalads.push(element);
        }

        return freeSalads;
    }



    discountsDisclaimer = () => {
        return <div className="alert alert-success" role="alert">Discounts will be deducted at the end.</div>
    }

    render() {
        if (this.props.state.playBall === 0) return null;

        var freeSalads = this.freeSaladSides();

        return (
            <form className="form">
                <div className="card text-center">
                    <div className="card-header">
                        Free Salad Sides
                    </div>
                    <div className="card-body">
                        {this.discountsDisclaimer()}
                        <table className="table">
                            <tbody>
                                {
                                    freeSalads.map((item, i) => {
                                        return item;
                                    })
                                }
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        );
    }
}

const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps)(FreeSaladSides);
