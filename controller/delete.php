<?php  

require '../connection/connect.php';
require '../index.php';

$id = $_GET['id'];

if (delete ($id) > 0) {
	echo "<script>
	alert('data dihapus');
	document.location.href = '../index.php';
	</script>";
} else {
	echo "<script>
	alert('data gagal dihapus');
	document.location.href = '../index.php';
	</script>";
}

?>