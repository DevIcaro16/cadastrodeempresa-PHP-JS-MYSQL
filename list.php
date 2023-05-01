<?php

//Arquivo PHP para exibir as informações do BD .

include_once("./conexao/conexao.php"); // Para incluir as informações do arquivo conexao.php . 

$pagina = filter_input(INPUT_GET,"pagina",FILTER_SANITIZE_NUMBER_INT); // Variável GET para fazer a paginação do código . 

if(!empty($pagina)){ // Se página não estiver vazio :

//Calcular o inicio da visualização : 

$num_registros = 4; //Para definir a Quantidade de registro dos usuários por página .

$inicio_pagina = ($pagina * $num_registros) - $num_registros; //Variável para identificar o inicio da pagina .


$query_usuarios = "SELECT * FROM usuario ORDER BY id_usuario DESC LIMIT $inicio_pagina,$num_registros"; //Código SQL da query. 
$result_usuarios = $connect -> prepare($query_usuarios); //Para preparar a query.
$result_usuarios -> execute(); // Para executar a query.


//Paginação - somar a qunatidade de registros de usuários cadastrados : 

    //query para realizar o cálculo de usuários .

$query_count_usuarios = "SELECT COUNT(id_usuario) AS num_registros_usuarios FROM usuario";
$result_count_usuarios = $connect -> prepare($query_count_usuarios);
$result_count_usuarios->execute();
$row_count_usuarios = $result_count_usuarios->fetch(PDO::FETCH_ASSOC); //FETCH_ASSOC irá associar os nomes das colunas aos seus registros .

//Quantidade de páginas : 

$quant_pagina = ceil($row_count_usuarios['num_registros_usuarios'] / $num_registros) ;

$dados = "<div class='table-responsive'>

            <table class='table table-bordered'>

                <thead class='thead-dark'>

                    <tr>

                        <th>ID : </th>
                        <th>Nome : </th>
                        <th>Email : </th>
                        <th>Função : </th>
                        <th>Edição : </th>
                        <th>Excluir : </th>

                    </tr>

            </thead>

    <tbody>"; //Variável que vai guardar as informações do banco : 

while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){ //Estrutura para selecionar as informações(Colunas) da tabela do BD 

    extract($row_usuario); //Para converter os valores do Array Assoc row_usuario(colunas do BD) em variáveis.
    $dados .= "<tr>

                    <td>#$id_usuario</td>
                    <td>$nome_usuario</td>
                    <td>$email_usuario</td>
                    <td><button id='$id_usuario' class='btn btn-primary btn-sm ' onclick='visualizarInformacoesUsuario($id_usuario)'>Visualizar</button></td>
                    <td><button id='$id_usuario' class='btn btn-warning btn-sm ' onclick='editarInformacoesUsuario($id_usuario)'>Editar</button></td>
                    <td><button id='$id_usuario' class='btn btn-danger btn-sm ' onclick='excluirInformacoesUsuario($id_usuario)'>Apagar</button></td>
                    <br>

                </tr>";
    
}

$dados .= "</tbody>

    </table>

</div>";

    //Para adicionar o código HTML (Bootstrap) para passar as páginas .

    $min_links = 2; //Para ter 2 paginas anteriores quando for passar as páginas : . 
    $max_links = 2; //Para ter 2 paginas posteriores quando for passar as páginas : . 

    $dados .= '<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">';

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='usuariosCadastrados($pagina - ($pagina - 1))'>Primeira</a></li>";

    for($pag_anterior = $pagina - $min_links;$pag_anterior<=$pagina-1;$pag_anterior++){

        //Utlizando a função onclick Para direcionar a página anterior .
        
        if($pag_anterior >= 1 ){ // Para não deixar exibir o num de uma página menor que 1 . 

            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='usuariosCadastrados($pag_anterior)'>$pag_anterior</a></li>";

        }

        

    }

    $dados .= "<li class='page-item'><a class='page-link' href='#'>Atual($pagina)</a></li>";

    for($pag_posterior = $pagina + 1;$pag_posterior<=$pagina+$max_links;$pag_posterior++){

        //Utlizando a função onclick Para direcionar a página poaterior .
        
        if($pag_posterior <= $quant_pagina ){ // Para não deixar exibir o num de uma página maior que a última página . 

            $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='usuariosCadastrados($pag_posterior)'>$pag_posterior</a></li>";
         }

 }    

    //Utlizando a função onclick Para direcionar a ultima página . 

    $dados .= "<li class='page-item'><a class='page-link' href='#' onclick='usuariosCadastrados($quant_pagina)'>Última</a></li>";

    $dados .= '</ul></nav>';  


    


echo"$dados"; //Para exibir as informações . 


}else{ //Caso haja uma página sem usuários cadastrados irá ser exibido esta mensagem : 

    echo "<div class='alert alert-danger' role='alert'>Ops! Parece que não há Usuários Cadastrados aqui</div>";

}
?>