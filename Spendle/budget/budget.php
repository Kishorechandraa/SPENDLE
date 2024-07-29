<?php
  include('../connection.php');
  session_start();
  $id = $_SESSION['id'];

  $food = mysqli_query($con, "select sum(trans_amount) from transactions where category='Food' and user_id='$id';");
  $shopping = mysqli_query($con, "select sum(trans_amount) from transactions where category='Shopping' and user_id='$id';");
  $movies = mysqli_query($con, "select sum(trans_amount) from transactions where category='Movies' and user_id='$id';");
  $health = mysqli_query($con, "select sum(trans_amount) from transactions where category='Health' and user_id='$id';");
  $home = mysqli_query($con, "select sum(trans_amount) from transactions where category='Home' and user_id='$id';");
  $transport = mysqli_query($con, "select sum(trans_amount) from transactions where category='Transport' and user_id='$id';");
  $mobile = mysqli_query($con, "select sum(trans_amount) from transactions where category='Mobile' and user_id='$id';");
  $clothing = mysqli_query($con, "select sum(trans_amount) from transactions where category='Clothing' and user_id='$id';");
  $education = mysqli_query($con, "select sum(trans_amount) from transactions where category='Education' and user_id='$id';");
  $insurance = mysqli_query($con, "select sum(trans_amount) from transactions where category='Insurance' and user_id='$id';");

  $con->close();
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../icons/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <title>Spendle | Budgets</title>
  </head>
  <body>
    <header>
      <nav>
          <a href="../redirect.php?id=$id"><img src="../icons/img/records2.png" id="img" /><span>Records</span></a>
          <a href="../chart/expense.php"><img src="../icons/img/analytics2.png" id="img" /><span>Analysis</span></a>
          <a href="../login.php" onclick="return logout();"><img src="../icons/logo.png" height="50" width="50" id="img" /></a>
          <a href="../budget/budget.php"><img src="../icons/img/budget2.png" id="img" /><span>Budgets</span></a>
          <a href="../cat/cat.php"><img src="../icons/img/cat2.png" id="img" /><span>Categories</span></a>
      </nav>
    </header>

    <div class="column">
      <h2>Expense Categories</h2>
      <div class="cat">
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Food';
        document.getElementById('expense').innerHTML = <?php if($rows=$food->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons/expense/icons8-meal-50.png" /><br />Food
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Shopping';
        document.getElementById('expense').innerHTML = <?php if($rows=$shopping->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-buying-50.png" /><br />Shopping
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Movies';
        document.getElementById('expense').innerHTML = <?php if($rows=$movies->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-popcorn-50.png" /><br />Movies
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Health';
        document.getElementById('expense').innerHTML = <?php if($rows=$health->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-health-50.png" /><br />Health
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Home';
        document.getElementById('expense').innerHTML = <?php if($rows=$home->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-home-50.png" /><br />Home
        </button><br>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Transport';
        document.getElementById('expense').innerHTML = <?php if($rows=$transport->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-public-transportation-50.png"/><br />Transport
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Mobile';
        document.getElementById('expense').innerHTML = <?php if($rows=$mobile->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-push-notifications-50.png"/><br />Mobile
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Clothing';
        document.getElementById('expense').innerHTML = <?php if($rows=$clothing->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-shirt-50.png" /><br />Clothing
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Education';
        document.getElementById('expense').innerHTML = <?php if($rows=$education->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-education-50.png" /><br />Education
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Insurance';
        document.getElementById('expense').innerHTML = <?php if($rows=$insurance->fetch_assoc()) { echo $rows['sum(trans_amount)'];}?>">
          <img src="../icons\expense\icons8-insurance-50.png" /><br />Insurance
        </button>
      </div>
    </div>

    <div class="column">
      <ul class="cards">

        <li>
          <img src="../icons/budget/icons8-piggy-bank-100.png" alt="">
          <span>
            <h3>₹<span id="budget">0</span></h3>
            <b>Budget</b>
          </span>
        </li><br>

        <li>
          <img src="../icons/budget/icons8-expenses-100.png" alt="">
          <span>
            <h3>₹<span id="expense">0</span></h3>
            <b>Expenses</b>
          </span>
        </li><br>

        <li>
          <img src="../icons/budget/icons8-balance-100.png" alt="">
          <span>
            <h3>₹<span id="balance">0</span></h3>
            <b>Balance</b>
          </span>
        </li>
        
      </ul>
    </div>

    <div class="column">
      <h2>Budgeting</h2>
      <form class="budget_content" onsubmit="event.preventDefault()" method="post">
          <input type="number" id="amt" name="amt" placeholder="Enter Your Budget"/><br>
          <label>Expense Category | </label>
          <label id="text">--</label><br>
          <input type="hidden" name="category" id="category">
          <button name="set" class="button" onclick="budget()">Set Budget</button>
      </form>
    </div>

    <script>
      function budget() {
        if (document.getElementById("amt").value <= 0) {
          alert('Budget cannot be less than or equal to 0');
        } else {
          document.getElementById("budget").innerHTML = document.getElementById("amt").value;
          const budget = parseInt(document.getElementById("budget").innerHTML);
          const expense = parseInt(document.getElementById("expense").innerHTML);
          const balance = budget + expense;
          document.getElementById("balance").innerHTML = balance;
          if (balance<0) {
            alert('You have exceeded your budget!');
          }        
        }
      }

      function logout() {
        if (confirm("Are you sure you want to logout?")) {
          return true;
        } else {
          return false;
        }
      }
    </script>
  </body>
</html>