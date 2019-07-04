function editMark(markFieldId) {
    console.log("Edit mark " + markFieldId);
    var markField = document.getElementById(markFieldId);
    markField.removeAttribute("readonly");
    markField.setAttribute("class", "form-control text-right")
}