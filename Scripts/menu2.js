$(function() {
	    $( "#datepickerI" ).datepicker({ dateFormat: 'yy-mm-dd' });
	    $( "#datepickerF" ).datepicker({ dateFormat: 'yy-mm-dd' });

		$('#servicios_en_linea').mouseenter(function(){

		    $('#slide_servicios').toggle()
		})

		$('div#slide_servicios').mouseleave(function(){
			$("div#slide_servicios").hide();

		})

	  });

$(document).mouseup(function (e)
{
    var container = $("div#slide_search");

    if (container.has(e.target).length === 0)
    {
    	if($("div#ui-datepicker-div").css('display')=='none'){
   	        container.hide();
    	}

    }
});

function showMenu(discipline, program){
		$('#menu_areas > ul > li > a').css('background-color', '#EEEEEE')
		$('.discipline_'+discipline).css('background-color', '#D6D7D9')
		$.post('show_discipline.php', {disciplina : discipline, programa : program}, function(data){
			
			if($('div#slide_menu:visible')){
				$('div#slide_menu').hide(0)
			}

			switch(discipline){
				//submenu Preparatoria Abierta
				case 12: 
					$('div#slide_menu').css('top', '202px')
				break;
				//submenu-xochitla
				case 13: 
					$('div#slide_menu').css('top', '350px')
				break;
				//submenu Atencion integral a Empresas
				case 16: 
					$('div#slide_menu').css('top', '112px')
				break;
				//sub-menu Atencion Integral al Sector Publico
				case 17: 
					$('div#slide_menu').css('top', '475px')
				break;
				//sub-menu Studio Loft
				case 20: 
					$('div#slide_menu').css('top', '97px')
				break;
				//sub-menu Harvard
				case 23: 
					$('div#slide_menu').css('top', '270px')
				break;
				default: 
					$('div#slide_menu').css('top', '-1px')
			}

			$('div#slide_menu').empty().append(data).show(0)
		})
	}

	$(document).find('a#close_slider_menu').live("click", function(){

		$('div#slide_menu').hide(0)	
		$('#menu_areas > ul > li > a').css('background-color', '#EEEEEE')
	})

$(document).mouseup(function (e)
{

    var container = $("div#slide_menu");

    if (container.has(e.target).length === 0)
    {
        container.hide(0);
    }
});

function show_search(){
	
	$('div#slide_search').show();
}