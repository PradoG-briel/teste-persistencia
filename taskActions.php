<?php

require("./database/conexao.php");
switch($_POST["acao"]){
    case "inserir":
    // se houver o envio do formulário com uma tarefa
        if (isset($_POST["tarefa"])) {
            $tarefa = $_POST["tarefa"];
                $sqlTarefa = "INSERT INTO tbl_task (descricao) VALUES ('$tarefa')";
                $resultado = mysqli_query($conexao, $sqlTarefa);
           
                if($resultado == false){
                    $mensagem = "Erro ao adicionar tarefa!!!";
                    $tipoMensagem = "erro";
                }else{
                    $tipoMensagem = "sucesso";
                    $mensagem = "Tarefa adicionada com sucesso!!!";
                }
               //redirecionar para index.php (página das tarefas)
            }
       
    break;

    case "deletar":
    // implementar o algoritimo de deleção aqui
        if(isset($_POST["tarefaId"]) && $_POST["tarefaId"] !="") {
            $id = $_POST["tarefaId"];
           
            $sqlDelete = "DELETE FROM tbl_task WHERE id = $id";
            $resultado = mysqli_query($conexao, $sqlDelete);
            if($resultado == false){
                $tipoMensagem = "erro";
                $mensagem = "Erro ao excluir a tarefa!!";
            }else{
                $tipoMensagem = "sucesso";
                $mensagem = "Tarefa excluida com sucesso!!";
            }
        }
       

    case "editar":
        if(isset($_POST["tarefa"]) && isset($_POST["tarefaId"])){
            //pegar a tarefa e a tarefaId
            $tarefa = $_POST["tarefa"];
            $tarefaId = $_POST["tarefaId"];
            //declarar a query update
            $sqlUpdate = "UPDATE tbl_task SET descricao = '$tarefa' WHERE id = $tarefaId";
            //executar a query
            $resultado = mysqli_query($conexao, $sqlUpdate);
           
            
            //verificar se deu certo
            if ($resultado) {
                //se deu certo, mensagem de sucesso
                $tipoMensagem = "sucesso";
                $mensagem = "Tarefa editada com sucesso!";
            }else{
                //se não deu certo, mensagem de erro
                $tipoMensagem = "erro";
                $mensagem ="Ops, erro ao editar a tarefa!";
            }
        //redirecionar para a tela de listagem (index.php) com a mensagem
        }
        break;
}
header("location: index.php?mensagem=$mensagem&tipoMensagem=$tipoMensagem");
