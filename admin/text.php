<script>

function getproductlist(pcatid)
	{
		
		
	//alert(pcatid);
	if(pcatid !='' && !isNaN(pcatid))
	{
	jQuery.ajax({
	type: 'POST',
	url: 'ajax_getproductlist.php',
	data: 'pcatid='+pcatid+'&process=sale',
	dataType: 'html',
	success: function(data){
	document.getElementById('productnamelist').innerHTML=data;
	}
	
	});//ajax close
	}		
	}
	
	 function getgst(tax_id)
{
	//alert(tax_id);
		jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/get_tax.php',
			  data: 'tax_id='+tax_id,
			  dataType: 'html',
			  success: function(data){
				  //alert(data);
				 arr=data.split("|");
				 jQuery('#igst').val(arr[0]);
				 jQuery('#sgst').val(arr[1]);
				 jQuery('#cgst').val(arr[2]);
				  jQuery('#vat').val(arr[3]);
				
				}
				
			  });//ajax close
	
}	









	
	
function myFunction()
{
  //alert('hi');
  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td1 = tr[i].getElementsByTagName("td")[0];
	td2 = tr[i].getElementsByTagName("td")[1];
	td3 = tr[i].getElementsByTagName("td")[2];
	td4 = tr[i].getElementsByTagName("td")[3];
	
	//alert(td);
    if(td1 || td2 || td3 || td4) {
      if(td1.innerHTML.toUpperCase().indexOf(filter) > -1 || td2.innerHTML.toUpperCase().indexOf(filter) > -1 || td3.innerHTML.toUpperCase().indexOf(filter) > -1 || td4.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}


 
  
  
	
jQuery(document).ready(function(){
						   
						   jQuery('#menues').click();
						  
						   });


/*jQuery(document).ready(function(){
								 setTotalrate();
								},10000);*/




function funprint(a,billno,saleid)
{
	jQuery("#myModal2").modal('show');
	jQuery('#mbillno').val(billno);
	jQuery('#msaleid').val(saleid);
	
	if(a=='c')
	{
		jQuery('#type').val('c');	
	}
	
	if(a=='i')
	{
		jQuery('#type').val('i');	
	}
	
}
function printbill(size)
{
	var type = jQuery('#type').val();
	var saleid=jQuery('#msaleid').val();
	if(type=='i')
	{
		if(size=='1')
		{
			window.open("pdf_sale_details.php?saleid="+saleid); 
		}
		
		if(size=='2')
		{
			window.open("pdf_sale_details_prnita5.php?saleid="+saleid); 
		}
		
	}
	
	if(type=='c')
	{
		if(size=='1')
		{
			window.open("pdf_sale_challan_details.php?saleid="+saleid); 
		}
		
		if(size=='2')
		{
			window.open("pdf_sale_chalana5.php?saleid="+saleid); 
		}
	}
	
	jQuery(typesize).val('');
	
}
	
<?php
if($_GET['action']==3)
{
?>
	
	add();
	
<?php } ?>


	

function check_supplier_exist(supparty_name)
{
	//alert(supparty_name);
	jQuery.ajax({
					type: 'POST',
					url: 'ajax_check_supplier_exist.php',
					data: 'supparty_name='+supparty_name,
					dataType: 'html',
					success: function(data){				  
					//alert(data);
						if(data == 0 || data == "")
						{
							alert('Supplier name not found!')
							jQuery("#search_supplier").val('');
							jQuery("#search_supplier").focus();
						}
					}
			  });//ajax close
}











function show_model(saleid)
{
	
	if(!isNaN(saleid))
	{
		
		jQuery.ajax({
					type: 'POST',
					url: 'ajax_getinvoicedetail.php',
					data: 'saleid='+saleid,
					dataType: 'html',
					success: function(data){				  
					arr=data.split('|');
					paidamount=arr[0].trim();
					receiptno=arr[1].trim();
					tot_amt=arr[2].trim();
					var bal_amt=tot_amt-paidamount;
					
					jQuery("#saleidd").val(saleid);
					jQuery("#suppartyidd").val(suppartyid);
					jQuery("#myModal_payment").modal('show');
					jQuery("#cheque_td").hide();
					jQuery("#bank_td").hide();
					jQuery("#ref_td").hide();	
					jQuery('#error').html('');
					jQuery('#totalbillamount').val(tot_amt);
					jQuery('#prevamount').val(paidamount);
					jQuery('#receiptno').val(receiptno);
					jQuery('#balanceamount').val(bal_amt);
					
					}
				
			  });//ajax close
		
	}
}











</script>

<?php if($last_bill !='' || $last_bill !='0')
{ ?>
<script>show_model(<?php echo $last_bill ?>);
<?php } ?>
</script>