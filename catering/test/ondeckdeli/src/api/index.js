import fetch from 'cross-fetch';
const BASE_URL = '/catering/online/ondeckdeli'

const SUBMIT_ORDER = () => {
    return {
        type: "SUBMIT_ORDER"
    }
}

const SUBMIT_ORDER_SUCCESS = (res) => {
    return {
        type: "SUBMIT_ORDER_SUCCESS",
        confirmation: res
    }
}


const SUBMIT_ORDER_FAILURE = (err) => {
    return {
        type: "SUBMIT_ORDER_FAILURE",
        err
    }
}


export function submitForm(state) {

    return function (dispatch) {
        dispatch(SUBMIT_ORDER);

        let req = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify(buildState(state))
        };

        return fetch(`${BASE_URL}/submit.php`, req)
            .then(response => {
                if (!response.ok) {
                    throw new Error("404");
                }
                // response.text().then(text => {
                //     console.log(text);
                // });
                response.json().then(json => {
                    // console.log(json);
                    dispatch(SUBMIT_ORDER_SUCCESS(json));
                });
                return response.json();
            }
            ).catch(err => dispatch(SUBMIT_ORDER_FAILURE(err)))
            
            // .then(json => {
            //     // console.log(json);
            //     // dispatch(SUBMIT_ORDER_SUCCESS(json));
            // }).catch(err => dispatch(SUBMIT_ORDER_FAILURE(err)))


    }


}




function buildState(state) {
    return {
        orderID: 1234,

        fastball: state.fastball,
        changeUp: state.changeUp,
        curveBallRegular: state.curveBallRegular,
        curveBallLarge: state.curveBallLarge,

        apple: state.apple,
        orange: state.orange,
        cranberry: state.cranberry,
        coke: state.coke,
        dietCoke: state.dietCoke,
        sprite: state.sprite,
        dasani: state.dasani,
        neighborhood: state.neighborhood,
        vanillaHazelnut: state.vanillaHazelnut,
        decaf: state.decaf,

        powerHitterRegular: state.powerHitterRegular,
        powerHitterLarge: state.powerHitterLarge,
        perfectGame: state.perfectGame,
        tripleCrown: state.tripleCrown,
        qualityStart: state.qualityStart,
        playBall: state.playBall,

        pastaSalad: state.pastaSalad,
        macaroniSalad: state.macaroniSalad,
        romaineSalad: state.romaineSalad,
        blackBeanSalad: state.blackBeanSalad,
        ancientGrainSalad: state.ancientGrainSalad,
        fruitSalad: state.fruitSalad,
        greekSalad: state.greekSalad,
        chickpeaSalad: state.chickpeaSalad,
        asianSalad: state.asianSalad,


        cobSalad: state.cobSalad,
        chefSalad: state.chefSalad,
        caesarSalad: state.caesarSalad,
        veggieSalad: state.veggieSalad,
        ranch: state.ranch,
        italian: state.italian,
        caesar: state.caesar,


        batterUp: state.batterUp,
        infieldFly: state.infieldFly,
        safeCall: state.safeCall,
        fairBall: state.fairBall,
        outfielder: state.outfielder,
        groundRule: state.groundRule,

        leadOff: state.leadOff,
        onDeck: state.onDeck,
        inTheHole: state.inTheHole,

        crispyTreat: state.crispyTreat,
        fruityPebble: state.fruityPebble,
        pbChocolate: state.pbChocolate,
        chocolateChunkCookie: state.chocolateChunkCookie,
        sugarCookie: state.sugarCookie,
        cranberryRaisin: state.cranberryRaisin,
        battingAverageCupcake: state.battingAverageCupcake,

        freeSalads: state.freeSalads,
        extraChips: state.extraChips,

        orderTotal: state.orderTotal
    };
}