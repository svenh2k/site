<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> Phone Book </title>
    <style>
        table,
        th,
        td {
            border: 1px blue solid;
            padding: 5px;
        }

    </style>
</head>

<body>
    <h1>My Phone Book</h1>

    <form action="php_03.php" method="post">
        <label for="name">Name</label>
        <input type="text" placeholder="Enter Name" name="name" id="name"><br>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="Enter Email"><br>
        <label for="phone">Phone</label>
        <input type="text" placeholder="Enter Phone" name="phone" id="phone"><br>
        <input type="submit" value="Insert" name="insert">
    </form>


    <?php
    
    $host = "localhost";
    $user = "root";
    // does not have a password to access 
    $pass = "";
    $db = "contacts";
    $port = "8888";

    //$conn = mysqli_connect ($host, $user, $pass, $db, $port);
    // use for future projects line 35-44
    $conn = mysqli_connect ($host, $user, $pass, $db);

    if ($conn){
        echo "Successfully Connected to the DB <br>";
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        
        if (isset($_POST['insert'])){ 
            $sql = "insert into friends (name, email, phone) values (?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $phone);
            $stmt->execute();
            echo "<p>Added $name </p>";
        }
    }
    else {
        die( "DB Connection Failed");
    }

    // Display the table
    
    $sql = "select * from friends";
    $res = $conn->query($sql);
    $row_cnt = mysqli_num_rows($res);
    
    //echo "<p>Found $row_cnt records </p>";
    
    if ($row_cnt > 0){
        echo "
        <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
        </tr>";
        
        for ($i = 0; $i < $row_cnt; $i++){
            $rec = $res->fetch_assoc();   // Cursor
            $name = $rec['name'];
            $email = $rec['email'];
            $phone = $rec['phone'];
            
            
            echo "<tr>
                  <td>$name </td>
                  <td>$email </td>
                  <td>$phone </td>
                  </tr>
                  ";
        }
        
        echo "</table>";
    }
    
    $conn->close();
?>
</body>

</html>
