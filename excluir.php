<?php


include_once("conexao/conexao.php");

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);



if(empty($dados['excluir_id'])){ 

    $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: O ID do usuário não foi encontrado! .</div>"];


}else{

    //Exluindo o registro do usuário no BD atráves do ID .

    $query_delete_usuario = "DELETE FROM usuario WHERE id_usuario = :id"; //Código SQL da Query .
    $result_query_delete_usuario = $connect -> prepare($query_delete_usuario); //Para preparar a query.
    $result_query_delete_usuario->bindParam(':id',$dados['excluir_id']);
    

    //Por ser apenas uma query para registro individual(apenas 1), não é necessário utilizar a estrutura : while(utlizada quando há mais de 1 registro).

    if($result_query_delete_usuario->execute()){


    $result = ['erro' => false,'msg' => "<div class='alert alert-success' role='alert'>Registro Excluído Com Sucesso!</div>"];

    }else{

        $result = ['erro' => true, 'msg' => "<div class='alert alert-danger' role='alert'>Erro: Não foi possível excluir este registro .</div>"];

    }

}


echo json_encode($result);

?>

