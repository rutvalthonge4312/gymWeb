var nameHere = document.getElementById("name");
var mobileNumber = document.getElementById("mobileNumber");
var email = document.getElementById("email");
var subscriptionNames = document.getElementsByClassName("optionInput");
var duration = document.getElementById("duration");
var subscriptionName = document.getElementById("subscriptionName");
var startingDate = document.getElementById("startingDate");

var takeAdmissionButton = document.getElementById("takeAdmissionButton");
var subscriptionName = document.getElementById("subscriptionName");
var option = document.getElementsByTagName("option");

var dropDown = document.getElementsByTagName("option");
var idOfoption;
var dropDownPressed = (e) => {
  idOfoption = e.target.id;
  console.log(e.target.id);
};

for (let option of dropDown) {
  event.preventDefault();
  option.addEventListener("click", dropDownPressed);
}

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
var arr = [];
const request = new Request(apiUrl, {
  method: "GET",
});
fetch(request)
  .then((response) => response.json())
  .then((responseJson) => {
    if (responseJson.status == 200) {
      console.log("hi Data Found!");
      //  console.log(responseJson.data);
      for (var j = 0; j < responseJson.data.length; j++) {
        arr[j] = responseJson.data[j];
        console.log("data added to array");
      }
      // console.log(arr[0]);
      responseJson.data.forEach((element) => {
        let option = document.createElement("option");
        option.setAttribute("id", element.fees);
        option.setAttribute("class", "optionsInSub");

        let optionText = document.createTextNode(element.name);
        option.appendChild(optionText);

        optionInput.appendChild(option);
        //console.log(option.length);
      });

      var subscriptionName;
      takeAdmissionButton.addEventListener("click", function () {
        event.preventDefault();
        var apiUrl1 = "http://localhost/GYM_API/index.php/user/addCustomer";
        /*for (temp in arr) {
          for (tempOption in option) {
            if (temp.value === tempOption.value) {
              var tempAmount = temp.fees;
              subscriptionName = temp.name;
              amountTotal = temp.fees * duration.value;
            }
          }
        }
        for (var k = 0; k < arr.length; k++) {
          for (tempOption in option) {
            if (arr[k].fees == tempOption.value) {
              subscriptionName = arr[k].name;
              var amountTotal = arr[k].fees * duration.value;
              console.log(amountTotal);
              break;
            }
          }
        }
*/

        // var amountTotal = tempAmount * duration.value;

        var params = {
          name: nameHere.value,
          mobileNumber: mobileNumber.value,
          email: email.value,
          amount: 45000,
          duration: duration.value,
          subscriptionName: clickedElementId,
          startingDate: startingDate.value,
        };

        // console.log("payload" + JSON.stringify(params.values));
        console.log(params);
        let body = Object.keys(params)
          .map((key) => {
            return (
              encodeURIComponent(key) + "=" + encodeURIComponent(params[key])
            );
          })
          .join("&");
        const request1 = new Request(apiUrl1, {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: body,
        });

        fetch(request1)
          .then((response) => response.json())
          .then((responseJson) => {
            console.log(JSON.stringify(responseJson));
            if (responseJson.status == 200) {
              alert("Successfully Admited the Gym!");
            } else {
              alert("Wrong Credentials");
            }
          })
          .catch((err) => {
            alert("Server is Unavialbe at this moment! Try After some time");
            console.log(err);
          });

        //
      });
    }
  })
  .catch((err) => {
    console.log(err);
  });
