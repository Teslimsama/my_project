<?php
// include('session.php');
$conn = new PDO('mysql:host=localhost;dbname=unibooks', 'root', '');
include('function.php');
$query = '';
$output = array();
$query .= "SELECT * FROM producttb ";
if (isset($_POST["search"]["value"])) {
	$query .= 'WHERE product_name LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR product_image LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR product_price LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR faculty LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR department LIKE "%' . $_POST["search"]["value"] . '%" ';
	$query .= 'OR level LIKE "%' . $_POST["search"]["value"] . '%" ';
}
if (isset($_POST["order"])) {
	$query .= 'ORDER BY ' . $_POST['order']['0']['column'] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
	$query .= 'ORDER BY id DESC ';
}
if ($_POST["length"] != -1) {
	$query .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}
$statement = $conn->prepare($query);
$statement->execute();
$result = $statement->fetchAll();
$data = array();
$filtered_rows = $statement->rowCount();
foreach ($result as $row) {
	$image = '';
	if ($row["product_image"] != '') {
		$image = '<img src="upload/' . $row["product_image"] . '" class="img-thumbnail" width="50" height="35" />';
	} else {
		$image = '';
	}
	if ($row['type'] === '1') {
		$type="Free Book";
	} else {
		$type = "Project";
	}
	$sub_array = array();
	$sub_array[] = 1;
	$sub_array[] = $image;
	$sub_array[] = $row["product_name"];
	$sub_array[] = '₦'. $row["product_price"];
	$sub_array[] = $type;
	$sub_array[] = $row["faculty"];
	$sub_array[] = $row["department"];
	$sub_array[] = $row["level"]. 'L';
	$sub_array[] = '<a href="javascript:;" class="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
	<i class="fa-solid fa-ellipsis-vertical"></i>
</a>
<ul class="dropdown-menu">
	<li>
		<button type="button" name="update" id="' . $row["id"] . '" class="dropdown-item update">Edit</button>
	</li>
	<li>
		<button type="button" name="delete" id="' . $row["id"] . '" class="dropdown-item delete">Delete</button>
	</li>
</ul>';
	// $sub_array[] = '';
	$data[] = $sub_array;
	;
}
$output = array(
	"draw"				=>	intval($_POST["draw"]),
	"recordsTotal"		=> 	$filtered_rows,
	"recordsFiltered"	=>	get_total_all_records(),
	"data"				=>	$data
);
echo json_encode($output);
?>