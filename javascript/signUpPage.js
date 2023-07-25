// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
  "use strict";

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  const forms = document.querySelectorAll(".needs-validation");

  // Loop over them and prevent submission
  Array.from(forms).forEach((form) => {
    form.addEventListener(
      "submit",
      (event) => {
        if (!form.checkValidity()) {
          event.preventDefault();
          event.stopPropagation();
        }

        form.classList.add("was-validated");
      },
      false
    );
  });
})();
var optionInput = document.getElementById("optionInput");

var apiUrl = "http://localhost/GYM_API/index.php/user/getSubscription?limit=50";
const request = new Request(apiUrl, {
  method: "GET",
});
fetch(request)
  .then((response) => response.json())
  .then((responseJson) => {
    console.log(JSON.stringify(responseJson));
    if (responseJson.status == 200) {
      console.log("hi Data Found!");

      var i = 0;

      responseJson.data.forEach((element) => {
        let option = document.createElement("option");
        option.setAttribute("value", element.name);

        let optionText = document.createTextNode(element.name);
        option.appendChild(optionText);

        optionInput.appendChild(option);
        i++;
      });
    }
  })
  .catch((err) => {
    console.log(err);
  });
