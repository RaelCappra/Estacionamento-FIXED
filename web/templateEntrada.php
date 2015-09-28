
<?php
    error_reporting(E_ALL);

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
  
    
    $tpl = new Template("../view/entradaVeiculo.html");
    $veiculoDao = new VeiculoDao();
    $entrada = $veiculoDao->getEntrada($_SESSION['placa']);
 
    
        $tpl->PLACA = $entrada[0]['placa_veiculo'];
        $tpl->HORARIO = $entrada[0]['hora_entrada'];
        $tpl->ANDAR = $entrada[0]['andar_vaga'];
        $tpl->NUMERO = $entrada[0]['numero_vaga'];        
    $tpl->show();
    
    

?>
