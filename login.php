<?php
include_once 'logpro.php';
?>
<html>
<head>
<meta charset="UTF-8">
<title>SMS/USSD CS - Login Page</title>
<link rel="stylesheet" href="style.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function signin() {
                var u = _("username").value;
                var lp = _("lpassword").value;
                if (u == "" || lp == "") {
                    _("lstatus").innerHTML = "<p>All fields are required*</p>";
                } else {
                    _("signinbtn").style.display = "none";
                    _("lstatus").innerHTML = '<p>please wait ...</p>';
                    var ajax = ajaxObj("POST", "logpro.php");
                    ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) == true) {
                            if (ajax.responseText == "login_failed") {
                                _("lstatus").innerHTML = "<p>Sign in unsuccessful, try again.</p>";
                                _("signinbtn").style.display = "block";
                            } else if (ajax.responseText == "not_exists") {
                                _("lstatus").innerHTML = "<p>That username donnot exist.</p>";
                                _("signinbtn").style.display = "block";
                            } else {
                                window.location = "user.php?u=" + ajax.responseText;
                            }
                        }
                    }
                    ajax.send("u=" + u + "&lp=" + lp);
                }
            }
</script>
</head>
<body><div id="container">
<?php include_once('pageTP.php');?>
<div id="pageMiddle">
<div id="pageMiddleWrap">
<div id="pageMiddleTitle">
<p>login to continue</p>
</div>
<div class="login-page">
  <div  class="form">
    <form class="login-form" id="signinform" onsubmit="return false;">
	<span id="lstatus"></span></td>
      <input class="textinput" id="username" type="text" onfocus="emptyElement('lstatus')" onkeyup="restrict('username')" maxlength="88" placeholder="mobile number"/>
      <input class="textinput" id="lpassword" type="password" onfocus="emptyElement('lstatus')" maxlength="88" placeholder="password"/>
      <button id="signinbtn" onclick="signin()">login</button>
      <p class="message">Not registered? <a href="register.php">Create an account</a></p>
    </form>
  </div>
</div>

</div>
</div>
</div>
</body>
</html>