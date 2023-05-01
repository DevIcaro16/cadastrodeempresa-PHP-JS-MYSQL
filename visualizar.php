<?php

//Arquivo PHP para exibir as informações do Usuário em janela modal .

include_once("./conexao/conexao.php"); // Para incluir as informações do arquivo conexao.php . 

$id = filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT); // Variável que receberá pelo método GET o valor do ID  . 

if(!empty($id)){ // Se existir um ID  :

    //Realizando a consulta do nome e da função do usuário no BD atráves do ID .

    $query_select_funcao = "SELECT id_usuario,nome_usuario,email_usuario,funcao_usuario FROM usuario WHERE id_usuario = :id LIMIT 1 "; //Código SQL da Query .
    $result_query_select_funcao = $connect -> prepare($query_select_funcao); //Para preparar a query.
    $result_query_select_funcao->bindParam(':id',$id);
    $result_query_select_funcao->execute();

    //Por ser apenas uma query para registro individual(apenas 1), não é necessário utilizar a estrutura : while(utlizada quando há mais de 1 registro).

    $row_select_funcao = $result_query_select_funcao->fetch(PDO::FETCH_ASSOC); //FETCH_ASSOC irá associar os nomes das colunas aos seus registros .


    $result = ['erro' => false,'dados' => $row_select_funcao];


}else{ //Caso haja uma página sem usuários cadastrados irá ser exibido esta mensagem : 

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' 
    role='alert'>Ops! Parece que não há Usuários Cadastrados aqui</div>"];
}


echo json_encode($result);
?>