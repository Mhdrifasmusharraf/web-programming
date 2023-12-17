<?php
session_start();

if (!isset($_SESSION['email'])) 
	{
		header("Location: login.php");
		exit();
	}

include 'db.php';

$email = $_SESSION['email'];
$sql = "SELECT * FROM Lecturer WHERE Email = '$email'";
$result = $conn->query($sql);

if ($result->num_rows == 1)
	{
		$lecturer = $result->fetch_assoc();
		$courseID = $lecturer['CourseID'];

		$courseSql = "SELECT * FROM Course WHERE CourseID = $courseID";
		$courseResult = $conn->query($courseSql);

		if ($courseResult->num_rows == 1) 
			{
				$course = $courseResult->fetch_assoc();
			} 
		else 
			{
				header("Location: error.php");
				exit();
			}
	} 
else 
	{
		header("Location: login.php");
		exit();
	}

$conn->close();
?>



    <!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Dashboard</title>
    <style>
      /* Add some basic CSS styles */
      body 
		{
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}

     #sidebar 
		{
			height: 100vh;
			padding: 20px;
			background-color: #e1e1e1;
			float: left;
			width: 250px;
		}

     #sidebar h2 
		{
			margin-top: 0;
		}

     #content 
		{
			padding: 20px;
			float: left;
			width: calc(100% - 250px);
		}

      /* Style the navigation links */
     #sidebar a 
		{
			color: #333;
			display: block;
			margin-bottom: 10px;
			text-decoration: none;
		}
     #sidebar a:hover 
		{
			text-decoration: underline;
		}
    </style>
  </head>
		<body>
			<div id="sidebar">
			  <h2><?php echo $lecturer['Name']; ?> Dashboard</h2>
			 
			  <a href="Profile.php" target="_blank">Profile</a>
			  <a href="Course.php" target="_blank">Course</a>
			  
			  <a href="#">Settings</a>
			</div>
			<div id="content">
			  <h1>Welcome back, <?php echo $lecturer['Name']; ?>!</h1>
			  <p>
				You can manage your account, orders, settings, and much more from this dashboard.
			  </p>
			  
			</div>
		</body>
</html>

    <a href="logout.php">Logout</a>
</body>
</html>
