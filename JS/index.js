//Arquivo JS para selecionar os dados do arquivo PHP e acessar o arquivo HTML para exibir as informações . 

//Para selecionar os elementos do arquivo HTML que foi linkado .



// variáveis para receberem os Formulários de cadastro e de edição de cadastro : 
const cardForm = document.getElementById("cad-usuario-form");
const editarForm = document.getElementById("editar-usuario-form");
const excluirForm = document.getElementById("excluir-usuario-form");



// variáveis para receberem e carregarem as janelas Modais do Bootstrap no arquivo HTML : 
const cardModal = new bootstrap.Modal(document.getElementById("CadUsuarioModal"));
const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarUsuarioModal"));  
const editarModal = new bootstrap.Modal(document.getElementById("editarUsuarioModal"));
const excluirModal = new bootstrap.Modal(document.getElementById("excluirUsuarioModal"));

//Variáveis para receberem os elementos que correspondem aos 'botões limpar' : 
const btnLimparInputs = document.getElementById("btn-limpar-inputs");
const btnLimparInputsEditar = document.getElementById("btn-limpar-inputs-editar");

// variáveis para receberem os valores do Inputs do Formulário de Cadastro : 
const nomeInput = document.getElementById("nome");
const emailInput = document.getElementById("email");
const funcaoInput = document.getElementById("funcao");
const nomeInputEditar = document.getElementById("editar_nome");
const emailInputEditar = document.getElementById("editar_email");
const funcaoInputEditar = document.getElementById("editar_funcao");

// variáveis para acessarem o local da tag span no arquibo HTML : 
const tbody = document.querySelector(".usuarios-cadastrados");
const msgAlerta = document.getElementById("msgAlerta");
const msgAlertaErro = document.getElementById("msgAlertaErro");
const msgAlertaErroEditar = document.getElementById("msgAlertaErroEditar");
const msgAlertaErroExcluir = document.getElementById("msgAlertaErroExcluir");
const spanFuncaoUsuario = document.getElementById("funcao-usuario");
const spanNomeUsuario = document.getElementById("nome-usuario");

/*Criando a Função Assíncrona (Funções que buscam dados ou recursos em arquivos externos) .
 para isso utiliza-se a key word : async .Nela podemos utilizar o await . */

const usuariosCadastrados = async(pagina) =>{ 

    //Await faz aguardar o processamento do código, só deixando ir para a próxima linha quando finalizar esta linha . 

    const dados = await fetch("./list.php?pagina=" + pagina); //Método fetch serve para buscar informações/dados em arquivos externos, no caso, um arquivo PHP .


    /*Método .text() :  Quando esse método é usado para retornar conteúdo,
     *ele retorna o conteúdo de texto de todos os elementos correspondentes (a marcação (tags) HTML será removida). */
    
     const resposta = await dados.text(); 
    
    tbody.innerHTML = resposta; // Para acessar o elemento tbdoy a partir do arquivo HTML .

}


    //Chamndo as Funções para executar o código .
    usuariosCadastrados(1);  





