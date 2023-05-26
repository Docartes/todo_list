<?php  
require 'connection/connect.php';
$result = mysqli_query($conn, "SELECT * FROM todo_list");

function addTask () {
	global $conn;
	$newTask = $_POST['input'];

	$query = "INSERT INTO todo_list VALUES('', '$newTask')";
	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

if (isset($_POST['save'])) {
	if (addTask () > 0) {
		header("Location: index.php");
	} else {
		echo "<script>
		alert('gagal');
		document.location.href = 'index.php';
		</script>";
	}
}

function delete ($id) {
	global $conn;
	$query = "DELETE FROM todo_list WHERE id = $id";
	$result = mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>List</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Itim&family=Manrope&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
	<div class="container-fluid mt-4">
		<div class="row justify-content-center align-items-center mb-3 rounded flex-column">
			<div class="col-lg-4 bg-primary text-light">
				<p class="h3 text-center pt-1">To do list</p>
			</div>
			<div class="col-lg-4 mt-4 mb-5 bg-light pt-2 rounded" id="clm2">
				<form action="" method="post" class="form-check d-flex flex-column">
					<div class="formElement mt-5 ms-auto me-auto" style="margin-bottom: 10px;">
						<?php $i = 1; ?>
						<?php while ($row = mysqli_fetch_assoc($result)) : ?>
							<input type="checkbox" class="check form-check-input" id="check<?php echo $i; ?>">
							<label for="check<?php echo $i; ?>" id="label<?php echo $i; ?>" class="label form-check-label mb-2" style="margin-left: 15px;"><?php echo $row["todo"]; ?></label>
							
							<a href="controller/delete.php?id=<?php echo $row["id"]; ?>" class="delete" onclick="return confirm('Yakin?')"><i class="text-dark bi bi-trash"></i></a>
							<br>
							<?php $i++ ?>
						<?php endwhile; ?>	
					</div>
					<div class="input d-flex" style="height: 30px; margin-bottom: 40px; margin-left: auto; margin-right: auto;">
						<input type="text" class="form-control" style="width: 180px; height: 30px; display: none; margin-top: 2px;" name="input" id="inputText" autocomplete="off">
						<button id="save" name="save" class="btn btn-success btn-sm ms-2 mt-auto" style="display: none; margin-bottom: 20px;"><i class="bi bi-save"></i></button>							
						<button id="cancel" name="cancel" class="btn btn-danger btn-sm ms-2 mt-auto me-4" style="display: none; margin-bottom: 20px;"><i class="bi bi-x-circle-fill"></i></button>
					</div>
				</form>
			</div>
			<div class="col-lg-4">
				<form action="" method="post" class="d-flex justify-content-center align-items-center">
					<button type="submit" name="submit" class="btn btn-success rounded" id="create"><i class="bi bi-plus-lg me-2"></i>New task</button>
				</form>
			</div>
		</div>
	</div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#create").click(function(event) {
				event.preventDefault();
				$("#inputText").show();
				$("#save").show();
				$("#cancel").show();
				$("#cancel").click(function() {
					$("#inputText").hide();
					$("#save").hide();
					$("#cancel").hide();
				})
			});
		});
	</script>
</body>
</html>