<?php

/**
 * Informações do Formalário
 */
$nomedoformulario = 'Cadastrar Módulo';
$acaodoformulario = 'index.php?acao=cadastrar&ctrl=modulo';
$avisodoformulario = 'Esta página você cadastra os módulos do painel.';
$options = '';

/**
 * Inicia o Formulário
 */
$objForm->sk_iniciaFormulario($nomedoformulario,$acaodoformulario,$avisodoformulario);

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Página de cadastro de módulo');

$objForm->sk_formText('Módulo','titulo','',true,'Aqui você escolhe o nome do módulo minusculo e sem acento.');

$objForm->sk_formText('Nome do módulo','menu','',true,'Aqui você escolhe o nome do módulo.');

$objForm->sk_formText('Controle','ctrlModulo','',true,'Caminho do Controle ex: ../ctrlElenco.php.');
		
$diretorio = scandir('images/icons/todos');       					   							
foreach ($diretorio as $value) {
    if($value != '.' and $value != '..'){
        if(strstr($value, '.jpg') or strstr($value, '.png') or strstr($value, '.jpeg') or strstr($value, '.gif'))       					   			
            $options[] .= "<option data-image='images/icons/todos/".$value."' value='images/icons/todos/".$value."'>".$value."</option>";
        }
    }		

$objForm->sk_formSelectWithImage('Caminho do ícone','img',$options,true,"Caminho do Ícone ex: images/icons/light/users2.png");
 

/**
 * Final do Wizard
 */
$objForm->sk_fimWizard();

/**
 * Inicia o Wizard
 */
$objForm->sk_inicioWizard('Página de cadastro de módulo');

$camposBranco[] =  "<div class='formRow' style='padding:5px 14px;'><label>Menu do módulo <span id=\"sheepItForm_label\"></span></label><div class='formRight'><input style='width:80%;' placeholder='Exemplo: Cadastrar' class='validate[required]' id=\"sheepItForm_#index#_titulo\" type='text' name='tituloform[]'/><input class='validate[required]' placeholder='Exemplo: index.php?acao=frmCadElenco&ctrl=elenco' style='width:80%;' id=\"sheepItForm_#index#_url\" type='text' name='url[]'/><br/><div align='right' style='width:80%;'><a href='javascript:;' id=\"sheepItForm_remove_current\"><img class=\"delete\" src=\"images/icons/control/16/clear.png\" width=\"16\" height=\"16\" border=\"0\"></a></div></div><div class='clear'></div></div>";

$objForm->sk_formClone($camposBranco);

/**
 * Verfica se o usuário e Administrador
 */
if($objSession2->get('tlAdmLoginNivel') == 1){
    /**
     * Cria um input submit
     */
    $objForm->sk_formSubmit();

}

/**
 * Final do Wizard
 */
$objForm->sk_fimWizard();

/**
 * Final do Formulário
 */
$objForm->sk_fimDoFormulario();

?>

<script>
    
$(function () { 

if($("#sheepItForm").html() != null){
    $('#sheepItForm').sheepIt({
           separator: '',
           allowRemoveLast: true,
           allowRemoveCurrent: true,
           allowRemoveAll: true,
           allowAdd: true,
           allowAddN: true,
           minFormsCount: 0,
           iniFormsCount: 1,
           removeLastConfirmation: true,
   removeCurrentConfirmation: true,
   removeAllConfirmation: true,
   removeLastConfirmationMsg: 'Deseja Remover?',
   removeCurrentConfirmationMsg: 'Deseja Remover?',
   removeAllConfirmationMsg: 'Deseja Remover todos?'
    });
    }

});
</script>
