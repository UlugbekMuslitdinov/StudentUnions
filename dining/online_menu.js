function currentDate() {
    var today = new Date();
        day = today.getDay();
        daylist = ["SUNDAY","MONDAY","TUESDAY","WEDNESDAY ","THURSDAY","FRIDAY","SATURDAY"];
    var currentDate = new Date(),
        date = currentDate.getDate(),
        month = currentDate.getMonth(),
        monthlist = ["JANUARY", "FEBRUARY", "MARCH", "APRIL", "MAY", "JUNE", "JULY", "AUGUST", "SEPTEMBER", "OCTOBER", "NOVEMBER", "DECEMBER"];
        year = currentDate.getFullYear();
    document.write(daylist[day] + ", " + monthlist[month] + " " +  date + ", " + year)
}

function showNext() {
    document.getElementById('second').style.visibility = "visible";
    document.getElementById('first').style.visibility = "hidden";
}

function showPrevious() {
    document.getElementById('first').style.visibility = "visible";
    document.getElementById('second').style.visibility = "hidden";
}

function showNextFlex() {
    document.getElementById('second').style.display = null;
    document.getElementById('first').style.display = "none";
}

function showPreviousFlex() {
    document.getElementById('first').style.display = null;
    document.getElementById('second').style.display = "none";
}
