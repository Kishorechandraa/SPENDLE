if (document.getElementById("balance").innerHTML === "₹") {
  let balance = prompt("Please enter your Account Balance");
  document.getElementById("balance").innerHTML = "₹"+balance;
  document.getElementById("bal").value = balance;
}

function copyContent() {
  if (text.innerHTML.trim() === "--" || amount.value.trim() === ""|| amount.value.trim() === "-" || amount.value.trim() === "+") {
    alert("Please select a Category and Amount");
  } else {
  document.getElementById("category").value = document.getElementById("text").innerHTML;
  }
}

function logout() {
  if (confirm("Are you sure you want to logout?")) {
    return true;
  } else {
    return false;
  }
}

var cells = document.getElementsByTagName("td");
for (var i = 3; i < cells.length; i++) {
  var cellValue = cells[i].innerHTML;
  var amt = cellValue.slice(1);
  i+=4;
  if (amt > 0) {
    cells[i-7].style.color = "limegreen";
  } else {
    cells[i-7].style.color = "red";
  }
}

if (window.history.replaceState) {
  window.history.replaceState(null, null, window.location.href);
}