<html>
<head>
<style>
	body{
		font-family:Arial, Helvetica, sans-serif;
	}
	li{
		font-family:Arial, Helvetica, sans-serif;
	}
	p{
		font-family:Arial, Helvetica, sans-serif;
	}
	div{
		font-family:Arial, Helvetica, sans-serif;
	}
</style>
</head>
<div style="width:800px;">
<div style="width:800px; overflow:hidden;">
	<img src="images/banner.gif" />
</div>
<div style="float:left;width:200px;">
<h3 align="center">Don't have a netID? Create a new account for your application.</h3>
	<form action="./application/start.php" method="post" name="create" target="_top">
    	Email:<br /> <input type="text" size="20" name="email" /><br />
        Password: <input type="password" size="20" name="password" /><br />
        Confirm : <input type="password" size="20" name="confirm" /><br />
       	<input type="button" onClick="if(document.create.password.value==document.create.confirm.value && document.create.password.value != ''){document.create.submit();}else{alert('passwords do not match');}" value="submit" />
     </form>
</div>
<div style="float:left;">
            	<div style="height:445px; width:400px; _padding-top:20px;" align="left">
                    <p style="color:#C01525; font-size:16px;" align="center" ><strong>What you should know about working at the<br> Arizona Student Unions</strong></p>

                    Over 1,000 students work for the Arizona Student Unions each semester, making us the largest employer on campus. Be part of our diverse winning team and receive hands-on experience, while working in a fun and safe environment. We strive to coach, teach, and mentor all of our students.
</div>
</div>
