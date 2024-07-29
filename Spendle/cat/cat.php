<?php
  include('../connection.php');
  session_start();
  $id = $_SESSION['id'];

  $category = @$_POST['category'];
  $sql2 ="select * from transactions where category='$category' and user_id='$id' order by trans_id desc;";
  $result = $con->query($sql2);

  $con->close();
?>
    
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../icons/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <title>Spendle | Categories</title>
  </head>
  <body>

  <header>
    <nav>
      <a href="../redirect.php?id=$id"><img src="../icons/img/records2.png" id="img" /><span>Records</span></a>
      <a href="../chart/expense.php"><img src="../icons/img/analytics2.png" id="img" /><span>Analysis</span></a>
      <a href="../login.php" onclick="return logout();"><img src="../icons/logo.png" height="50" width="50" id="img" /></a>
      <a href="../budget/budget.php"><img src="../icons/img/budget2.png" id="img" /><span>Budgets</span></a>
      <a href="cat.php"><img src="../icons/img/cat2.png" id="img" /><span>Categories</span></a>
    </nav>
  </header>

    <div class="column">
      <h2>Expense Categories</h2>
      <div class="cat">
        <button class="expbtn" 
          onclick="document.getElementById('text').innerHTML = 'Food';

          document.getElementById('text').style.color = 'red'">
          <img src="../icons/expense/icons8-meal-50.png" /><br /><b>Food</b>
        </button>
        <button class="expbtn"
          onclick="document.getElementById('text').innerHTML = 'Shopping';

          document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-buying-50.png" /><br />Shopping
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Movies';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-popcorn-50.png" /><br />Movies
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Health';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-health-50.png" /><br />Health
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Home';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-home-50.png" /><br />Home
        </button><br>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Transport';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-public-transportation-50.png"/><br />Transport
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Mobile';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-push-notifications-50.png"/><br />Mobile
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Clothing';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-shirt-50.png" /><br />Clothing
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Education';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-education-50.png" /><br />Education
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Insurance';
        document.getElementById('text').style.color = 'red'">
          <img src="../icons\expense\icons8-insurance-50.png" /><br />Insurance
        </button>
      </div><br><br><hr>

      <h2>Income Categories</h2>
      <div class="cat">
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Salary';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="../icons\income\icons8-money-with-wings-50.png"/><br />Salary
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Rent';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="../icons\income\icons8-rent-50.png" /><br />Rent
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Grants';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="../icons\income\icons8-salary-50.png"/><br />Grants
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Sales';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="../icons\income\icons8-sales-50.png" /><br />Sales
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Refunds';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="../icons\income\icons8-refund-50.png" /><br />Refunds
        </button>
      </div>
    </div>

    <div class="column">
      <div class="container">

        <form method="post">
          <label for="text">Category Selected  |  </label>
          <label id="text">--</label>
          <input type="hidden" name="category" id="category">
          <br><br>
          <button class="button" onclick="copyContent()">Show Transaction History</button>
        </form>

      </div>
    </div>

    <div class="column">
      <h2>Transaction History</h2>
      <table>
          <tr>
            <th>Category</th>
            <th>Date</th>
            <th>Time</th>
            <th>Amount</th>
            <th></th>
          </tr>
          <?php
            while($rows=$result->fetch_assoc())
            {
              $original_date = $rows['trans_date'];;
              $timestamp = strtotime($original_date);
              $date = date("jS F Y", $timestamp);
              $time = date("h:i A", $timestamp);
          ?>
          <tr>
            <td><?php echo $rows['category'];?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $time;?></td>
            <td>₹<?php echo $rows['trans_amount'];?></td>
          </tr>
          <?php
            }
          ?>
      </table>
    </div>
    <script>
      function copyContent() {
        document.getElementById("category").value = document.getElementById("text").innerHTML;
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
        i+=3;
        if (amt > 0) {
          cells[i-6].style.color = "limegreen";
        } else {
          cells[i-6].style.color = "red";
        }
      }
    </script>
  </body>
</html>
