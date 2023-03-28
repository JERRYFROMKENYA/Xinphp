function validateForm() {
    let x = document.forms["booking"]["full-name"].value;
    if (x == "") {
        alert("Name must be filled out");
        return false;
    }
    let y = document.forms["booking"]["email"].value;
    if (y == "") {
        alert("email must be filled out");
        return false;
    }
}