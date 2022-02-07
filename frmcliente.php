<?php
$idcliente = isset($_GET["idcliente"])? $_GET["idcliente"]:null;
$op = isset ($_GET["op"]) ? $_GET ["op"]: null;
include "menu.php";
try{

    $servidor = "localhost";
    $usuario = "root";
    $senha = "";
    $bd = "bdprojeto";

    $con = new PDO("mysql:host=$servidor;dbname=$bd",$usuario,$senha);


    if($op=="del"){

        $sql = "delete FROM clientes where idcliente = :idcliente";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(":idcliente",$idcliente);
        $stmt->execute();
        header ("Location:listarclientes.php");


    }


    if($idcliente){

      $sql = "SELECT * FROM clientes where idcliente = :idcliente";  
      $stmt = $con -> prepare($sql);
      $stmt -> bindValue(":idcliente",$idcliente);
      $stmt -> execute();
      $cliente = $stmt -> fetch (PDO::FETCH_OBJ);
    }
    if($_POST){
        if($_POST["idcliente"]){
        $sql = "UPDATE clientes SET nome=:nome, email=:email WHERE idcliente=:idcliente";
        $stmt = $con -> prepare($sql);
        $stmt -> bindValue(":nome",$_POST["nome"]);
        $stmt -> bindValue(":email",$_POST["email"]);
        $stmt-> bindValue("idcliente",$_POST["idcliente"]);
        $stmt -> execute(); 
        }else{
            $sql = "INSERT INTO clientes (nome,email) values (:nome,:email)";

        $stmt = $con -> prepare($sql);
        $stmt -> bindValue(":nome",$_POST["nome"]);
        $stmt -> bindValue(":email",$_POST["email"]);
        $stmt -> execute();
        }
        header ("Location:listarclientes.php");
    }


} catch(PDOException $e){
echo $e-> getMessage();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<title>sistema crud</title>
</head>
<body>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>
    <title>Clientes</title>
</head>
<body>
    <h1>Formulario Cliente</h1>
    <hr>
    <form method="POST">
        nome <input type="text" name="nome"     value="<?php echo isset($cliente)? $cliente->nome:null?>"><br>
        email <input type="email" name ="email" value="<?php echo isset($cliente)? $cliente->email:null?>">
        <input type="hidden" name="idcliente"   value="<?php echo isset($cliente)? $cliente->idcliente:null?>"> <br><br>
        <input type="submit" value ="cadastrar">
       
    </form>


</body>
</html>