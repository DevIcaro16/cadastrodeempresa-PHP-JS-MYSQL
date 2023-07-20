<?php

//Arquivo para conter o código HTML e exibir as informações do BD a partir das tags :  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Linkamento CSS do Bootstrap : -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
     integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
     crossorigin="anonymous">
     <link rel="stylesheet" href="style/style.css">
    <title>Projeto CRUD - PHP/JS</title>

    <link rel="short icon" href="../IMG/cinetec.ico">
</head>

<body>

    <nav>


        <ul id="navbar">
            <h2 id="h2-navbar">Companhia Pinheiro LTDA &copy;</h2>
        </ul>

</nav>

    <!-- Classes usadas a partir do linkamento com o framework bootstrap para ajustar e tornar responsivas as dimensões da página :  -->

    <div class="container">

        <div class="row mt-4">

            <div class="col-lg-12 d-flex justify-content-between align-items-center ">

                    <div>

                        <h4>Usuários Cadastrados : </h4>

                    </div>

                <div>
 
                        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#CadUsuarioModal">
                            Cadastrar
                        </button>


             </div>

        </div>

    </div>

        <hr>

        <span id="msgAlerta"></span>

        <!-- Código HTML para listar os usuários : -->

        <!-- Classes usadas nos arquivos HTML e PHP, a partir do linkamento com o framework bootstrap
         para ajustar e tornar responsivas as dimensões da página :  -->
        
        <div class="row">

            <div class="col-lg-12">

                <span class="usuarios-cadastrados"></span>

            </div>

        </div>


    </div>



    <footer id="rodape">

    <p> Grupo Pinheiro &copy; 2023</p>
</footer>


<!-- Janelas Moldais Do Bootstrap: -->


    <!-- Janela Modal para realizar o Cadastro : -->
<div class="modal fade" id="CadUsuarioModal" tabindex="-1" aria-labelledby="CadUsuarioModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CadUsuarioModal">Novo Cadastro</h5>
        <input type="submit" id="btn-limpar-inputs" class="btn btn-outline-warning" value="Limpar...">
      </div>
      <div class="modal-body">
      <form id="cad-usuario-form">
        <span id="msgAlertaErro"></span>
          <div class="mb-3">
            <label for="nome" class="col-form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="nome" placeholder="Digite o Nome De Usuário. Ex.: Joabe Lima">
          </div>
          <div class="mb-3">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="email" placeholder="Digite um Email Válido . Ex.: JoabeLima@gmail.com">
          </div>
          <div class="mb-3">
            <label for="funcao" class="col-form-label">Funcões:</label>
            <input type="text" name="funcao" class="form-control" id="funcao" placeholder="Insira as Funções do usuário . Ex.: Trabalha como Dev Back-End" maxlength="255"></textarea>
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                <input type="submit" class="btn btn-outline-success" id="cad-usuario-btn" value="Cadastrar">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>  

<!-- Janela Modal para mostrar os detalhes de Cadastro do usuário : -->


<div class="modal fade" id="visualizarUsuarioModal" tabindex="-1" aria-labelledby="visualizarUsuarioModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="visualizarUsuarioModal"><span id="nome-usuario"></span></h5>
        <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
      </div>
      <div class="modal-body">
        <span id="msgAlertaErroVisualizar"></span>
        <dl class="row">
          <dt class="col-sm-3">Funcão Exercida: </dt>
           <dd class="col-sm-9"><span id="funcao-usuario"></span></dd>
        </dl>
      </div>
    </div>
  </div>
</div>  



<!-- Janela Modal para realizar a edição das informações do Usuário : -->

<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editarUsuarioModal">Alterar Cadastro</h5>
        <input type="submit" id="btn-limpar-inputs-editar" class="btn btn-outline-warning" value="Limpar...">
      </div>
      <div class="modal-body">
      <form id="editar-usuario-form">
        <span id="msgAlertaErroEditar"></span>
        <!--hidden : type que deixa o input oculto no form . -->
        <input type="hidden" name="id" id="editar_id">
          <div class="mb-3">
            <label for="nome" class="col-form-label">Nome:</label>
            <input type="text" name="nome" class="form-control" id="editar_nome" placeholder="Digite o Nome De Usuário. Ex.: Joabe Lima">
          </div>
          <div class="mb-3">
            <label for="email" class="col-form-label">Email:</label>
            <input type="email" name="email" class="form-control" id="editar_email" placeholder="Digite um Email Válido . Ex.: JoabeLima@gmail.com">
          </div>
          <div class="mb-3">
            <label for="funcao" class="col-form-label">Funcões:</label>
            <input type="text" name="funcao" class="form-control" id="editar_funcao" placeholder="Insira as Funções do usuário . Ex.: Trabalha como Dev Back-End" maxlength="255"></textarea>
          </div>
          <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                <input type="submit" class="btn btn-outline-success" id="editar-usuario-btn" value="Alterar">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>  



<!-- Janela Modal para excluir os dados de registro do usuário : -->


<div class="modal fade" id="excluirUsuarioModal" tabindex="-1" aria-labelledby="excluirUsuarioModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="excluirUsuarioModal">Apagar Registro</h5>
      </div>
      <div class="modal-body">
      <form id="excluir-usuario-form">
        <span id="msgAlertaErroExcluir"></span>
          <h5>Deseja realmente excluir esse registro De Nome: </h5>
          <input type="text" name="nome" class="form-control" id="excluir_nome" disabled placeholder="Digite o Nome De Usuário. Ex.: Joabe Lima">
          <!--hidden : type que deixa o input oculto no form . -->
          <input type="hidden" name="excluir_id" id="excluir_id">
          <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Fechar</button>
                <input type="submit" name="excluir-usuario-btn" class="btn btn-outline-success" id="excluir-usuario-btn" value="Excluir">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>  




    <!-- Limkamento JS do bootstrap V5 : -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>

    <!-- Limkamento JS do Diretório : -->
    <script src="JS/index.js"></script>

</body>
</html>