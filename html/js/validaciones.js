
$(function(){

    $(".validarNumeros").keydown(function(event){

        if((event.keyCode < 33 || event.keyCode > 40) && (event.keyCode < 46 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==8 && event.keyCode !==9){
            return false;
        }
	});

	$(".validarNumerosDecimal").keydown(function(event){

        if((event.keyCode < 33 || event.keyCode > 40) && (event.keyCode < 46 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9){
            return false;
        }
	});

	$(".validarNumerosLetras").keydown(function(event){

		if((event.keyCode < 33 || event.keyCode > 40) && (event.keyCode < 46 || event.keyCode > 57) && (event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 96 || event.keyCode > 111) && (event.keyCode < 187 || event.keyCode > 226) && event.keyCode !==8 && event.keyCode !==9 && event.keyCode !==32){
			return false;
		}
	});

	$(".validarNumerosLetrasDecimal").keydown(function(event){

		if((event.keyCode < 33 || event.keyCode > 40) && (event.keyCode < 46 || event.keyCode > 57) && (event.keyCode < 65 || event.keyCode > 90) && (event.keyCode < 96 || event.keyCode > 111) && (event.keyCode < 187 || event.keyCode > 226) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9 && event.keyCode !==32){
			return false;
		}
	});

	$(".validarLetras").keydown(function(event){

		if((event.keyCode < 33 || event.keyCode > 40) && (event.keyCode < 46 || event.keyCode > 57) && (event.keyCode < 65 || event.keyCode > 90) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9 && event.keyCode !==32){
			return false;
		}
	});
})