const Cv = document.querySelector(".cvimg");
const CvOverlay = document.querySelector(".bg-img");
const CvButton = document.querySelector(".cvbutton");
const Close = document.querySelector(".close");

CvButton.addEventListener("click", () => {
  if (Cv.classList.contains("hidden")) {
    Cv.classList.remove("hidden");
    CvOverlay.classList.remove("hidden");
  }
});

Close.addEventListener("click", () => {
  Cv.classList.add("hidden");
  CvOverlay.classList.add("hidden");
});
