<?php

//defini os paths para as classes do sistema e as classes gerais
$path["conexao"] = "painel/classes/";

include_once $path["conexao"] . "class.conexao.php";

//classe úteis
include_once $path["classes"] . "class.uteis.php";
$objUteis = new Uteis();

//inclui a classe de configuracao
include_once $path["classes"] ."class.Configuracao.php";
$objConfiguracao = new Configuracao();

//inclui a classe csv
include_once $path["classes"] ."class.csv.php";
$objCsv = new CSV();

//inclui a classe de pdf
include_once $path["classes"] ."class.pdf.php";
$objPdf = new FPDF();

//classe de post
include_once $path["classes"]."session/post.class.php";
$objPost = new gp();

//inclui a classe de correios
include_once $path["classes"] ."class.Correios.php";
$objCorreios = new Correios();

//inclui a classe de email
include_once $path["classes"] ."class.Email.php";
$objEmail = new Email();

$conf = Config::AtributosConfig();
$objUteis->encode($conf);

$meta->og['image'] = "http://" . $_SERVER['SERVER_NAME'] . "/imagem/100x100/img/facebooklogo/logo.png";
$meta->og['title'] = "";
$meta->og['description'] = "";

$titPag = ".: COLOCAR TITULO - ";

switch ($objPost->param["acao"]) {
    default:
        $meta->tags = "metas tags separadas por virgula";
        $meta->descricao = "descrição maximo 160 caracteres";
        $titPag .= "SUBTITULO :.";
        $abrePag = "internas/principal.php";
    break;

    case 'institucional':
        $meta->tags = "metas tags separadas por virgula";
        $meta->descricao = "descrição maximo 160 caracteres";
        $titPag .= "SUBTITULO :.";
        $abrePag = "internas/institucional.php";
    break;

    case 'envia-contato':
    	$condicao = array(
    				'tipo' => "Fale Conosco",
    				'status' => 1
    			);
    	
    	$configuracoes = $objConfiguracao->listar($condicao);
    	$objUteis->encode($configuracoes);
    	
    	$msg = array();
    	$msg[0]['tipo'] = 'Nome:';
    	$msg[0]['msg'] = $_REQUEST['nome'];
    	 
    	$msg[1]['tipo'] = 'Email:';
    	$msg[1]['msg'] = $_REQUEST['email'];
    	 
    	$msg[2]['tipo'] = 'Telefone:';
    	$msg[2]['msg'] = $_REQUEST['telefone'];
    	 
    	$msg[3]['tipo'] = 'Mensagem:';
    	$msg[3]['msg'] = $_REQUEST['mensagem'];
    	
    	$emailsAEnviar = array();
    	for($i=0;$i<$configuracoes["num"];$i++){
    		$emailsAEnviar[] = $configuracoes[$i]->email;
    	}
    	 
    	$result = $objUteis->enviaEmail($emailsAEnviar,$msg,$conf["smtp"]['from'],'Formulário de contato - site.');
    
    	if (!$result) {
    		$resposta['situacao'] = "error";
    		$resposta['msg'] = "Erro ao enviar.";
    	} else {
    		$resposta['situacao'] = "sucess";
    		$resposta['msg'] = "Enviado com sucesso.";
    	}
    
    	echo json_encode($resposta);
    
    break;
    
    case "listarCidades":
        $cidades = $objCurr->getCidadesByEstado($_REQUEST["uf"]);
        $objUteis->encode($cidades);
        ob_start();
        echo "<option value=\"\" >Selecione...</option>";
        for($i=0;$i<$cidades["num"];$i++) {
            if(isset($_REQUEST['cidade']) && $_REQUEST['cidade'] == $cidades[$i]->id) {
                echo "<option value=\"{$cidades[$i]->id}\" selected >".$cidades[$i]->nome."</option>";
                continue;
            }
            echo "<option value=\"{$cidades[$i]->id}\" >".$cidades[$i]->nome."</option>";
        }
        ob_flush();
    break;

    case 'grava-email':
        $form['nome'] = $_POST["nome"];
        $form['email'] = $_POST["email"];
		
        $objUteis->decode($form);
        $result = $objEmail->cadastrar($form);
        
        if (!$result) {
        	$resposta['situacao'] = "error";
        	$resposta['msg'] = "Erro ao cadastrar, ou email já cadastrado.";
        } else {
        	$resposta['situacao'] = "sucess";
        	$resposta['msg'] = "Gravado com sucesso.";
        }

        echo json_encode($resposta);
    break;
    
    case 'busca_clima':

            $json = null;
            $json->mensagem = "Não possível localizar.";
            $json->status = false;

            $url = "http://www.google.com/ig/api?weather=" . urlencode($_REQUEST["cidade"]) . "," . urlencode($_REQUEST["estado"]) . "," . urlencode($_REQUEST["pais"]) . "&hl=pt-br";

            $url = utf8_encode(file_get_contents($url));

            $xml = simplexml_load_string($url);

            if($xml->weather->current_conditions->temp_c) {		

                    $clima->temp = $xml->weather->current_conditions->temp_c->Attributes()->data;
                    $clima->cond = $xml->weather->current_conditions->condition->Attributes()->data;		
                    $clima->loca = $xml->weather->forecast_information->city->Attributes()->data;
                    $clima->umid = $xml->weather->current_conditions->humidity ->Attributes()->data;

                    $json->status = true;
                    $json->mensagem = "";
                    $json->clima = $clima;

            }

            echo json_encode($json);


    break;

    case 'csv_exemplo':

            // set headings
            $objCsv->setHeading('Nome', 'Email');

            for($i=0;$i<10;$i++){
                // add a line of data
                $objCsv->addLine('bob', '123-4567');
            
            }

            // output the csv
            //$objCsv->output();
            $objCsv->output("D","testfile.csv");
            // clear the buffer
            $objCsv->clear();

    break;
    
    
    case 'pdf_exemplo':

            $objPdf->AddPage();
 
            $objPdf->SetFont('arial','B',18);
            $objPdf->Cell(0,5,"Relatório",0,1,'C');
            $objPdf->Cell(0,5,"","B",1,'C');
            $objPdf->Ln(50);

            //cabeçalho da tabela
            $objPdf->SetFont('arial','B',14);
            $objPdf->Cell(130,20,'Coluna 1',1,0,"L");
            $objPdf->Cell(140,20,'Coluna 2',1,0,"L");

            //linhas da tabela
            $objPdf->SetFont('arial','',12);
            for($i= 1; $i <10;$i++){
                $objPdf->Cell(130,20,"Linha ".$i,1,0,"L");
                $objPdf->Cell(140,20,rand(),1,0,"L");
            }
            $objPdf->Output("arquivo.pdf","D");

    break;

}
?>