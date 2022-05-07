<?php

$servername = "localhost";
$username = "mamata";
$password = "sv50/tXJxd.XOQU4";
$dbname = "crudoperation";
// Create connection
$conn = mysqli_connect($servername, $username, $password,$dbname);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}


extract($_POST);
//display data
if(isset($_POST['readrecord'])){
    $data = '<table class="table table-bordered table-striped">
    <tr>
    <th>No.</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email Address</th>
    <th>Mobile Number</th>
    <th>Edit Action</th>
    <th>Delete Action</th>
    </tr>';
    $displayquery = "SELECT * FROM `crudtable`";
    $result = mysqli_query($conn,$displayquery);

    if(mysqli_num_rows($result)>0){
      $number = 1;
       while($row = mysqli_fetch_array($result)){

        $data .= '<tr>
        <td>'.$number.'</td>
        <td>'.$row['firstname'].'</td>
        <td>'.$row['lastname'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['mobile'].'</td>
        <td>
        <button onclick="getUserDetails('.$row['id'].')" class="btn btn-warning">Edit</button>
        </td>
        <td>
        <button onclick="deleteUser('.$row['id'].')" class="btn btn-warning">Delete</button>
        </td>
        </tr>';
        $number++;
       }
    }
    $data .='</table>';
    echo $data;


}

//insert data
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['mobile'])){
    $query = "INSERT INTO `crudtable` (`firstname`, `lastname`, `email`, `mobile`) VALUES ('$firstname','$lastname','$email','$mobile');";
    mysqli_query($conn,$query);
}

// $sql = "INSERT INTO `crudtable` (`id`, `firstname`, `lastname`, `email`, `mobile`) VALUES (NULL, 'Milan', 'Gurung', 'milangurung@gmail.com', '9803582104');";
// mysqli_query($conn,$sql);


//delete user record

if(isset($_POST['deleteid'])){
  echo "it works";
  $userid = $_POST['deleteid'];
  $deletequery = "DELETE FROM `crudtable` WHERE `crudtable`.`id` = '$userid'";
  mysqli_query($conn,$deletequery);
}
?>