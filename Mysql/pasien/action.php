
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "uas";
    $table = "Pasiens";

    $action = $_POST['action'];

    $conn = new mysqli($servername, $username, $password, $dbname);
   
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if('CREATE_TABLE' == $action){
        $sql = "CREATE TABLE IF NOT EXISTS $table (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            identitas VARCHAR(30) NOT NULL,
            status VARCHAR(30) NOT NULL
            )";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('GET_ALL' == $action){
        $dbdata = array();
        $sql = "SELECT id, identitas, status FROM $table ORDER BY id DESC";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $dbdata[]=$row;
            }
            echo json_encode($dbdata);
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('ADD_PAS' == $action){
        $identitas = $_POST['identitas'];
        $status = $_POST['status'];
        $sql = "INSERT INTO $table (identitas, status) VALUES('$identitas', '$status')";
        $result = $conn->query($sql);
        echo 'success';
        return;
    }

    if('UPDATE_PAS' == $action){
        $emp_id = $_POST['emp_id'];
        $identitas = $_POST['identitas'];
        $status = $_POST['status'];
        $sql = "UPDATE $table SET identitas = '$identitas', status = '$status' WHERE id = $emp_id";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }

    if('DELETE_PAS' == $action){
        $emp_id = $_POST['emp_id'];
        $sql = "DELETE FROM $table WHERE id = $emp_id";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "error";
        }
        $conn->close();
        return;
    }
    
?>
