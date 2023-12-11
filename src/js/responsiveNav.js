/* Schaltet um zwischen "navigation responsive" und "navigation" */
function makeNavResponsive() {
  var x = document.getElementById("jsNav");
  if (x.className === "navigation") {
      x.className += " responsive";
  } else {
      x.className = "navigation";
  }
}