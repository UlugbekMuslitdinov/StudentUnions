<?php

$to = 'gallaghertheater@gmail.com';
$subject = 'New Viewer\'s Choice Member - '.$_POST['name'];
$body = '
<html>
<head>
  <title>'.$subject.'</title>
</head>
<body>Form Data:<br/>
<table>
  <tr><td><b>Name</b></td><td>'.$_POST['name'].'</td></tr>
  <tr><td><b>E-mail</b></td><td>'.$_POST['email'].'</td></tr>
  <tr><td><b>Affiliation</b></td><td>'.ucfirst($_POST['year']).'</td></tr>
  <tr><td><b>Address</b></td><td>'.$_POST['address'].'</td></tr>
  <tr><td><b>Favorite Movie</b></td><td>'.$_POST['faveMovie'].'</td></tr>
  <tr><td><b>Favorite Genre</b></td><td>'.$_POST['genre'].'</td></tr>
  <tr><td><b>Movie Recommendation</b></td><td>'.$_POST['movieSelection'].'</td></tr>
  <tr><td><b>Heard About Us From</b></td><td>'.ucfirst($_POST['aboutUs']).'</td></tr>
  </table>
  </body>
</html>
';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: "Viewer\'s Choice" <noreply@unions.arizona.edu>' . "\r\n";
$headers .= 'Reply-To: noreply@unions.arizona.edu' . "\r\n";
	
mail($to, $subject, $body, $headers);

header('Location: index.php?submitted=1');

?>