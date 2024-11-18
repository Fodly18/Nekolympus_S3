const container = document.getElementById("container");
const loginbtn = document.getElementById("login");
const forgotLink = document.getElementById("forgot");


loginbtn.addEventListener("click", () => {
  container.classList.remove("active");
});

forgotLink.addEventListener("click", (event) => {
  event.preventDefault();
  container.classList.add("active");
});
