
<?php



if(isset($_POST['card_number'])){

    $card_number = $_POST['card_number'];
    $cvv = $_POST['cvv'];
    $ano = $_POST['ano'];
    $mes = $_POST['mes'];
    $preco_total = $_POST['preco_total'];

    

	//URL
	$url = 'http://127.0.0.1:8080/Sistema_de_pagamentos/rest/pagamento';

	// Criar cURL
	$ch = curl_init($url);

	//preparar array de DADOS para enviar via POST
	$dados = array(
        "num_card" => $card_number,
        "cvv" => $cvv,
        "data_exp" => array(
            "year"=>$ano,
            "month" => $mes,
            "day"=>1
        ),
        "conta_recetor" => 2147483647,
        "valor" => $preco_total
	);

	//codificar array de dados em JSON
	$dados_em_json = json_encode($dados);

	//Juntar od dados no URL
	curl_setopt($ch, CURLOPT_POSTFIELDS, $dados_em_json);

	//formatar o conteudo página em application/json
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

	//Definir o retorno da resposta em vez de imprimir no ecrã
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	// Executar a chamada POST
	$resposta = curl_exec($ch);
	/*
	$resposta=json_decode($resposta);
	
	$resultado=$resposta->resultado;
	$mensagem=$resposta->mensagem;
	*/
	echo $resposta;

	//Fechar o cURL
	curl_close($ch);


}


?>