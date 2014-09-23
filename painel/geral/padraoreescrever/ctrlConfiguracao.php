<?
	//inicia a sess�o
	session_start();
	/*
	*	T�tulo: Controle da Classe de Not�cias
	*	Fun��o: Respons�vel por fazer a solicita��o de cadastro,
	*			altera��o e exclus�o de not�cias(obs.: e suas respectivas fotos).
	*	Desenvolvido por: Eric Silva Magalh�es
	*/
        
       /*
        * Texto do Ctrl = (Alterar) - (alterar)
        * Texto Cadastrado com sucesso = (textocadastrado)
        * Texto erro ao cadastrar = (textoerroaocadastrar)
        * ctrl = ctrlmodificar
        * 
        */
	
	//classe de conex�o
	include_once "../../classes/class.conexao.php";
	
	//verifica se o usu�rio est� realmente logado no sistema
	include "inc/protege.php";
	
	//classe de abstra��o de banco de dados
	include_once "../../classes/class.db.php";
	$sqlGl = new gl_DB();
	
	//classe que possui algumas fun��es utéis(Ex.: Convers�o de datas, moedas, etc.)
	include_once "classes/class.uteis.php";
	$objUteis = new Uteis();
	
	//inclui a classe de not�cias e estância um objeto
	include_once "classes/class.Alterar.php";
	$objAlterar = new Alterar();
        
	//inclui a classe de not�cias e estância um objeto
	include_once "classes/class.form.php";
	$objForm = new Form();
	
	
	include_once "usuarios/classes/class.usuarios.php";
	$objUsuario = new Usuarios();
	
	//classe de se��o
	include_once "../classes/class.secao.php";
	$objSecao = new Secao();

        $permissao = $objSecao->permissaoSecaoFixaUsuario("1",$_SESSION['i9s']['tlAdmLoginId']);

        $secoes_fixas = $objSecao->listar_fixas();
        $objUteis->encode($secoes_fixas);
	
	//verifica qual a a��o est� sendo solicitada pela câmada de vis�o(formul�rios)
	switch($_REQUEST['acao']){
		case "frmCadAlterar":
                        $abrePag = "../frms/frmCadAlterar.php";
                break;
		case "cadastraAlterar":
			//monta o objeto com os dados do formul�rio
			$form->form 			= $_POST['form'];
			$form->status			= 1;
			
			$objUteis->decode($form);
			$result = $objAlterar->cadastrar($form);

                        if($result->result){
                            //grava log de a��o no sistema
                            $objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Configuração"),$_SESSION['i9s']['tlAdmLoginId'],"Cadastrou",$_SERVER['REMOTE_ADDR']);
                        }
                        
			//mostra o resultado para o usu�rio
                        $objUteis->showResult("textocadastrado","textoerroaocadastrar",$result->result,"mostraMensagem",'index.php?acao=listar&ctrl=ctrlmodificar');
                        exit();
                break;
		case "listar":
			//busca todas as not�cias
			$alterars = $objAlterar->listar();
                        $objUteis->encode($alterars);
			$abrePag = "../frms/listaAlterar.php";
                break;
		case "frmAlterar":
			//busca os dados de uma not�cia espec�fica
			$alterar = $objAlterar->alterarById($_REQUEST['id']);
                        $objUteis->encode($alterar);
			$abrePag = "../frms/frmAltAlterar.php";
                break;
		case "alteraAlterar":
			//monta o objeto com os dados do formul�rio
			$form->id			= $_POST['id'];
			$form->nome 			= $_POST['nome'];
			$form->email 			= $_POST['email'];
			$form->tipo 			= $_POST['tipo'];
			$form->status 			= 1;

                        //altera o registro no banco
			$objUteis->decode($form);
			$result = $objAlterar->alterar($form);

                        if($result->result){
                            //grava log de a��o no sistema
                            $objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Configuração"),$_SESSION['i9s']['tlAdmLoginId'],"Alterou",$_SERVER['REMOTE_ADDR']);
                        }
			
			//mostra o resultado para o usu�rio
			$objUteis->showResult("Configuração alterada com sucesso","Erro ao alterar esta configuração.",$result->result,"mostraMensagem",'index.php?acao=listar&ctrl=configuracoes');
                        exit();
                      
		break;
		case "deletar":
			//deleta o registro no banco
			$result = $objAlterar->deletar($_REQUEST['id']);

                        if($result){
                            //grava log de a��o no sistema
                            $objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Configuração"),$_SESSION['i9s']['tlAdmLoginId'],"Deletou",$_SERVER['REMOTE_ADDR']);
                        }
                        if (!$result) {
                            $resposta->situacao = "error";
                            $resposta->msg = "Erro ao deletar esta configuração.";

                        } else {
                            $resposta->situacao = "sucess";
                            $resposta->msg = "Configuração deletada com sucesso.";
                        }

                        echo json_encode($resposta);

                        exit();
		break;
			
		case "publicar":
			//deleta o registro no banco
			$result = $objAlterar->publicar($_REQUEST['id'],$_REQUEST['status']);
			//verifica o resultado
			if($result){
				//verifica o status
				if($_REQUEST['status']=="1"){
					$act = "ativou";
					$staturs = "publicada";
				}else{
					$act = "desativou";
					$staturs = "despublicada";
				}
				//grava log de a��o no sistema
			}

                        if($result){
                            //grava log de a��o no sistema
                            $objUteis->gravaLog($_SESSION['i9s']['tlAdmLoginNome'],utf8_decode("Configuração"),$_SESSION['i9s']['tlAdmLoginId'],"Publicou",$_SERVER['REMOTE_ADDR']);
                        }

                        if (!$result) {
                            $resposta->situacao = "error";
                            $resposta->msg = "Erro ao $staturs esta configuração.";

                        } else {
                            $resposta->situacao = "sucess";
                            $resposta->msg = "Configuração $staturs com sucesso.";
                        }

                        echo json_encode($resposta);
                        exit();
		break;
	
	}
?>