<?php

include_once("conexao/conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT); //Variável que receberá externamente(por método POST) todos os valores fo Formulário HTML em um Array .

//Validação no PHP utilizando o !empty(não vazio) Para não deixar nenhum dos campos vazios :
//OBS : Caso, por algum motivo, a validação JS seja burlada, ainda resta a validação PHP. Por isso, é recomendado que a validação seja feita em ambas . 


if(empty($dados['id'])){

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: não foi possível fazer a alteração desse usuário!</div>"];

}elseif(empty($dados['nome'])){

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Nome!</div>"];

}elseif(empty($dados['email'])){

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Email!</div>"];

}elseif(empty($dados['funcao'])){

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Funcão!</div>"];


}else{ //Caso todos os campos estejam preenchidos, todo o seguinte código para realizar o cadastro será executado : 

    $query_editar_cadastro = "UPDATE usuario SET nome_usuario = :nome , email_usuario = :email, funcao_usuario = :funcao WHERE id_usuario = :id"; //Código SQL da Query .
    $result_query_editar_cadastro = $connect -> prepare($query_editar_cadastro); //Para preparar a query.
    
    // Para selecionar e indicar os parâmetros no código SQL da query .
    
    $result_query_editar_cadastro->bindParam(':id',$dados['id']);
    $result_query_editar_cadastro->bindParam(':nome',$dados['nome']);
    $result_query_editar_cadastro->bindParam(':email',$dados['email']);
    $result_query_editar_cadastro->bindParam(':funcao',$dados['funcao']);
    
    
    $result_query_editar_cadastro -> execute(); // Para executar a query.

    
    if($result_query_editar_cadastro->rowCount()){
    
    //Array assoc result que conterá as mensagens de resposta do Cadastro(Sucesso).
    $result = ['erro' => false,'msg'=> "<div class='alert alert-success' role='alert'>Registro Editado Com Sucesso!</div>"]; 

    }else{

    //Array assoc result que conterá as mensagens de resposta do Cadastro(Erro).

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não Foi Possível Realizar a Edição do Cadastro!</div>"];
    
    }

}

echo json_encode($result);
    /*JSON_encode é uma função nativa da linguagem de programação PHP. Com ela, somos capazes de transformar valores para o formato JSON,
     muito utilizado como uma versão leve de para armazenamento de arquivos para troca e processamento de dados entre Sistemas Web.
     Em outras palavras, a função do JSON_encode é retornar a uma representação alternativa dos valores armazenados — objetos em PHP serão retornados objetos JSON.
      A implementação ocorreu a partir da versão 5.2 do PHP.*/

?>