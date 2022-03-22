import React, { Component } from 'react';
import { connect } from "react-redux";
import { submitForm } from '../api';
import Loader from 'react-loader-spinner';

class Confirmation extends Component {

    constructor(props) {
        super(props);

        this.props.dispatch({
            type: 'navIndex',
            payload: 9
        })
    }

    componentDidMount() {
        this.props.submitForm(this.props.state);
    }

    render() {

        let load = (
            <div className='text-center' style={{padding: '20px'}}>
                <Loader
                    type="Bars"
                    color="#f59525"
                    height="100"
                    width="100"
                />
            </div>
        );

        let data;

        let confirmation = this.props.state.confirmation;

        if (confirmation !== {}) {
            data = (
                <div className="card" style={{marginBottom: '15px'}}>
                    <div className="card-body">
                        <p className="card-title display-4">
                            Thank you
                        </p>
                        <div className="card-text">
                            <p className="lead">
                                Your order is confirmed. For your convenience, an email has been sent to {confirmation.email}
                            </p>
                            <table className="table">
                                <thead>
                                    <tr>
                                        <td>Order ID</td>
                                        <td>{confirmation.orderID}</td>
                                    </tr>
                                </thead>
                            </table>
                            <div className="text-center" style={{ paddingBottom: "10px" }}>
                                <a className="btn btn-lg btn-orange" href="/">Back to Main Site</a>
                                <a className="btn btn-lg btn-orange" href="/dining/sumc/ondeck">Back to On Deck Deli</a>
                                <a className="btn btn-lg btn-orange" href="/catering/online_order">Order Again</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
            );
        }

        let content = this.props.state.loading ? load : data;

        return <div>{content}</div>;
    }
}

const mapDispatchToProps = dispatch => (
    {
        submitForm: (state) => dispatch(submitForm(state)),
        dispatch: (obj) => dispatch(obj)
    }
)

const mapStateToProps = (state) => ({
    state: state
});

export default connect(mapStateToProps, mapDispatchToProps)(Confirmation);