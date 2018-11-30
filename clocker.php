<?php
require "header.php";
?>
	<div class="modal hide fade" id="myModal">
		<div class= "modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title text-">Clocker: Organizador de tareas</h4>
					</div>
					<div class="modal-body">
						<p>Puede utilizar esta aplicación para crear su lista de pendientes, e ir chequeándolos periódicamente. Inicie Sesión para poder comenzar a usar Clocker. </p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
					</div>
			</div>
		</div>
	</div>
		<main class="container mt-4" id="contenedor">
			<form id="organizador" class="input-group input-group-lg">
					<input type="text" id="tarea" class="form-control" placeholder="Ir al dentista">
					<input type="time" id="hora" class="form-control" value="13:30" placeholder="13:30">
					<input type="submit" class="btn btn-warning btn-lg" value="Agregar tarea" id="agregar">
					
				</form>
			</div>
		<div class="container">
			<div class="mt-4 card">
				<ul class="list-group list-group-flush" id="lista">
					<? $tareas ?>
				</ul>
			</div>
		</main>	
	<footer class="text-center bg-secondary navbar-fixed-bottom">
		<p>Hecho por Pérez-dono</p>
	</footer>
</body>
<script src="js/app.js"></script>
</html>