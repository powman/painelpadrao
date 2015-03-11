       
<?php

/**
 * Informações do Formalário
 */
$nomedoformulario = 'Cadastrar Imóvel';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=imovel';
$avisodoformulario = 'Esta página você cadastra os imóveis.';

/**
 * Inicia o Formulário
 */
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

/**
 * Inicia o Wizard
 */
//$objForm->sk_inicioWizard('Local do imóvel');


//$objForm->sk_montaMapa();

/**
 * Fim do Wizard
 */
//$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Dados de informação');

/**
 * Cria um input text
 */
$objForm->sk_formCheckbox('Destaque','destaque',"",false,'Aqui você escolhe se o imóvel vai ser destaque na página principal.',1);

$optionsCategorias = array();

for($i=0;$i<$categorias["num"];$i++){
	$optionsCategorias[] = '<option value="'.$categorias[$i]->id.'">'.$categorias[$i]->nome.'</option>';
}

$objForm->sk_formSelect('Categoria','imoveis_categoria_id',$optionsCategorias,true,"Aqui você escolhe a categoria do imóvel.");


$optionsSituacao = array();

for($i=0;$i<$situacaoes["num"];$i++){
	$optionsSituacao[] = '<option value="'.$situacaoes[$i]->id.'">'.$situacaoes[$i]->nome.'</option>';
}

$objForm->sk_formSelect('Situação do imóvel','imoveis_situacao_id',$optionsSituacao,true,"Aqui você escolhe a situação do imóvel.");


$optionsTipos = array();

for($i=0;$i<$tipos["num"];$i++){
	$optionsTipos[] = '<option value="'.$tipos[$i]->id.'">'.$tipos[$i]->nome.'</option>';
}


$objForm->sk_formSelect('Tipos','tipos_id[]',$optionsTipos,true,"Aqui você escolhe os tipos do imóvel.",true);

$objForm->sk_formText('Nome','nome','',true,'Aqui você escolhe um nome para o seu parceiro.');

/**
 * Cria um input text
 */
$objForm->sk_formTextarea('Breve Descrição','breve_descricao','',true,'Breve descrição do imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formTextHTML('Descrição','descricao',false,'Descrição do imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formText('Palavras Chaves','tags','',false,'Palavras Chaves separadas por virgula.');


/**
 * Fim do Wizard
 */
$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Dados do imóvel');

/**
 * Cria um input text
 */
$objForm->sk_formPreco('Valor: Aluguel e Compra','valor','',true,'Valor do imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formPreco('Condomínio','condominio','',false,'Valor do condomínio do imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formTextSoNumber('Quartos','quartos','',false,'Quantidade de quartos no imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formTextSoNumber('Suítes','suites','',false,'Quantidade de suítes no imóvel.');

/**
 * Cria um input text
 */
$objForm->sk_formTextSoNumber('Vagas na Garagem','vagas','',false,'Quantidade de vagas na garagem no imóvel.');


$objForm->sk_formArea('Área construída','area_construida','',false,'Área construída do imóvel.');

$objForm->sk_formArea('Área do terreno','area_terreno','',false,'Área do terreno do imóvel.');

$objForm->sk_formFile('Imagem principal','img',true,'Aqui você escolhe uma imagem principal do imóvel. Largura: 600px - Altura: 400px');


/**
 * Fim do Wizard
 */
$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Dados de endereço');

/**
 * Cria um input text
 */
$objForm->sk_formTextCep('Cep','cep','',false,'Palavras Chaves separadas por virgula.');

$optionsEstado = array();

for($i=0;$i<$estados["num"];$i++){
	$optionsEstado[] = '<option value="'.$estados[$i]->id.'">'.$estados[$i]->uf.'</option>';
}

$objForm->sk_formSelectEstado('Estado','estado',$optionsEstado,true,"Aqui você escolhe o estado do imóvel.");

$optionsCidade = array();
$optionsCidade[] = '<option value="">Selecione um estado acima.</option>';

$objForm->sk_formSelectCidade('Cidade','cidade',$optionsCidade,true,"Aqui você escolhe a cidade do imóvel.");

$optionsBairro = array();
$optionsBairro[] = '<option value="">Selecione uma cidade acima.</option>';

$objForm->sk_formSelect('Bairro','bairro',$optionsBairro,true,"Aqui você escolhe o bairro do imóvel.");

$objForm->sk_formText('Endereço','endereco','',false,'Endereço do imóvel.');

$objForm->sk_formText('Complemento','complemento','',false,'Complemento do imóvel.');

/**
 * Fim do Wizard
 */
$objForm->sk_fimWizard();

$objForm->sk_inicioWizard('Dados do mapa');

$objForm->sk_formGoogleMaps('Link do google maps','link_mapa','',false,'Link do google maps do local do imóvel.');

$objForm->sk_formText('Latitude','latitude','',false,'Latitude do google maps.');

$objForm->sk_formText('Longitude','longitude','',false,'Longitude do google maps.');

$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Fotos');

/**
 * Cria um input text
 */
$objForm->sk_montaMultUploadGaleria('','index.php?acao=cadastraFoto&ctrl=imovel','','');

/**
 * Verfica se o usuário e Administrador
 */
if($permissao->cadastrar == 1){
    /**
     * Cria um input submit
     */
    $objForm->sk_formSubmit();

}

/**
 * Fim do Wizard
 */
$objForm->sk_fimWizard();



/**
 * Final do Formulário
 */
$objForm->sk_fimDoFormulario();

?>  