
<!doctype html>
<html lang="en">
<head>
<meta charset="ISO-8859-1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="Uso del Proyecto Troya, Algoritmo de Sustitución para cifrar información">
<meta name="author" content="Airy Fabian Rosales">
<title>Proyecto Troya</title>
<link href="src/css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="src/js/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="src/js/popper.min.js"></script>
<script type="text/javascript" src="src/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	$("#Generar").click(function() {
		var parametros={
				"metodo":"crearNuevoCifrado",
				"parametros":""
		};
		$.ajax({
			data: parametros,
			url: "Request.php",
			type: "POST",
		    encoding:"UTF-8",
		    dataType:"json", 
		    contentType: "text/json; charset=UTF-8",
			beforeSend: function() {
				$("cargando").html("<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>");
			},
			success: function(response) {
				$("cargando").html("");
				$("#jsonAbc").val(response);
			}
		});
    });
	$("#convertir").click(function() {
		var parametros={
				"metodo":"convertirFrase",
				"parametros":$("#texto_base").val()
		};
		$.ajax({
			data: parametros,
			url: "Request.php",
			type: "POST",
			beforeSend: function() {
				$("#texto_convertir").html("<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\"><div class=\"spinner-border\" role=\"status\"><span class=\"sr-only\">Loading...</span></div><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span></button></div>");
			},
			success: function(response) {
				$("#texto_convertir").html(response);
			}
		});
    });
})
</script>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="card text-center">
					<div class="card-header">Proyecto Troya</div>
					<div class="card-body">
						<h5 class="card-title">Troya: Cifra/Enmascara tu contenido</h5>
						<p class="card-text">Troya es un algoritmo de
							sustituci&oacute;n de caracteres que te permite encapsular
							contenido. Su uso es muy sencillo y te permite tener una
							noci&oacute;n de como fueron los primeros pasos en el mundo de la
							Seguridad.</p>
					</div>
					<div class="card-footer text-muted">Autor: Ing. Airy Fabian
						Rosales</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">Generar nuevo c&oacute;digo</h5>
										<p class="card-text">De forma automatica se va a generar
											el c&oacute;digo que permitir&aacute; cifrar el contenido</p>
											<button id="Generar" class="btn btn-primary">Generar</button>
									</div>
								</div>
							</div>
							<div class="col-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
							<div class="col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">&iquest;Qu&eacute; se Gener&oacute;?</h5>
										<p class="card-text">Podr&aacute;s ver el c&oacute;digo que se genero
											para ejecutar la sustitici&oacute;n del contenido.</p>
										<form>
											<div class="form-group">
												<textarea class="form-control" id="jsonAbc" placeholder=""></textarea>
											</div>
										</form>
									</div>
								</div>
								<div class="cargando" id="cargando"></div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">Prueba t&uacute; c&oacute;digo</h5>
										<p class="card-text">Escribe en la caja de texto la palabra o frase que deseas cambiar.</p>
										<input class="form-control" type="text" placeholder="escriba aqui su texto" id="texto_base">
										<button class="btn btn-info" id="convertir">Convertir</button>
									</div>
								</div>
							</div>
							<div class="col-0 col-sm-0 col-md-2 col-lg-2 col-xl-2"></div>
							<div class="col-10 col-sm-10 col-md-5 col-lg-5 col-xl-5">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">Tu nuevo texto cifrado es</h5>
										<p class="card-text" id="texto_convertir"></p>
									</div>
								</div>
							</div>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
</body>
</html>