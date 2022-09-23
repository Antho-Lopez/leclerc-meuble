function disableBtn() {
    if(document.getElementById("myForm").reportValidity()) {
        document.getElementById("myBtn").disabled = true;
        document.getElementById("myForm").submit()
    }
}
