
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

<?php
  if (isset($_POST["tombol"]))
	{
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		
		$head = $_POST["head"];
		$detail = $_POST["item"];
		echo "Head Looping Foreach <br/>";
		foreach ($head as $k => $v)
		{
			echo $k . " = " . $v . "<br/>";
		}
		echo "<hr/>Head Tanpa Looping <br/>";
		echo "Numero de Factura : ". $head["nofaktur"] . "<br/>";
		echo "Cajero : ". $head["namakasir"] ."<br/><br/>";
		
		$items = array();
		
		for ($i = 0; $i < sizeof($detail['code']); $i++) {
                array_push($items, array(
                    "Numero de Factura" => $head['nofaktur'],
                    "Codigo" => $detail['code'][$i],
                    "Quantidad" => $detail['qty'][$i]
                ));
		}
		echo "<pre>";
		print_r($items);
		echo "</pre>";
		
	}
?>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
    <table>
        <tr>
            <td>No </td>
            <td>: <input type="text" name="head[nofaktur]" value="xxx-103-001" readonly></td>
        </tr>
		<tr>
            <td>Cajero </td>
            <td>: <input type="text" name="head[namakasir]" value="Jorge" readonly></td>
        </tr>
        <tr>
            <td>Fecha </td>
            <td>: <?php echo date("d, M Y"); ?></td>
        </tr>
    </table>
	
	
    <hr/>
    
	
	<table width ="50%" >
        <tr>
            <th><input placeholder="Code" type="text" class="span1" name="itemcode" id="itemcode"/></th>
            <th><input placeholder="Item Name" type="text" class="span3" name="itemname" id="itemname"/></th>
            <th><input placeholder="Price" type="text" class="span2" name="itemprice" id="itemprice"/></th>
            <th><input placeholder="Qty" type="text" class="span2" name="itemqty" id="itemqty"/></th>
            <th>Action</th>
        </tr>
		
        <tbody id="itemlist">
			<tr>
				<td><input type="hidden" name="item[code][]" value="ITEM001">ITEM001</td>
				<td>Item 1</td>
				<td><input type="text" class="span2" name="item[price][]" value="5000"></td>
				<td><input type="text" class="span2" name="item[qty][]" value="10"></td>
				<td><a href="javascript:void(0);" id="hapus">Remove</a></td>
			</tr>
			<tr>
				<td><input type="hidden" name="item[code][]" value="ITEM002">ITEM002</td>
				<td>Item 1</td>
				<td><input type="text" class="span2" name="item[price][]" value="10000"></td>
				<td><input type="text" class="span2" name="item[qty][]" value="10"></td>
				<td><a href="javascript:void(0);" id="hapus">Remove</a></td>
			</tr>
        </tbody>
		
		
    </table>
    <input type="submit" name="tombol" value="Save"/>
</form>

<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.2.min.js"></script>
<script type="text/javascript">
    $('#itemqty').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemcode').focus();
        }
    });
    $('#itemname').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemprice').focus();
        }
    });
    $('#itemprice').on('keypress', function(e) {
        if(e.keyCode==13){
            $('#itemqty').focus();
        }
    });
    function clear (){
        $("#itemcode").val("");
        $("#itemname").val("");
        $("#itemprice").val("");
        $("#itemqty").val("");
    }
     $("tbody#itemlist").on("click","#hapus",function(){
        $(this).parent().parent().remove();
    });
    $('#itemqty').on('keypress', function(e) {
        if(e.keyCode==13){
            e.preventDefault();
            var itemcode = $("#itemcode").val();
            var itemname = $("#itemname").val();
            var itemprice = $("#itemprice").val();
            var itemqty = $("#itemqty").val();
            var items = "";
			
            items += "<tr>";
            items += "<td><input type='hidden' name='item[code][]' value='"+ itemcode +"'>"+itemcode+"</td>";
            items += "<td>"+ itemname +"</td>";
            items += "<td><input type='text' class='span2' name='item[price][]' value='"+ itemprice +"'></td>";
            items += "<td><input type='text' class='span2' name='item[qty][]' value='"+ itemqty +"'></td>";
            items += "<td><a href='javascript:void(0);' id='hapus'>Remove</a></td>";
			items += "</tr>";
        
            if ($("tbody#itemlist tr").length == 0)
            {
                $("#itemlist").append(items);
                clear();
            }else{
                var callback = checkList(itemcode);
                if(callback === true){
                    $("#itemlist").append(items);
                    clear();
                    return false;
                }
            }
        }
    });

    function checkList(val){
        var cb = true;
        console.log($(itemcode).val());
    
        $("#itemlist tr").each(function(index){
            var input = $(this).find("input[type='hidden']:first");
            if (input.val() == $(itemcode).val()){
                cb = false;
            }
        });
        return cb;
    }   
</script>


</body>
</html>
