	var exprCiclo = /^20[0-9]{2}[(a|b|v)(A|B|V)]$/;

$("#btnRegistrar").click(function (){

	var $ciclo = $("#nciclo").val();
	var $inicio = $("#inicio").val();
	var $finalizacion = $("#finalizacion").val();

	if($ciclo == "")
	{
		$("#errorCiclo").replaceWith("<div class=\"errores\" id=\"errorCiclo\">Escribe el ciclo</div>");
		$("#errorCiclo").fadeIn("slow");
	}
	else
	{
		$("#errorCiclo").fadeOut();
		if(!exprCiclo.test($ciclo))
		{
			$("#errorCiclo").replaceWith("<div class=\"errores\" id=\"errorCiclo\">Ciclo inválido</div>");
			$("#errorCiclo").fadeIn("slow");
		}
	}
	if($inicio == "" || $inicio == 0)
		$("#errorFecha1").fadeIn("slow");
	else
		$("#errorFecha1").fadeOut();

	if($finalizacion == "" || $finalizacion == 0)
		$("#errorFecha2").fadeIn("slow");
	else
		$("#errorFecha2").fadeOut();
});