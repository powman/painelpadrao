$(function() {
	
	
/* Form related plugins
================================================== */

	//===== Usual validation engine=====//

	$("#usualValidate").validate({
		rules: {
			firstname: "Obrigatório",
			minChars: {
				required: true,
				minlength: 3
			},
			maxChars: {
				required: true,
				maxlength: 6
			},
			mini: {
				required: true,
				min: 3
			},
			maxi: {
				required: true,
				max: 6
			},
			range: {
				required: true,
				range: [6, 16]
			},
			emailField: {
				required: true,
				email: true
			},
			urlField: {
				required: true,
				url: true
			},
			dateField: {
				required: true,
				date: true
			},
			digitsOnly: {
				required: true,
				digits: true
			},
			enterPass: {
				required: true,
				minlength: 5
			},
			repeatPass: {
				required: true,
				minlength: 5,
				equalTo: "#enterPass"
			},
			customMessage: "Obrigatório",
			
	
			topic: {
				required: "#newsletter:checked",
				minlength: 2
			},
			agree: "required"
		},
		messages: {
			customMessage: {
				required: "Esta Mensagem é editável",
			},
			agree: "Por favor, aceite a nossa política"
		}
	});



	//===== Input limiter =====//
	
	$('.lim').inputlimiter({
		limit: 100
		//boxClass: 'limBox',
		//boxAttach: false
	});


	//===== Multiple select with dropdown =====//
	
	$(".chzn-select").chosen({no_results_text: "sem resultados!",widht:'100%'}); 
        
        
        $(".select-image").msDropdown({visibleRows:8});

	
	
	//===== Placeholder =====//
	
	$('input[placeholder], textarea[placeholder]').placeholder();
	
	
	//===== ShowCode plugin for <pre> tag =====//
	
	$('.showCode').sourcerer('js html css php'); // Display all languages
	$('.showCodeJS').sourcerer('js'); // Display JS only
	$('.showCodeHTML').sourcerer('html'); // Display HTML only
	$('.showCodePHP').sourcerer('php'); // Display PHP only
	$('.showCodeCSS').sourcerer('css'); // Display CSS only
	
	
	//===== Autocomplete =====//
	
	var availableTags = [ "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++", "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran", "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl", "PHP", "Python", "Ruby", "Scala", "Scheme" ];
	$( "#ac" ).autocomplete({
	source: availableTags
	});	
	
	
	//===== Masked input =====//
	
	$.mask.definitions['~'] = "[+-]";
	$(".maskDate").mask("99/99/9999");
        $(".maskCep").mask("99.999-999");
	$(".maskPhone").mask("(999) 9999-9999");
	$(".maskPhoneExt").mask("(999) 999-9999? x99999");
	$(".maskIntPhone").mask("+33 999 999 999");
	$(".maskTin").mask("99-9999999");
	$(".maskSsn").mask("999-99-9999");
	$(".maskProd").mask("a*-999-a999", { placeholder: " " });
	$(".maskEye").mask("~9.99 ~9.99 999");
	$(".maskPo").mask("PO: aaa-999-***");
	$(".maskPct").mask("99%");
	
	
	//===== Dual select boxes =====//
	
	$.configureBoxes();
	
	
	//===== Wizards =====//
	
	$("#wizard1").formwizard({
		formPluginEnabled: true, 
		validationEnabled: false,
		focusFirstInput : false,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status1").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#w1").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			resetForm: true
		}
	});
	
	$("#wizard2").formwizard({ 
		formPluginEnabled: true,
		validationEnabled: true,
		focusFirstInput : false,
		disableUIStyles : true,
	
		formOptions :{
			success: function(data){$("#status2").fadeTo(500,1,function(){ $(this).html("<span>Form was submitted!</span>").fadeTo(5000, 0); })},
			beforeSubmit: function(data){$("#w2").html("<span>Form was submitted with ajax. Data sent to the server: " + $.param(data) + "</span>");},
			dataType: 'json',
			resetForm: true
		},
                validationOptions : {
			rules: {
				email: { required: true, email: true },
				nome: { required: true },
				login: { required: true }
			},
			messages: {
				email: { required: "Insira um E-mail.", email: "O Email deve ser no modelo nome@domain.com.br" },
				nome: { required: "Insira um nome." },
				login: { required: "Insira um login para acessar o sistema." }
			}
		}
	});
        var existeFormulario = $('.SignupForm').size();
        
        if(existeFormulario > 0){
            
        var $signupForm = $( '.SignupForm' );
            
        $signupForm.validationEngine();

        $signupForm.formToWizard({
            submitButton: 'Cadastrar',
            showProgress: false, //default value for showProgress is also true
            nextBtnName: 'Próximo',
            prevBtnName: 'Voltar',
            showStepNo: false,
            validateBeforeNext: function() {
               // return $signupForm.validationEngine('validate');
               if($signupForm.validationEngine('validate') == false){
                  $signupForm.validationEngine('validate');  
               }else{
                  $signupForm.validationEngine('hideAll'); 
                  return $signupForm.validationEngine('validate');
               }
            }
        });
        
        }


        $( '#txt_stepNo' ).change( function() {
            $signupForm.formToWizard( 'GotoStep', $( this ).val() );
        });

        $( '#btn_next' ).click( function() {
            $signupForm.formToWizard( 'NextStep' );
        });

        $( '#btn_prev' ).click( function() {
            $signupForm.formToWizard( 'PreviousStep' );
        });
	
	$("#wizard3").formwizard({
		formPluginEnabled: false, 
		validationEnabled: false,
		focusFirstInput : false,
		disableUIStyles : true
	});
	
	
	//===== Validation engine =====//
	
	$("#validate").validationEngine();
	
	
	//===== WYSIWYG editor =====//
	
	/*$("#editor").cleditor({
		width:"100%", 
		height:"100%",
		bodyStyle: "margin: 10px; font: 12px Arial,Verdana; cursor:text"
	}); */
  
  window.onload = function() {
        
        if(document.getElementById("editor") != null){

    	CKEDITOR.replace( 'editor',
                {
                   forcePasteAsPlainText : true ,
                   removeButtons : 'Underline,Subscript,Superscript',
                   enterMode : CKEDITOR.ENTER_BR ,
                   contentsCss : 'css/fckeditor.css',
                //    filebrowserBrowseUrl : '../sistema/kcfinder/browse.php?type=files',
                //    filebrowserImageBrowseUrl : '../sistema/kcfinder/browse.php?type=images',
                //    filebrowserFlashBrowseUrl : '../sistema/kcfinder/browse.php?type=flash',
                //    filebrowserUploadUrl : '../sistema/kcfinder/upload.php?type=files',
                //    filebrowserImageUploadUrl : '../sistema/kcfinder/upload.php?type=images',
                //    filebrowserFlashUploadUrl : '../sistema/kcfinder/upload.php?type=flash',
                   resize_enabled : false,
                   extraPlugins : 'iframedialog,iframe,filebrowser,uicolor,colorbutton,panelbutton,button,lineutils,pagebreak,qrc,ckwebspeech,youtube',
                   oembed_WrapperClass : 'embededContent',
                   oembed_maxWidth : '560',
                   oembed_maxHeight : '315',
                   toolbarGroups: [
                           		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
								{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
								{ name: 'links' },
								{ name: 'insert' },
								{ name: 'tools' },
								{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
								{ name: 'others' },
								'/',
								{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
								{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align' ] },
								{ name: 'colors' },
								{ name: 'styles' },
								{ name: 'youtube' },
                           	],
                   	ckwebspeech : {'culture' : 'en-us',
                   'commandvoice' : 'command',   //trigger voice commands
                   'commands': [                 //command list
                               {'newline': 'new line'},            //trigger to add a new line in CKEditor
                               {'newparagraph': 'new paragraph'},  //trigger to add a new paragraph in CKEditor
                               {'undo': 'undo'},                   //trigger to undo changes in CKEditor
                               {'redo': 'redo'}                    //trigger to redo changes in CKEditor
                            ]
                         },
                         youtube_width : '640',
                         youtube_height : '480',
                         youtube_related : true,
                         youtube_older : false,
                         youtube_privacy : false
                   
                   
                });
               
        }
               
               
               
               
               
               
    };
    
	
	
	//===== File uploader =====//
	
	$("#uploader").pluploadQueue({
		runtimes : 'html5,html4',
		url : 'php/upload.php',
		max_file_size : '1mb',
		unique_names : true,
		filters : [
			{title : "Arquivos de Imagens", extensions : "jpg,gif,png"}
			//{title : "Zip files", extensions : "zip"}
		]
	});
        
        $(".plupload_start").detach();
	
	
	//===== Tags =====//	
		
	$('.tags').tagsInput({width:'100%'});
	$('.tags2').tagsInput({width:'100%'});
	$('.tags3').tagsInput({width:'100%'});
		
		
	//===== Autogrowing textarea =====//
	
	$(".autoGrow").autoGrow();



/* General stuff
================================================== */


	//===== Left navigation styling =====//
	
	$('li.this').prev('li').css('border-bottom-color', '#2c3237');
	$('li.this').next('li').css('border-top-color', '#2c3237');

	
	
	//===== User nav dropdown =====//		
	
	$('.dd').click(function () {
		$('.userDropdown').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("dd"))
		$(".userDropdown").slideUp(200);
	});
	  
	  
	  
	//===== Statistics row dropdowns =====//	
		
	$('.ticketsStats > h2 a').click(function () {
		$('#s1').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("ticketsStats"))
		$("#s1").slideUp(150);
	});
	
	
	$('.visitsStats > h2 a').click(function () {
		$('#s2').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("visitsStats"))
		$("#s2").slideUp(150);
	});
	
	
	$('.usersStats > h2 a').click(function () {
		$('#s3').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("usersStats"))
		$("#s3").slideUp(150);
	});
	
	
	$('.ordersStats > h2 a').click(function () {
		$('#s4').slideToggle(150);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("ordersStats"))
		$("#s4").slideUp(150);
	});
	
	
	
	//===== Collapsible elements management =====//
	
	$('.exp').collapsible({
		defaultOpen: 'current',
		cookieName: 'navAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 200
	});
	
	$('.opened').collapsible({
		defaultOpen: 'opened,toggleOpened',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	$('.closed').collapsible({
		defaultOpen: '',
		cssOpen: 'inactive',
		cssClose: 'normal',
		speed: 200
	});
	
	
	$('.goTo').collapsible({
		defaultOpen: 'openedDrop',
		cookieName: 'smallNavAct',
		cssOpen: 'active',
		cssClose: 'inactive',
		speed: 100
	});
	
	/*$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("smalldd"))
		$(".smallDropdown").slideUp(200);
	});*/



	
	//===== Middle navigation dropdowns =====//
	
	$('.mUser').click(function () {
		$('.mSub1').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mUser"))
		$(".mSub1").slideUp(100);
	});
	
	$('.mMessages').click(function () {
		$('.mSub2').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mMessages"))
		$(".mSub2").slideUp(100);
	});
	
	$('.mFiles').click(function () {
		$('.mSub3').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mFiles"))
		$(".mSub3").slideUp(100);
	});
	
	$('.mOrders').click(function () {
		$('.mSub4').slideToggle(100);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("mOrders"))
		$(".mSub4").slideUp(100);
	});



	//===== User nav dropdown =====//		
	
	$('.sidedd').click(function () {
		$('.sideDropdown').slideToggle(200);
	});
	$(document).bind('click', function(e) {
		var $clicked = $(e.target);
		if (! $clicked.parents().hasClass("sidedd"))
		$(".sideDropdown").slideUp(200);
	});
	






/* Tables
================================================== */


	//===== Check all checbboxes =====//
	
	$(".titleIcon input:checkbox").click(function() {
		var checkedStatus = this.checked;
		$("#checkAll tbody tr td:first-child input:checkbox").each(function() {
			this.checked = checkedStatus;
				if (checkedStatus == this.checked) {
					$(this).closest('.checker > span').removeClass('checked');
				}
				if (this.checked) {
					$(this).closest('.checker > span').addClass('checked');
				}
		});
	});	
	
	$('#checkAll tbody tr td:first-child').next('td').css('border-left-color', '#CBCBCB');
	
	
	
	//===== Resizable columns =====//
	
	$("#res, #res1").colResizable({
		liveDrag:true,
		draggingClass:"dragging" 
	});
	  
	  
	  
	//===== Sortable columns =====//
	
	$("table").tablesorter();
	
	
	
	//===== Dynamic data table =====//
	
	oTable = $('.dTable').dataTable({
		"bJQueryUI": true,
		"sPaginationType": "full_numbers",
		"sDom": '<""l>t<"F"fp>',
                "aaSorting": [[ 0, "desc" ]],
                "bStateSave": true
	});





/* # Pickers
================================================== */


	//===== Color picker =====//
	
	$('#cPicker').ColorPicker({
		color: '#000000',
		onShow: function (colpkr) {
			$(colpkr).fadeIn(500);
			return false;
		},
		onHide: function (colpkr) {
			$(colpkr).fadeOut(500);
			return false;
		},
		onChange: function (hsb, hex, rgb) {
			$('#cPicker input').val('#' + hex);
		}
	});
	
	$('#flatPicker').ColorPicker({flat: true});
	
	
	
	//===== Time picker =====//
	
	$('.timepicker').timeEntry({
		show24Hours: true, // 24 hours format
		showSeconds: true, // Show seconds?
		spinnerImage: 'images/forms/spinnerUpDown.png', // Arrows image
		spinnerSize: [19, 30, 0], // Image size
		spinnerIncDecOnly: true // Only up and down arrows
	});
	
	
	//===== Datepickers =====//
	
	$( ".datepicker" ).datepicker({ 
		defaultDate: +7,
		autoSize: true,
		appendText: '(dia/mes/ano)',
		dateFormat: 'dd/mm/yy',
	});	
	
	$( ".datepickerInline" ).datepicker({ 
		defaultDate: +7,
		autoSize: true,
		appendText: '(dia/mes/ano)',
		dateFormat: 'dd/mm/yy',
		numberOfMonths: 1
	});	


	








//===== Progress bars =====//
	
	// default mode
	$('#progress1').anim_progressbar();
	
	// from second #5 till 15
	var iNow = new Date().setTime(new Date().getTime() + 5 * 1000); // now plus 5 secs
	var iEnd = new Date().setTime(new Date().getTime() + 15 * 1000); // now plus 15 secs
	$('#progress2').anim_progressbar({start: iNow, finish: iEnd, interval: 1});
	
	// jQuery UI progress bar
	$( "#progress" ).progressbar({
			value: 80
	});
	
	
	
	//===== Animated progress bars =====//
	
	var percent = $('.progressG').attr('title');
	$('.progressG').animate({width: percent},1000);
	
	var percent = $('.progressO').attr('title');
	$('.progressO').animate({width: percent},1000);
	
	var percent = $('.progressB').attr('title');
	$('.progressB').animate({width: percent},1000);
	
	var percent = $('.progressR').attr('title');
	$('.progressR').animate({width: percent},1000);
	
	
	
	
	var percent = $('#bar1').attr('title');
	$('#bar1').animate({width: percent},1000);
	
	var percent = $('#bar2').attr('title');
	$('#bar2').animate({width: percent},1000);
	
	var percent = $('#bar3').attr('title');
	$('#bar3').animate({width: percent},1000);
	
	var percent = $('#bar4').attr('title');
	$('#bar4').animate({width: percent},1000);
	
	var percent = $('#bar5').attr('title');
	$('#bar5').animate({width: percent},1000);

	var percent = $('#bar6').attr('title');
	$('#bar6').animate({width: percent},1000);

	var percent = $('#bar7').attr('title');
	$('#bar7').animate({width: percent},1000);

	var percent = $('#bar8').attr('title');
	$('#bar8').animate({width: percent},1000);

	var percent = $('#bar9').attr('title');
	$('#bar9').animate({width: percent},1000);




/* Other plugins
================================================== */


	//===== File manager =====//
	
	$('#fm').elfinder({
		url : 'php/connector.php',
	});

	
	//===== Calendar =====//
	
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	
	$('.calendar').fullCalendar({
		header: {
			left: 'prev,next',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},
		editable: true,
		events: [
			{
				title: 'Evento de dia inteiro',
				start: new Date(y, m, 1)
			},
			{
				title: 'Long event',
				start: new Date(y, m, 5),
				end: new Date(y, m, 8)
			},
			{
				id: 999,
				title: 'Repetindo evento',
				start: new Date(y, m, 2, 16, 0),
				end: new Date(y, m, 3, 18, 0),
				allDay: false
			},
			{
				id: 999,
				title: 'Repetindo evento',
				start: new Date(y, m, 9, 16, 0),
				end: new Date(y, m, 10, 18, 0),
				allDay: false
			},
			{
				title: 'A cor do fundo pode ser mudada',
				start: new Date(y, m, 30, 10, 30),
				end: new Date(y, m, d+1, 14, 0),
				allDay: false,
				color: '#5c90b5'
			},
			{
				title: 'Almoço',
				start: new Date(y, m, 14, 12, 0),
				end: new Date(y, m, 15, 14, 0),
				allDay: false
			},
			{
				title: 'Festa de Aniversário',
				start: new Date(y, m, 18),
				end: new Date(y, m, 20),
				allDay: false
			},
			{
				title: 'Clackable',
				start: new Date(y, m, 27),
				end: new Date(y, m, 29),
				url: 'http://www/nitidapropaganda.com.br/'
			}
		]
	});
	
	
	
	
/* UI stuff
================================================== */


	//===== Sparklines =====//
	
	$('.negBar').sparkline('html', {type: 'bar', barColor: '#db6464'} );
	$('.posBar').sparkline('html', {type: 'bar', barColor: '#6daa24'} );
	$('.zeroBar').sparkline('html', {type: 'bar', barColor: '#4e8fc6'} ); 
	
	
	
	//===== Tooltips =====//
	
	$('.tipN').tipsy({gravity: 'n',fade: true});
	$('.tipS').tipsy({gravity: 's',fade: true});
	$('.tipW').tipsy({gravity: 'w',fade: true});
	$('.tipE').tipsy({gravity: 'e',fade: true});
	
		
	
	//===== Accordion =====//		
	
	$('div.menu_body:eq(0)').show();
	$('.acc .title:eq(0)').show().css({color:"#2B6893"});
	
	$(".acc .title").click(function() {	
		$(this).css({color:"#2B6893"}).next("div.menu_body").slideToggle(300).siblings("div.menu_body").slideUp("slow");
		$(this).siblings().css({color:"#404040"});
	});
	
	
	//===== Tabs =====//
		
	$.fn.contentTabs = function(){ 
	
		$(this).find(".tab_content").hide(); //Hide all content
		$(this).find("ul.tabs li:first").addClass("activeTab").show(); //Activate first tab
		$(this).find(".tab_content:first").show(); //Show first tab content
	
		$("ul.tabs li").click(function() {
			$(this).parent().parent().find("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$(this).addClass("activeTab"); //Add "active" class to selected tab
			$(this).parent().parent().find(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
			return false;
		});
	
	};
	$("div[class^='widget']").contentTabs(); //Run function on any div with class name of "Content Tabs"
	
	
	
	//===== Notification boxes =====//
	
	$(".hideit").click(function() {
		$(this).fadeTo(200, 0.00, function(){ //fade
			$(this).slideUp(300, function() { //slide up
				$(this).remove(); //then remove from the DOM
			});
		});
	});	
	
	
	
	//===== Lightbox =====//
	
	$("a[rel^='lightbox']").prettyPhoto();
	
	
	
	//===== Image gallery control buttons =====//
	
	$(".gallery ul li").hover(
		function() { $(this).children(".actions").show("fade", 200); },
		function() { $(this).children(".actions").hide("fade", 200); }
	);
	
	
	//===== Spinner options =====//
	
	var itemList = [
		{url: "http://ejohn.org", title: "John Resig"},
		{url: "http://bassistance.de/", title: "J&ouml;rn Zaefferer"},
		{url: "http://snook.ca/jonathan/", title: "Jonathan Snook"},
		{url: "http://rdworth.org/", title: "Richard Worth"},
		{url: "http://www.paulbakaus.com/", title: "Paul Bakaus"},
		{url: "http://www.yehudakatz.com/", title: "Yehuda Katz"},
		{url: "http://www.azarask.in/", title: "Aza Raskin"},
		{url: "http://www.karlswedberg.com/", title: "Karl Swedberg"},
		{url: "http://scottjehl.com/", title: "Scott Jehl"},
		{url: "http://jdsharp.us/", title: "Jonathan Sharp"},
		{url: "http://www.kevinhoyt.org/", title: "Kevin Hoyt"},
		{url: "http://www.codylindley.com/", title: "Cody Lindley"},
		{url: "http://malsup.com/jquery/", title: "Mike Alsup"}
	];
	
	var opts = {
		'sDec': {decimals:2},
		'sStep': {stepping: 0.25},
		'sCur': {currency: '$'},
		'sInline': {},
		'sLink': {
			//
			// Two methods of adding external items to the spinner
			//
			// method 1: on initalisation call the add method directly and format html manually
			init: function(e, ui) {
				for (var i=0; i<itemList.length; i++) {
					ui.add('<a href="'+ itemList[i].url +'" target="_blank">'+ itemList[i].title +'</a>');
				}
			},
	
			// method 2: use the format and items options in combination
			format: '<a href="%(url)" target="_blank">%(title)</a>',
			items: itemList
		}
	};
	
	for (var n in opts)
		$("#"+n).spinner(opts[n]);
	
	$("button").click(function(e){
		var ns = $(this).attr('id').match(/(s\d)\-(\w+)$/);
		if (ns != null)
			$('#'+ns[1]).spinner( (ns[2] == 'create') ? opts[ns[1]] : ns[2]);
	});
	
	
	
	//===== UI dialog =====//
	
	$( "#dialog-message" ).dialog({
		autoOpen: false,
		modal: true,
		buttons: {
			Ok: function() {
				$( this ).dialog( "close" );
			}
		}
	});
	
	$( "#opener" ).click(function() {
		$( "#dialog-message" ).dialog( "open" );
		return false;
	});	
		
	
	
	//===== Breadcrumbs =====//
	
	$('#breadcrumbs').xBreadcrumbs();
	
		
		
	//===== jQuery UI sliders =====//	
	
	$( ".uiSlider" ).slider(); /* Usual slider */
	
	
	
	$( "#amount" ).val( "$" + $( ".uiSliderInc" ).slider( "value" ) );
		
		
	$( ".uiRangeSlider" ).slider({ /* Range slider */
		range: true,
		min: 0,
		max: 500,
		values: [ 75, 300 ],
		slide: function( event, ui ) {
			$( "#rangeAmount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	});
	$( "#rangeAmount" ).val( "$" + $( ".uiRangeSlider" ).slider( "values", 0 ) +" - $" + $( ".uiRangeSlider" ).slider( "values", 1 ));
			
			
	$( ".uiMinRange" ).slider({ /* Slider with minimum */
		range: "min",
		value: 37,
		min: 1,
		max: 700,
		slide: function( event, ui ) {
			$( "#minRangeAmount" ).val( "$" + ui.value );
		}
	});
	$( "#minRangeAmount" ).val( "$" + $( ".uiMinRange" ).slider( "value" ) );
	
	
	$( ".uiMaxRange" ).slider({ /* Slider with maximum */
		range: "max",
		min: 1,
		max: 100,
		value: 20,
		slide: function( event, ui ) {
			$( "#maxRangeAmount" ).val( ui.value );
		}
	});
	$( "#maxRangeAmount" ).val( $( ".uiMaxRange" ).slider( "value" ) );	



	//===== Form elements styling =====//
	
	$("select, input:checkbox, input:radio, input:file").uniform();
	
});

$(document).ready(
	function()
	{
		$('#redactor').redactor({ 	
			imageUpload: 'php/image_upload.php',
			fileUpload: 'php/file_upload.php',
			imageGetJson: 'json/data.json'
		});
	}
);
    
$(function(){
   $("#frmLogarPaginaInicial").validationEngine({
        onValidationComplete: function(form, status){
         if (status == true) {
                $('#frmLogarPaginaInicial').validationEngine('showPrompt', "Verificando...", 'load', "topLeft", false);
                $.ajax({
                url: '../sistema/index.php?acao=logar&ctrl=usuarios',
                dataType: 'json',
                type: 'POST',
                data: $('#frmLogarPaginaInicial').serialize(),
                success: function(obj){
                    if(obj.situacao=="sucess"){
                        $('#frmLogarPaginaInicial').validationEngine('showPrompt', obj.msg, 'pass', "topLeft", false);
                        $("#frmLogarPaginaInicial").each(function(){
                           this.reset(); //Cada volta no laço o form atual será resetado
                        });
                        window.location.href='../../geral/sistema/index.php';
                    } else if(obj.situacao=="error"){
                        $('#frmLogarPaginaInicial').validationEngine('showPrompt', obj.msg, 'error', "topLeft", false );
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
});


$(function(){
	   $("#frmEsquecerSenhaPaginaInicial").validationEngine({
	        onValidationComplete: function(form, status){
	         if (status == true) {
	                $('#frmEsquecerSenhaPaginaInicial').validationEngine('showPrompt', "Verificando...", 'load', "topLeft", false);
	                $.ajax({
	                url: '../sistema/index.php?acao=recuperarSenha&ctrl=usuarios',
	                dataType: 'json',
	                type: 'POST',
	                data: $('#frmEsquecerSenhaPaginaInicial').serialize(),
	                success: function(obj){
	                    if(obj.situacao=="sucess"){
	                        $('#frmEsquecerSenhaPaginaInicial').validationEngine('showPrompt', obj.msg, 'pass', "topLeft", false);
	                        $("#frmEsquecerSenhaPaginaInicial").each(function(){
	                           this.reset(); //Cada volta no laço o form atual será resetado
	                        });
	                    } else if(obj.situacao=="error"){
	                        $('#frmEsquecerSenhaPaginaInicial').validationEngine('showPrompt', obj.msg, 'error', "topLeft", false );
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
	});


function selecionarTodosItensUsuario(i){

    if($(".publicarFixa"+i).closest('.checker > span').attr('class') && $(".excluirFixa"+i).closest('.checker > span').attr('class') && $(".alterarFixa"+i).closest('.checker > span').attr('class') && $(".cadastrarFixa"+i).closest('.checker > span').attr('class')){

        $(".publicarFixa"+i).closest('.checker > span').removeClass('checked');
        $(".publicarFixa"+i).attr('checked',false);

        $(".excluirFixa"+i).closest('.checker > span').removeClass('checked');
        $(".excluirFixa"+i).attr('checked',false);

        $(".alterarFixa"+i).closest('.checker > span').removeClass('checked');
        $(".alterarFixa"+i).attr('checked',false);

        $(".cadastrarFixa"+i).closest('.checker > span').removeClass('checked');
        $(".cadastrarFixa"+i).attr('checked',false);
        
    }else{



        $(".publicarFixa"+i).closest('.checker > span').addClass('checked');
        $(".publicarFixa"+i).attr('checked',true);

        $(".excluirFixa"+i).closest('.checker > span').addClass('checked');
        $(".excluirFixa"+i).attr('checked',true);

        $(".alterarFixa"+i).closest('.checker > span').addClass('checked');
        $(".alterarFixa"+i).attr('checked',true);

        $(".cadastrarFixa"+i).closest('.checker > span').addClass('checked');
        $(".cadastrarFixa"+i).attr('checked',true);


    }
}

$(function(){

  $("#frmCadUsuario").validationEngine({

    onValidationComplete: function(form, status){
        if (status == true) {

            $("#frmCadUsuario").validationEngine('detach');

            $("#frmCadUsuario").submit();


        }
    }
});
});

function vaiScroll(){
    $('html, body').animate({
        scrollTop: $("body, html").offset().top
    }, 2000);
}

function atualizaAba(targetUrl){
	window.location.href=targetUrl;
}


    function confirmDelGeral(url,urlRetorno){
            var answer = confirm("Deseja realmente excluir?");

            if (answer){
                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: {

                    },
                    success: function(obj){
                        if(obj.situacao=="sucess"){
                            showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 1,
                                type: "success"
                            });
                            setTimeout(function(){parent.window.location.href=urlRetorno}, 800);
                        } else if(obj.situacao=="error"){
                        	showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 3,
                                type: "error"
                            });

                        }
                    },
                    error : function (XMLHttpRequest, textStatus, errorThrown) {

                    },

                    beforeSend : function(requisicao){
                    	showNotification({
                    		message: 'Aguarde...',
                            autoClose: true,
                            duration: 10,
                            type: "information"
                        });
                    }
                });
            }
            else{
                    return false;
            }
    }
    
    
    function confirmDelFotoGaleria(url,idexcuir){
            var answer = confirm("Deseja realmente excluir?");
            
            
            if (answer){
            $(idexcuir).parent().parent().remove();    
            $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: {

                    },
                    success: function(obj){
                        if(obj.situacao=="sucess"){
                            showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 1,
                                type: "success"
                            });
                        } else if(obj.situacao=="error"){
                        	showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 3,
                                type: "error"
                            });
                        }
                    },
                    error : function (XMLHttpRequest, textStatus, errorThrown) {

                    },

                    beforeSend : function(requisicao){
                    	showNotification({
                    		message: 'Aguarde...',
                            autoClose: true,
                            duration: 10,
                            type: "information"
                        });
                    }
                });
            }
            else{
                    return false;
            }
    }

  //confirma exclusão
    function confirmPubGeral(url,urlRetorno){
                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'POST',
                    data: {

                    },
                    success: function(obj){
                        if(obj.situacao=="sucess"){
                            showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 1,
                                type: "success"
                            });
                            setTimeout(function(){parent.window.location.href=urlRetorno}, 800); 
                        } else if(obj.situacao=="error"){
                        	showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 3,
                                type: "error"
                            });
                        }
                    },
                    error : function (XMLHttpRequest, textStatus, errorThrown) {

                    },

                    beforeSend : function(requisicao){
                    	showNotification({
                    		message: 'Aguarde...',
                            autoClose: true,
                            duration: 10,
                            type: "information"
                        });
                    }
                });
    }
    
    
$(function () {
function handleFileSelect(evt) {
    $("#list").html("");
    var files = evt.target.files; // FileList object

    // Loop through the FileList and render image files as thumbnails.
    for (var i = 0, f; f = files[i]; i++) {

      // Only process image files.
      if (!f.type.match('image.*')) {
        continue;
      }

      var reader = new FileReader();

      // Closure to capture the file information.
      reader.onload = (function(theFile) {
        return function(e) {
          // Render thumbnail.
          var span = document.createElement('span');
          span.innerHTML = ['<img class="thumbFiles" src="', e.target.result,
                            '" title="', escape(theFile.name), '"/>'].join('');
          document.getElementById('list').insertBefore(span, null);
        };
      })(f);

      // Read in the image file as a data URL.
      reader.readAsDataURL(f);
    }
  }

  //document.getElementById('files').addEventListener('change', handleFileSelect, false);
});


        







$("textarea[maxlength]").keypress(function(event){
    var key = event.which;
 
    //todas as teclas incluindo enter
    if(key >= 33 || key == 13) {
        var maxLength = $(this).attr("maxlength");
        var length = this.value.length;
        if(length >= maxLength) {
            event.preventDefault();
        }
    }
});





/*
 * CEP E GOOGLE MAPS 
 * 
 */



function pegarLatLgn(urlMaps,id){
	if(urlMaps){
	var aAux = urlMaps.split("@");
	aAux = aAux[1].split(",");
	var latitude = aAux[0];
	var longitude = aAux[1];

	$("#"+id).val(latitude+','+longitude);
	
	}
}

function verificaCep(cep){
	
	if(cep != "__.___-___"){
	var cep = cep.replace(".","");
	$.ajax({
        url: "../ctrlCorreio.php?acao=verifica-cep-correios",
        dataType: 'json',
        type: 'POST',
        data: {
			cep: cep
        },
        success: function(obj){
            if(obj.situacao=="sucess"){
                showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "success"
                });

               var bairrogeral = obj.valorescep.bairro_id;
               var complementogeral = obj.valorescep.logracompl;

                /* Atualizar Estado */
                $("#estado").find("option").each(function(){
					if(obj.valorescep.uf_cod == $(this).val()){
						$(this).attr("selected","selected");
					}
                });
                $.uniform.update();
                /* Final Atualizar Estado */



                $.ajax({
                    url: "../ctrlCorreio.php?acao=verifica-cidades-por-estado",
                    dataType: 'json',
                    type: 'POST',
                    data: {
    					estado: obj.valorescep.uf_cod,
    					cidade: obj.valorescep.cidade_id
                    },
                    success: function(obj){
                        if(obj.situacao=="sucess"){
                            showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 2,
                                type: "success"
                            });

                            /* Atualizar Estado */
    						$("#cidade").html("");
    						$("#bairro").html('');
    						$("#bairro").append('<option value="">Selecione uma cidade acima.</option>');
    						$("#cidade").append(obj.valores);
                           
                            $.uniform.update();
                            /* Final Atualizar Estado */


                			$.ajax({
                                url: "../ctrlCorreio.php?acao=verifica-bairros-por-cidade",
                                dataType: 'json',
                                type: 'POST',
                                data: {
                                	cidade: obj.cidade,
                                	bairro: bairrogeral
                                },
                                success: function(obj){
                                    if(obj.situacao=="sucess"){
                                        showNotification({
                                            message: obj.msg,
                                            autoClose: true,
                                            duration: 2,
                                            type: "success"
                                        });

                                        /* Atualizar Estado */
                						$("#bairro").html("");
                						$("#endereco").val(complementogeral);
                						$("#bairro").append(obj.valores);
                                       
                                        $.uniform.update();
                                        /* Final Atualizar Estado */

                                        
                                    } else if(obj.situacao=="error"){
                                    	showNotification({
                                            message: obj.msg,
                                            autoClose: true,
                                            duration: 2,
                                            type: "error"
                                        });
                                    }
                                },
                                error : function (XMLHttpRequest, textStatus, errorThrown) {

                                },

                                beforeSend : function(requisicao){
                                	showNotification({
                                        message: "Carregando bairros...",
                                        autoClose: true,
                                        duration: 1000,
                                        type: "success"
                                    });
                                }
                            });
                            

                            
                        } else if(obj.situacao=="error"){
                        	showNotification({
                                message: obj.msg,
                                autoClose: true,
                                duration: 2,
                                type: "error"
                            });
                        }
                    },
                    error : function (XMLHttpRequest, textStatus, errorThrown) {

                    },

                    beforeSend : function(requisicao){
                    	showNotification({
                            message: "Carregando cidades...",
                            autoClose: true,
                            duration: 1000,
                            type: "success"
                        });
                    }
                });
                

                
            } else if(obj.situacao=="error"){
            	showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "error"
                });
            }
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {

        },

        beforeSend : function(requisicao){
        	showNotification({
                message: "Verificando cep...",
                autoClose: true,
                duration: 1000,
                type: "success"
            });
        }
    });
}
}





