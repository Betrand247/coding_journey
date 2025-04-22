const headerNav = document.querySelector(".header-nav");
const headerBtn = document.querySelector(".header-btn-open");
const headerBtnClose = document.querySelector(".header-closer-btn");

headerBtn.addEventListener("click", () => {
  console.log("clicked");
  headerNav.classList.toggle("active");
});

headerBtnClose.addEventListener("click", () => {
  console.log("clicked");
  headerNav.classList.toggle("active");
});
