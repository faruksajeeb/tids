<link href="../css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="datetime/jquery.datetimepicker.css" rel="stylesheet" type="text/css"/>
<link href="../css/jquery.dataTables.css" rel="stylesheet">
<script language="javascript" type="text/javascript" src="../script/jquery-1.9.1.min.js"></script>

	<div class="container">
		<div class="row">
			<div class="col-sm-5">
				<br />
				<button class="btn bttn_add">Display Today Schedule</button>
				<br />
				<br />
			</div>
			<div class="col-sm-7">
				<h3>Insert Video Schedule</h3>
			</div>
		</div>
		<!--For select customer  -->
		
	</div>
	<div class="container">
		<div class="row">
			<form name="frm">
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="brand">Company Name</label>
						<select name="brand_id" id="brand_id" class="form-control" onchange="getmodeldetails(this.value)">
							<option value="">Select Company Name</option>
							<?php foreach($brand as $count): ?>
								<option value="<?php echo $count->brand_id; ?>"><?php echo $count->brand_name; ?></option>
							<?php endforeach; ?> 
						</select>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="model">Video</label>
						<select name="model_id" id="model_id" class="form-control" onchange="getpartsdetails(this.value)">
								<option value="">Select Video</option>
						</select>
					</div>
				</div>						
				<div class="col-md-1">
					<div class="form-group">
						<label class="control-label" for="add">  &nbsp </label>
						<input type="button" class="form-control bttn" value="Add" id="add_to">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="container">
		<form name="dynamic_frm" action="" class="form-horizontal" method="post">
			<table class="table">
				<thead>
					<tr>
						<th>Schedule ID</th>
						<th>Company Name</th>
						<th>Video Name</th>
						
					</tr>
				</thead>
				<tbody class="ab">
					<!--displaying flying value-->
				</tbody>
			</table>

			<?php

				$mysqli=new mysqli("localhost","root","","db_motor_inventory");


				if(isset($_REQUEST['submit'])){
					
					$q_sales = "INSERT INTO sales(
						company_id,
						customer_id,
						sales_discount,
						sales_commission,
						sales_vat,
						sales_tax,
						sales_total) VALUES(
							'".$this->session->userdata('cid')."',
							'".$_POST['customer_id']."',
							'".$_POST['discount']."',
							'".$_POST['comission']."',
							'".$_POST['vat_price']."',
							'".$_POST['tax_price']."',
							'".$_POST['net_price']."'
						)";

					$rst_sales=$mysqli->query($q_sales);



					$q_max = "SELECT MAX(sales_no) FROM sales";
					$rst_max=$mysqli->query($q_max);
					$rst_max_row = $rst_max->fetch_array();
					$sales_no=$rst_max_row[0];
					echo $sales_no;




					echo $this->session->userdata('com_name');
					//insert sales;
					// retrive last salesno in a varaiable
					$field_values_total = $_REQUEST['field_total'];
					$field_values_rate = $_REQUEST['field_rate'];
					$field_values_qty = $_REQUEST['field_qty'];
					$field_values_id = $_REQUEST['field_id'];
					
					/*print '<pre>';
					print_r($field_values_rate);
					print_r($field_values_total);
					print_r($field_values_qty);
					print_r($field_values_id);
					print '</pre>';
					*/
					//$a=new array();
					$i=count($field_values_total);
					for($a=0;$a<$i;$a++)
					{
						//insert salesorderdetails 
						// values(1,$lastsalesno,$field_values_id[$a],)
						//echo $field_values_rate[$a]." ".$field_values_total[$a];
						$q_sales_details = "INSERT INTO sales_details(
						company_id,
						sales_no,
						parts_id,
						sales_order_quantity,
						sales_details_unit_price) VALUES(
							'".$this->session->userdata('cid')."',
							'".$sales_no."',
							'".$field_values_id[$a]."',
							'".$field_values_qty[$a]."',
							'".$field_values_rate[$a]."'
						)";
						$rst_sales_details=$mysqli->query($q_sales_details);
					}

					foreach($field_values_total as $value){
						//your database query goes here
					}
				}
			?>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label col-sm-2" for="customer">Date</label>
						<div class="col-sm-10">
							<select name="customer_id" id="customer_id" class="form-control">
								<option value="">Select Date</option>
								<?php foreach($customer as $count): ?>
									<option value="<?php echo $count->customer_id; ?>">
										<?php echo $count->customer_id."--".$count->customer_name."--".$count->customer_phone; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					
					<div class="label_right control-label">
						
						<input type="submit" name="submit" class="btn btn-default" value="SUBMIT"/>
					</div>
				</div>
			</div>
		</form>
	</div>

	<script>
		function getmodeldetails(id)
		{
			//alert('this id value :'+id);
			$.ajax({
				type: "POST",
				url: '<?php //echo site_url('sales/ajax_model_list').'/';?>'+id,
				//data: id='cat_id',
				success: function(data){
					//alert(data);
					$('#model_id').html(data);
					getpartsdetails(id="");
				},
			});
		}

		function getpartsdetails(id)
		{
			//alert('this id value :'+id);
			$.ajax({
				type: "POST",
				url: '<?php //echo site_url('sales/ajax_parts_list').'/';?>'+id,
				//data: id='cat_id',
				success: function(data){
					//alert(data);
					$('#parts_id').html(data);
					$('#parts_no').val("");
					$('#quantity').val("");
					$('#rate').val("");
					$('#total').val("");
				},
			});
		}

		function getpartsno(id)
		{
			//Ajax Load data from ajax
			$.ajax({
				url : "<?php //echo site_url('sales/ajax_parts_no/')?>/" + id,
				type: "GET",
				dataType: "JSON",
				success: function(data)
				{
					//$('[name="input field name"]').val(data.database field);
					$('[name="parts_no"]').val(data.parts_no);
					$('[name="rate"]').val(data.sales_price);
					//alert($('#brand_id').val());
					//alert(data.model_id);
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					//alert('Error get data from ajax');
					$('[name="parts_no"]').val("");
					$('[name="rate"]').val("");
				}
			});
		}

		function add_total () {
			var n1 = parseInt(document.frm.rate.value);
			var n2 = parseInt(document.frm.quantity.value);
			if (isNaN(n2)) {n2=0};
			document.frm.total.value = n1*n2;
		}

		function get_total () {
			var inps = document.getElementsByName('field_total[]');
			var f_total = 0;
			var f_discount = document.dynamic_frm.discount.value;
			var f_vat = document.dynamic_frm.vat.value;
			var f_tax = document.dynamic_frm.tax.value;
			for (var i = 0; i <inps.length; i++) {
				f_total += parseInt(inps[i].value);
			}

			document.dynamic_frm.final_total.value=f_total;
			var n_total =f_total-f_discount;
			var vat_total =(n_total*f_vat)/100;
			var tax_total =(n_total*f_tax)/100;
			var f_net_price = n_total+(vat_total+tax_total);

			document.dynamic_frm.vat_price.value=vat_total;
			document.dynamic_frm.tax_price.value=tax_total;
			document.dynamic_frm.net_price.value=f_net_price;
		}
	</script>

	<script type="text/javascript">

		$(document).ready(function(){
			
			$("#add_to").click(function(){
				//alert(0);
				var a = '<td><input type="text" name="field_id[]"  value="'+$('#parts_id').val()+'" ></td>';
				var b = '<td><input type="text" name="field_no[]"  value="'+$('#parts_no').val()+'" ></td>';
				var c = '<td><input type="text" name="field_qty[]"  value="'+$('#quantity').val()+'" ></td>';
				var d = '<td><input type="text" name="field_rate[]"  value="'+$('#rate').val()+'" ></td>';
				var e = '<td><input type="text" name="field_total[]"  value="'+$('#total').val()+'" ></td>';
				var f = '<td><input type="button" value="remove" class="remove"/></td>';
				$(".ab").append('<tr>'+a+b+c+d+e+f);

				$('#brand_id').val("");
				get_total();
				getmodeldetails(id="");

			});

			$(".ab").on('click', '.remove', function(e){ //Once remove button is clicked
					e.preventDefault();
					$(this).closest('tr').remove(); //Remove field html
					get_total();
			});
		});
	</script>	
<script src="datetime/jquery.js"></script>
<script src="datetime/jquery.datetimepicker.js"></script>
<script src="../script/jquery.dataTables.min.js" type="text/javascript"></script>
<script>/*
window.onerror = function(errorMsg) {
	$('#console').html($('#console').html()+'<br>'+errorMsg)
}*/
$('#datetimepicker').datetimepicker({
dayOfWeekStart : 1,
lang:'en',
disabledDates:['1986/01/08','1986/01/09','1986/01/10'],
startDate:'Date.now()'
});
//$('#datetimepicker').datetimepicker({value:'2015/04/15 05:03',step:10});
</script>
<script>
	$(document).ready(function() {
		$('.example').dataTable();
			});
</script>