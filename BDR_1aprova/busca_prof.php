<?php

header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20420998_bancodedados", "id20420998_dadosdatabase", "Tomate50!!!>>>");

$received_data = json_decode(file_get_contents("php://input"));

$data = array();

if($received_data->query != '')
{
	$query = "
	SELECT * FROM fatec_professores 
	WHERE first_name LIKE '%".$received_data->query."%' 
	OR course LIKE '%".$received_data->query."%' 
	ORDER BY id DESC
	";
}
else
{
	$query = "
	SELECT * FROM fatec_professores 
	ORDER BY id DESC
	";
}

$statement = $connect->prepare($query);

$statement->execute();

while($row = $statement->fetch(PDO::FETCH_ASSOC))
{
	$data[] = $row;
}

echo json_encode($data);

?>