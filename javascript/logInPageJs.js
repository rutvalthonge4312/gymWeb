var logInButtonInLogInPage = document.getElementById("logInButtonInLogInPage");
var body = document.body;

logInButtonInLogInPage.addEventListener("click", function (event) {
  event.preventDefault(); // Prevent form submission behavior
  window.location.href = "Admin Page Folder/adminPageGym.html";
});
