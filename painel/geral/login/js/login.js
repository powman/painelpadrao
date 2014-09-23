Ext.BLANK_IMAGE_URL = '../js/ext/resources/images/default/s.gif';
Ext.onReady(function(){
    Ext.QuickTips.init();
	
	//cria o painel de login
    var login = new Ext.FormPanel({
        labelWidth:55,
        url:'../usuarios/ctrlUsuarios.php',
        frame:true,
        title:'Acesso Restrito',
        width:230,
		bodyStyle:'padding-top:5px;',
        defaultType:'textfield',
		monitorValid:true,
		labelAlign:'right',
		buttonAlign:'right',
		//cria os campos texto no formulario
        items:[{
                fieldLabel:'Usu&aacute;rio',
                name:'login',
                allowBlank:false,
				tabIndex:0
            },{
                fieldLabel:'Senha',
                name:'senha',
                inputType:'password',
                allowBlank:false
            },{
                fieldLabel:'IP',
                name:'ip',
                allowBlank:true,
				value:document.getElementById('ip').value,
				readOnly:true,
				disabled:true
            },{
				fieldLabel:'Ação',
				name:'acao',
				inputType:'hidden',
				value:'logar',
				hideLabel:true				
            }],
		//adiciona o formulario
        buttons:[{
                text:'Entrar',
                formBind: true,
                //pega o click do botao e submita o formulario
                handler:submitLogin
            },{
				text:'Esqueceu sua senha',
				handler:function(){
					var winRecSenha = new Ext.Window({
						layout:'fit',
						width:210,
						height:110,
						closable: true,
						resizable: false,
						plain: true,
						draggable:true,
						shadow:true,
						closeAction:'hide',
						title:'Recuperar Senha',
						items: [formRecSenha]
					}).show();
				}
			}]
    });
	
	var formRecSenha = new Ext.FormPanel({
		labelWidth:40,
        url:'../usuarios/ctrlUsuarios.php?acao=solicitaRecuperaSenha',
        frame:true,
        defaultType:'textfield',
		monitorValid:true,
		items:[{
			fieldLabel:'Login',
			name:'login',
			allowBlank:false
		}],
		buttons:[{
			text:'Enviar',
			formBind:true,
			handler:function(){
						formRecSenha.getForm().submit({
							method:'POST',
							waitTitle:'Conectando',
							waitMsg:'Enviando dados...',
							//mensagem de sucesso e redirecionamento
							success:function(){ 
								Ext.Msg.alert('Sucesso', 'Foi enviado para o seu email as instru&ccedil;&otilde;es para recuperar sua senha!', function(btn, text){
								   if (btn == 'ok'){
										var redirect = 'index.php'; 
										window.location = redirect;
								   }
								});
							},
							//mensagem de erro
							failure:function(form, action){
								if(action.failureType == 'server'){
									obj = Ext.util.JSON.decode(action.response.responseText);
									Ext.Msg.alert('Erro', obj.errors.reason);
								}else{
									Ext.Msg.alert('Advert&ecirc;ncia!','Autentica&ccedil;&atilde;o com servidor est&aacute; inacess&iacute;vel : '+action.response.responseText);
								}
								formRecSenha.getForm().reset();
							}
						});
					}
		}]
	});
	
	//cria a janela de login
    var win = new Ext.Window({
        layout:'fit',
        width:250,
        height:175,
        closable: false,
        resizable: false,
        plain: true,
		draggable:false,
        items: [login],
		keys: [{
			key: Ext.EventObject.ENTER,
			fn: submitLogin,
			scope:this
		}]
	});
	win.show();
	
	function submitLogin(){
		login.getForm().submit({
			method:'POST',
			waitTitle:'Conectando',
			waitMsg:'Enviando dados...',
			//mensagem de sucesso e redirecionamento
			success:function(){
				var redirect = '../index.php'; 
				window.location = redirect;
			},
			//mensagem de erro
			failure:function(form, action){
				if(action.failureType == 'server'){
					obj = Ext.util.JSON.decode(action.response.responseText);
					Ext.Msg.alert('Login Falhou!', obj.errors.reason);
				}else{
					Ext.Msg.alert('Advert&ecirc;ncia!','Autentica&ccedil;&atilde;o com servidor est&aacute; inacess&iacute;vel : '+action.response.responseText);
				}
				login.getForm().reset();
			}
		});
	}
});