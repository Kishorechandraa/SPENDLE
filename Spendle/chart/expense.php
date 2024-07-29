<?php
  include('../connection.php');
  session_start();
  $id = $_SESSION['id'];
  
  $exp = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount<0 and user_id='$id';");
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
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../icons/logo.png" />
    <link rel="stylesheet" href="style.css">
    <title>Spendle | Analysis</title>
  </head>
  <body>

    <header>
      <nav>
        <a href="../redirect.php?id=$id"><img src="../icons/img/records2.png" id="img" /><span>Records</span></a>
        <a href="expense.php"><img src="../icons/img/analytics2.png" id="img" /><span>Analysis</span></a>
        <a href="../login.php" onclick="return logout();"><img src="../icons/logo.png" height="50" width="50" id="img" /></a>
        <a href="../budget/budget.php"><img src="../icons/img/budget2.png" id="img" /><span>Budgets</span></a>
        <a href="../cat/cat.php"><img src="../icons/img/cat2.png" id="img" /><span>Categories</span></a>
      </nav>
    </header>

    <div class="chartCard">
      <div>
        <h2>Analysis</h2>
        <div class="chartBox">
          <select onchange = "location = this.value;">
            <option value="expense.php" id="exp">Expense Overview</option>
            <option value="income.php" id="inc">Income Overview</option>
          </select>
          <div class=exp>
            <h3>Total Expense :<br><br>
            ₹<?php if($rows=$exp->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?></h3>
          </div>
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script>
      function logout() {
        if (confirm("Are you sure you want to logout?")) {
          return true;
        } else {
          return false;
        }
      }
      
      const xValues = ["Food", "Shopping", "Movies", "Health", "Home", "Transport", "Mobile", "Clothing", "Education", "Insurance"];
      const yValues = [
        <?php if($rows=$food->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$shopping->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$movies->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$health->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$home->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$transport->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$mobile->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$clothing->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$education->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$insurance->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
      ];

      const barColors = [
        "#9e0142",
        "#d53e4f",
        "#f46d43",
        "#fdae61",
        "#fee08b",
        "#e6f598",
        "#abdda4",
        "#66c2a5",
        "#3288bd",
        "#5e4fa2"
      ];

      new Chart("myChart", {
      type: "doughnut",
      data: {
          labels: xValues,
          datasets: [{
          backgroundColor: barColors,
          data: yValues
          }]
      }});
    </script>
  </body>
</html>