function mudarCidade(estado){
	$.ajax({
        url: "../ctrlCorreio.php?acao=verifica-cidades-por-estado",
        dataType: 'json',
        type: 'POST',
        data: {
			estado: estado
        },
        success: function(obj){
            if(obj.situacao=="sucess"){
                showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "success"
                });

                /* Atualizar Estado */
				$("#cidade").html("");
				$("#bairro").html('');
				$("#bairro").append('<option value="">Selecione uma cidade acima.</option>');
				$("#cidade").append(obj.valores);
               
                $.uniform.update();
                /* Final Atualizar Estado */

                
            } else if(obj.situacao=="error"){
            	showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "error"
                });
            }
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {

        },

        beforeSend : function(requisicao){
        	showNotification({
                message: "Carregando cidades...",
                autoClose: true,
                duration: 1000,
                type: "information"
            });
        }
    });
}


function mudarBairro(cidade){
	$.ajax({
        url: "../ctrlCorreio.php?acao=verifica-bairros-por-cidade",
        dataType: 'json',
        type: 'POST',
        data: {
        	cidade: cidade
        },
        success: function(obj){
            if(obj.situacao=="sucess"){
                showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "success"
                });

                /* Atualizar Estado */
				$("#bairro").html("");
				$("#bairro").append(obj.valores);
               
                $.uniform.update();
                /* Final Atualizar Estado */

                
            } else if(obj.situacao=="error"){
            	showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "error"
                });
            }
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {

        },

        beforeSend : function(requisicao){
        	showNotification({
                message: "Carregando bairros...",
                autoClose: true,
                duration: 1000,
                type: "information"
            });
        }
    });
}


