<?php
if (isset($_POST['btnlogin'])) {
  require_once "config.php";
  $sql = "SELECT * FROM tblaccounts WHERE username=? AND `userpass`=? AND userstatus='ACTIVE'";
  if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "ss", $_POST['txtusername'], $_POST['txtpassword']);
    if (mysqli_stmt_execute($stmt)) {
      $result = mysqli_stmt_get_result($stmt);
      if (mysqli_num_rows($result) > 0) {
        $account = mysqli_fetch_array($result, MYSQLI_ASSOC);
        session_start();
        $_SESSION['username'] = $_POST['txtusername'];
        $_SESSION['usertype'] = $account['usertype'];
        if($_SESSION['usertype']==="ADMINISTRATOR"){
          header("location: employees-management.php");

        }else{
          header("location: attendance-management-employee.php");
        }
        echo "<font color='green'>Login Successful</font>";
      } else {
        echo "<font color='red'>Incorrect login details or account is disabled/inactive</font>";
      }
    } else {
      echo "<font color='red'>Error on login statement</font>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Atkinson+Hyperlegible+Next:ital,wght@0,200..800;1,200..800&family=Jockey+One&family=Lexend:wght@100..900&family=Mulish:ital,wght@0,200..1000;1,200..1000&family=Noto+Sans+Mongolian&family=Roboto:ital,wght@0,100..900;1,100..900&family=Schibsted+Grotesk:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
<style>
  body { 
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    margin: 0;
    font-family: Arial, Helvetica, sans-serif;
    overflow: hidden;
    height: 100vh;
    display: flex;
    flex-direction: column;
  }

  /* Header */
  .logoicon {
    width: 23px;
    height: 23px;
    margin-right: 8px;
    margin-left: 40px;
    margin-bottom: 5px;
  }

  .header {
    display: flex;
    align-items: center;
    background-color: #ffffff;
    padding: 10px 10px;
  }

  .header a {
    color: black;
    text-decoration: none;
    font-size: 18px;
    border-radius: 4px;
  }

  .header a.logo {
    font-family: "Atkinson Hyperlegible Next", serif;
    font-size: 25px;
    font-weight: bold;
    padding-left: 5px;
  }

  /* Login Contents */
  .container {
    max-width: 100%;
    padding-left: 400px;
    padding-top: 200px;
    padding-right: 500px;
  }

  .row {
    justify-content: flex-start !important;
  }

  .col-md-4 {
    width: 100%;
    max-width: 400px;
  }

  .welcome, .enter, .user, .pass {
    text-align: left;
  }

  .welcome {
    font-family: "Lexend", serif;
    font-size: 40px;
    font-weight: normal;
    margin-bottom: 13px;
  }

  .enter {
    font-family: "Lexend", serif;
    font-size: 20px;
    font-weight: normal;
    margin-bottom: 60px;
  }

  .leaf-container {
    position: absolute;
    top: 80px;
    right: 0px;
  }

  .leaf {
    width: 800px;
    height: 875px;
    margin-top: 0;
  }

  .user, .pass, .show {
    font-weight: bold;
    font-size: 18px;
  }

  .show{
    margin-top: 10px;
  }

  .txtusername, .txtpassword {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    height: 45px;
    border-radius: 8px;
    border: 1px solid #B4B4B4;
  }

  .login {
    width: 100%;
    padding: 5px;
    font-size: 18px;
    font-weight: bold;
    background-color: #0A112F;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    margin-top: 20px; 
  }

  body, html {
    overflow: hidden;
    height: 100%;
  }

  /* Responsive Styles for Smaller Screens */
  @media screen and (max-width: 1480px) {
    .container {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  height: 100vh; 
  padding: 40px; 
}

.row {
  width: 100%;
  max-width: 500px; 
}

.col-md-6 {
  width: 100%;
  max-width: 400px;
}

.welcome {
  font-size: 32px; 
}

.enter {
  font-size: 18px;
  margin-bottom: 30px;
}

.txtusername, .txtpassword {
  width: 100%;
  font-size: 16px;
  padding: 12px;
  height: 45px;
}

.login {
  width: 100%;
  font-size: 18px;
  padding: 12px;
}

.leaf-container {
  display: none; /* Hide image in split screen mode */
}
  }

  /* Responsive Styles for Mobile */
  @media screen and (max-width: 768px) {
    .container {
      padding-left: 20px;
      padding-right: 20px;
      padding-top: 50px;
    }

    .welcome {
      font-size: 30px;
    }

    .enter {
      font-size: 16px;
      margin-bottom: 30px;
    }

    .col-md-6 {
      width: 100%;
    }

    .leaf-container {
      display: none; /* Hide leaf image on mobile */
    }

    .login {
      font-size: 16px;
      padding: 10px;
    }

    .txtusername, .txtpassword {
      font-size: 14px;
      padding: 8px;
      height: 35px;
    }
  }
</style>
</head>
<body>
  <div class="header">
    <img src="hand-coins.png" alt="Logo" class="logoicon">
    <a href="#default" class="logo">PAYROLL</a>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h2 class="welcome">Welcome back!</h2>
        <h2 class="enter">Enter your Credentials to access your account</h2>
        <form method="post" action="index.php">
          <div class="mb-3">
            <label for="username" class="user">Username</label>
            <input type="text" class="txtusername" placeholder="employeeID" name="txtusername" />
          </div>
          <div class="mb-3">
            <label for="password" class="pass">Password</label>
            <input type="password" class="txtpassword" placeholder="•••••••" name="txtpassword" id="password" />
            <div class="show">
              <input type="checkbox" class="form-check-input" id="showPassword" />
              <label class="form-check-label" for="showPassword">Show Password</label>
            </div>
            <input type="submit" class="login" name="btnlogin" value="Login">
        </form>
      </div>
    </div>
  </div>

  <div class="leaf-container">
    <img src="leaf.png" alt="Image" class="leaf">
  </div>

  <script>
    document.getElementById("showPassword").addEventListener("change", function () {
      const passwordField = document.getElementById("password");
      passwordField.type = this.checked ? "text" : "password";
    });
  </script>
  
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>