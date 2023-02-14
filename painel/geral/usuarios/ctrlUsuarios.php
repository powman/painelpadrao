<?php

/*
 * 	Título: Controle da Classe de Usuários
 * 	Função: Responsável por fazer a solicitação de listagem, busca, cadastro,
 * 			alteração e exclusão de usuários.
 * 	Desenvolvido por: Paulo Henrique Pereira
 * 	Data: 14/04/2014
 * 	Atualizado em: 15/04/2014 por: Paulo henrique Pereira
 */

//classe de usuários
include_once "classes/class.usuarios.php";
$objUsuario = new Usuarios();

//inclui a classe de Configuracao
include_once "../classes/class.Configuracao.php";
$objConfiguracao = new Configuracao();

$conf = Config::AtributosConfig();
$objUteis->encode($conf);


if ($objSession2->get('tlAdmLoginId')) {
    $permissao = $objSecao->permissaoSecaoFixaUsuario("1", $objSession2->get('tlAdmLoginId'));
}


//executa a ação que o usuário do sistema estiver solicitando
switch ($_REQUEST['acao']) {
    default:
        $abrePag = "../usuarios/frms/frmHome.php";
        break;
    case "logar":
        //consulta o usuário e senha no banco de dados
        $resposta  = array();
        $usuario = $objUsuario->logar($objPost->param["email"], $objPost->param["senha"]);
        if (!empty($usuario)) {
            if ($usuario['status'] == '1') {
                $objSession2->set('tlAdmLogin', true);
                $objSession2->set('tlAdmLoginId', $usuario['id']);
                $objSession2->set('tlAdmLoginNome', $usuario['nome']);
                $objSession2->set('tlAdmLoginSenha', $usuario['senha']);
                $objSession2->set('tlAdmLoginEmail', $usuario['email']);
                $objSession2->set('tlAdmLoginImg', $usuario['img']);
                $objSession2->set('tlAdmLoginStatus', $usuario['status']);
                $objSession2->set('tlAdmLoginNivel', $usuario['nivel']);

                //grava log de ação no sistema
                $objUteis->gravaLog($usuario['nome'], utf8_decode("usuários"), $usuario['id'], "entrou", $_SERVER['REMOTE_ADDR']);
                $resposta['situacao'] = "sucess";
                $resposta['msg'] = "Logando aguarde...";
                echo json_encode($resposta);
            } else {
                $resposta['situacao'] = "error";
                $resposta['msg'] = "Usuario inativo, favor contate ao administrador.";
                echo json_encode($resposta);
            }
        } else {
            $resposta['situacao'] = "error";
            $resposta['msg'] = "Usuario e senha invalido";
            echo json_encode($resposta);
        }
        exit();
        break;
    case "recuperarSenha":
        //consulta o usuário e senha no banco de dados
        $resposta  = array();
        $usuario = $objUsuario->usuarioByEmail($objPost->param["email"]);
        if (!empty($usuario)) {
            if ($usuario['email']) {
                $novaSenha = $objUteis->gerarCodigo(time());
                $objUteis->encode($novaSenha);
                $msg = array();
                $msg[0]['tipo'] = 'Nome:';
                $msg[0]['msg'] = $usuario['nome'];

                $msg[1]['tipo'] = 'Email / Usuário:';
                $msg[1]['msg'] = $usuario['email'];

                $msg[2]['tipo'] = 'Nova Senha:';
                $msg[2]['msg'] = $novaSenha;

                $msg[3]['tipo'] = 'Obs:';
                $msg[3]['msg'] = 'Senha temporária criada.';

                $result2 = $objUteis->enviaEmail(array(0 => $usuario['email']), $msg, $conf["smtp"]['from'], 'Painel administrativo - Recuperação de senha.');
                if ($result2) {
                    $usuario3 = array();
                    $usuario3['senha'] = $novaSenha;
                    $usuario3['id'] = $usuario['id'];
                    $result3 = $objUsuario->alterarSenha($usuario3);
                    if ($result3) {
                        $resposta['situacao'] = "sucess";
                        $resposta['msg'] = "Senha recuperada com sucesso, verifique seu email!";
                        echo json_encode($resposta);
                        $objSession2->set('tlAdmLoginSenha', $novaSenha);
                    }
                }
            }
        } else {
            $resposta['situacao'] = "error";
            $resposta['msg'] = "Email não existente em nosso banco de dados.";
            echo json_encode($resposta);
        }
        exit();
        break;
    case "sair":
        //grava log de ação no sistema
        $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $objSession2->get('tlAdmLoginId'), "saiu", $_SERVER['REMOTE_ADDR']);
        //destroi a sessão
        unset($_SESSION['SESSIONPIXELGO']);
        unset($objSession2);
        session_destroy();
        session_unset();
        //redireciona o usuário do sistema para a index novamente
        echo "<script type='text/javascript'>window.location ='../../index.php';</script>";
        exit();
        break;
    case "frmCadUsuario":
        //protege - arquivo que verifica se o usuário esta logado no sistema

        //busca as seções fixas e dinâmicas no banco de dados
        $secoes_fixas = $objSecao->listar_fixas();
        $objUteis->encode($secoes_fixas);

        $abrePag = "../usuarios/frms/frmCadUsuario.php";
        break;
    case "cadastraUsuario":

        $anexoName = $objPost->param["img"]["name"];
        $anexoTemp = $objPost->param["img"]["tmp_name"];

        $usuario_verifica = $objUsuario->usuarioByEmail($objPost->param["email"]);
        $objUteis->encode($usuario_verifica);

        if ($usuario_verifica->email) {
            $objUteis->showResult("", "Este email já esta cadastrado", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
            exit();
        }

        $usuario_login = $objUsuario->usuarioByLogin($objPost->param["login"]);
        $objUteis->encode($usuario_login);

        if ($usuario_login->login) {
            $objUteis->showResult("", "Este login já existe", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
            exit();
        }

        $img = '';
        //se tiver selecionado uma imagem
        if ($objPost->param["img"]["name"] != "") {

            if (!$objUteis->verificaImagem($objPost->param["img"]["name"])) {
                $objUteis->showResult("", "Formato de arquivo inválido.<br /> apenas imagens", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
                exit();
            }
            //Retorna formato da imagem
            $formatoImg = $objUteis->formatoFile($objPost->param["img"]["name"]);
            //Definir nome para imagem
            $dir = "arq_usuario/";
            if (!file_exists("arq_usuario")) {
                $objUteis->criaDir("arq_usuario");
            }
            $nomeImg = "usuario_" . date("dmYhis") . "." . $formatoImg;
            $temp = $dir . $nomeImg;
            //Fazendo o upload da imagem
            $objUteis->uploadArq($objPost->param["img"]["tmp_name"], $temp);

            //gera thumb
            $img = $dir . $nomeImg;
        }

        $usuario = array();
        $usuario['img'] = $img;
        //inseri o registro no banco
        $usuario['nome'] = $objPost->param['nome'];
        $usuario['login'] = $objPost->param['login'];
        $usuario['senha'] = $objPost->param['senha'];
        $usuario['email'] = $objPost->param['email'];
        $usuario['status'] = $objPost->param['status'];
        $usuario['nivel'] = $objPost->param['nivel'];
        //seções de sistemas personalizados
        $usuario['secao_fixa'] = $objPost->param['secao_fixa'];
        $usuario['cadastrar_fixa'] = $objPost->param['cadastrar_fixa'];
        $usuario['alterar_fixa'] = $objPost->param['alterar_fixa'];
        $usuario['excluir_fixa'] = $objPost->param['excluir_fixa'];
        $usuario['publicar_fixa'] = $objPost->param['publicar_fixa'];

        //inseri o usuário no banco
        $objUteis->decode($usuario);
        $result = $objUsuario->cadastrar($usuario);



        //verifica se foi inserido com sucesso e retorna a mensagem para o usuário
        if ($result) {
            //grava log de usuário no sistema
            $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $result, "cadastrou", $_SERVER['REMOTE_ADDR']);
            /* FIM - ENVIANDO EMAIL COM OS DADOS DO USUARIO */
            $msg = array();
            $msg[0]['tipo'] = 'Nome:';
            $msg[0]['msg'] = $usuario['nome'];

            $msg[1]['tipo'] = 'Email / Usuário:';
            $msg[1]['msg'] = $usuario['email'];

            $msg[2]['tipo'] = 'Senha:';
            $msg[2]['msg'] = $usuario['senha'];

            $msg[3]['tipo'] = 'Obs:';
            $msg[3]['msg'] = 'Este e seu usuário e senha para acesso ao painel administrativo.';

            $anexos = array(
                0 => array(
                    'url' => $objPost->param['img']['tmp_name'],
                    'name' => $objPost->param['img']['name']
                )
            );
            $result2 = $objUteis->enviaEmail(array(0 => $objPost->param['email']), $msg, $conf["smtp"]['from'], 'Painel administrativo - Usuário e Senha.', $anexos);
            $msg2 = '';
            if ($result2) {
                $msg2 = 'Verifique seu email';
            }
            //mostra o resultado para o usuário
            $objUteis->showResult("Usuário cadastrado com sucesso $msg2.", "Erro ao cadastrar este usuário, usuário ja existe.", $result, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
        } else {
            $objUteis->showResult("", "Erro ao cadastrar este usuário, usuário ja existe.", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
        }

        exit();
        break;
    case "listaUsuarios":
        //busca todos os usu�rios
        $usuarios = $objUsuario->listar();
        $objUteis->encode($usuarios);
        $abrePag = "../usuarios/frms/listaUsuarios.php";
        break;
    case "frmAltUsuario":
        //busca todas as se��es fixas e din�micas
        $secoes_fixas = $objSecao->listar_fixas();
        $objUteis->encode($secoes_fixas);
        //busca em quais se��es o usu�rio est� cadastrado
        $secoes_fixas_usuario = $objSecao->secaoFixaPorUsuario($_REQUEST['id']);
        $objUteis->encode($secoes_fixas_usuario);
        //busca os dados do usu�rio por seu id
        $usuario = $objUsuario->usuarioById($_REQUEST['id']);
        $objUteis->encode($usuario);
        $abrePag = "../usuarios/frms/frmAltUsuario.php";
        break;
    case "alteraUsuario":
        //monta o objeto usu�rio com os dados que foram enviados pelo formul�rio
        $usuario['id'] = $objPost->param['id'];
        $usuario['nome'] = $objPost->param['nome'];
        $usuario['status'] = $objPost->param['status'];
        $usuario['nivel'] = $objPost->param['nivel'];
        //se��es de sistemas personalizados
        $usuario['secao_fixa'] = $objPost->param['secao_fixa'];
        $usuario['cadastrar_fixa'] = $objPost->param['cadastrar_fixa'];
        $usuario['alterar_fixa'] = $objPost->param['alterar_fixa'];
        $usuario['excluir_fixa'] = $objPost->param['excluir_fixa'];
        $usuario['publicar_fixa'] = $objPost->param['publicar_fixa'];

        $usuarioById = $objUsuario->usuarioById($objPost->param['id']);
        $objUteis->encode($usuarioById);

        if ($objPost->param['email'] != $usuarioById->email) {
            $verificaEmail = $objUsuario->usuarioByEmail($objPost->param['email']);
            $objUteis->encode($verificaEmail);
            if ($verificaEmail->id) {
                $objUteis->showResult("", "Este email já existe em nosso banco de dados", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
                exit();
            }
        }



        //se tiver selecionado uma imagem
        if ($objPost->param["img"]["name"] != "") {

            $formatoImg = "." . $objUteis->formatoFile($objPost->param["img"]["name"]);


            if ($formatoImg == ".jpg" || $formatoImg == ".JPG" || $formatoImg == ".jpeg" || $formatoImg == ".JPEG" || $formatoImg == ".gif" || $formatoImg == ".GIF" || $formatoImg == ".png" || $formatoImg == ".PNG") {
            } else {
                $objUteis->showResult("", "Formato de arquivo inválido.<br /> apenas imagens", false, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
                exit();
            }

            //Retorna formato da imagem
            $formatoImg = "." . $objUteis->formatoFile($objPost->param["img"]["name"]);
            //Definir nome para imagem
            if (!file_exists("arq_usuario")) {
                $objUteis->criaDir("arq_usuario");
            }
            $img = "arq_usuario/" . date("dmYhis") . $formatoImg;
            //deleta a imagem antiga
            $objUteis->delFile($objPost->param['imgAntiga']);
            //Fazendo o upload da imagem
            $objUteis->uploadArq($objPost->param["img"]["tmp_name"], $img);
            $usuario['img'] = $img;
        } else {
            $usuario['img'] = $objPost->param['imgAntiga'];
        }

        //verifica se o campo senha est� vazio ou se ele existe
        if (isset($objPost->param['senha']) && !empty($objPost->param['senha'])) {
            //se existir altera a senha no banco
            $usuario2 = array();
            $usuario2['id'] = $objPost->param['id'];
            $usuario2['senha'] = $objPost->param['senha'];
            $resultSenha = $objUsuario->alterarSenha($usuario2);
            if ($resultSenha) {

                $msg = array();
                $msg[0]['tipo'] = 'Nome:';
                $msg[0]['msg'] = $objPost->param['nome'];

                $msg[1]['tipo'] = 'Email / Usuário:';
                $msg[1]['msg'] = $objPost->param['email'];

                $msg[2]['tipo'] = 'Senha nova:';
                $msg[2]['msg'] = $objPost->param['senha'];

                $msg[3]['tipo'] = 'Obs:';
                $msg[3]['msg'] = 'sua senha foi alterada.';

                $result2 = $objUteis->enviaEmail(array(0 => $objPost->param['email']), $msg, $conf["smtp"]['from'], 'Painel administrativo - Senha alterada.');

                //grava log de a��o no sistema
                $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $objPost->param['id'], "alterou senha", $_SERVER['REMOTE_ADDR']);
            }
        }

        //verifica se o campo senha est� vazio ou se ele existe
        if (isset($objPost->param['email']) && !empty($objPost->param['email']) && $objPost->param['email'] != $usuarioById->email) {
            //se existir altera a senha no banco
            $usuario3 = array();
            $usuario3['id'] = $objPost->param['id'];
            $usuario3['email'] = $objPost->param['email'];
            $resultSenha = $objUsuario->alterarEmail($usuario3);
            if ($resultSenha) {

                $msg = array();
                $msg[0]['tipo'] = 'Nome:';
                $msg[0]['msg'] = $objPost->param['nome'];

                $msg[1]['tipo'] = 'Email Alterado:';
                $msg[1]['msg'] = $objPost->param['email'];

                $msg[3]['tipo'] = 'Obs:';
                $msg[3]['msg'] = 'Seu email foi alterado, este email será o seu login.';

                $result2 = $objUteis->enviaEmail(array(0 => $objPost->param['email']), $msg, $conf["smtp"]['from'], 'Painel administrativo - Email alterado.');

                //grava log de a��o no sistema
                $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $objPost->param['id'], "alterou senha", $_SERVER['REMOTE_ADDR']);
                $objSession2->set('tlAdmLoginEmail', $objPost->param['email']);
            }
        }

        //altera os dados no usu�rio
        $objUteis->decode($usuario);
        $result = $objUsuario->alterar($usuario);
        //verifica se foi inserido com sucesso e retorna a mensagem para o usu�rio
        if ($result) {
            //grava log de a��o no sistema
            $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $objPost->param['id'], "alterou", $_SERVER['REMOTE_ADDR']);
            //se estiver alterando os pr�prios dados atualiza a SESSION
            if ($usuario['id'] == $objSession2->get('tlAdmLoginId')) {
                $objSession2->set('tlAdmLogin', true);
                $objSession2->set('tlAdmLoginId', $usuario['id']);
                $objSession2->set('tlAdmLoginNome', $usuario['nome']);
                if (isset($objPost->param['senha']) && !empty($objPost->param['senha'])) {
                    $objSession2->set('tlAdmLoginSenha', md5($usuario['senha']));
                }
                $objSession2->set('tlAdmLoginImg', $usuario['img']);
                $objSession2->set('tlAdmLoginEmail', $usuario['email']);
                $objSession2->set('tlAdmLoginStatus', $usuario['status']);
            }
        }
        //mostra o resultado para o usu�rio
        $objUteis->showResult("Usuário alterado com sucesso.", "Erro ao alterar este usuário.", $result, "mostraMensagem", 'index.php?acao=listaUsuarios&ctrl=usuarios');
        exit();
        break;
    case "deletarUsuario":
        //deleta o usuário

        $usuario = $objUsuario->usuarioById($objPost->param['id']);
        $objUteis->encode($usuario);
        $result = $objUsuario->deletar($objPost->param['id']);
        //verifica se foi inserido com sucesso e retorna a mensagem para o usu�rio
        if ($result) {
            //grava log de a��o no sistema
            $objUteis->gravaLog($objSession2->get('tlAdmLoginNome'), utf8_decode("usuários"), $objPost->param['id'], "deletou", $_SERVER['REMOTE_ADDR']);

            $msg = array();

            $msg[0]['tipo'] = 'Usuário Deletado:';
            $msg[0]['msg'] = 'Seu usuário foi deletado do painel administrativo.';

            $result2 = $objUteis->enviaEmail(array(0 => $usuario['email']), $msg, $conf["smtp"]['from'], 'Painel administrativo - Usuário deletado.');
        }

        $resposta = array();
        if (!$result) {
            $resposta['situacao'] = "error";
            $resposta['msg'] = "Erro ao deletar este usuário.";
        } else {
            $resposta['situacao'] = "sucess";
            $resposta['msg'] = "Usuário deletado com sucesso.";
        }

        echo json_encode($resposta);
        exit();
        break;
    case "verificaUsuario":
        $usuario = $objUsuario->usuarioByLogin($objPost->param["fieldValue"]);
        $objUteis->encode($usuario);

        /* RECEIVE VALUE */
        $validateValue = $objPost->param['fieldValue'];
        $validateId = $objPost->param['fieldId'];

        /* RETURN VALUE */
        $arrayToJs = array();


        if (isset($usuario['id']) && $usuario['id']) {  // validate??
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        } else {
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        }
        exit();
        break;
    case "verificaUsuarioAlt":
        if (!$objSession2->get('tlAdmLoginNivel') == 1) {
            if ($objPost->param["fieldValue"] != $objSession2->get('tlAdmLoginUsuario')) {
                $usuario = $objUsuario->usuarioByLogin($objPost->param["fieldValue"]);
                $objUteis->encode($usuario);
            } else {
                if (isset($usuario['id'])) {
                    $usuario['id'] == "";
                }
            }
        } else {
            if (isset($usuario['id'])) {
                $usuario['id'] == "";
            }
        }
        /* RECEIVE VALUE */
        $validateValue = $objPost->param['fieldValue'];
        $validateId = $objPost->param['fieldId'];

        /* RETURN VALUE */
        $arrayToJs = array();

        if (isset($usuario['id']) && $usuario['id']) {  // validate??
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        } else {
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        }
        exit();
        break;
    case "verificaUsuarioEmail":
        $usuario = $objUsuario->usuarioByEmail($objPost->param["fieldValue"]);
        $objUteis->encode($usuario);

        /* RECEIVE VALUE */
        $validateValue = $_REQUEST['fieldValue'];
        $validateId = $_REQUEST['fieldId'];

        /* RETURN VALUE */
        $arrayToJs = array();

        if (isset($usuario['id']) && $usuario['id']) {  // validate??
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        } else {
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        }
        exit();
        break;
    case "verificaUsuarioSenha":
        $usuario = $objUsuario->usuarioBySenha($objSession2->get('tlAdmLoginUsuario'), $objPost->param["fieldValue"]);
        $objUteis->encode($usuario);

        /* RECEIVE VALUE */
        $validateValue = $objPost->param['fieldValue'];
        $validateId = $objPost->param['fieldId'];

        /* RETURN VALUE */
        $arrayToJs = array();

        if (isset($usuario['id']) && $usuario['id']) {  // validate??
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = false;
            echo json_encode($arrayToJs);
        } else {
            $arrayToJs[0] = $validateId;
            $arrayToJs[1] = true;
            echo json_encode($arrayToJs);
        }
        exit();
        break;
}
