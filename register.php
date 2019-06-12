<?php
include_once 'regpro.php';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>SMS/USSD CS - Registration page</title>
<link rel="stylesheet" href="style.css">
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
			function emptyElement(x) {
                _(x).innerHTML = "";
            }
			function checkphone() {
                var m = _("phone").value;
                if (m != "") {
                    var ajax = ajaxObj("POST", "regpro.php");
                    ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) === true) {
                            _("phonestatus").innerHTML = ajax.responseText;
                        }
                    }
                    ajax.send("phonecheck=" + m);
                } else {
                    _("phonestatus").innerHTML = '<p>your mobile number is required*</p>';
                }
            }
			function checkname() {
                var n = _("name").value;
                if (n != "") {
                    var ajax = ajaxObj("POST", "regpro.php");
                    ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) === true) {
                            _("namestatus").innerHTML = ajax.responseText;
                        }
                    }
                    ajax.send("namecheck=" + n);
                } else {
                    _("namestatus").innerHTML = '<p>company name is required*</p>';
                }
            }
			function checkpassword() {
                var p = _("password").value;
                if (p != "") {
                    var ajax = ajaxObj("POST", "regpro.php");
                    ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) === true) {
                            _("passwordstatus").innerHTML = ajax.responseText;
                        }
                    }
                    ajax.send("passwordcheck=" + p);
                }
                else {
                    _("passwordstatus").innerHTML = '<p>new password is required*</p>';
                }
            }
			function checkpassword1() {
                var p1 = _("password1").value;
                if (p1 != "") {
                    var ajax = ajaxObj("POST", "regpro.php");
                    ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) === true) {
                            _("password1status").innerHTML = ajax.responseText;
                        }
                    }
                    ajax.send("password1check=" + p1);
                }
                else {
                    _("password1status").innerHTML = '<p> confirm password is required*</p>';
                }
            }
			function signup() {
				var m = _("phone").value;
                var n = _("name").value;
                var p = _("password").value;
				var p1 = _("password1").value;
                var status = _("status");
                if (m == "" || n == "" ||  p == "" || p1 == "") {
                    status.innerHTML = "<p>All fields are required*</p>";
                } else {
                    _("signupbtn").style.display = "none";
                    status.innerHTML = '<p>please wait ...</p>';
                    var ajax = ajaxObj("POST", "regpro.php");
					ajax.onreadystatechange = function() {
                        if (ajaxReturn(ajax) == true) {
                            if (ajax.responseText !== "signup_success") {
                                status.innerHTML = ajax.responseText;
                                _("signupbtn").style.display = "block";
                            } else {
                                window.location = 'user.php';
                            }
                        }
                    }				
                    ajax.send("m=" + m +"&n=" + n + "&p=" + p + "&p1=" + p1);
                }
            }
			
</script>
</head>
<body><div id="container">
<?php include_once('pageTP.php');?>
<div id="pageMiddle">
<div id="pageMiddleWrap">
<div id="pageMiddleTitle">
<p>create an account</p>
</div>
<div class="login-page">
  <div class="form">
    <form id="signupform" onsubmit="return false;">
	<span id="status"></span></td>
      <input type="text" id="phone" onblur="checkphone()" onfocus="emptyElement('status')" maxlength="16"  placeholder="mobile number"/> 
	  <span id="phonestatus"></span>
      <input type="text" id="name" onblur="checkname()" onfocus="emptyElement('status')" maxlength="16" placeholder="company name"/>
	  <span id="namestatus"></span>
	  <input type="password" id="password" onblur="checkpassword()" onfocus="emptyElement('status')" maxlength="88" placeholder="new password"/>
	  <span id="passwordstatus"></span>
	  <input type="password" id="password1" onblur="checkpassword1()" onfocus="emptyElement('status')" maxlength="88" placeholder="confirm password"/>
	  <span id="password1status"></span>
      <button id="signupbtn" onclick="signup()">create</button>
      <p class="message">Already registered? <a href="login.php">Sign In</a></p>
    </form>
  </div>
</div>

</div>
</div>
</div>
</body>
</html>