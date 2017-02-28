<!DOCTYPE html>
<html ng-app='DemoPagineo'>
	<head>
<?php include'../cabezera.php' ?>
	</head>

	<body ng-controller='tablaUsuarios' ng-cloack>
		<br>
		<div class="container">
			<div class="panel panel-default">
				<div class="panel-body">
					<table ng-init='configPages()' class='table'>
						<thead>
							<tr>
								<th>Id</th>
								<th>Primer Nombre</th>
								<th>Segundo Nombre</th>
								<th>Primer Apellido</th>
								<th>Segundo Apellido</th>
								<th>Fecha Nacimiento</th>
							</tr>
						</thead>
						<tbody>
							<tr ng-repeat='usuario in usuarios | startFromGrid: currentPage * pageSize | limitTo: pageSize', ng-click='seleccionarUsuario(usuario.id)'>
								<td>{{usuario.id}}</td>
								<td>{{usuario.primernombre}}</td>
								<td>{{usuario.segundonombre}}</td>
								<td>{{usuario.primerapellido}}</td>
								<td>{{usuario.segundoapellido}}</td>
								<td>{{usuario.fechanacimiento}}</td>
							</tr>
						</tbody>
					</table>
					<div class='btn-group'>
						<button type='button' class='btn btn-default' ng-disabled='currentPage == 0' ng-click='currentPage = currentPage - 1'>&laquo;</button>
						<button type='button' class='btn btn-default' ng-disabled='currentPage == page.no - 1' ng-click='setPage(page.no)' ng-repeat='page in pages'>{{page.no}}</button>
						<button type='button' class='btn btn-default' ng-disabled='currentPage >= usuarios.length/pageSize - 1' ng-click='currentPage = currentPage + 1'>&raquo;</button>
					</div>
				</div>
			</div>
		</div>

		<script src="../js/app.js"></script>
	</body>
</html>