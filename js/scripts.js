
/*yepnope1.5.x|WTFPL*/
(function(a,b,c){function d(a){return"[object Function]"==o.call(a)}function e(a){return"string"==typeof a}function f(){}function g(a){return!a||"loaded"==a||"complete"==a||"uninitialized"==a}function h(){var a=p.shift();q=1,a?a.t?m(function(){("c"==a.t?B.injectCss:B.injectJs)(a.s,0,a.a,a.x,a.e,1)},0):(a(),h()):q=0}function i(a,c,d,e,f,i,j){function k(b){if(!o&&g(l.readyState)&&(u.r=o=1,!q&&h(),l.onload=l.onreadystatechange=null,b)){"img"!=a&&m(function(){t.removeChild(l)},50);for(var d in y[c])y[c].hasOwnProperty(d)&&y[c][d].onload()}}var j=j||B.errorTimeout,l=b.createElement(a),o=0,r=0,u={t:d,s:c,e:f,a:i,x:j};1===y[c]&&(r=1,y[c]=[]),"object"==a?l.data=c:(l.src=c,l.type=a),l.width=l.height="0",l.onerror=l.onload=l.onreadystatechange=function(){k.call(this,r)},p.splice(e,0,u),"img"!=a&&(r||2===y[c]?(t.insertBefore(l,s?null:n),m(k,j)):y[c].push(l))}function j(a,b,c,d,f){return q=0,b=b||"j",e(a)?i("c"==b?v:u,a,b,this.i++,c,d,f):(p.splice(this.i++,0,a),1==p.length&&h()),this}function k(){var a=B;return a.loader={load:j,i:0},a}var l=b.documentElement,m=a.setTimeout,n=b.getElementsByTagName("script")[0],o={}.toString,p=[],q=0,r="MozAppearance"in l.style,s=r&&!!b.createRange().compareNode,t=s?l:n.parentNode,l=a.opera&&"[object Opera]"==o.call(a.opera),l=!!b.attachEvent&&!l,u=r?"object":l?"script":"img",v=l?"script":u,w=Array.isArray||function(a){return"[object Array]"==o.call(a)},x=[],y={},z={timeout:function(a,b){return b.length&&(a.timeout=b[0]),a}},A,B;B=function(a){function b(a){var a=a.split("!"),b=x.length,c=a.pop(),d=a.length,c={url:c,origUrl:c,prefixes:a},e,f,g;for(f=0;f<d;f++)g=a[f].split("="),(e=z[g.shift()])&&(c=e(c,g));for(f=0;f<b;f++)c=x[f](c);return c}function g(a,e,f,g,h){var i=b(a),j=i.autoCallback;i.url.split(".").pop().split("?").shift(),i.bypass||(e&&(e=d(e)?e:e[a]||e[g]||e[a.split("/").pop().split("?")[0]]),i.instead?i.instead(a,e,f,g,h):(y[i.url]?i.noexec=!0:y[i.url]=1,f.load(i.url,i.forceCSS||!i.forceJS&&"css"==i.url.split(".").pop().split("?").shift()?"c":c,i.noexec,i.attrs,i.timeout),(d(e)||d(j))&&f.load(function(){k(),e&&e(i.origUrl,h,g),j&&j(i.origUrl,h,g),y[i.url]=2})))}function h(a,b){function c(a,c){if(a){if(e(a))c||(j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}),g(a,j,b,0,h);else if(Object(a)===a)for(n in m=function(){var b=0,c;for(c in a)a.hasOwnProperty(c)&&b++;return b}(),a)a.hasOwnProperty(n)&&(!c&&!--m&&(d(j)?j=function(){var a=[].slice.call(arguments);k.apply(this,a),l()}:j[n]=function(a){return function(){var b=[].slice.call(arguments);a&&a.apply(this,b),l()}}(k[n])),g(a[n],j,b,n,h))}else!c&&l()}var h=!!a.test,i=a.load||a.both,j=a.callback||f,k=j,l=a.complete||f,m,n;c(h?a.yep:a.nope,!!i),i&&c(i)}var i,j,l=this.yepnope.loader;if(e(a))g(a,0,l,0);else if(w(a))for(i=0;i<a.length;i++)j=a[i],e(j)?g(j,0,l,0):w(j)?B(j):Object(j)===j&&h(j,l);else Object(a)===a&&h(a,l)},B.addPrefix=function(a,b){z[a]=b},B.addFilter=function(a){x.push(a)},B.errorTimeout=1e4,null==b.readyState&&b.addEventListener&&(b.readyState="loading",b.addEventListener("DOMContentLoaded",A=function(){b.removeEventListener("DOMContentLoaded",A,0),b.readyState="complete"},0)),a.yepnope=k(),a.yepnope.executeStack=h,a.yepnope.injectJs=function(a,c,d,e,i,j){var k=b.createElement("script"),l,o,e=e||B.errorTimeout;k.src=a;for(o in d)k.setAttribute(o,d[o]);c=j?h:c||f,k.onreadystatechange=k.onload=function(){!l&&g(k.readyState)&&(l=1,c(),k.onload=k.onreadystatechange=null)},m(function(){l||(l=1,c(1))},e),i?k.onload():n.parentNode.insertBefore(k,n)},a.yepnope.injectCss=function(a,c,d,e,g,i){var e=b.createElement("link"),j,c=i?h:c||f;e.href=a,e.rel="stylesheet",e.type="text/css";for(j in d)e.setAttribute(j,d[j]);g||(n.parentNode.insertBefore(e,n),m(c,0))}})(this,document);

