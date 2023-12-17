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
		<title>course</title>
	
		
	</head>
	<body>
	<center>
	
		<h1><b><u>Course</u></b></h1>
		
		<?php if (isset($error_message)) { ?>
			<p style="color: red;"><?php echo $error_message; ?></p>
		<?php } ?>
		
		
	<table>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
	
	
	<tr>
	<td><label><h2>Course ID:</h2></label></td>
          <td><h2><?php echo $lecturer['CourseID']; ?></h2></td>
	</tr>
	<tr>
	<td><label><h2>Course Name:</h2></label></td>
          <td><h2><?php
			if($lecturer['CourseID']==1001)
			{
				echo "Higher National Diploma in IT";
			}
			else if($lecturer['CourseID']==1002)
			{
				echo "Higher National Diploma in Accounting";
			}
			else if($lecturer['CourseID']==1003)
			{
				echo "Higher National Diploma in English";
			}
			else if($lecturer['CourseID']==1004)
			{
				echo "Higher National Diploma in THM";
			}
			else
			{
				echo "Not selected";
			}
			?>
		  
		  </h2></td>
	</tr>
	 </form>
	</table>
	</center>
</body>
</html>