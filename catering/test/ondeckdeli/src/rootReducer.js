import {calculateBreakfastTotal,
    calculateBeverageTotal,
    calculateDeliTraysTotal,
    calculateSaladBoxes,
    calculateSaladSides,
    REGULAR_SALAD_PRICE,
    LARGE_SALAD_PRICE,
    ASTAR_REGULAR_SALAD_PRICE,
    ASTAR_LARGE_SALAD_PRICE,
    calculateLunchbox,
    DESSERT_REGULAR_PRICE,
    DESSERT_LARGE_PRICE,
    calculateDessert,
    calculateSubSandwiches,
    BATTINGAVG_PRICE,
    CHIPS_PRICE
} from './pricing';

import { INITIAL_STATE } from './state';

const roundTo = require('roundto');


const initialState = INITIAL_STATE;

function saladSidePrice(size, quantity, astar) {
    if(!astar) {
        if(size === 'Regular') {
            return roundTo(REGULAR_SALAD_PRICE * quantity, 2);
        } else {
            return roundTo(LARGE_SALAD_PRICE * quantity, 2);
        }
    } else {
        if(size === 'Regular') {
            return roundTo(ASTAR_REGULAR_SALAD_PRICE * quantity, 2);
        } else {
            return roundTo(ASTAR_LARGE_SALAD_PRICE * quantity, 2);
        }
    }
}

export default function rootReducer(state = initialState, action) {

    var newState = {};

    switch(action.type) {
        case "SUBMIT_ORDER": {
            console.log('submit order');
            console.log(action);
            newState = {...state, loading: true};
            break;
        }
        case "SUBMIT_ORDER_SUCCESS": {
            console.log('submit order success');
            newState = {...state, loading: false, error: false, confirmation: action.confirmation}
            break;
        }
        case "SUBMIT_ORDER_FAILURE": {
            newState = {...state, loading: false, error: action.err}
            break;
        }
        case "EXTRA_CHIPS": {
            newState = Object.assign({}, state);

            if(action.hasOwnProperty('qty')) {
                newState.extraChips.qty = action.qty;
                newState.extraChips.firstRender = false;
                break;
            }
            
            let choice = action.payload;

            if(choice === 'Yes') {
                newState.extraChips.state = true;
            } else {
                newState.extraChips.firstRender = false;
            }

            break;
        }
        case "INIT_FREE_SALAD": {
            newState = Object.assign({}, state);

            let playBall = newState.playBall;
            let len = newState.freeSalads.length;

            console.log(playBall);
            console.log(len);

            if(playBall !== len) {
                if(playBall < newState.freeSalads.length) {
                    while(newState.freeSalads.length > playBall) {
                        newState.freeSalads.pop();
                    }
                } else {
                    while(newState.freeSalads.length < playBall) {   
                        newState.freeSalads.push('Potato Salad');
                    }

                }
            }

            break;
        }
        case "UPDATE_FREE_SALAD": {
            newState = Object.assign({}, state);
            
            newState.freeSalads[action.payload.index] = action.payload.salad;

            break;
        }
        case "SALAD_SIDES": {
            newState = Object.assign({}, state);
            let quantity = newState[action.payload.salad].quantity = Number(action.payload.quantity);
            let size = newState[action.payload.salad].size = action.payload.size;
            let astar = newState[action.payload.salad].astar;

            newState[action.payload.salad].total = saladSidePrice(size, quantity, astar);

            break;
        }
        case "DESSERT": {
            newState = Object.assign({}, state);
            
            let size = newState[action.payload.dessert].size = action.payload.size;
            let quantity = newState[action.payload.dessert].quantity = action.payload.quantity;
            
            if(action.payload.dessert === 'battingAverageCupcake') {
                newState[action.payload.dessert].total = roundTo(
                    newState[action.payload.dessert].quantity
                    * BATTINGAVG_PRICE
                    , 2
                );
            } else {
                newState[action.payload.dessert].total = roundTo(
                    size === 'Regular'
                    ? DESSERT_REGULAR_PRICE * quantity
                    : DESSERT_LARGE_PRICE * quantity
                    , 2
                );
            }
            

            break;
        }
        default: {
            newState = Object.assign({}, state, {
                [action.type]: action.payload
            });
            break;
        }
    }

    newState['orderTotal'] = 0;
    newState['orderTotal'] += newState['breakfastTotal'] = calculateBreakfastTotal(newState);
    newState['orderTotal'] += newState['beverageTotal'] = calculateBeverageTotal(newState);
    newState['orderTotal'] += newState['deliTraysTotal'] = calculateDeliTraysTotal(newState);
    newState['orderTotal'] += newState['greenSaladTotal'] = calculateSaladBoxes(newState);
    newState['orderTotal'] += newState['saladSidesTotal'] = calculateSaladSides(newState);
    newState['orderTotal'] += newState['lunchBoxTotal'] = calculateLunchbox(newState);
    newState['orderTotal'] += newState['dessertTotal'] = calculateDessert(newState);
    newState['orderTotal'] += newState['subSandwichTotal'] = calculateSubSandwiches(newState);
    newState['orderTotal'] += newState['extraChips'].qty * CHIPS_PRICE;    

    newState['orderTotal'] = roundTo(newState['orderTotal'], 2);
    return newState;
}