
<html>
	<head>
		<title>Chamado para clientes</title>
		<!-- incluyo mis estilos css -->
		<link rel="stylesheet" type="text/css" href="style.css" />
		<!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
         <script src="//code.jquery.com/jquery-1.10.2.js"></script>
         <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
         <link rel="stylesheet" href="/resources/demos/style.css">
         <script>
              $(function() {
                      $( "#datepicker" ).datepicker();
              });
         </script> -->
	</head>
	<body>



		<div id="content">

			<a id="button" href="#" onClick="history.go(-1);return true;">Return</a>

			<form method="POST" action="customer_calls.php"> 
				<table id="box-table-a">

					<!--
<tr>
	<td>Issue:</td>
	<td><input type="text" name="issue" size="95" value = "<?php print $issue ?>"></td>
</tr>

<td><input type='text' size="95" name="notes" value = "<?php print $issue ?>"></td> */

<tr>
	<td>Date Open:</td>
	<td><input type='text' readonly name="open" value = "<?php print $open ?>"></td>
</tr>

-->

				<tr>
					<td>Loja : </td>
					<td><input type='text' name="store" value = "<?php print $store ?>"></td>
					<td>N&uacute;mero de empregados</td>
					<td><select class="element select medium" id="element_5" name="no_employees"> 
									<option value="" selected="selected"></option>
									<option value="1" >1 - 2</option>
									<option value="2" >3 -5</option>
									<option value="3" >4 - 10</option>
									<option value="4" >11 - 20</option>Customer
									<option value="5" >20+</option>
							</select>
					</td>
				</tr>

				<tr>
					<td>Cliente : </td>
					<td><input type='text' name="sku" value = "<?php print $sku ?>"></td>
					<td>Potencial de vendas :</td>
					<td><select class="element select medium" id="element_5" name="potential"> 
									<option value="5K" selected="selected" >< $5K</option>
									<option value="10K" >$6 - 10K</option>
									<option value="20K" >$11 - 20K</option>
									<option value="50k" >$21 - 50K</option>
									<option value="+50k" >> $ 50k</option>
					</select>
					</td>
				</tr>

				<tr>
					<td>Solicitante / Propriet&aacute;rio:</td>
					<td><input type='text' name="owner" value = "<?php print $owner ?>"></td>
					<td>Fornecedor Principal :</td>
					<td><select class="element select medium" id="element_5" name="potential"> 
							<option value="Home Center" >Home Center</option>
							<option value="Directo Fabrica" >Directo Fabrica</option>
							<option value="Loja de Tinta" selected="selected" >Loja de Tinta</option>
					</select>
					</td>
				</tr>

				<tr>
					<td>Data de Vencimento:</td>
					<td><input type='text' name="duedate" id="datepicker" value = "<?php print $duedate ?>"></td>
					<td>Fornecedor Secundario :</td>
					<td><select class="element select medium" id="element_5" name="potential"> 
							<option value="Home Center" >Home Center</option>
							<option value="Directo Fabrica" selected="selected">Directo Fabrica</option>
							<option value="Loja de Tinta"  >Loja de Tinta</option>
					</select>
					</td>
				</tr>

				<tr>
					<td>Notas:</td>
					<td><textarea name='notes' rows="5" cols="50"><?php print $notes ?></textarea></td>
				    <td><table>
							<tr><td>Marca Principal:</td></tr>
							<tr><td>Marca Secondaria:</td></tr>
						</table>
					</td>
                    <td><table>
							<tr><td>
									<select class="element select medium" id="element_5" name="potential"> 
											<option value="SW" selected="selected">Sherwin Williams</option>
											<option value="CORAL" >Coral</option>
											<option value="SUVINIL" >Suvinil</option>
											<option value="IQUINE" >Iquine</option>
											<option value="OUTROS" >Outros</option>
									</select>
							     </td>
							</tr>
							<tr><td>
									<select class="element select medium" id="element_5" name="potential"> 
											<option value="SW" >Sherwin Williams</option>
											<option value="CORAL" selected="selected" >Coral</option>
											<option value="SUVINIL" >Suvinil</option>
											<option value="IQUINE" >Iquine</option>
											<option value="OUTROS" >Outros</option>
									</select>
								</td>
							</tr>
						</table>
					</td>	
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td>Classifica&ccedil;&atilde;o da conta :</td>
					<td><select class="element select medium" id="element_5" name="potential"> 
							<option value="N&atilde;o qualificado" selected="selected" >N&atilde;o qualificado</option>
							<option value="Prospecto" >Prospecto</option>
							<option value="Comprador" >Comprador</option>
							<option value="Cliente leal" >Cliente leal</option>
							<option value="Parceiro valorizado" >Parceiro valorizado</option>
							<option value="Remover da lista" >Remover da lista</option>
							<option value="N&uacute;mero de telefone errado" >N&uacute;mero de telefone errado</option>
					</select>
					</td>
				</tr>

				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td align =right>
						<input type="submit" name="insert" value ="Entrar">  
						</td>
					</tr>

				</table>
			</form>
		</div>

<?php
    error_reporting(E_ALL);
	ini_set('display_errors','1');
	
	include_once ("dbactions.php"); // incluye las clases
    $sku=  "";
	$store = "";
	$duedate= date("Y-m-d");
	$owner = "";
	$notes = "";
	
	if (isset($_GET['dt'])) // si la operacion es modificar, este valor viene seteado y ejecuta el siguiente codigo
	{		
		$reporte=new Comentario($_GET['dt']);  
		
		//$reporte=new Comentario('H60YJ19-4');
		// print_r($reporte);
		
		$sku=$reporte->sku;		
		$owner=$reporte->owner;
		$store=$reporte->store;
		$notes=$reporte->notes;
		$duedate=$reporte->duedate;
		echo $reporte=$reporte->getComentarioC($reporte->sku);
	}	 
	
	if (isset($_POST['insert'])) // si presiono el boton ingresar
		{
			//print_r($_POST);

			//echo $_POST['open'];
			//return;
			$comentario=new Comentario('quepez');

			$comentario->sku = $_POST['sku']; 
			$comentario->notes = $_POST['notes'];	
			$comentario->owner = $_POST['owner'];
			$comentario->store = $_POST['store'];
			$comentario->duedate = $_POST['duedate'];

			//print_r($comentario);
			if (trim($comentario->sku) == "") {
				echo "Falta Customer";
			} elseif (trim($comentario->owner) == "") {
				echo "Falta Owner";
			} elseif (trim($comentario->notes) == "") {
				echo "Falta comentario";
			} elseif (trim($comentario->duedate) == "") {
				echo "Falta fecha compromiso";	
			} else {
				print " Consulta ejecutada: ". $comentario->insertComentario(); // inserta y muestra el resultado	
				echo $comentario=$comentario->getComentarioC($comentario->sku);
			}	
		}
?>


	</body>
</html>
													