cardForm.addEventListener("submit", async (e)=>{ //Função de Evento(submit) do formulario Cadastrar .

    e.preventDefault(); //Para não recarregar a página em todo o evento .

     //Para mudar o value do btn da janela modal enqunto é feito o cadastro .

    //Validação no JS utilizando o .value === ""(valor do input igual a vazio) Para não deixar nenhum dos campos vazios :
    //OBS : é recomendado que a validação seja feita no JS, para que os dados não sejam mandados ao servidor .

    if(nomeInput.value === ""){

        msgAlertaErro.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Nome!</div>";

    }else if(emailInput.value === ""){

        msgAlertaErro.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Email!</div>";

    }else if(funcaoInput.value === ""){

        msgAlertaErro.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Preencha o campo Função!</div>";

    }else{

        /* FormData : FormData é, simplesmente, uma estrutura de dados que pode ser usada para armazenar pares chave-valor. 
    Assim como sugere o seu nome, ela foi projetada para manter dados de formulários, ou seja, você pode usá-la com o JavaScript
     para criar um objeto que corresponda a um formulário de HTML. usando como parâmetro a constante cardForm que contém os dados do
     formulário HTML . */



    const dadosForm = new FormData(cardForm); 
    dadosForm.append("add",1);


    const dados = await fetch("cadastrar.php",{

        method: "POST",
        body: dadosForm,

    });

    
    const result = await dados.json(); //Variável que retornará a mensagem de resultado do Cadastro no formato Json .
    console.log(result);


    if(result['erro']){ //Quando o cadastro der errado(Erro = True) .

    msgAlertaErro.innerHTML = result['msg'];
  
  
    }else{ //Quando o cadastro for Sucesso((Erro = False)) .
  
      msgAlerta.innerHTML = result['msg'];

      //Para apagar os valores que foram inseridos(.reset) e para fechar a janela modal quando for realizado o cadastro(.hide) .
      cardForm.reset();
      cardModal.hide();

      //Chamando a Função para atualizar a página assim que o novo cadastro foi realizado(Erro = False) .
        usuariosCadastrados(1);  
  
    }



    document.getElementById("cad-usuario-btn").value = "Cadastrar"; //Para retornar o value padrão do btn da janela modal . 



    }


});

//Funções com comandos relacionados ao CRUD : 

function limparDadosCadastro(){ //Função para limpar os Inputs da janela modal .

    nomeInput.value = " " ;
    emailInput.value = " " ;
    funcaoInput.value = " " ;


}

function limparDadosEdicaoCadastro(){ //Função para limpar os Inputs da janela modal .

    nomeInputEditar.value = " " ;
    emailInputEditar.value = " " ;
    funcaoInputEditar.value = " " ;


}

btnLimparInputs.addEventListener("click",(e)=>{ //Evento do Botão Limpar para o form de cadastro .

    e.preventDefault();

    limparDadosCadastro(); //Chamando a função para que seja executada ao clicar no botão 

});

btnLimparInputsEditar.addEventListener("click",(e)=>{ //Evento do Botão Limpar para o form de edição de cadastro .

    e.preventDefault();

    limparDadosEdicaoCadastro(); //Chamando a função para que seja executada ao clicar no botão 

});

async function visualizarInformacoesUsuario(id){ //Função Assíncrona para realizar a visualização dos usuarios atráves das requisições do fetch .

    //console.log("Acessou o " + id);

    const dados = await fetch('visualizar.php?id=' + id);

    const result = await dados.json();

    console.log(result);

    if(result['erro']){

        msgAlerta.innerHTML = result['msg'];

    }else{

        visualizarModal.show(); //Para apresentar a janela modal com a funcao do usuário .

        spanFuncaoUsuario.innerHTML = result['dados'].funcao_usuario; //Para atribuir um HTML (tag span) a funcao_usuario na janela modal .
        spanNomeUsuario.innerHTML = result['dados'].nome_usuario; //Para atribuir um HTML (tag span) a funcao_usuario na janela modal .

        //OBS : A variável result é um Array assoc, e dados(uma das suas chvaes) é um Objeto que possui atributos .

    }

}

async function editarInformacoesUsuario(id){ //Função Assíncrona para realizar a visualização dos usuarios atráves das requisições do fetch .

    const dados = await fetch('visualizar.php?id=' + id);

    const result = await dados.json();

    console.log(result);

    if(result['erro']){ // Qunado ocorre um problema(Erro = true) .

        msgAlerta.innerHTML = result['msg'];

    }else{ //Quando dar certo (Erro = false)

        editarModal.show();

        //Para acessar os elementos HTML e atribuirem os seus respectivos valores por meio Array assoc com Objetos result .

        document.getElementById("editar_id").value = result['dados'].id_usuario ; 
        document.getElementById("editar_nome").value = result['dados'].nome_usuario ; 
        document.getElementById("editar_email").value = result['dados'].email_usuario ; 
        document.getElementById("editar_funcao").value = result['dados'].funcao_usuario ; 
    }

}