var pathGeral = "sistemas/geral/";

yepnope([{
	  load: [ 
	          pathSite+"js/bower_components/components-font-awesome/css/font-awesome.min.css",
	          pathSite+"js/bower_components/bootstrap/dist/js/bootstrap.min.js",
	          pathSite+"js/bower_components/modernizr/modernizr.js", 
	          pathSite+"js/bower_components/jquery-mousewheel/jquery.mousewheel.min.js", 
	          pathSite+"js/bower_components/noty/js/noty/packaged/jquery.noty.packaged.min.js", 
	          pathSite+"js/bower_components/noty/js/noty/packaged/animate.css", 
	          pathSite+"js/bower_components/html2canvas/build/html2canvas.min.js", 
	          pathSite+"js/bower_components/jQuery-Mask-Plugin/dist/jquery.mask.min.js" ],
	  complete: function () {

		  
		      
		  	 /*
		  	 * FUNCAO PARA CRIAR BANNER
		  	 * 
		  	 * 
		  	 *  <div id="cbp-fwslider" class="cbp-fwslider">
				    <ul>
				        <?php for($i=0;$i<10;$i++):?>
				        <li><a href="#"><img src="<?php echo $path["site"]?>img/banner_luta_dialogo.jpg" alt="img01"/></a></li>
				        <?php endfor;?>
				    </ul>
				</div>
		  	 */
		  	 if($('.cbp-fwslider').length != 0){
		      	yepnope([{
		  		  load: [  pathSite+"js/FullWidthImageSlider/css/component.css", pathSite+"js/FullWidthImageSlider/js/jquery.cbpFWSlider.min.js", pathSite+"js/FullWidthImageSlider/js/modernizr.custom.js"],
		  		  complete: function () {
		  			$( function() {
						/*
						- how to call the plugin:
						$( selector ).cbpFWSlider( [options] );
						- options:
						{
							// default transition speed (ms)
							speed : 500,
							// default transition easing
							easing : 'ease'
						}
						- destroy:
						$( selector ).cbpFWSlider( 'destroy' );
						*/

						$( '.cbp-fwslider' ).cbpFWSlider();

					} );
		  		  }
		  		}]);
		      }
		      
		      
		      /*
		  	 * FUNCAO PARA CAROUSEL
		  	 * 
		  	 * 
		  	 * <div class="carousel">
			    <?php for($i=0;$i<10;$i++):?>
			        <div class="item"><img class="lazyOwl" data-src="<?php echo $path["site"]?>img/banner_luta_dialogo.jpg" alt="Lazy Owl Image"></div>
			    <?php endfor;?>
			    </div>
		  	 */
		  	if($('.carousel').length != 0){
		      	yepnope([{
		  		  load: [ pathSite+"js/bower_components/OwlCarousel/owl-carousel/owl.carousel.css",pathSite+"js/bower_components/OwlCarousel/owl-carousel/owl.theme.css", pathSite+"js/bower_components/OwlCarousel/owl-carousel/owl.carousel.min.js" ],
		  		  complete: function () {
		  			 $(".carousel").owlCarousel({
		  				navigation : false,
		  				lazyLoad : true,
		  				items : 4,
		  				pagination: false,
		  				responsive: true
		  			});
		  		  }
		  		}]);
		      }

		  	
		  	/*
		  	 * FUNCAO PARA FILE INPUT
		  	 * 
		  	 * 
		  	 * <input id="file-2" type="file" class="file" data-show-remove="false" data-show-upload="false" data-show-caption="true" data-show-preview="false">
		  	 */
		  	if($('input[type=file]').length != 0){
		  		yepnope([{
		  			load: [ pathSite+"js/bower_components/bootstrap-fileinput/css/fileinput.min.css",pathSite+"js/bower_components/bootstrap-fileinput/js/fileinput.min.js" ],
		  			complete: function () {	
		  				$("input[type=file]").fileinput({
			  					showCaption: false,
			  					showRemove: false,
			  					showUpload: false,
		  						browseClass: "btn btn-primary btn-lg"
		  				});
		  			}
		  		}]);
		  	}
		      
		  	
		  	/*
		  	 * Tabs Responsives
		  	 * 
		  	 * 
		  	 * <div class="responsiveTabs">
			        <ul>
			            <li><a href="#tab-1">Responsive Tab-1</a></li>
			        </ul>
			
			        <div id="tab-1">
			            teste 1
			        </div>
			
			    </div>
		  	 */
		  	if($('.responsiveTabs').length != 0){
		  		yepnope([{
		  			load: [ pathSite+"js/bower_components/responsive-tabs/css/responsive-tabs.css",pathSite+"js/bower_components/responsive-tabs/js/jquery.responsiveTabs.min.js" ],
		  			complete: function () {	
		  				$('.responsiveTabs').responsiveTabs({
		  				    startCollapsed: 'accordion'
		  				});
		  			}
		  		}]);
		  	}
		  	
		  	
		  	
		  	/*
		  	 * 
		  	 * <select data-placeholder="Selecione uma cidade" multiple="multiple" id="cidadespesquisa" style="width: 100%;" name="idcidade" class="chosen-select">
			        <?php 
			        
			        foreach ($cidadesFull as $cidade):
			        
			        $ciSessao = explode("-",$atributos["idcidade"]);
			         
			        $checar = "";
			        if (in_array(strtolower($cidade->IDCIDADE), $ciSessao)) {
			            $checar = "selected='selected'";
			        }
			        
			        ?>
			        <option <?php echo $checar;?> value="<?php echo $cidade->IDCIDADE;?>"><?php echo $cidade->NMCIDADE;?></option>
			        <?php endforeach;?>
		        </select>
		        
		        <select data-placeholder="Selecione um bairro" multiple="multiple" id="bairrospesquisa" disabled="disabled" style="width: 100%;" name="idbairro" class="chosen-select">
		        
	        	</select>
		  	 */
		  	if($('.chosen-select').length != 0){
		      	yepnope([{
		  		  load: [ pathSite+"js/bower_components/chosen_v1.3.0/chosen.jquery.min.js",pathSite+"js/bower_components/chosen_v1.3.0/chosen.proto.min.js", pathSite+"js/bower_components/chosen_v1.3.0/chosen.min.css" ],
		  		  complete: function () {
		  			$(".chosen-select").chosen({no_results_text: "Oops, sem resultados!"});
		  			
		  			
		  			$('#cidadespesquisa').on('change', function(){
		  				var str = "";
		  				$('#cidadespesquisa option:selected').each(function(index) { 
		  					if(index == 0){
		  						str += $( this ).val();
		  					}else{
		  						str += "-"+$( this ).val();
		  					}
		  				});
		  				if(str){
		  					pegarBairrosByCidadePesquisa(str,"bairrospesquisa","");
		  				}else{
		  					$("#bairrospesquisa option").remove();
		  		        	$("#bairrospesquisa").append("<option value=''>Selecione uma cidade.</option>");
		  		        	$("#bairrospesquisa").trigger("chosen:updated");
		  				}
		  		    });
		  			
		  		  }
		  		}]);
		      }
		  	
		  	if($('.QapTcha').length != 0){
			  	$('.QapTcha').QapTcha({
					disabledSubmit:true,
					autoRevert:true,
					autoSubmit:false,
					txtLock: 'Para desbloquear o envio arraste a seta para a direita.',
					txtUnlock: 'Formulário liberado;',
					PHPfile: pathSite+'ctrl.php?acao=verificaCaptcha'
				});
		  	}
		  	
		      /*
		       * FUNCAO PARA CRIAR AUTOCOMPLETE
		       */
		      if($('#buscaHome').length != 0){
		  	    $.getJSON( pathSite+'ctrl.php?acao=pegarAutocomplete', function(data) { 
		  		  	var availableTags = data;
		  		  	$( "#buscaHome" ).autocomplete({
		  		            source: availableTags,
		  		            select: function( event, ui ) {
		  		                $( "#buscaHome" ).val( ui.item.nometudo );
		  		                return false;
		  		            },
		  		             focus: function( event, ui ) {
		  		                $( "#buscaHome" ).val( ui.item.nometudo );
		  		                return false;
		  		             }
		  		        }).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
		  		        return $( "<li style='width:500px; padding:5px 0px;'></li>" )
		  		            .data( "item.autocomplete", item )
		  		            .append( "<a href='javascript:;'>" + "<img src='" + item.imgsrc + "' style='vertical-align:middle;'/>" + item.id+ " - " + item.nome+ "</a>" )
		  		            .appendTo( ul );
		  		        };
		  		 });
		  	 }
		  	 
		  	 
		  	/*
		  	 * FUNCAO PARA CRIAR FORMULARIO DE ENVIO DE CONTATO AJAX
		  	 */ 	
		      if($('#frmContato').length != 0){
		      	yepnope([{
		  		  load: [ pathSite+"js/bower_components/jQuery-Validation-Engine/js/jquery.validationEngine.js", pathSite+"js/bower_components/jQuery-Validation-Engine/js/languages/jquery.validationEngine-pt_BR.js", pathSite+"js/bower_components/jQuery-Validation-Engine/css/validationEngine.jquery.css" ],
		  		  complete: function () {
		  				$("#frmContato").validationEngine({
		  			        onValidationComplete: function(form, status){
		  			         if (status == true) {
		  			                mostraMensagem("Aguarde...","",'info');
		  			                $.ajax({
		  			                url: pathSite + 'ctrl.php?acao=envia-contato',
		  			                dataType: 'json',
		  			                type: 'POST',
		  			                data: $('#frmContato').serialize(),
		  			                success: function(obj){
		  			                    if(obj.situacao=="sucess"){
		  			                        mostraMensagem(obj.msg,4,'success');
		  			                        $("#frmContato").each(function(){
		  			                           this.reset(); //Cada volta no laÃ§o o form atual serÃ¡ resetado
		  			                        });
		  			                    } else if(obj.situacao=="error"){
		  			                        mostraMensagem(obj.msg,4,'error');
		  			                    }
		  			                },
		  			                error : function (XMLHttpRequest, textStatus, errorThrown) {
		  			
		  			                },
		  			
		  			                beforeSend : function(requisicao){
		  			                }
		  			            });
		  			         }
		  			        }
		  			
		  			   });
		  		    
		  		  }
		  		}]);
		      }
		      
		      /*
		       * FUNCAO PARA CRIAR O FANCYBOX MODAL
		       * 
		       * 
		       */
		      
		      
		      if($("a[rel=imagem_grupo]").length != 0 || $("a[rel=youtube_galeria]").length != 0){
		      	yepnope([{
		  		  load: [ pathSite+"js/bower_components/fancybox/source/jquery.fancybox.css", pathSite+"js/bower_components/fancybox/source/jquery.fancybox.pack.js" ],
		  		  complete: function () {
		  		   
		  			  if($("a[rel=imagem_grupo]").length != 0){
			  			  $("a[rel=imagem_grupo]").fancybox({
			  			    helpers:  {
			  			        thumbs : {
			  			            width: 50,
			  			            height: 50
			  			        }
			  			    },
			  			    beforeClose : function() {
			  			        $(".formError").remove();
			  			    }
			  			});
		  			  }
		  			  
		  			  if($("a[rel=youtube_galeria]").length != 0){
		  				 $("a[rel=youtube_galeria]").click(function() {
			  			        $.fancybox({
			  			                'padding'		: 0,
			  			                'autoScale'		: false,
			  			                'transitionIn'	: 'none',
			  			                'transitionOut'	: 'none',
			  			                'title'			: this.title,
			  			                'width'			: 680,
			  			                'height'		: 495,
			  			                'href'			: this.href.replace(new RegExp("watch\\?v=", "i"), 'v/'),
			  			                'type'			: 'swf',
			  			                'swf'			: {
			  			                    'wmode'				: 'transparent',
			  			                        'allowfullscreen'	: 'true'
			  			                }
			  			        });
			  			
			  			        return false;
			  			});
		  			  }
		  			  
		  			  
		  		  }
		  		}]);
		      }
		      
		      
		      /*
		  	 * FUNCAO PARA COLOCAR MASCARA DE DINHEIRO
		  	 * <input type="text" name="one" id="one" data-affixes-stay="true" data-prefix="R$ " data-thousands="." data-decimal=",">
		  	 */
		      	yepnope([{
		  		  load: [ pathSite+"js/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js" ],
		  		  complete: function () {
		  			$('input[data=money]').maskMoney();
		  		  }
		  		}]);
		  	 
		  	 
		  	//Inicio Mascara Telefone
		    // <input type="text" name="one" id="one" mask-input="cpfCnpj">
		  	if($('input[mask-input=telefone]').length != 0){
		  		$('input[mask-input=telefone]').mask('(00) 0000-0000',  
		  		{onKeyPress: function(phone, event, currentField, options){  
		  			 var new_sp_phone = phone.match(/^(\(11\) 9(5[0-9]|6[0-9]|7[01234569]|8[0-9]|9[0-9])[0-9]{1})/g);  
		  			 new_sp_phone ? $(currentField).mask('(00) 00000-0000', options) : $(currentField).mask('(00) 0000-0000', options)  
		  		}}  
		  		); 
		  	}

		  	if($('input[mask-input=cpfCnpj]').length != 0){
		  		var options =  {
		  		  maxlength: false,
		  		  onKeyPress: function(cep, event, currentField, options){
		  		 var masks = ['00.000.000/0000-00', '###.###.###-##'];
		  			mask = (cep.length>14) ? masks[0] : masks[1];
		  		  $('input[mask-input=cpfCnpj]').mask(mask, options);
		  		}};
		  		
		  		$('input[mask-input=cpfCnpj]').mask('###.###.###-##', options);
		  	}

		  	//Fim Mascara Telefone
		  	$("input[mask-input=cpf]").mask("999.999.999-99");
		  	$("input[mask-input=rg]").mask("99.999.999-*");
		  	$("input[mask-input=data]").mask("99/99/9999");
		  	$("input[mask-input=idade]").mask("99");
		  	$("input[mask-input=horario]").mask("99:99");
		  	$("input[mask-input=cep]").mask("99.999-999");
		      

		  
		  
		  /*
		   * FUNCAO PARA CRIAR MAPA DO GOOGLE COM STREET VIEW
		   */ 	
		  if($('.mapa_imovelDestaque').length != 0){
		  	
		  	yepnope([{load:'http://www.google.com/jsapi', callback: function() {
	  	    google.load("maps", "3",
	  	                {
	  	                    callback: function () {
	  	                        var fenway = new google.maps.LatLng(-16.668631,-49.260137);
	  	                        yepnope([{
	  							  load: [ pathSite+"js/bower_components/gmap3/dist/gmap3.min.js" ],
	  							  complete: function () {
	  									$(".mapa_imovelDestaque").gmap3({
	  								        map: {
	  								            options: {
	  								                zoom: 14, 
	  											    mapTypeId: google.maps.MapTypeId.ROADMAP, 
	  											    streetViewControl: true, 
	  											    center: fenway
	  								
	  								            }
	  								        },
	  								        streetviewpanorama:{
	  										    options:{
	  										      container: $( ".mapa_imovelDestaque2" ).append($(document.createElement("div")).addClass("googlemap")),
	  										      opts:{
	  										      	position: fenway,
	  										        pov: {
	  										          heading: 34,
	  										          pitch: 10,
	  										          zoom: 1
	  										        }
	  										      }
	  										    },
	  										    callback: function(){
	  										      $('.mapa_imovelDestaque2').css("zIndex",'-99999');
	  										   }
	  										  }
	  										  
	  								    });
	  							    
	  							  }
	  							}]);
	  	                    },
	  	                    other_params: "sensor=false"
	  	                });
	  		}}]);
	      }
		  
		  if($('.fundoMapa').length != 0){
			  yepnope([{load:'http://www.google.com/jsapi', callback: function() {
				  google.load("maps", "3",
						  {
						  callback: function () {
							  yepnope([{
								  load: [ pathSite+"js/bower_components/gmap3/dist/gmap3.min.js" ],
								  complete: function () {
									  $(".fundoMapa").gmap3({ 
	                                      marker: { 
	                                          values:[
											      {latLng:[-16.693154, -49.256176], data:"<div align='center'>Vendas: Rua 89, NÂº 630, Setor SUl - CEP 74.093-140 - GoiÃ¢nia - Go </div>"}
											    ],
	                                          options: { 
	                                              icon: pathSite + "img/mapa/icone.png", 
	                                              draggable: false
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
											              options:{content: context.data}
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
	                                      map: { 
	                                          options: { 
	                                              zoom: 12 
	
	                                          } 
	                                      } 
	                                  });
									  
								  }
							  }]);
						  },
						  other_params: "sensor=false"
				     });
			  }}]);
		  }
		  
		  // inserir script aqui
		  
		  // Faz um print da tela
		  $('#load').click(function(){

	            html2canvas($('#rodape'), {
	                onrendered: function (canvas) {
	                    var img = canvas.toDataURL("image/png");
	                    window.open(img);
	                }
	            });

	    });
		
		  
	  /*
	   * 
	   * <div class="row" style="margin-top: 5px;">
                <div class="col-md-12 col-xs-12 col-sm-12" align="center">
                <input type='hidden' name="offsetPaginacao" id="offsetPaginacao2" value='4'/>
                <input type='hidden' name="totalPaginacao" id="totalPaginacao2" value='<?php echo count($aImoveisTotal);?>'/>
                    <div class="pagination-holder clearfix">
                		<div class="paginacao2 light-theme simple-pagination" id="light-pagination"></div>
                	</div>
            	</div>
          </div>
	   * 
	   */  
	  if($('.paginacao2').length != 0){ 
			$('.paginacao2').pagination({
				items: $('#totalPaginacao2').val(),
				itemsOnPage: $('#offsetPaginacao2').val(),
				cssStyle: 'compact-theme',
				nextText: 'Próximo',
				prevText: 'Anterior',
				displayedPages : 2,
				onPageClick: function(pageNumber, event){
					var str = location.toString();
					var n = str.indexOf("pagina"); 
					if(n == -1){
						window.location.href=str+"/pagina/"+(pageNumber);
					}else{
						var outString = str.replace(/\/pagina\/[0-9]+/gi, '');
						window.location.href=outString+"/pagina/"+pageNumber;
					}
				},
				onInit : function(){
					var pagina = location.toString().match(/\/pagina\/[0-9]+/gi);
					if(pagina != null){
						var paginaFormatada = pagina.toString().match(/[0-9]+/);
						$('.paginacao2').pagination('drawPage', paginaFormatada);
					}
				}
			});
		}
		  

	  }
}]);


function mostraMensagem(msg,tempo,type,modal) {
	    var timere = null;
	    if(tempo == ""){
	        tempo = 10;
	        
	    }else{
	        tempo = tempo;
	    }
	    
	    var opts = {
	    };
	    switch (type) {
	    case 'error':
	        opts.title = "Erro";
	        opts.text = msg;
	        opts.type = "error";
	        break;
	    case 'info':
	        opts.title = "Informação";
	        opts.text = msg;
	        opts.type = "information";
	        break;
	    case 'success':
	        opts.title = "Sucesso";
	        opts.text = msg;
	        opts.type = "success";
	        break;
	    }
	    //$.pnotify(opts);
	    
	    noty({
	    	text: opts.title+" - "+opts.text,
	    	maxVisible: 10,
	    	layout: 'center',
	    	killer: true,
	    	modal       : modal,
	    	theme       : 'relax',
	    	timeout: (tempo * 1000),
		    type: opts.type,
		    animation   : {
                open  : 'animated zoomIn',
                close : 'animated zoomOut',
                easing: 'swing',
                speed : 500
            }
	    	});
    
}



/*
 * Remove special chars string
 */
function removeSpecialCharSimple(strToReplace) {
    strSChar = "áàãâäéèêëíìîïóòõôöúùûüçÁÀÃÂÄÉÈÊËÍÌÎÏÓÒÕÖÔÚÙÛÜÇ";
    strNoSChars = "aaaaaeeeeiiiiooooouuuucAAAAAEEEEIIIIOOOOOUUUUC";
    var newStr = "";
    for (var i = 0; i < strToReplace.length; i++) {
        if (strSChar.indexOf(strToReplace.charAt(i)) != -1) {
            newStr += strNoSChars.substr(strSChar.search(strToReplace.substr(i,1)),1);
        } else {
            newStr += strToReplace.substr(i,1);
        }
    }
    return newStr.toLowerCase().replace(/ /g,"-");
}


/*
 * CONVERTER TIPO FLOAT EM MOEDA
 */
function converteFloatMoeda(valor){
      var inteiro = null, decimal = null, c = null, j = null;
      var aux = new Array();
      valor = ""+valor;
      c = valor.indexOf(".",0);
      //encontrou o ponto na string
      if(c > 0){
         //separa as partes em inteiro e decimal
         inteiro = valor.substring(0,c);
         decimal = valor.substring(c+1,valor.length);
      }else{
         inteiro = valor;
      }

      //pega a parte inteiro de 3 em 3 partes
      for (j = inteiro.length, c = 0; j > 0; j-=3, c++){
         aux[c]=inteiro.substring(j-3,j);
      }

      //percorre a string acrescentando os pontos
      inteiro = "";
      for(c = aux.length-1; c >= 0; c--){
         inteiro += aux[c]+'.';
      }
      //retirando o ultimo ponto e finalizando a parte inteiro

      inteiro = inteiro.substring(0,inteiro.length-1);

      decimal = parseInt(decimal);
      if(isNaN(decimal)){
         decimal = "00";
      }else{
         decimal = ""+decimal;
         if(decimal.length === 1){
            decimal = decimal+"0";
         }
      }


      valor = "R$ "+inteiro+","+decimal;


      return valor;

}


/*
 * CONVERTER MOEDA REAL EM FLOAT
 */
function moeda2float(moeda){

   moeda = moeda.replace(".","");

   moeda = moeda.replace(",",".");

   return parseFloat(moeda);

}

function bytesToSize(megabytes) {
	bytes = parseInt(megabytes) * 1000000;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i];
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

function pesquisarHome(id){
	
	var params = $('#'+id).serialize();
	
	var aValor = params.split('&');
	var url = '';
	
	var aIndices = new Array();
	var oURL     = {};
	
	for(var i in aValor){
		var aValorAux = aValor[i].split('=');
		
		if(aValorAux[1]) {
			if (aIndices.indexOf(aValorAux[0]) == -1) {
				aIndices.push(aValorAux[0]);
				//url += '/'+aValorAux[0]+'/'+aValorAux[1];
				oURL[aValorAux[0]] = aValorAux[1];
			} else {
				oURL[aValorAux[0]] = oURL[aValorAux[0]] + '-' + aValorAux[1];
				//url += '/'+aValorAux[0]+'/'+aValorAux[1];
			}
		}
	}
	window.location.href=pathSite+"busca/"+ereJoin(oURL)+"pagina/1";
}

function ereJoin(obj) {
	var url = '';
	for (var i in obj) {
		url += i + '/' + obj[i] + '/';
	}
	return url;
}

function pegarBairrosByCidadePesquisa(cidadeId,idMostrarCarregando,bairrosSelecionados){
	$.ajax({
        url: pathSite + 'ctrl.php?acao=listarBairros',
        dataType: 'json',
        type: 'POST',
        data: {
        	id: cidadeId,
        	bairros_selecionados: bairrosSelecionados
        },
        success: function(obj){
        	if(obj == null){
        		$("#"+idMostrarCarregando+" option").remove();
        		$("#"+idMostrarCarregando).append("<option value=''>Erro ao carregar os bairros.</option>");
            	$("#"+idMostrarCarregando).trigger("chosen:updated");
        	}
            if(obj.situacao=="sucess"){
            	
            	$("#"+idMostrarCarregando+" option").remove();
            	$("#"+idMostrarCarregando).append(obj.bairros);
            	$("#"+idMostrarCarregando).attr('disabled',false);
            	$("#"+idMostrarCarregando).trigger("chosen:updated");
            } else if(obj.situacao=="error"){
            	
                mostraMensagem(obj.msg,4,'error',true);
            }else if(obj == null){
            	
            }
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {
        	
        },

        beforeSend : function(requisicao){
        	$("#"+idMostrarCarregando+" option").remove();
        	$("#"+idMostrarCarregando).append("<option value=''>Carregando bairros.</option>");
        	$("#"+idMostrarCarregando).trigger("chosen:updated");
        }
    });
}

$(function(){
	$(".selecaoPegarBairros").change(function(){
		var str = "";
		$('#cidades option:selected').each(function(index) { 
			if(index == 0){
				str += $( this ).val();
			}else{
				str += "-"+$( this ).val();
			}
		});
		if(str){
			pegarBairrosByCidade(str,"bairros");
		}else{
			$("#bairros option").remove();
        	$("#bairros").append("<option value=''>Selecione uma cidade.</option>");
		}
	});
	
});

$(function(){
	$('#cidadespesquisa').on('change', function(){
		var str = "";
		$('#cidadespesquisa option:selected').each(function(index) { 
			if(index == 0){
				str += $( this ).val();
			}else{
				str += "-"+$( this ).val();
			}
		});
		if(str){
			pegarBairrosByCidadePesquisa(str,"bairrospesquisa","");
		}else{
			$("#bairrospesquisa option").remove();
        	$("#bairrospesquisa").append("<option value=''>Selecione uma cidade.</option>");
		}
    });
});

function abreFoto(img){
	
	$.fancybox.open(["<div align='center'><img src='"+img+"'/></div>"],{
    	openEffect : 'elastic',
			openEasing : 'easeOutBack',
			openSpeed  : 800,
			closeEasing : 'easeInBack',
			closeSpeed  : 800,
			closeEffect : 'elastic',
			nextEasing : 'easeInBack',
			nextSpeed: 800,
			nextEffect : 'elastic',
			prevEffect : 'elastic',
			prevEasing : 'easeInBack',
			prevSpeed: 800
			
	});
}


function abreHtml(html){
	
	$.fancybox.open([html],{
    	openEffect : 'elastic',
			openEasing : 'easeOutBack',
			openSpeed  : 800,
			closeEasing : 'easeInBack',
			closeSpeed  : 800,
			closeEffect : 'elastic',
			nextEasing : 'easeInBack',
			nextSpeed: 800,
			nextEffect : 'elastic',
			prevEffect : 'elastic',
			prevEasing : 'easeInBack',
			prevSpeed: 800
			
	});
}

function abrirFotos(url){
	
	mostraMensagem('Carregando',4,'info',true);
	$.ajax({
		  url: url,
		  dataType: 'json',
		  type: 'POST',
		  success: function(obj){
			  
			  if(obj.situacao=="sucess"){
				
				var photos = new Array();
				  for (var i in obj.fotos) {
					photos[i] = {href : obj.fotos[i].src, title : obj.fotos[i].title};
				  }
				    
				    $.fancybox.open(photos,{
				    	openEffect : 'elastic',
	  					openEasing : 'easeOutBack',
	  					openSpeed  : 800,
	  					closeEasing : 'easeInBack',
	  					closeSpeed  : 800,
	  					closeEffect : 'elastic',
	  					nextEasing : 'easeInBack',
	  					nextSpeed: 800,
	  					nextEffect : 'elastic',
	  					prevEffect : 'elastic',
	  					prevEasing : 'easeInBack',
	  					prevSpeed: 800,
	  					afterLoad : function(){
	  						$.noty.closeAll();
					    }
	  					
				    }
				    
				    );
				    
				    
				  
			  } else if(obj.situacao=="error"){
				  mostraMensagem('Não existem fotos para este imóvel',2,'error',true);
			  }
		  },
		  error : function (XMLHttpRequest, textStatus, errorThrown) {
			  
		  },
		  
		  beforeSend : function(requisicao){
		  }
	  });
}


// Preloader Body
/*window.addEventListener('DOMContentLoaded', function() {
    new QueryLoader2(document.querySelector("body"), {
        barColor: "#efefef",
        backgroundColor: "#111",
        percentage: true,
        barHeight: 1,
        minimumTime: 200,
        fadeOutTime: 1000
    });
});*/






