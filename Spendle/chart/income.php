<?php
  include('../connection.php');
  session_start();
  $id = $_SESSION['id'];

  $inc = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount>0 and user_id='$id';");
  $salary = mysqli_query($con, "select sum(trans_amount) from transactions where category='Salary' and user_id='$id';");
  $rent = mysqli_query($con, "select sum(trans_amount) from transactions where category='Rent' and user_id='$id';");
  $grants = mysqli_query($con, "select sum(trans_amount) from transactions where category='Grants' and user_id='$id';");
  $sales = mysqli_query($con, "select sum(trans_amount) from transactions where category='Sales' and user_id='$id';");
  $refunds = mysqli_query($con, "select sum(trans_amount) from transactions where category='Refunds' and user_id='$id';");

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
        <a href="income.php"><img src="../icons/img/analytics2.png" id="img" /><span>Analysis</span></a>
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
                <option value="income.php" id="inc">Income Overview</option>
                <option value="expense.php" id="exp">Expense Overview</option>
            </select>
            <div class=inc>
              <h3>Total Income :<br><br>
              ₹<?php if($rows=$inc->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?></h3>
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
      const xValues = ["Salary", "Rent", "Grants", "Sales", "Refunds"];
      const yValues = [
        <?php if($rows=$salary->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$rent->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$grants->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$sales->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
        <?php if($rows=$refunds->fetch_assoc()) {echo $rows['sum(trans_amount)'];}?>,
      ];

      const barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797",
        "#e8c3b9",
        "#1e7145"
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