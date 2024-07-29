<?php
  include('connection.php');
  
  session_start();
  $id = $_SESSION['id'];
  $sql2 ="select * from transactions where user_id='$id' order by trans_id desc;";
  $result = $con->query($sql2);
  $bal = mysqli_query($con, "SELECT (SELECT SUM(trans_amount) FROM transactions where user_id='$id') + (SELECT balance FROM user where user_id='$id') AS bal;")->fetch_assoc();
  $inc = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount>0 and user_id='$id';")->fetch_assoc();
  $exp = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount<0 and user_id='$id';")->fetch_assoc();
  
  if(isset($_POST["trans"]) && !empty($_POST['category'])) {
    $id = $_SESSION['id'];
    $amount = $_POST['amount'];
    $category = $_POST['category'];

    if(!empty($_POST['bal'])) {
      $bal = $_POST['bal'];
      mysqli_query($con, "update user set balance='$bal' where user_id='$id';");
    }
    $sql = "insert into transactions (user_id, category, trans_amount) values ('$id', '$category', '$amount')";
    mysqli_query($con, $sql);
    
    $sql2 ="select * from transactions where user_id='$id' order by trans_id desc;";
    $result = $con->query($sql2);
    $bal = mysqli_query($con, "SELECT (SELECT SUM(trans_amount) FROM transactions where user_id='$id') + (SELECT balance FROM user where user_id='$id') AS bal;")->fetch_assoc();
    $inc = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount>0 and user_id='$id';")->fetch_assoc();
    $exp = mysqli_query($con, "select sum(trans_amount) from transactions where trans_amount<0 and user_id='$id';")->fetch_assoc();
  }
  
  if (isset($_POST["delete"])) {
    $trans_id = $_POST['trans_id'];
    mysqli_query($con, "delete from transactions where trans_id = '$trans_id';");
    header("Location: redirect.php");
  }
  $con->close();
?>
    
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="icons/logo.png" />
    <link rel="stylesheet" href="style.css" />
    <title>Spendle | Records</title>
  </head>
  <body>

  <header>
    <nav>
      <a href="redirect.php"><img src="icons/img/records2.png" id="img" /><span>Records</span></a>
      <a href="chart/expense.php"><img src="icons/img/analytics2.png" id="img" /><span>Analysis</span></a>
      <a href="login.php" onclick="return logout();"><img src="icons/logo.png" height="50" width="50" id="img" /></a>
      <a href="budget/budget.php"><img src="icons/img/budget2.png" id="img" /><span>Budgets</span></a>
      <a href="cat/cat.php"><img src="icons/img/cat2.png" id="img" /><span>Categories</span></a>
    </nav>
  </header>

    <div class="column">
      <h2>Expense Categories</h2>
      <div class="cat">
        <button class="expbtn" 
          onclick="document.getElementById('text').innerHTML = 'Food';
          document.getElementById('amount').value = '-';
          document.getElementById('text').style.color = 'red'">
          <img src="icons/expense/icons8-meal-50.png" /><br /><b>Food</b>
        </button>
        <button class="expbtn"
          onclick="document.getElementById('text').innerHTML = 'Shopping';
          document.getElementById('amount').value = '-';
          document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-buying-50.png" /><br />Shopping
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Movies';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-popcorn-50.png" /><br />Movies
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Health';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-health-50.png" /><br />Health
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Home';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-home-50.png" /><br />Home
        </button><br>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Transport';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-public-transportation-50.png"/><br />Transport
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Mobile';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-push-notifications-50.png"/><br />Mobile
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Clothing';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-shirt-50.png" /><br />Clothing
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Education';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-education-50.png" /><br />Education
        </button>
        <button class="expbtn" onclick="document.getElementById('text').innerHTML = 'Insurance';
        document.getElementById('amount').value = '-';
        document.getElementById('text').style.color = 'red'">
          <img src="icons\expense\icons8-insurance-50.png" /><br />Insurance
        </button>
      </div><br><br><hr>

      <h2>Income Categories</h2>
      <div class="cat">
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Salary';
        document.getElementById('amount').value = '+';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="icons\income\icons8-money-with-wings-50.png"/><br />Salary
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Rent';
        document.getElementById('amount').value = '+';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="icons\income\icons8-rent-50.png" /><br />Rent
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Grants';
        document.getElementById('amount').value = '+';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="icons\income\icons8-salary-50.png"/><br />Grants
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Sales';
        document.getElementById('amount').value = '+';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="icons\income\icons8-sales-50.png" /><br />Sales
        </button>
        <button class="incbtn" onclick="document.getElementById('text').innerHTML = 'Refunds';
        document.getElementById('amount').value = '+';
        document.getElementById('text').style.color = 'limegreen'">
          <img src="icons\income\icons8-refund-50.png" /><br />Refunds
        </button>
      </div>
    </div>

    <div class="column">
      <div class="container">
        <h3>Your Balance</h3>
        <h1 id="balance">₹<?php echo $bal['bal'];?></h1>

        <div class="inc-exp-container">
          <div>
            <h3>Income</h3>
            <h3 id="money-plus" class="money plus">₹<?php echo $inc['sum(trans_amount)'];?></h3>
          </div>
          <div>
            <h3>Expense</h3>
            <h3 id="money-minus" class="money minus">₹<?php echo $exp['sum(trans_amount)'];?></h3>
          </div>
        </div>
        <br><hr>
        <h3><u>Add New Transaction</u></h3>

        <form method="post">
          <label for="text">Category Selected  |  </label>
          <label id="text">--</label>
          <input type="hidden" name="category" id="category">
          <input type="hidden" name="bal" id="bal">
          <br><br>
          <label for="amount">Amount (in ₹)</label>
          <input type="text" id="amount" name="amount" placeholder="Enter amount"/>
          <br>
          <input type="submit" name="trans" class="button" value="Add Transaction" onclick="copyContent()">
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
            <td>
              <form method="post">
                <input type="hidden" name="trans_id" value="<?php echo $rows['trans_id'];?>">
                <button class="change" name="delete">
                  <img src="icons\white\icons8-delete-button-20.png" />
                </button>
              </form>
            </td>
          </tr>
          <?php
            }
          ?>
      </table>
    </div>
    <script src=script.js></script>
  </body>
</html>