<?php
header('Access-Control-Allow-Origin: *');

$connect = new PDO("mysql:host=localhost;dbname=id20420998_bancodedados", "id20420998_dadosdatabase", "Tomate50!!!>>>");
$received_data = json_decode(file_get_contents("php://input"));
$data = array();
if ($received_data->action == 'fetchall') {
    $query = "
 SELECT * FROM fatec_professores 
 ORDER BY id DESC
 ";
    $statement = $connect->prepare($query);
    $statement->execute();
    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    echo json_encode($data);
}
if ($received_data->action == 'insert') {
    $data = array(
        // colocar os nomes das tabelas e dos v-models linkados ao JS
        ':first_name' => $received_data->firstName,
        ':adress' => $received_data->adressProf,
        ':course' => $received_data->courseProf,
        ':wage' => $received_data->wageProf,
    );

    $query = "
 INSERT INTO fatec_professores 
 (first_name, adress, course, wage) 
 VALUES (:first_name, :adress, :course, :wage)
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Adicionado'
    );

    echo json_encode($output);
}
if ($received_data->action == 'fetchSingle') {
    $query = "
 SELECT * FROM fatec_professores 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $result = $statement->fetchAll();

    foreach ($result as $row) {
        // colocar os nomes das tabelas e dos v-models linkados ao JS
        $data['id'] = $row['id'];
        $data['first_name'] = $row['first_name'];
        $data['adress'] = $row['adress'];
        $data['course'] = $row['course'];
        $data['wage'] = $row['wage'];
    }

    echo json_encode($data);
}
if ($received_data->action == 'update') {
    // colocar os nomes das tabelas e do que foi criado no JS
    $data = array(
        ':first_name' => $received_data->firstName,
        ':adress' => $received_data->adressProf,
        ':course' => $received_data->courseProf,
        ':wage' => $received_data->wageProf,
        ':id' => $received_data->hiddenId
    );

    $query = "
 UPDATE fatec_professores 
 SET first_name = :first_name, 
 adress = :adress,
 course = :course,
 wage = :wage
 WHERE id = :id
 ";

    $statement = $connect->prepare($query);

    $statement->execute($data);

    $output = array(
        'message' => 'Professor Atualizado'
    );

    echo json_encode($output);
}

if ($received_data->action == 'delete') {
    $query = "
 DELETE FROM fatec_professores 
 WHERE id = '" . $received_data->id . "'
 ";

    $statement = $connect->prepare($query);

    $statement->execute();

    $output = array(
        'message' => 'Professor Deletado'
    );

    echo json_encode($output);
}

?>