<?
	//inicia a sessão
	/*
	*	Título: Controle da Classe de Logs
	*	Função: Responsável por fazer a solicitação de listagem, busca de logs.
	*	Desenvolvido por: Eric Silva Magalhães
	*	Data: 14/04/2008
	*	Atualizado em: 24/04/2008 por: Eric Silva Magalhães.
	*/
	
	//classe de logs
	include_once "classes/class.logs.php";
	$objLog = new Logs();

        $permissao = $objSecao->permissaoSecaoFixaUsuario("1",$objSession2->get('tlAdmLoginId'));
	
	//verifica qual a ação está sendo solicitada pela câmada de visão(formulários)
	switch(isset($objPost->param['acao'])){
		case "listaLogs":
			$logs = $objLog->ultimosLogs();
                        $abrePag = "frms/listaLogs.php";
                        
			break;
		default:
			$logs = $objLog->ultimosLogs();
                        $objUteis->encode($logs);
			$acesso = $objLog->ultimoAcesso($objSession2->get('tlAdmLoginId'));
                        $objUteis->encode($acesso);
                        $abrePag = "../frms/listaLogs.php";
                        
			break;
	}

?>