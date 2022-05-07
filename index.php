<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD Operation using AJAX in PHP</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  
</head>
<body>
    
   <div class="container">
       <h1 class="text-primary text-uppercase text-center">AJAX CRUD OPERATION</h1>
       <div class="d-flex justify-content-end">
            <!-- Button to Open the Modal -->
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal">Open Model</button>

       </div>
       <h2 class="text-danger">All Records</h2>
       <div id="records_contant"></div>
       <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
          <label for="Firstname">Firstname:</label>
          <input type="text" name="" id="firstname" class="form-control" placeholder="First Name">
       </div>
       <div class="form-group">
           <label for="Lastname">Lastname:</label>
           <input type="text" name="" id="lastname" class="form-control" placeholder="Last Name">
           </div>
           <div class="form-group">
           <label for="email">Email ID:</label>
           <input type="text" name="" id="email" class="form-control" placeholder="Email">
           </div>
           <div class="form-group">
           <label for="Phone Number">Mobile:</label>
           <input type="text" name="" id="mobile" class="form-control" placeholder="Mobile Number">   
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="addRecord()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> 


<!-- update modal -->
   <!-- The Modal -->
   <div class="modal" id="update">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">AJAX CRUD OPERATION</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    
      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
          <label for="update_firstname">Update Firstname:</label>
          <input type="text" name="" id="update_firstname" class="form-control" placeholder="First Name">
       </div>
       <div class="form-group">
           <label for="update_lastname">Update Lastname:</label>
           <input type="text" name="" id="update_lastname" class="form-control" placeholder="Last Name">
           </div>
           <div class="form-group">
           <label for="update_email">Update Email ID:</label>
           <input type="email" name="" id="update_email" class="form-control" placeholder="Email">
           </div>
           <div class="form-group">
           <label for="update_mobile">Update Mobile:</label>
           <input type="text" name="" id="update_mobile" class="form-control" placeholder="Mobile Number">   
       </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="updateUserDetail()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <input type="hidden" name="" id="hidden_user_id">
      </div>

    </div>
  </div>
</div> 


   </div>


  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <!-- <script type="text/javascript" src="https://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/js/bootstrap.min.js"></script>    -->
    <!-- jQuery library -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript">
      

      $(document).ready(function(){
          readRecords();
      });
       function readRecords(){
           var readrecord = "readrecord";

           $.ajax({
               url:"backend.php",
               type:"post",
               data:{ readrecord:readrecord},
               success:function(data,status){
                   $('#records_contant').html(data);
               }
           });
       };
      function addRecord(){
          var firstname = $('#firstname').val();
          var lastname = $('#lastname').val();
          var email = $('#email').val();
          var mobile = $('#mobile').val();

          $.ajax({
              url: "backend.php",
              type: 'post',
              data: {firstname:firstname,
                  lastname:lastname,
                  email:email,
                  mobile:mobile
              },
              success:function(data,status){
                  readRecords();
              },
          });
      };

      function deleteUser(deleteid){
          var conf = confirm("Are you sure about deleting the data!!!");
          if(conf===true){
              $.ajax({
                  url: "backend.php",
                  type: "post",
                  data:{ deleteid:deleteid},
                  success:function(data,status){
                      readRecords();
                  },
              });
              
          }
      };

      function getUserDetails(id){
        var conf = confirm("Are you sure about updating the data!!!");
          $('#hidden_user_id').val(id);

          $.post("backend.php",{
              id:id,
          }, function(data,status){
              var user = JSON.parse(data);
              $('#update_firstname').val(user.firstname);
              $('#update_lastname').val(user.lastname);
              $('#update_email').val(user.email);
              $('#update_mobile').val(user.mobile);

          }
          );
          $("#update").modal("show");

     
      };
      function updateUserDetail(){
        var firstnameupd = $('#update_firstname').val();
          var lastnameupd = $('#update_lastname').val();
          var emailupd = $('#update_email').val();
          var mobileupd = $('#update_mobile').val();

          var hidden_user_idupd = $('#hidden_user_id').val();
          $.post("backend.php",{
              hidden_user_idupd:hidden_user_idupd,
              firstnameupd:firstnameupd,
              lastnameupd:lastnameupd,
              emailupd:emailupd,
              mobileupd:mobileupd,
          },
          function(data,status){
            $("#update").modal("hide");
            readRecords();
          }

          );
      };

  </script>
</body>
</html>