async function excluirInformacoesUsuario(id){ //Função assíncrona que realizará o apagamento do registro do usuário .

    


        const dados = await fetch('visualizar.php?id=' + id);

        const result = await dados.json();

        console.log(result);
    
        if(result['erro']){ // Qunado ocorre um problema(Erro = true) .
    
            msgAlerta.innerHTML = result['msg'];
    
        }else{ //Quando dar certo (Erro = false)
    
            excluirModal.show();
            document.getElementById("excluir_nome").value = result['dados'].nome_usuario ;
            document.getElementById("excluir_id").value = result['dados'].id_usuario ;

    }

   



}



editarForm.addEventListener("submit", async (e)=>{ //Função de Evento(submit) do formulario Cadastrar .

    e.preventDefault(); //Para não recarregar a página em todo o evento .

     //Para mudar o value do btn da janela modal enqunto é feito o cadastro .


    


        /* FormData : FormData é, simplesmente, uma estrutura de dados que pode ser usada para armazenar pares chave-valor. 
    Assim como sugere o seu nome, ela foi projetada para manter dados de formulários, ou seja, você pode usá-la com o JavaScript
     para criar um objeto que corresponda a um formulário de HTML. usando como parâmetro a constante cardForm que contém os dados do
     formulário HTML . */



    const dadosForm = new FormData(editarForm); 
    console.log(dadosForm);
    
    const dados = await fetch("editar.php",{

        method: "POST",
        body: dadosForm,

    });

    
    const result = await dados.json(); //Variável que retornará a mensagem de resultado do Cadastro no formato Json .
    console.log(result);


    if(result['erro']){ //Quando o cadastro der errado(Erro = True) .

    msgAlertaErroEditar.innerHTML = result['msg'];
  
  
    }else{ //Quando o cadastro for Sucesso((Erro = False)) .
  
      msgAlerta.innerHTML = result['msg'];

      //Para apagar os valores que foram inseridos(.reset) e para fechar a janela modal quando for realizado o cadastro(.hide) .
      editarForm.reset();
      editarModal.hide();

      //Chamando a Função para atualizar a página assim que o novo cadastro foi realizado(Erro = False) .
        usuariosCadastrados(1);  
  
    }



    document.getElementById("cad-usuario-btn").value = "Alterar"; //Para retornar o value padrão do btn da janela modal . 

 

});


excluirForm.addEventListener("submit", async (e)=>{ //Função de Evento(submit) do formulario Cadastrar .

    e.preventDefault(); //Para não recarregar a página em todo o evento .

     //Para mudar o value do btn da janela modal enqunto é feito o cadastro .

    //Validação no JS utilizando o .value === ""(valor do input igual a vazio) Para não deixar nenhum dos campos vazios :
    //OBS : é recomendado que a validação seja feita no JS, para que os dados não sejam mandados ao servidor .

    


        /* FormData : FormData é, simplesmente, uma estrutura de dados que pode ser usada para armazenar pares chave-valor. 
    Assim como sugere o seu nome, ela foi projetada para manter dados de formulários, ou seja, você pode usá-la com o JavaScript
     para criar um objeto que corresponda a um formulário de HTML. usando como parâmetro a constante cardForm que contém os dados do
     formulário HTML . */



    const dadosForm = new FormData(excluirForm); 
    console.log(dadosForm);

    
    
    const dados = await fetch("excluir.php",{

        method: "POST",
        body: dadosForm,

    });

    
    const result = await dados.json(); //Variável que retornará a mensagem de resultado do Cadastro no formato Json .
    console.log(result);


    if(result['erro']){ //Quando o cadastro der errado(Erro = True) .

    msgAlertaErroExcluir.innerHTML = result['msg'];
  
  
    }else{ //Quando o cadastro for Sucesso((Erro = False)) .
  
      msgAlerta.innerHTML = result['msg'];

      //Para apagar os valores que foram inseridos(.reset) e para fechar a janela modal quando for realizado o cadastro(.hide) .
      excluirForm.reset();
      excluirModal.hide();

      //Chamando a Função para atualizar a página assim que o comando for passado corretamente .(Erro = False) .
        usuariosCadastrados(1);  
  
    }



    document.getElementById("excluir-usuario-btn").value = "Excluir"; //Para retornar o value padrão do btn da janela modal . 

 

});









