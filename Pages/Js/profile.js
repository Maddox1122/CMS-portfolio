function populateFields() {
  let select = document.getElementsByName("update")[0];
  let selectedOption = select.options[select.selectedIndex];
  let naamField = document.getElementById("naamField");
  let beschrijvingField = document.getElementById("beschrijvingField");
  let datumField = document.getElementById("datumField");

  if (selectedOption) {
    let naam = selectedOption.getAttribute("data-naam");
    let beschrijving = selectedOption.getAttribute("data-beschrijving");
    let datum = selectedOption.getAttribute("data-datum");

    naamField.value = naam;
    beschrijvingField.value = beschrijving;
    datumField.value = datum;
  } else {
    naamField.value = "";
    beschrijvingField.value = "";
    datumField.value = "";
  }
}
