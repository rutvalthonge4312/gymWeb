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
var subscriptionName;
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
        option.setAttribute("value", element.name);

        let optionText = document.createTextNode(element.name);
        option.appendChild(optionText);

        optionInput.appendChild(option);
        //console.log(option.length);
      });

      /*for (var o = 0; o < dropDown.length; o++) {
        alert("hi");
        dropDown[o].addEventListener("change", function () {
          subscriptionName = this.id;
          console.log(subscriptionName);
        });
      }*/

      /* for (let tempData in dropDown) {
        tempData.addEventListener("change", function () {
          subscriptionName = this.id;
          console.log(subscriptionName);
        });
      }*/

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
        }*/
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

        optionInput.addEventListener("click", function () {
          alert("hi");
          for (var o = 0; o < arr.length; o++) {
            var tempIdoption = arr[o].fees;

            var tempElementOption = document.getElementById(
              tempIdoption.toString()
            );
            alert(tempIdoption);

            tempElementOption.addEventListener("click", function () {
              console.log(tempIdoption);
              alert(tempIdoption);
            });
          }
        });

        // var amountTotal = tempAmount * duration.value;

        var params = {
          name: nameHere.value,
          mobileNumber: mobileNumber.value,
          email: email.value,
          amount: 45000,
          duration: duration.value,
          subscriptionName: "temp",
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
