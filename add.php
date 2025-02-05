<?php
    include_once('db.php');
    $output = array('error' => false);
    $database = new connDB();
    $db = $database->open();
    try{
        //use of prepared statement to prevent sql injection
        $stmt = $db->prepare("INSERT INTO members (firstname, lastname, address) VALUES (:firstname, :lastname, :address)");
        //if-else statement executing prepared statement
        if ($stmt->execute(array(':firstname' => $_POST['firstname'] , ':lastname' => $_POST['lastname'] , ':address' => $_POST['address'])) ){
            $output['message'] = 'Member added successfully';
        }
        else{
            $output['error'] = true;
            $output['message'] = 'Something went wrong. Cannot add member';
        } 
    }
    catch(PDOException $e){
        $output['error'] = true;
        $output['message'] = $e->getMessage();
    }
    //close connection
    $database->close();
 
    echo json_encode($output);
?>