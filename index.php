<!doctype html>
<html lang="en">
  <head>
    <title>Meu TOP 10 filmes</title>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.css">
	  <link rel="stylesheet" href="css/style.css">
    
    
  </head>
  <body>
    <!-- navbar criada no topo da pagina -->
    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#!">Meu TOP 10 Filmes</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <?php require_once 'process.php'; ?>

    <?php
    if (isset($_SESSION['msg'])): ?>

    <div class="alert alert-<?=$_SESSION['tipo_msg']?>">

    <?php
      echo $_SESSION['msg'];
      unset($_SESSION['msg']); 
    ?>
    </div>

    <?php endif; ?>

    <!-- abrir conexao mysqli-->
    <div class="container">
      <?php 
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
        
      ?>

      <!-- elemento panel envolve a lista de filmes -->
      <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Filmes</h3>
            </div>
            <div class="panel-body">
              <div class="row justified-context-center">
                <table class="table">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Titulo</th>
                      <th>Descricao</th>
                      <th>Categoria</th>
                      <th>Ator</th>
                      <th>Diretor</th>
                      <th>Imagem</th>
                      <th colspan="2">Ação</th>
                    </tr>
                  </thead>
                  <!-- imprime registro de cada filme atraves de um while loop-->   
                  <?php 
                    $i = 1;
                    while($row = $result->fetch_assoc()): ?>
                      <tr>
                        <td> <?php echo $i; ?> </td>
                        <td> <?php echo $row['titulo']; ?> </td>
                        <td> <?php echo $row['descricao']; ?> </td>
                        <td> <?php echo $row['categoria']; ?> </td>
                        <td> <?php echo $row['ator']; ?> </td>
                        <td> <?php echo $row['diretor']; ?> </td>
                        <td> <img class="thumbnail" src="<?php echo $row['imagem']; ?>"> </td>
                        <td>
                          <a href="index.php?edit=<?php echo $row['id']; ?>" class="btn btn-info">Editar</a>
                          <a href="process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Deletar</a>
                        </td>
                      </tr>
                  <?php $i++; endwhile; ?>
                </table>
              </div>
            </div>
          </div>
        </div>
    </div>

    <div class="center-block" style="width: 500px;">
      <div class="panel panel-default">
          <div class="panel-heading">
              <h3 class="panel-title">Adicionar Filme</h3>
          </div>
          <div class="panel-body">
              <div class="row center-block">
                  <div class="col-md-10">
                      <form action="" method="post">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <div class="form-group">
                            <label>Título</label>
                            <input type="text" name="titulo" class="form-control" value="<?php echo $titulo; ?>" placeholder="Digite o título do filme">
                        </div>
                        <div class="form-group">
                            <label>Descrição</label>
                            <textarea name="descricao" class="form-control" value="<?php echo $descricao; ?>" placeholder="Descrição do filme"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Categoria</label>
                            <select type="text" name="categoria" class="form-control" value="<?php echo $categoria; ?>">
                                <option placeholder="Suspense">Suspense</option>
                                <option placeholder="Drama">Drama</option>
                                <option placeholder="Romance">Romance</option>
                                <option placeholder="Ação">Ação</option>
                                <option placeholder="Outro">Outro</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ator</label>
                            <input type="text" name="ator" class="form-control" value="<?php echo $ator; ?>" placeholder="Ator do filme">
                        </div>
                        <div class="form-group">
                            <label>Diretor</label>
                            <input type="text" name="diretor" class="form-control" value="<?php echo $diretor; ?>" placeholder="Diretor do filme">
                        </div>
                        <div class="form-group">
                            <label>Imagem</label>
                            <input type="text" name="imagem" class="form-control" value="<?php echo $imagem; ?>" placeholder="Imagem do filme">
                        </div>
                        
                        <?php if($update == true): ?>
                        <button type="submit" class="btn btn-info" name="update">Atualizar</button>
                        <?php else: ?>
                        <button type="submit" class="btn btn-primary" name="save">Adicionar</button>
                        <?php endif; ?>
                        
                      </form>
                  </div>
              </div>
          </div>
      </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="/bower_components/bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>