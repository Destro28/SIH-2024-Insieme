var coll = document.getElementsByClassName("collapsible");
for (var i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });

}

const form = document.getElementById('myForm');
const progressBar = document.getElementById('progress');

form.addEventListener('input', updateProgressBar);

function updateProgressBar() {
  const formElements = Array.from(form.elements).filter(el => el.type !== 'submit');
  const totalFields = formElements.length;
  let filledFields = formElements.filter(el => el.value.trim() !== '').length;

  // Calculate progress percentage
  const progressPercentage = (filledFields / totalFields) * 100;
  progressBar.style.width = progressPercentage + '%';
}