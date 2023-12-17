<?php
session_start();

// Check if the user is not logged in, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}


include 'db.php';

$email = $_SESSION['email'];
$sql = "SELECT lecturer.*, course.Title AS CourseTitle
        FROM lecturer
        JOIN course ON lecturer.CourseID = course.CourseID
        WHERE lecturer.Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $lecturer = $result->fetch_assoc();
    $courseTitle = $lecturer['CourseTitle'];

    // ... other profile information

} else {
    // Handle lecturer not found as needed
    header("Location: login.php");
    exit();
}
$conn->close();
?>

<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lecturer Profile</title>
		<style>
				a:link, a:visited 
				{
				  background-color: #f44339;
				  color: white;
				  padding: 13px 25px;
				  text-align: center;
				  text-decoration: none;
				  display: inline-block;
				}

				a:hover, a:active 
				{
				  background-color:blue ;
				}
			</style>
	</head>
	<body></h3>
	<center>
	
		<h1><b><u>Profile</u></b></h1>
		
		<?php if (isset($error_message)) { ?>
			<p style="color: red;"><?php echo $error_message; ?></p>
		<?php } ?>
	<table>
	<tr>
	
	<td><label><h2>Name in full:</h2></label></td>
          <td><h2><?php echo $lecturer['Name']; ?></h2></td>
	</tr>
	<tr>	
	<td><label><h2>Email:</h2></label></td>
          <td><h2><?php echo $lecturer['Email']; ?></h2></td>
	</tr>	  
	<tr>
	<td><label><h2>Designation:</h2></label></td>
          <td><h2><?php echo $lecturer['Designation']; ?></h2></td>
	</tr>
	<tr>
	<td><label><h2>course:</h2></label></td>
          <td><h2><?php echo $lecturer['CourseID']; ?></h2></td>
	</tr>
	<tr>	   
	<td><label><h2>Gender:</h2></label></td>
           <td><h2><?php echo $lecturer['Gender']; ?></h2></td>
	</tr>

	<tr>	   
	<td><label><h2>Password:</h2></label></td>
           <td><h2><?php echo $lecturer['Password']; ?></h2></td>
	</tr>
	<tr>
	<td colspan="2" align="center"><a href="register.php" target="_blank">Edit Profile</a></td>
	</tr>
	</table>
	</center>
</body>
</html>
