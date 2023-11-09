<?php 
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mathpage</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include('hdr.html') ?>
<div class="header">
	<h2>Mathpage</h2>
</div>
<div class="content">
    <center>
        <p>Number</p>
        <input type="text" id="num1" placeholder="Type number to add.">
        <div></div>
        <button onclick="fn1(); fn7(); fn8();">+</button>
        <button onclick="fn2(); fn7(); fn8();">-</button>
        <button onclick="fn3(); fn7(); fn8();">*</button>
        <button onclick="fn4(); fn7(); fn8();">/</button>
        <div></div>
        <button onclick="fn6()">Reset</button>
        <button onclick="fn7()">Power</button>
        <div class="sidebar" style="width: 200px; height: 54px;">
            <p style="float: left;">Answer:</p>
            <p id="output" style="float: right;">0</p>
        </div>
        <p id="output2"></p>
            
        <script>
           var num2 = 0
           var fn4count = 0
        function fn1()
            {
                var num1 = parseInt(document.getElementById("num1").value);
                var num3 = num2 + num1
                document.getElementById("output").innerHTML = num3;
                num2 = num3
            }
         function fn2()
            {
                var num1 = parseInt(document.getElementById("num1").value);
                var num3 = num2 - num1
                document.getElementById("output").innerHTML = num3;
                num2 = num3
            }
         function fn3()
            {
                var num1 = parseInt(document.getElementById("num1").value);
                var num3 = num2 * num1
                document.getElementById("output").innerHTML = num3;
                num2 = num3
            }
         function fn4()
            {
                var num1 = parseInt(document.getElementById("num1").value);
                //var num3 = num2 / num1
                //num2 = num3
                var num4 = num2
                var num5 = num2 / num1
                while (num2 >= num1)
                {
                    num2 -= num1;
                    fn4count += 1;
                }
                if (num2 != 0)
                    document.getElementById("output").innerHTML = num5 + ", or " + fn4count + " with a remainder of " + num2 + ".";
                else
                    document.getElementById("output").innerHTML = num5
                fn4count = 0
                num4 = 0
                num2 = num5
            }
         function fn5()
            {
                var num1 = parseInt(document.getElementById("num1").value);
                var num3 = num2 + num1
            }
         function fn6()
            {
               var num1 = 0
               var num3 = 0
               document.getElementById("output").innerHTML = num3;
               document.getElementById("output2").innerHTML = "";
               num2 = num3 
            }
          function fn7()
            {
                if (num2 > 9000)
                    {
                        var stnum2 = num2.toString();
                        document.getElementById("output").innerHTML = stnum2;
                        document.getElementById("output2").innerHTML = ".. wait.. THAT'S OVER 9000!!!";
                        num2 = num3
                    }
            }
          function fn8()
            {
                if (num2 <= 9000)
                    {
                        var stnum2 = num2.toString();
                        document.getElementById("output").innerHTML = stnum2;
                        document.getElementById("output2").innerHTML = "";
                        num2 = num3
                    }
            }
        </script>
    </center>
    </div>
</body>
</html>