<?
class Form {
	public function sk_iniciaFormulario($nome = '', $acaoDoFormulario = '', $aviso = '', $wizardForm = true) {
		if ($wizardForm == true) {
			$wizard = 'SignupForm';
		}
		$formulario = "";
		$formulario .= '<div class="wrapper">';
		if ($aviso) {
			$formulario .= '<div class="nNote nWarning hideit">';
			$formulario .= '<p><strong>AVISO: </strong>' . $aviso . '</p>';
			$formulario .= '</div>';
		}
		$formulario .= '<form id="validate" class="form ' . $wizard . '" method="post" action="' . $acaoDoFormulario . '" target="iframeCadForms" name="frmCadFormulario" enctype="multipart/form-data">';
		$formulario .= '<div class="widget">';
		$formulario .= '<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" /><h6>' . $nome . '</h6></div>';
		
		echo $formulario;
	}
	public function sk_inicioWizard($nome = '') {
		$formulario = "";
		$formulario .= '<fieldset class="step">';
		$formulario .= '<h1>' . $nome . '</h1>';
		
		echo $formulario;
	}
	public function sk_fimDoFormulario() {
		$formulario = "";
		$formulario .= '<iframe name="iframeCadForms" frameborder="0" width="0" height="0"></iframe>';
		$formulario .= '</div>';
		$formulario .= '</form>';
		$formulario .= '</div>';
		
		echo $formulario;
	}
	public function sk_fimWizard() {
		$formulario = "";
		$formulario .= '</fieldset>';
		
		echo $formulario;
	}
	// OK
	public function sk_formColor($nomeLabel = '', $nameInput = '', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $nomeLabel . '</label>';
		$input .= '<div class="formRight" id="cPicker">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' " title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formData($nomeLabel = '', $nameInput = '', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' maskDate" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formText($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formGoogleMaps($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" onblur="pegarLatLgn(this.value,\'' . $nameInput . '\')" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '<a href="https://www.google.com.br/maps/preview" target="_blank">Abrir google maps para pegar o link do mapa</a>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextPassword($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '',$minSize='') {
	    if($minSize)
	        $minsize = 'minSize['.$minSize.']';
	    if ($required == true) {
			$required = 'validate[required,minSize[6]]';
			$addAsteristico = '<span class="req">*</span>';
		}else if($minSize){
		    $required = 'validate['.$minsize.']';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="password" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formCheckbox($nomeLabel = '', $nameInput = '', $checked = '', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		if ($checked) {
			$checado = "checked='checked'";
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label></label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="checkbox" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" ' . $checado . ' name="' . $nameInput . '" value="' . $value . '" id="' . $nameInput . '" /><label for="' . $nameInput . '">' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTags($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight ' . $tooltip . '" title="' . $textoDescription . '">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' tags' . $nameInput . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		$input .= '<script>$(".tags' . $nameInput . '").tagsInput({width:\'100%\'});</script>';
		
		echo $input;
	}
	public function sk_formTextEmail($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required,custom[email]]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'validate[custom[email]]';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextUrl($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required,custom[url]]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'validate[custom[url]]';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextTelefone($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required] maskPhone';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'maskPhone';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextCPF($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required] maskCPF';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'maskCPF';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextCNPJ($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required] maskCNPJ';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'maskCNPJ';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextCep($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required] maskCep';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'maskCep';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input onblur="verificaCep(this.value)" type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formHidden($nameInput = '', $value = '') {
		$input = "";
		$input .= '<input type="hidden" name="' . $nameInput . '" id="' . $nameInput . '" value="' . $value . '" />';
		
		echo $input;
	}
	public function sk_formSubmit($nome = 'Salvar') {
		$input = "";
		$input .= '<a href="javascript:;" onClick="$(\'#validate\').submit();" title="" class="button blackB" style="margin: 18px; float: right;"><span>' . $nome . '</span></a>';
		
		echo $input;
	}
	public function sk_formSelect($nomeLabel = '', $nameInput = '', $arrayOption = '', $required = false, $descripton = '', $multiple = false) {
		$multiplo = '';
		$classeMultipe = '';
		$selecione = '';
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$selecione = '<option value="" selected="selected">Selecione...</option>';
		}
		
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		if ($multiple) {
			$multiplo = "multiple='multiple'";
			$classeMultipe = "multiple";
			$multipleStyle = "width:100%; height:150px;";
		} else {
			$multipleStyle = "width:100%;";
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<select ' . $multiplo . ' style="' . $multipleStyle . '" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' ' . $classeMultipe . '" title="' . $textoDescription . '">';
		
		for($i = 0; $i < count ( $arrayOption ); $i ++) {
			$input .= $selecione;
			$input .= $arrayOption [$i];
		}
		$input .= '</select>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formSelectEstado($nomeLabel = '', $nameInput = '', $arrayOption = '', $required = false, $descripton = '', $multiple = false) {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$selecione = '<option value="" selected="selected">Selecione...</option>';
		}
		
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		if ($multiple) {
			$multiplo = "multiple='multiple'";
			$classeMultipe = "multiple";
			$multipleStyle = "width:100%; height:150px;";
		} else {
			$multipleStyle = "width:100%;";
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<select onchange="mudarCidade(this.value)" ' . $multiplo . ' style="' . $multipleStyle . '" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' ' . $classeMultipe . '" title="' . $textoDescription . '">';
		
		for($i = 0; $i < count ( $arrayOption ); $i ++) {
			$input .= $selecione;
			$input .= $arrayOption [$i];
		}
		$input .= '</select>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formSelectCidade($nomeLabel = '', $nameInput = '', $arrayOption = '', $required = false, $descripton = '', $multiple = false) {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$selecione = '<option value="" selected="selected">Selecione...</option>';
		}
		
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		if ($multiple) {
			$multiplo = "multiple='multiple'";
			$classeMultipe = "multiple";
			$multipleStyle = "width:100%; height:150px;";
		} else {
			$multipleStyle = "width:100%;";
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<select onchange="mudarBairro(this.value)" ' . $multiplo . ' style="' . $multipleStyle . '" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' ' . $classeMultipe . '" title="' . $textoDescription . '">';
		
		for($i = 0; $i < count ( $arrayOption ); $i ++) {
			$input .= $selecione;
			$input .= $arrayOption [$i];
		}
		$input .= '</select>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formSelectWithImage($nomeLabel = '', $nameInput = '', $arrayOption = '', $required = false, $descripton = '', $multiple = false) {
		$multiplo = '';
		$multipleStyle = '';
		$selecione = '';
		$classeMultipe = '';
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$selecione = '<option value="" selected="selected">Selecione...</option>';
		}
		
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		if ($multiple) {
			$multiplo = "multiple='multiple'";
			$classeMultipe = "multiple";
			$multipleStyle = "width:100%; height:150px;";
		} else {
			$multipleStyle = "width:100%;";
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<select ' . $multiplo . ' style="' . $multipleStyle . '" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . ' ' . $classeMultipe . ' select-image" title="' . $textoDescription . '">';
		
		for($i = 0; $i < count ( $arrayOption ); $i ++) {
			$input .= $selecione;
			$input .= $arrayOption [$i];
		}
		$input .= '</select>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formPreco($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight ' . $tooltip . '" title="' . $textoDescription . '">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $nameInput . ' preco" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formArea($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight ' . $tooltip . '" title="' . $textoDescription . '">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' area" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextarea($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		if ($maxlength) {
			$jsLimite = "<script>$('.lim" . $nameInput . "').inputlimiter({
                            limit: " . $maxlength . "
                            //boxClass: 'limBox',
                            //boxAttach: false
                    });</script>";
			$limita = "lim" . $nameInput;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<textarea style="height:250px;" name="' . $nameInput . '" id="' . $nameInput . '" title="' . $textoDescription . '" class="' . $required . ' ' . $tooltip . ' ' . $limita . '">' . $value . '</textarea>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		$input .= $jsLimite;
		
		echo $input;
	}
	public function sk_formTextHTML($nomeLabel = '', $nameInput = '', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight ' . $tooltip . '" title="' . $textoDescription . '">';
		$input .= '<textarea name="' . $nameInput . '" id="editor" class="' . $required . '">' . $value . '</textarea>';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextSoNumber($nomeLabel = '', $nameInput = '', $maxlength = '255', $required = false, $descripton = '', $value = '') {
		if ($required == true) {
			$required = 'validate[required,custom[onlyNumberSp]]';
			$addAsteristico = '<span class="req">*</span>';
		} else {
			$required = 'validate[custom[onlyNumberSp]]';
		}
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		$input = "";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="text" name="' . $nameInput . '" id="' . $nameInput . '" maxlength="' . $maxlength . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" value="' . $value . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formTextSliderByte($nomeLabel = '', $nameInput = '',$minValor = '0', $maxValor = '500',$step='1', $value = '') {
		
		$input = " <script>
		        $(function(){
	                 $( \".uiSliderInc\" ).slider({ 
                		value:".($value && $value != 'unlimited' ? $value : $minValor).",
                		min: ".$minValor.",
                		max: ".$maxValor.",
                		step: ".$step.",
                		slide: function( event, ui ) {
                			$( \".mudarValor\" ).html( bytesToSize(ui.value) );
                			$( \"#".$nameInput."\" ).val( ui.value );
                		}
                	});
	            });
		       
		        </script>
		        ";
		$input .= '<div class="formRow">';
		$input .= '<label>' . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<label class="mudarValor">'.($value && $value != 'unlimited' ? $this->formatBytes($value) : $this->formatBytes($minValor)).'</label>';
		$input .= '<div class="uiSliderInc"></div>';
		$input .= '<input type="hidden" name="' . $nameInput . '" id="' . $nameInput . '" value="' . ($value && $value != 'unlimited' ? $value : $minValor) . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_formFile($nomeLabel = '', $nameInput = '', $required = false, $descripton = '', $arquivoImg = '', $urlExcluir = '', $urlRetorno = '') {
		$input = "";
		if ($required == true) {
			$required = 'validate[required]';
			$addAsteristico = '<span class="req">*</span>';
		}
		
		if ($descripton) {
			$tooltip = 'tipS';
			$textoDescription = $descripton;
		}
		
		if ($arquivoImg) {
			$input .= '<div class="gallery">';
			
			$input .= '<ul>';
			$input .= '<li style="position:relative;">';
			if ($urlExcluir && $urlRetorno) {
				$input .= '<div style="position:absolute; right:0px; top:0px;">';
				$input .= '<a href="javascript:;" onclick="confirmDelGeralfile(\'' . $urlExcluir . '\',\'' . $urlRetorno . '\')"> <img src="images/icons/control/16/clear.png"/> </a>';
				$input .= '</div>';
			}
			$input .= '<a href="' . $arquivoImg . '" title="" rel="lightbox"><img src="' . $arquivoImg . '" height="100" alt="" /></a>';
			$input .= '</li>';
			$input .= '</ul>';
			$input .= '<div class="fix"></div>';
			$input .= '</div>';
		}
		
		$input .= '<div class="formRow">';
		$input .= '<label>' . $addAsteristico . " " . $nomeLabel . '</label>';
		$input .= '<div class="formRight">';
		$input .= '<input type="file" name="' . $nameInput . '" id="' . $nameInput . '" class="' . $required . ' ' . $tooltip . '" title="' . $textoDescription . '" />';
		$input .= '</div><div class="clear"></div>';
		$input .= '</div>';
		
		echo $input;
	}
	public function sk_montaMultUploadGaleria($id = '', $acaoGravarFotos = '', $arrayFotos = '', $urlExcluirArquivo = '', $idupload = 'uploadergaleria', $fileTypes = 'jpg,gif,png', $fileTypesDesc = 'Todos os arquivos', $width = 640, $height = 640, $maxFotos = 10) {
		
		/**
         * Exemplo <?=/**
		 * Exemplo <?=/**
		 * Exemplo <?=/**
		 * Exemplo <?=$objUteis->sk_montaMultUploadGaleria($configuracao["id"],'index.php?acao=cadastraFoto&ctrl=configuracoes',$fotos,'','');
		 *
		 * ?>
		 */
		$funcaoJquery = "";
		$funcaoJquery .= '<h6 style="padding:10px; font-size:11px; color:red; text-align:center;">Número máximo de fotos por cadastro ou alteração ' . $maxFotos . ', tamanhos de fotos recomendados ' . $width . 'px largura e ' . $height . 'px de altura.  </h6>';
		$funcaoJquery .= '<a id="' . $idupload . '" href="javascript:;">Selecionar Imagens</a>';
		$funcaoJquery .= '
						<script type="text/javascript">
						';
		$funcaoJquery .= "var maxfiles = " . $maxFotos . ";";
		$funcaoJquery .= "$('#" . $idupload . "').pluploadQueue({ \n";
		$funcaoJquery .= "runtimes : 'html5,html4', \n";
		$funcaoJquery .= "url : '" . $acaoGravarFotos . "&id=" . $id . "', \n";
		$funcaoJquery .= "max_file_size : '10mb', \n";
		$funcaoJquery .= "init : { \n
					            FilesAdded: function(up, files) { // Fire up after file added to uploader \n
					                plupload.each(files, function(file) { \n
					                    if (up.files.length > maxfiles) { // If count of files greater than 'maxfiles' then remove it \n
					                        up.removeFile(file); \n
					                    } \n
					                }); \n
					                if (up.files.length >= maxfiles) { // If count of files greater than 'maxfiles' then hide add-files button \n
					                    $('#" . $idupload . "_browse').hide(\"slow\"); \n
					                } \n
					            }, \n
					            FilesRemoved: function(up, files) { \n
					                if (up.files.length < maxfiles) { \n
					                    $('#" . $idupload . "_browse').fadeIn(\"slow\"); \n
					                } \n
					            } \n 
					        }, \n

        					\n";
		$funcaoJquery .= "max_file_count : " . $maxFotos . ", \n";
		$funcaoJquery .= "unique_names : true, \n";
		$funcaoJquery .= "resize : {width : " . $width . ", height : " . $height . ", quality : 100, crop: true}, \n";
		$funcaoJquery .= "filters : [ \n";
		$funcaoJquery .= "{title : '" . $fileTypesDesc . "', extensions : '" . $fileTypes . "'} \n";
		$funcaoJquery .= "//{title : 'Zip files', extensions : 'zip'} \n";
		$funcaoJquery .= "], \n";
		$funcaoJquery .= "}); \n";
		$funcaoJquery .= "$('.plupload_start').detach(); \n";
		$funcaoJquery .= "$('form').validationEngine({ \n";
		$funcaoJquery .= "onValidationComplete: function(form, status){ \n";
		$funcaoJquery .= "if (status == true) { \n";
		$funcaoJquery .= "var uploader = $('#" . $idupload . "').pluploadQueue(); \n";
		$funcaoJquery .= "if (uploader.files.length > 0) { \n";
		$funcaoJquery .= "// When all files are uploaded submit form \n";
		$funcaoJquery .= "uploader.bind('StateChanged', function() { \n";
		$funcaoJquery .= "if (uploader.files.length === (uploader.total.uploaded + uploader.total.failed)) { \n";
		$funcaoJquery .= "$('form')[0].submit(); \n";
		$funcaoJquery .= "} \n";
		$funcaoJquery .= "}); \n";
		$funcaoJquery .= "uploader.start(); \n";
		$funcaoJquery .= "parent.showNotification({ \n";
		$funcaoJquery .= "message: \"Aguarde... carregando arquivos.\", \n";
		$funcaoJquery .= "autoClose: true, \n";
		$funcaoJquery .= "duration: 2000, \n";
		$funcaoJquery .= "type: \"error\" \n";
		$funcaoJquery .= "}); \n";
		$funcaoJquery .= "}else{ \n";
		$funcaoJquery .= " $('form').validationEngine('detach'); \n";
		$funcaoJquery .= " $('form').submit(); \n";
		$funcaoJquery .= "} \n";
		$funcaoJquery .= "} \n";
		$funcaoJquery .= "} \n";
		$funcaoJquery .= "}); \n";
		$funcaoJquery .= "
						</script>";
		
		if ($arrayFotos) {
			$funcaoJquery .= '
                <div style="margin-top:20px;" class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" /><h6>Arquivos:</h6>
                </div>
                ';
                			$funcaoJquery .= '
                <div class="gallery" style="background:rgba(0, 0, 0, 0.4)">
                	';
                			$funcaoJquery .= '
                	<ul>
                		';
                			
                			for($i = 0; $i < $arrayFotos ["num"]; $i ++) {
                				if ($urlExcluirArquivo) {
                					$divExcluirArquivo = '
                		<div class="actions"><a href="javascript:;" onclick="confirmDelFotoGaleria(\'' . $urlExcluirArquivo . '&id=' . $arrayFotos [$i]->id . '&img=' . $arrayFotos [$i]->img . '\',$(this))" class="tipS" title="Excluir"><img src="images/icons/delete.png"/>
                		</div>';
                				}
                				$funcaoJquery .= '
                		<li style="width:95px; position:relative; background:#fff; height:100px; overflow:hidden;">
                			';
                				$funcaoJquery .= '<a href="' . $arrayFotos [$i] ->img . '" title="" rel="lightbox">';
                				$funcaoJquery .= '<img src="' . $arrayFotos [$i]->img . '" height="100" alt="" />';
                				$funcaoJquery .= '</a>';
                				$funcaoJquery .= $divExcluirArquivo;
                				$funcaoJquery .= '
                		</li>';
                			}
                			$funcaoJquery .= '
                	</ul>
                	';
                			$funcaoJquery .= '<div class="fix"></div>
                	';
                			$funcaoJquery .= '
                </div>';
		}
		
		echo $funcaoJquery;
	}
	public function sk_formListar($nome = '', $arrayTableNome, $arrayDadosTable, $campos, $ctrl = '', $permissaopublicar = 0, $permissaoalterar = 0, $permissaoexcluir = 0, $aviso = '', $acaoOrdenar = '') {
		$formulario = "";
		if ($acaoOrdenar) {
			$formulario .= '<script>';
			$formulario .= '$(function(){';
			$formulario .= 'ordemNaTabela("dTableAff","' . $acaoOrdenar . '","index.php?acao=listar&ctrl=' . $ctrl . '");';
			$formulario .= ' });';
			$formulario .= '</script>';
		}else{
		    $tableClasse = 'dTable';    
		}
		
		$formulario .= '
<div class="wrapper">
	';
		if ($aviso) {
			$formulario .= '
	<div class="nNote nWarning hideit">
		';
			$formulario .= '
		<p>
			<strong>AVISO: </strong>' . $aviso . '
		</p>
		';
			$formulario .= '
	</div>';
		}
		
		$formulario .= '
	<div class="widget">
		';
		$formulario .= '
		<div class="title"><img src="images/icons/dark/fullscreen.png" alt="" class="titleIcon" /><h6>' . $nome . '</h6>
		</div>
		';
		$formulario .= '
		<table cellpadding="0" cellspacing="0" border="0" class="display withCheck dTableAff '.$tableClasse.'">
			';
		$formulario .= '
			<thead>
				';
		$formulario .= '
				<tr>
					';
		if ($acaoOrdenar) {
			$formulario .= '<th>ORDEM</th>';
		}
		for($i = 0; $i < count ( $arrayTableNome ); $i ++) {
			$formulario .= '<th>' . $arrayTableNome [$i] . '</th>';
		}
		if ($permissaopublicar === 1) {
			$formulario .= '<th>STATUS</th>';
		}
		$formulario .= '<th>AÇÃO</th>';
		$formulario .= '
				</tr>
				';
		$formulario .= '
			</thead>
			';
		$formulario .= '
			<tbody>
				';
		
		for($i = 0; $i < $arrayDadosTable ["num"]; $i ++) {
			if (isset($arrayDadosTable [$i] ->status) && $arrayDadosTable [$i] ->status == 1) {
				$tooltip = "Clique para desativar";
				$statusAtivadoDesativado = "ativado";
				$statusAlterar = 0;
			} else {
				$tooltip = "Clique para ativar";
				$statusAlterar = 1;
				$statusAtivadoDesativado = "desativado";
			}
			$posicaoOrdem = "";
			if ($acaoOrdenar) {
				$posicaoOrdem = "data-position='" . ($i) . "' id='" . $arrayDadosTable [$i]->id . "'";
			}
			$formulario .= '
				<tr class="gradeA" ' . $posicaoOrdem . '>
					';
			$bgMove = "";
			if ($acaoOrdenar) {
				$bgMove = 'class="bgMoveMove"';
				$formulario .= '<td align="center" ' . $bgMove . '>';
				$formulario .= ($arrayDadosTable [$i]->ordem ? $arrayDadosTable [$i]->ordem : $i);
				$formulario .= '</td>';
			}
			for($j = 0; $j < count ( $arrayTableNome ); $j ++) {
				$formulario .= '<td align="center">';
				$formulario .= $arrayDadosTable [$i]->$campos [$j];
				$formulario .= '</td>';
			}
			if ($permissaopublicar === 1) {
				$formulario .= '<td align="center" class="actBtns">';
				if ($permissaopublicar === 1) {
					$formulario .= '<a href="javascript:;" title="' . $tooltip . '" class="tipS" onclick="confirmPubGeral(\'index.php?acao=publicar&ctrl=' . $ctrl . '&id=' . $arrayDadosTable [$i] ->id . '&status=' . $statusAlterar . '\',\'index.php?acao=listar&ctrl=' . $ctrl . '\');">';
					$formulario .= '<img src="images/icons/control/16/' . $statusAtivadoDesativado . '.png" />';
					$formulario .= '</a>';
				}
				$formulario .= '</td>';
			}
			$formulario .= '<td class="actBtns">';
			if ($permissaoalterar === 1) {
				$formulario .= '<a href="index.php?acao=frmAlterar&ctrl=' . $ctrl . '&id=' . $arrayDadosTable [$i]->id . '" title="Editar" class="tipS">';
				$formulario .= '<img src="images/icons/control/16/pencil.png" alt="" />';
				$formulario .= '</a>';
			}
			if ($permissaoexcluir === 1) {
				$formulario .= '<a href="javascript:;" title="Excluir" onclick="confirmDelGeral(\'index.php?acao=deletar&ctrl=' . $ctrl . '&id=' . $arrayDadosTable [$i]->id . '\',\'index.php?acao=listar&ctrl=' . $ctrl . '\');" class="tipS">';
				$formulario .= '<img src="images/icons/control/16/clear.png" alt="" />';
				$formulario .= '</a>';
			}
			$formulario .= '</td>';
			$formulario .= '
				</tr>';
		}
		$formulario .= '
			</tbody>
			';
		$formulario .= '
		</table>
		';
		$formulario .= '
	</div>
	';
		$formulario .= '
</div>';
		
		echo $formulario;
	}
	public function sk_montaMapa($idMapa = "markerAdd", $cidadeInicial = "Goiânia", $latitude = '', $longitude = '', $iconeMapa = 'images/iconMap.png') {
		
		/**
		 * Monta Galeria Youtube
		 */
		// $objForm->sk_montaYoutubeGaleria($produto["videos"],"produto",'index.php?acao=deletarVideosSelecionados');
		// $funcaoJquery = '<script src="http://maps.googleapis.com/maps/api/js?sensor=false" type="text/javascript"></script>';
		$funcaoJquery = '<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>';
		$funcaoJquery .= '
	<script>
';
		if ($latitude == "" && $longitude == "") {
			$funcaoJquery .= 'function setMarkerObject(toAddress) {
$(\'#' . $idMapa . '\').gmap3(\'destroy\');
$("#' . $idMapa . '").gmap3({
action: \'addMarker\',
marker: {
address: toAddress,
options:{
icon: "' . $iconeMapa . '",
draggable: true
},
events:{
dragend: function(marker){
$(this).gmap3({
getaddress:{
latLng:marker.getPosition(),
callback:function(results){
$("#' . $idMapa . 'latitude").val(results[0].geometry.location.lat());
$("#' . $idMapa . 'longitude").val(results[0].geometry.location.lng());
}
}
});
},
mouseover: function(marker, event, context){
var map = $(this).gmap3("get"),
infowindow = $(this).gmap3({get:{name:"infowindow"}});
if (infowindow){
infowindow.open(map, marker);
infowindow.setContent(context.data);
} else {
$(this).gmap3({
infowindow:{
anchor:marker,
options:{content: \'Arraste para marcar.\'}
}
});
}
},
mouseout: function(){
var infowindow = $(this).gmap3({get:{name:"infowindow"}});
if (infowindow){
infowindow.close();
}
}
}
},
map:{
options:{
zoom: 16
}
}
});
}

$(function(){
$("#' . $idMapa . 'mapaclick").click();
});

';
		}
		
		if ($latitude != "" && $longitude != "") {
			
			$funcaoJquery .= '
$(function(){
$("#' . $idMapa . '").gmap3({
map:{
options:{
center:[' . $latitude . ',' . $longitude . '],
zoom: 16
}
},
marker:{
values:[
{latLng:[' . $latitude . ', ' . $longitude . '], data:"Arraste para marcar."},
],
options:{
draggable: true,
icon: "' . $iconeMapa . '",
},
events:{
mouseover: function(marker, event, context){
var map = $(this).gmap3("get"),
infowindow = $(this).gmap3({get:{name:"infowindow"}});
if (infowindow){
infowindow.open(map, marker);
infowindow.setContent(context.data);
} else {
$(this).gmap3({
infowindow:{
anchor:marker,
options:{content: \'Arraste para marcar.\'}
}
});
}
},
mouseout: function(){
var infowindow = $(this).gmap3({get:{name:"infowindow"}});
if (infowindow){
infowindow.close();
}
},
dragend: function(marker){
$(this).gmap3({
getaddress:{
latLng:marker.getPosition(),
callback:function(results){
$("#' . $idMapa . 'latitude").val(results[0].geometry.location.lat());
$("#' . $idMapa . 'longitude").val(results[0].geometry.location.lng());
}
}
});
}
}
}
});});
';
		}
		$funcaoJquery .= '
	</script>';
		
		$funcaoJquery .= '
	<div align="center">
		';
		
		$funcaoJquery .= '
		<div class="formRow">
			';
		$funcaoJquery .= '
			<div class="widget">
				';
		$funcaoJquery .= '
				<div class="formRow">
					';
		$funcaoJquery .= '<label>Buscar:</label>';
		$funcaoJquery .= '
					<div class="formRight">
						';
		$funcaoJquery .= '
						<input type="text" name="enderecoMapa" value="' . $cidadeInicial . '" style="width: 70%;" id="' . $idMapa . 'enderecoMapa" maxlength="255" />
						';
		$funcaoJquery .= '<a href="javascript:;" id="' . $idMapa . 'mapaclick" onClick="setMarkerObject($(\'#' . $idMapa . 'enderecoMapa\').val());" title="" class="button greenB"><span>Buscar no mapa</span></a>';
		$funcaoJquery .= '
					</div><div class="clear"></div>
					';
		$funcaoJquery .= '
				</div>
				';
		$funcaoJquery .= '
				<div class="title"><img src="images/icons/dark/pencil.png" alt="" class="titleIcon" /><h6>Marcar Local - Clique em Buscar no Mapa</h6>
				</div>
				';
		$funcaoJquery .= '
				<div id="' . $idMapa . '" style="width: 100%; height: 400px;">
					';
		$funcaoJquery .= '
				</div>
				';
		$funcaoJquery .= '
				<div style="margin-top:10px;">
					';
		$funcaoJquery .= '
					<input type="text" title="Longitude" value="' . $longitude . '" name="longitude" id="' . $idMapa . 'longitude" maxlength="255" style="width:150px;" class="validate[required] tipS" />
					';
		$funcaoJquery .= '
					<input type="text" title="Latitude" value="' . $latitude . '" name="latitude" id="' . $idMapa . 'latitude" style="width:150px;" maxlength="255" class="validate[required] tipS" />
					';
		$funcaoJquery .= '
				</div>
				';
		$funcaoJquery .= '
			</div>
			';
		$funcaoJquery .= '
		</div>
		';
		$funcaoJquery .= '
	</div>';
		
		echo $funcaoJquery;
	}
	public function sk_formClone($campos = '') {
		$input = "";
		$input .= '<script src="js/jquery.sheepItPlugin-1.1.1.js"></script>';
		
		$input .= "<style>";
		$input .= "#sheepItForm_controls div, #sheepItForm_controls div input {";
		$input .= "float:left;";
		$input .= "margin-right: 10px;";
		$input .= "}";
		
		$input .= "</style>";
		
		$input .= "<!-- sheepIt Form -->";
		$input .= "<div id=\"sheepItForm\" style='margin:15px;' align='center'>";
		
		$input .= "<!-- Form template-->";
		$input .= "<div id=\"sheepItForm_template\">";
		for($i = 0; $i < count ( $campos ); $i ++) {
			
			$input .= $campos [$i];
		}
		$input .= "</div>";
		
		$input .= "<!-- /Form template-->";
		
		$input .= "<!-- No forms template -->";
		$input .= "<div id=\"sheepItForm_noforms_template\">Nenhum resultado</div>";
		$input .= "<!-- /No forms template-->";
		
		$input .= "<!-- Controls -->";
		$input .= "<div id=\"sheepItForm_controls\" align='center' style='padding:15px;'>";
		$input .= "<a href='javascript:;' id='sheepItForm_add' class='next button greenB'><span>mais campos</span></a>";
		$input .= "<a href='javascript:;' id='sheepItForm_remove_last' class='next button redB'><span>Remover</span></a>";
		$input .= "<a href='javascript:;' id='sheepItForm_remove_all' class='next button redB'><span>Remover todos</span></a>";
		$input .= "<span id=\"sheepItForm_add_n\">";
		$input .= "<input id=\"sheepItForm_add_n_input\" type=\"text\" size=\"4\" style='width:100px;'/>";
		$input .= "<a id='sheepItForm_add_n_button' class='next button blackB' href='javascript:;'><span>Add</span></a></div>";
		$input .= "</span>";
		$input .= "<!-- /Controls -->";
		
		$input .= "</div>";
		$input .= "<!-- /sheepIt Form -->";
		
		echo $input;
	}
    
    function formatBytes($bytes, $precision = 2)
    {
        $bytes = $bytes * 1000000;
        // human readable format -- powers of 1000
        //
        $unit = array('B','KB','MB','GB','TB','PB','EB');
    
        return @round(
                $bytes / pow(1000, ($i = floor(log($bytes, 1000)))), $precision
        ).' '.$unit[$i];
    }
}

?>
