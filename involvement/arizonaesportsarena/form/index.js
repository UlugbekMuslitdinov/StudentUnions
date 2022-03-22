function updateDate(value) {
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0');
    var yyyy = today.getFullYear().toString().substr(-2);

    today = mm + '/' + dd + '/' + yyyy;

    if(value.trim() === "") {
        document.getElementById("parent_date").value = "";
    }
    else {
        document.getElementById("parent_date").value = today;
    }
}