function excluirArquivo(urlDeExcluir,idArquivo,urlRetorno){
	$.ajax({
		url: urlDeExcluir,
		dataType: 'json',
		type: 'POST',
		data: {
			id: idArquivo
		},
		success: function(obj){
			if(obj.situacao=="sucess"){
				showNotification({
					message: obj.msg,
					autoClose: true,
					duration: 1,
					type: "success"
				});
				setTimeout(function(){parent.window.location.href=urlRetorno}, 800); 
				
			} else if(obj.situacao=="error"){
				showNotification({
					message: obj.msg,
					autoClose: true,
					duration: 2,
					type: "error"
				});
			}
		},
		error : function (XMLHttpRequest, textStatus, errorThrown) {
			
		},
		
		beforeSend : function(requisicao){
			showNotification({
				message: "Aguarde...",
				autoClose: true,
				duration: 10,
				type: "information"
			});
		}
	});
}


//confirma exclusão
function confirmDelGeralfile(url,urlRetorno){
    $.ajax({
        url: url,
        dataType: 'json',
        type: 'POST',
        data: {

        },
        success: function(obj){
            if(obj.situacao=="sucess"){
                showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 2,
                    type: "success"
                });
                setTimeout(function(){parent.window.location.href=urlRetorno}, 800); 
            } else if(obj.situacao=="error"){
            	showNotification({
                    message: obj.msg,
                    autoClose: true,
                    duration: 3,
                    type: "information"
                });
            }
        },
        error : function (XMLHttpRequest, textStatus, errorThrown) {

        },

        beforeSend : function(requisicao){
        	showNotification({
                message: 'Aguarde...',
                autoClose: true,
                duration: 10,
                type: "information"
            });
        }
    });
}


function ordemNaTabela(classesw,ctrlOrdem,ctrlSucess){
    $('.'+classesw).dataTable({
            "bJQueryUI": true,
            "sPaginationType": "full_numbers",
            "sDom": '<""l>t<"F"fp>',
            "aaSorting": [[ 0, "desc" ]],
            "bStateSave": false
    }).rowReordering({ sURL:ctrlOrdem,
        fnSuccess: function(text){
        	
        	showNotification({
                message: text,
                autoClose: true,
                duration: 2,
                type: "success"
            });
            setTimeout(function(){parent.window.location.href=ctrlSucess}, 800); 
            
        }
    });
}

$(function(){
	$('.preco').priceFormat({
        prefix: 'R$ ',
        centsSeparator: ',',
        thousandsSeparator: '.'
    });
	$('.area').priceFormat({
		prefix: '',
		centsSeparator: '.',
		thousandsSeparator: ''
	});
});

function bytesToSize(megabytes) {
	bytes = parseInt(megabytes) * 1000000;
    var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    if (bytes == 0) return 'n/a';
    var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
    if (i == 0) return bytes + ' ' + sizes[i];
    return (bytes / Math.pow(1024, i)).toFixed(1) + ' ' + sizes[i];
};

            