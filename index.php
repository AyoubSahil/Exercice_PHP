<?php
 $connexion=new PDO('mysql:host=localhost;dbname=hy', 'root', '');
if(isset($_GET['id'])&&isset($_GET['del'])){
  $d=$_GET['id'];
  $delete=$connexion->exec("delete from users where id=$d");
}
if ((isset ($_POST['name1'])  && isset($_POST['email1']))&&(isset($_GET['act'])&& isset($_GET['id']))){
  $id1=$_GET['id'];
  $name1=$_POST['name1'];
  $email1=$_POST['email1'];

 $connexion->exec("update users SET name ='$name1', email = '$email1' WHERE id=$id1");
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</head>
<body>
    <br>
    <br>
    <div class="container">
    <form method="post">
    <div class="form-group">
    <label for="exampleInputPassword1">Name</label>
    <input  class="form-control" id=""name="name" placeholder="Enter name">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">

  </div>

  <br>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>


 <?php
 
 if (isset ($_POST['name'])  && isset($_POST['email'])){
 $a=$_POST['name'];
 $b=$_POST['email'];
 

 $insert=$connexion->exec("insert into users(name,email) values('$a','$b')");
}

 
 $extract=$connexion->query("select * from users");
 $result=$extract->fetchAll(\PDO::FETCH_ASSOC);

  
echo '<br>';
if(isset($_GET['act'])&& isset($_GET['id'])){
  $k=$_GET['id'];
  $extract1=$connexion->query("select * from users where id=$k");
  $result1=$extract1->fetchAll(\PDO::FETCH_ASSOC);
  $name=$result1[0]['name'];
  $email=$result1[0]['email'];
  echo "<form method='post'  ><input type='text' id='fname' value='$name' name='name1' placeholder='Enter name'><input type='text' id='lname' value='$email' name='email1'  placeholder='Enter email'> <input type='submit' >";
 
}
 echo '<br>';

 $table="<table class='table table-bordered'>
 <tr> 
   <th>ID</th>
   <th>Email</th>
   <th>Name</th>
   <th>suprimer</th>
   <th>modifier</th>

 </tr>";
 for($i=1;$i<sizeof($result);$i++){
    $table=$table.'<tr>';
     $a=$result[$i]['email'];
    $b=$result[$i]['name'];
    $c=$result[$i]['id'];
     $table=$table."<td>$c</td><td>$a</td>";
     $table=$table."<td>$b</td><td><form action='index.php?id=$c&del=2' method='post' ><button type='submit' class='btn btn-danger' id='submit' name='submit'>Delete</button></form></td><td><form action='index.php?act=1&id=$c' method='post' ><button type='submit' class='btn btn-success' id='submit' name='submit'>Edit</button></form></td>";



    $table=$table."</tr>";
 } 


 $table=$table."</tbody></table>";
 echo '<br>';
echo "<div>$table</div>";



?>

  </div>
    
</body>
</html>