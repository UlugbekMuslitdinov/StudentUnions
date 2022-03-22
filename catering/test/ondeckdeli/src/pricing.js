const roundTo = require('roundto');

// Breakfast
export const FASTBALL_PRICE = 2.79;
export const CHANGEUP_PRICE = 2.79;
export const CURVEBALL_REGULAR_PRICE = 37.99;
export const CURVEBALL_LARGE_PRICE = 74.99;

// Beverages
export const MINUTEMAID_PRICE = 1.99;
export const BOTTLEDDRINKS_PRICE = 1.99;
export const DASANI_PRICE = 1.69;
export const COFFEEBOX_PRICE = 15.99;

// Deli Trays
export const POWERHITTER_REGULAR_PRICE = 34.99;
export const POWERHITTER_LARGE_PRICE = 69.99;
export const PERFECTGAME_PRICE = 34.99;
export const TRIPLECROWN_PRICE = 69.99;
export const QUALITYSTART_PRICE = 49.99;
export const PLAYBALL_PRICE = 59.99;

// Salad Boxes
export const SALADBOX_PRICE = 10.99;

// Salad Sides
export const REGULAR_SALAD_PRICE = 11.99;
export const LARGE_SALAD_PRICE = 21.99;
export const ASTAR_REGULAR_SALAD_PRICE = 14.99;
export const ASTAR_LARGE_SALAD_PRICE = 26.99;

// Lunch Boxes
export const LUNCHBOX_PRICE = 9.99;

// 18" Sub Sandwiches
export const SUBSANDWICH_PRICE = 19.99;

// Dessert
export const DESSERT_REGULAR_PRICE = 6.99;
export const DESSERT_LARGE_PRICE = 12.99;
export const BATTINGAVG_PRICE = 5.99;

// Extra Chips
export const CHIPS_PRICE = 0.89;

export function calculateBreakfastTotal(state) {
    return roundTo(
        (state.fastball * FASTBALL_PRICE
        + state.changeUp * CHANGEUP_PRICE
        + state.curveBallRegular * CURVEBALL_REGULAR_PRICE
        + state.curveBallLarge * CURVEBALL_LARGE_PRICE)
        , 2
    );
}

export function calculateBeverageTotal(state) {
    let minuteMaid = Number(state.apple) + Number(state.orange) + Number(state.cranberry);
    let minuteMaidPrice = minuteMaid * MINUTEMAID_PRICE;

    let bottledDrinks = Number(state.coke) + Number(state.dietCoke) + Number(state.sprite);
    let bottledDrinksPrice = bottledDrinks * BOTTLEDDRINKS_PRICE;

    let coffee = Number(state.neighborhood) + Number(state.vanillaHazelnut) + Number(state.decaf);
    let coffeePrice = coffee * COFFEEBOX_PRICE;

    return roundTo(
        (minuteMaidPrice
        + bottledDrinksPrice
        + coffeePrice
        + state.dasani * DASANI_PRICE)
        , 2
    );
}


export function calculateDeliTraysTotal(state) {

    return roundTo(
        (state.powerHitterRegular * POWERHITTER_REGULAR_PRICE
        + state.powerHitterLarge * POWERHITTER_LARGE_PRICE
        + state.perfectGame * PERFECTGAME_PRICE
        + state.tripleCrown * TRIPLECROWN_PRICE
        + state.qualityStart * QUALITYSTART_PRICE
        + state.playBall * PLAYBALL_PRICE)
        , 2
    );

}

export function calculateSaladBoxes(state) {

    let quantity = state.cobSalad
                + state.chefSalad
                + state.caesarSalad
                + state.veggieSalad;

    return roundTo(quantity * SALADBOX_PRICE, 2);

}

export function calculateSaladSides(state) {
    return roundTo(
        state.potatoSalad.total
        + state.pastaSalad.total
        + state.macaroniSalad.total
        + state.romaineSalad.total
        + state.blackBeanSalad.total
        + state.ancientGrainSalad.total
        + state.fruitSalad.total
        + state.greekSalad.total
        + state.chickpeaSalad.total
        + state.asianSalad.total
        , 2
    );
}

export function calculateLunchbox(state) {

    let quantity = state.batterUp
    + state.infieldFly
    + state.safeCall
    + state.fairBall
    + state.outfielder
    + state.groundRule;

    return roundTo(quantity * LUNCHBOX_PRICE, 2);
}

export function calculateDessert(state) {
    return roundTo(
        state.crispyTreat.total
        + state.fruityPebble.total
        + state.pbChocolate.total
        + state.chocolateChunkCookie.total
        + state.sugarCookie.total
        + state.cranberryRaisin.total
        + state.battingAverageCupcake.total
        , 2
    );
}

export function calculateSubSandwiches(state) {
    return roundTo(
        (state.leadOff
        + state.onDeck
        + state.inTheHole) * SUBSANDWICH_PRICE
        , 2);
}