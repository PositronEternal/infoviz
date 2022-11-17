document.addEventListener("input", (event) => {
  if (event.target.getAttribute("type") != "text") {
    return true;
  }

  setTextElementWidth(event.target);
});

document.addEventListener("DOMContentLoaded", (event) => {
  document.querySelectorAll("input[type=text]").forEach((element) => {
    setTextElementWidth(element);
  });
});

function setTextElementWidth(element) {
  let canvas = document.createElement("canvas");
  let context = canvas.getContext("2d");
  let font = window.getComputedStyle(element, null).getPropertyValue("font");
  let text = element.value;
  context.font = font;
  let text_width = context.measureText(text).width;
  let padding = parseFloat(
    window.getComputedStyle(element, null).getPropertyValue("padding-left")
  );
  let border = parseFloat(
    window.getComputedStyle(element, null).getPropertyValue("border-left-width")
  );

  text_width = text_width + 2 * (padding + border) + "px";
  element.style.width = text_width;
}
