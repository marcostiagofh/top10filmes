<?php

    session_start();

    //estabelecendo conexao
    $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
    
    //inicializacao de valor default para as seguintes variaveis
    $id = 0;
    $update = false;
    $titulo = '';
    $descricao = '';
    $categoria = '';
    $ator = '';
    $diretor = '';
    $imagem = '';

    //adicionando filme
    if(isset($_POST['save'])){
        $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error());
    
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $ator = $_POST['ator'];
        $diretor = $_POST['diretor'];
        $imagem = $_POST['imagem'];
        
        if($result->num_rows==10){
            echo "\tNão foi possível adicionar o filme. TOP 10 completado!";
            die;
        } else{
            //erro ao adicionar 11-esimo filme
            $_SESSION['msg'] = "Registro salvo com sucesso!";
            $_SESSION['tipo_msg'] = "success";

            header("location: index.php");

            //query para adicionar registro à tabela
            $mysqli->query("INSERT INTO data (titulo, descricao, categoria, ator, diretor, imagem) VALUES ('$titulo', '$descricao', '$categoria', '$ator', '$diretor', '$imagem')") or die($mysqli->error);
        }
    }

    //deletando registro de filme
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error());

        $_SESSION['msg'] = "Registro deletado com sucesso!";
        $_SESSION['tipo_msg'] = "danger";

        header("location: index.php");
    }

    //recuperando informacoes de registro a ser atualizado
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;

        $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
        
        if(count($result)==1){
            $row = $result->fetch_array();
            $titulo = $row['titulo'];
            $descricao = $row['descricao'];
            $categoria = $row['categoria'];
            $ator = $row['ator'];
            $diretor = $row['titulo'];
            $imagem = $row['imagem'];
        }
    }

    //atualizando registro
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $titulo = $_POST['titulo'];
        $descricao = $_POST['descricao'];
        $categoria = $_POST['categoria'];
        $ator = $_POST['ator'];
        $diretor = $_POST['diretor'];
        $imagem = $_POST['imagem'];

        $mysqli->query("UPDATE data SET titulo='$titulo', descricao='$descricao', categoria='$categoria', ator='$ator', diretor='$diretor', imagem='$imagem' WHERE id=$id") or die($mysqli->error);

        $_SESSION['msg'] = "Registro atualizado com sucesso";
        $_SESSION['tipo_msg'] = "warning";

        header('location: index.php');
    }
?>