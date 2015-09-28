<?php 

	require_once("../lib/Template.php");
    use raelgc\view\Template;
    include "../dao/VeiculoDao.php";
    include "../lib/sessions.php";
    $tipoSession = checkSession();

    if(!$tipoSession){
        header('location: ../view/index.php');
    } else if ($tipoSession != "funcionario"){
        header('location: templateMenuAdmin.php');
    }

    $tpl = new Template("../view/situacaoEstacionamento.html");
    $veiculoDao = new VeiculoDao();

    $entradas = $veiculoDao->getEntradasAtuais();
    foreach($entradas as $entrada){
        $tpl->PLACA= $entrada['placa_veiculo'];
        $tpl->ANDAR_ENTRADA = $entrada['andar_vaga'];
        $tpl->NUMERO_ENTRADA = $entrada['numero_vaga'];
        $tpl->HORA = $entrada['hora_entrada'];
        $tpl->TIPO_VEICULO = $entrada['nome'];
        $tpl->block("BLOCK_ESTACIONAMENTO");
    }

    
    $vagas = $veiculoDao->getVagasLivres();
    
    if($vagas){
        foreach($vagas as $vaga){
            $tpl->ANDAR_VAGA= $vaga['andar'];
            $tpl->NUMERO_VAGA = $vaga['numero'];
            $tpl->TIPO_VAGA = $vaga['nome'];
            $tpl->block("BLOCK_VAGAS");
        }
    } else{
        $tpl->block("BLOCK_NO_VAGAS");
    }



    $tpl->show();

?>