<?php
	global $title;
	require_once("../core/function.php");
	require_once("../core/config.php");
	if ($_SERVER['REQUEST_METHOD'] === 'POST'){
		session_start();
		$username = db::escape_string($_POST['username']);
		$password = db::escape_string($_POST['password']);
		$email = db::escape_string($_POST['email']);
		$captcha = db::escape_string($_POST['captcha']);
		$ip = getIP();
		
		$error = 0;
		
		$cusername = db::num_rows("SELECT * FROM contas WHERE login = '$username'");
		$cemail = db::num_rows("SELECT * FROM contas WHERE email = '$email'");
		
		$error = $error + $cusername + $cemail;
		if ($cusername > 0){
			echo "<script>alert('Already registered with same Username!');</script>";
			exit();
		}else if ($cemail > 0){
			echo "<script>alert('Already registered with same Email!');</script>";
			exit();
		}
		if (!isset($username) || !isset($password) || !isset($email) || !isset($captcha)){
			echo "<script>alert('You need to fill all data!');</script>";
		}
		if ($captcha == $_SESSION['captcha']){
			$qip = "SELECT * FROM contas WHERE ip = '$ip'";
			$checkip = db::num_rows($qip);
			if ($checkip > 100){
				echo "<script>alert('Already registered with same IP! Your IP = $ip');</script>";
			}else{
				$query = "INSERT INTO contas (ip, actived, login, senha, email) VALUES ('$ip', '1', '$username', '$password', '$email');";
				$exec = db::query($query);
				echo "<script>alert('Registered'); window.location.href = '/index.php';</script>";
			}
		}else{
			echo "<script>alert('Wrong captcha!');</script>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta http-equiv="pragma" content="no-cache">
		<meta http-equiv="cache-control" content="no-cache">
		<meta name="description" content="<?php echo $title; ?> Register">
		<meta name="csrf-token" content="rhN45ANGFlE1PUiKeCKfpnG40nkOT5bBqH2Y9ZR2">
		<title><?php echo $title; ?> Register</title>
		<link rel="stylesheet" href="/css/app.css">
		<link rel="stylesheet" href="/css/new-register.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<style type="text/css">
			.register-form form li select,
			.register-form form li input {
			}
		</style>
		<style type="text/css">
			body {
			background: url(/storage/landing/1/landing_pg_bg.jpg) top center no-repeat #080f13;
			}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="logo">
				<img src="/storage/pointblank_logo_beyaz.png" alt="Point Blank" class="img-fluid">
			</div>
			<div class="contents">
				<div class="row">
					<div class="col-12">
						<div class="event-detail">
							Welcome to <?php echo $title; ?> registration form.
						</div>
					</div>
				</div>
				<div class="row ">
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="register-form">
							<form name="userForm" id="userForm" class="form dev_check_enter" onsubmit="return formSend();">
								<div class="form-group">
									<input type="username" id="username" name="username" class="form-control"
										title="Enter Username"
										placeholder="Username"
										value=""
										>
									<p class="notice_txt" id="notice_txt_username"></p>
								</div>
								<div class="form-group">
									<input type="email" id="email" name="email" class="form-control"
										title="Enter Email Address"
										placeholder="Email Address"
										value=""
										>
									<p class="notice_txt" id="notice_txt_email"></p>
								</div>
								<div class="form-group">
									<input type="password" id="password" name="password" class="form-control"
										title="Enter Password"
										placeholder="Password">
									<p class="notice_txt" id="notice_txt_password"></p>
								</div>
								<div class="form-group">
									<input type="password" id="password_confirmation"
										name="password_confirmation" class="form-control"
										title="Enter Confirm Password"
										placeholder="Confirm Password"
										>
									<p class="notice_txt" id="notice_txt_password_confirmation"></p>
								</div>
								<div class="form-group">
									<table style="width: 100%">
										<tr>
											<td><img name="captcha" src="../core/captcha2.php"></td>
											<td><input type="input" id="captcha"  name="captcha" class="form-control" placeholder="Captcha"></td>
										</tr>
									</table>
									<p class="notice_txt" id="notice_txt_captcha"></p>
								</div>
								<!--<div class="check_agree">
									<div class="form-check">
										<input class="form-check-input" name="join_agree" type="checkbox" value="1" id="join_agree">
										<label class="form-check-label" for="join_agree">I've read and accepted the <a href="//www.tamgame.com/policy/customer.do" target="_blank">User Agreement (EULA)</a> , <a href="//www.tamgame.com/policy/privacy.do" target="_blank">Privacy Policy</a> and <a href="//www.tamgame.com/policy/manner.do" target="_blank">Hack Policy</a></label></label>
									</div>
								</div>-->
								<!--<button type="button" class="submit-form" onclick="javascript:sendIt();">CREATE ACCOUNT</button>-->
								<button type="button" class="submit-form" onclick="sendIt();" style="margin-top: 0px;">CREATE ACCOUNT</button>
							</form>
						</div>
					</div>
					<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
						<div class="gifts">
							<img src="/storage/landing/1/starter_pack_content_en.png" alt="TAM Game Portal Registration | PB Event"> 
							<!-- Picture Format
								Width : 309
								Height : 345
								Border Radius : 6-->
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<script type="text/javascript">
            $('.register-form input').keypress(function (e) {
                if (e.which == 13) {
                    sendIt();
                    return false;
                }
            });
            function drawMsg(key, str) {
                $("#notice_txt_" + key).html(str).fadeIn();
            }
			function refreshCaptcha(){
				var image = document.getElementsByName("captcha")[0];
				image.setAttribute("src", "./core/captcha.php");
			}
            $(document).ready(function () {
                //document.title = "title.site.register.title";
                $('#userid').keyup(function (evt) {
                    if (evt.keyCode == 13) {
                        return false;
                    }
                });
                $('.notice_txt').hide();
            });
        </script>
        <script type="text/javascript">
            var focusId = "";
            var errorCount = 0;

            function formSend() {
                sendIt();
                return false;
            }
			// NEW
			function sendIt(){
				focusId = "";
				errorCount = 0;
                $('.notice_txt').hide();
                setSubmitBlock(true);
				
				usernameCheck();
				emailCheck();
				passwordCheck();
				captchaCheck();
				
				availableCheck();
			}
			function usernameCheck(){
				var regExp = /^[a-zA-Z0-9]+$/;
                if ($("#username").val().trim() == "") {
                    drawMsg("username", "Please enter Username.");
                    if (focusId == "") focusId = "username";
                    errorCount++;
                }
				else if ($("#username").val().trim().length < 3 || $("#username").val().trim().length > 20) {
                    drawMsg("username", "Username has to be between 6-60 characters long");
                    if (focusId == "") focusId = "username";
                    errorCount++;
                }
                else if (!$('#username').val().match(regExp)) {
                    drawMsg("username", "Please enter a valid username. Characters and numbers only");
                    if (focusId == "") focusId = "username";
                    errorCount++;
                }
			}
			function emailCheck(){
				var regExp = /^[0-9a-zA-Z]([-_\.]*[0-9a-zA-Z]*)*@([0-9a-zA-Z_-]+)(\.[0-9a-zA-Z_-]+){1,2}$/;
                if ($("#email").val().trim() == "" || $("#email").val().trim() == "title.single.join.email") {
                    drawMsg("email", "Please enter E-Mail address.");
                    if (focusId == "") focusId = "email";
                    errorCount++;
                }
                else if ($("#email").val().trim().length < 6 || $("#email").val().trim().length > 60) {
                    drawMsg("email", "E-Mail has to be between 3-60 characters long");
                    if (focusId == "") focusId = "email";
                    errorCount++;
                }
                else if (!$('#email').val().match(regExp)) {
                    drawMsg("email", "Please enter a valid e-mail address.");
                    if (focusId == "") focusId = "email";
                    errorCount++;
                }

			}
			function passwordCheck(){
				var regPwd1 = /[^a-zA-Z0-9~`!@#$%^&*()_\-+={}[\]|\\;:'""<>,.?/]/g;
                var regPwd2 = /([a-zA-Z0-9])\1{2,}/g;

                if ($("#password").val().trim().length <= 0 || $("#password").val().trim() == "title.single.join.password") {
                    drawMsg("password", "Please enter your password.");
                    if (focusId == "") focusId = "password";
                    errorCount++;
                } else if ($("#password").val().trim().length < 6 || $("#password").val().trim().length > 16) {
                    drawMsg("password", "Password has to be between 6-16 characters long");
                    if (focusId == "") focusId = "password";
                    errorCount++;
                } else if (regPwd1.test($("#password").val().trim())) {
                    drawMsg("password", "Located only a number on your keyboard, you can use English characters and symbols.");
                    if (focusId == "") focusId = "password";
                    errorCount++;
                } else if (regPwd2.test($("#password").val().trim())) {
                    drawMsg("password", "Please do not use repeating characters in your password.");
                    if (focusId == "") focusId = "password";
                    errorCount++;
                } else if ($("#password").val().trim() != $("#password_confirmation").val().trim()) {
                    drawMsg("password_confirmation", "Passwords does not match.");
                    $("#password_confirmation").val("");
                    if (focusId == "") focusId = "password_confirmation";
                    errorCount++;
                }
			}
			function captchaCheck(){
				var regExp = /^[a-zA-Z0-9]+$/;
				if ($("#captcha").val().trim() == "") {
                    drawMsg("captcha", "Please enter Captcha.");
                    if (focusId == "") focusId = "captcha";
                    errorCount++;
                }
				else if ($("#captcha").val().trim().length < 6 && $("#captcha").val().trim().length > 1) {
                    drawMsg("captcha", "Captcha has to be 6 characters long");
                    if (focusId == "") focusId = "captcha";
                    errorCount++;
                }
                else if (!$('#captcha').val().match(regExp)) {
                    drawMsg("captcha", "Please enter a valid captcha. Characters and numbers only");
                    if (focusId == "") focusId = "captcha";
                    errorCount++;
                }
			}
			function availableCheck(){
				var error = 0;
				$.ajax({
					url: '../core/api.php?q=check_username&val=' +  $('#username').val(),
					success: function(msg) {
						var result = $.parseJSON(msg);
						if (result.registered == 1){
							drawMsg("username", "Existing Account With Same Username");
							//error++;
							errorCount++;
						} 
					}
				});
				$.ajax({
					url: '../core/api.php?q=check_email&val=' +  $('#email').val(),
					success: function(msg) {
						var result = $.parseJSON(msg);
						if (result.registered == 1){
							drawMsg("email", "Existing Account With Same E-Mail");
							//error++;
							errorCount++;
						} 
						registerCheck(error);
					}
				});
			}
			
			function registerCheck(val){
				//console.log("countError : " + errorCount);
				/*if (!$("#join_agree").is(":checked")) {
                    alert("Please agree the terms and conditions.");
                    $("#join_agree").focus();
                    setSubmitBlock(false);
                    return;
                }*/
				if (val == 0 && errorCount == 0){
					var frm = $("#userForm");
					frm.attr("method", "POST");
					frm.attr("onsubmit", "return true");
					//setSubmitBlock(false);
					//console.log(frm.serialize());
					frm.submit();
					//console.log("success");
				}
			}
			//

            function setSubmitBlock(stat) {
                if (stat) {
                    $("#btnSubmit").attr("disabled", "true").parent().hide();
                    $(".loding").show();        //$("#loading_progress").show();
                }
                else {
                    $("#btnSubmit").removeAttr("disabled").parent().show();
                    $(".loding").hide();        //$("#loading_progress").hide();
                }
            }

        </script>
	</body>
</html>
