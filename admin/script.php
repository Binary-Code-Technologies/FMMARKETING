
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
function addproduct(productid,prodname,unit_name,unitid,rate,tax_id)
{
	var search_supplier = document.getElementById('search_supplier').value;	
	//alert(search_supplier);
	if(search_supplier=='')
	{
		alert('Please Select Customer Name');
		jQuery("#productbarcode").val('');
		return false;
	}
	jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/check_rate.php',
			  data: 'search_supplier='+search_supplier+'&productid='+productid,
			  dataType: 'html',
			  success: function(data){
		      //alert(data);
		    jQuery("#myModal").modal('show');			
			jQuery("#prodname").val(prodname);
			jQuery("#productid").val(productid);
			jQuery("#unit_name").val(unit_name);
			jQuery("#unitid").val(unitid);
			jQuery("#rate").val(data);
			jQuery("#tax_id").val(tax_id);
			jQuery("#disc").val('0');
			jQuery("#qty").val('1');
			jQuery("#saveitem").attr('value', 'Add');
			jQuery("#saledetail_id").val('0');
			settotal();
			
			jQuery("#qty").focus();
			 }
						
		 });//ajax close		
}
function settotal()
{
	var qty=parseFloat(jQuery('#mqty').val());	
	var rate=parseFloat(jQuery('#mrate').val());	
	
	if(!isNaN(qty) && !isNaN(rate))
	{
		total=	qty * rate;
	}	
	
	
	jQuery('#mtotal').val(total.toFixed(2));
}	

	
  function addqty()
  {
  	var qty = parseInt(document.getElementById('mqty').value);
	
	var addqty1;
	//alert(qty);
	if(!isNaN(qty))
		{
			 addqty1 = parseInt(qty)+1;
		}
 		document.getElementById('mqty').value=addqty1;
		settotal();				
		
  }
  function minusqty()
  {
	  
  	var qty = parseInt(document.getElementById('mqty').value);	
	var addqty1;
	
	if(!isNaN(qty) && qty > 1)
	{
		 addqty1 = parseInt(qty)-1;
		 document.getElementById('mqty').value=addqty1;
		 settotal();
				 
	}else
	alert("Quntity can not be less than 1");
 	
  }

function updatelist()
{
	var  productid= document.getElementById('mproductid').value;
	//var  unit_name= document.getElementById('unit_name').value;
	var  unitid= document.getElementById('munitid').value;
	var  qty= document.getElementById('mqty').value;
	var  rate= document.getElementById('mrate').value;
	//var disc= document.getElementById('mdisc').value;
	var tax_id = document.getElementById('mtax_id').value;
	var saledetail_id = document.getElementById('saledetail_id').value;
	var keyvalue = '<?php echo $keyvalue; ?>';
	
		
	if(qty =='' && rate == '')
	{
		alert('Quantity & Rate cant be blank');	
		return false;
		
	}
	else
	{
		jQuery.ajax({
		  type: 'POST',
		  url: 'save_saleproduct.php',
		  data: 'productid='+productid+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&saledetail_id='+saledetail_id+
		  '&tax_id='+tax_id+'&saleid='+keyvalue,
		  dataType: 'html',
		  success: function(data){				  
		
			getrecord('<?php echo $keyvalue; ?>');
			
			jQuery('#mproductid').val('');
			
			jQuery('#mqty').val('');
			jQuery('#munit_name').val('');
			jQuery('#munitid').val('');
			jQuery('#mrate').val('');			
			jQuery('#mtax_id').val('');
			jQuery("#mprodname").val('');
			jQuery("#mtotal").val('');
			jQuery("#myModal").modal('hide');
			getrecord(keyvalue);
			}
			
		  });//ajax close
			
	}
	
}
	
	 

  
  
function save_supplier_data()
{
var supparty_name= document.getElementById('supparty_name').value;
		var mobile= document.getElementById('mobile').value;
		var bank_name= document.getElementById('bank_name').value;
		var bank_ac= document.getElementById('bank_ac').value;
		var ifsc_code= document.getElementById('ifsc_code').value;
		var bank_address= document.getElementById('bank_address').value;
		var stateid = document.getElementById('stateid').value;
		var address= document.getElementById('address').value;
		var prevbalance = document.getElementById('prevbalance').value;
		var prevbal_date= document.getElementById('prevbal_date').value;
		var panno= document.getElementById('panno').value;
		var cust_type= document.getElementById('cust_type').value;
		
		if(supparty_name == '')
		{
		    alert('Customer name can not be blank!');
			document.getElementById('supparty_name').focus();
			return false;
		}
		else
		{			
		
		  jQuery.ajax({
			  type: 'POST',
			  url: 'save_customer.php',
			  data: 'supparty_name='+supparty_name+'&mobile='+mobile+'&bank_name='+bank_name+'&bank_ac='+bank_ac+
			   '&ifsc_code='+ifsc_code+'&bank_address='+bank_address+'&address='+address+'&prevbalance='+prevbalance
			  +'&prevbal_date='+prevbal_date+'&panno='+panno+'&cust_type='+cust_type+'&stateid='+stateid,
			  dataType: 'html',
			  success: function(data){				  
		     //alert(data);
				jQuery('#suppartyid').val('');
				jQuery('#supparty_name').val('');
				jQuery('#mobile').val('');
				jQuery('#address').val('');
				jQuery('#bank_name').val('');
				jQuery('#bank_ac').val('');
				jQuery('#ifsc_code').val('');
				jQuery('#bank_address').val('');
				jQuery('#prevbalance').val(''); 
				jQuery('#ifsc_code').val('');
				jQuery('#prevbal_date').val('');
			    jQuery('#panno').val('');
				jQuery('#cust_type').val('');
				jQuery('#stateid').val('');
			    jQuery("#myModal1").modal('hide');
				jQuery('#suppartyid').html(data);			
				jQuery("#suppartyid").val('').trigger("liszt:updated");
				jQuery('#suppartyid').val('').trigger('chzn-single:updated');
				jQuery('#suppartyid').trigger('chzn-single:activate'); // for autofocus
				}
				
			  });//ajax close
				
		}
}



function save_product_data()
{
	var s_prodname = document.getElementById('s_prodname').value;
	var s_unitid =document.getElementById('s_unitid').value;
	var s_rate =document.getElementById('s_rate').value;
	var s_pur_rate =document.getElementById('s_pur_rate').value;
	var s_opening_stock =document.getElementById('s_opening_stock').value;
	var s_stockdate =document.getElementById('s_stockdate').value;
	var s_tax_id =document.getElementById('s_tax_id').value;
	var s_pcatid =document.getElementById('s_pcatid').value;
	var s_hsn_no =document.getElementById('s_hsn_no').value;
	var s_product_type ="finishgood"; 
	
		if(s_pcatid == "")
		{
			alert('Please Fill Category Name');
			document.getElementById('s_pcatid').focus();
			return false;
		}
		
		if(s_prodname == "")
		{
			alert('Please Fill Product Name');
			document.getElementById('s_prodname').focus();
			return false;
		}
		
		else
		{
			//alert(s_prodname='+s_prodname+'&unitid='+unitid+'&qty='+qty+'&rate='+rate+'&disc='+disc);
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_product.php',
			  data: 's_prodname='+s_prodname+'&s_unitid='+s_unitid+'&s_rate='+s_rate+'&s_pur_rate='+s_pur_rate+'&s_opening_stock='+s_opening_stock+'&s_stockdate='+s_stockdate+'&s_tax_id='+s_tax_id+'&s_hsn_no='+s_hsn_no+'&s_pcatid='+s_pcatid+'&s_product_type='+s_product_type,
			  dataType: 'html',
			  success: function(data){				  
		     // alert(data);
					jQuery('#showallbtn').click();
					jQuery("#s_prodname").val('');
					jQuery("#s_rate").val('');
					jQuery("#s_pur_rate").val('');
					jQuery("#s_barcode").val('');
					jQuery("#s_opening_stock").val('');
					jQuery("#s_stockdate").val('');
					jQuery("#s_wholeseller_rate").val('');
					jQuery("#s_design_code").val('');
					jQuery("#s_hsn_no").val('');
					jQuery("#myModal_product").modal('hide');
					jQuery('#productid').html(data);
					jQuery("#productid").val('').trigger("liszt:updated");
					jQuery('#productid').val('').trigger('chzn-single:updated');
					jQuery('#productid').trigger('chzn-single:activate'); // for autofocus
					getproductinfo();
					
				}
				
			  });//ajax close
				
		}
}
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




function show_model(saleid,tot_amt,suppartyid)
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
					var bal_amt=tot_amt-paidamount;
					
					jQuery("#saleidd").val(saleid);
					jQuery("#suppartyidd").val(suppartyid);
					jQuery("#myModal_payment").modal('show');
					jQuery("#cheque_td").hide();
					jQuery("#bank_td").hide();
					jQuery("#ref_td").hide();
					jQuery("#error").html('');
					jQuery('#totalbillamount').val(tot_amt);
					jQuery('#prevamount').val(paidamount);
					jQuery('#receiptno').val(receiptno);
					jQuery('#balanceamount').val(bal_amt);
					
					}
				
			  });//ajax close
		
	}
}
function set_payment(payment_type)
{
	if(payment_type != "")
	{
		if(payment_type == 'cash')
		{
			jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bank_name").val('');
			
			jQuery("#cheque_td").hide();
			jQuery("#bank_td").hide();
			jQuery("#ref_td").hide();
		}
		else if(payment_type=='cheque' || payment_type=='neft' )
		{
			jQuery("#chequeno").val('');
			jQuery("#refno").val('');
			jQuery("#bank_name").val('');
			
			jQuery("#cheque_td").show();
			jQuery("#bank_td").show();
			jQuery("#ref_td").show();
			
		}
	}
}

function save_payment_data()
{
	
        var payamt= document.getElementById('payamt').value;
		var payment_type= document.getElementById('payment_type').value;
		var chequeno= document.getElementById('chequeno').value;
		var refno= document.getElementById('refno').value;
		var bank_name= document.getElementById('bank_name').value;
		var paydate= document.getElementById('paydate').value;		
		var receiptno= document.getElementById('receiptno').value;
		var suppartyid = document.getElementById('suppartyidd').value;
		var saleid= document.getElementById('saleidd').value;
		var pay_mode="received";
		
		
		if(payamt == '')
		{
		    alert('Payment Amount can not be blank!');
			document.getElementById('payamt').focus();
			return false;
		}
		
		if(payment_type == '')
		{
		    alert('Payment Type can not be blank!');
			document.getElementById('payment_type').focus();
			return false;
		}
		
		if(paydate == '')
		{
		    alert('Payment date can not be blank!');
			document.getElementById('paydate').focus();
			return false;
		}
		
		else
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'save_payment.php',
			  data: 'payamt='+payamt+'&payment_type='+payment_type+'&chequeno='+chequeno+'&bank_name='+bank_name+
			   '&paydate='+paydate+'&receiptno='+receiptno+'&suppartyid='+suppartyid+'&saleid='+saleid+'&pay_mode='+pay_mode,
			  dataType: 'html',
			  success: function(data){				  
		    //  alert(data);
				jQuery('#payamt').val('');
				jQuery('#payment_type').val('');
				jQuery('#chequeno').val('');
				jQuery('#suppartyid').val('');
				jQuery('#bank_name').val('');
				jQuery('#paydate').val('');
				jQuery('#ifsc_code').val('');
				jQuery('#receiptno').val('');
				jQuery('#pay_mode').val('');
				jQuery('#saleid').val(''); 
			    jQuery("#myModal_payment").modal('hide');
				}
				
			  });//ajax close
				
		}
}


	
function checkamount()
{
	var balanceamount=parseInt(document.getElementById('balanceamount').value);
	var payamt=parseInt(document.getElementById('payamt').value);
	
	if(!isNaN(payamt))
	{
		if(balanceamount < payamt)
		{
			//alert("You cant pay more than Balance Amount");
			document.getElementById('error').innerHTML="You cant pay more than Balance Amount";
			jQuery('#payamt').val('');
			return false;
		}
		else if(balanceamount >= payamt)
		{
			document.getElementById('error').innerHTML="";
		}
		
	}
}





	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_stockdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#prevbal_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_manu_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
	
	
	jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#s_exp_date").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});
                //Datemask2 mm/dd/yyyy
             
                jQuery("[data-mask]").inputmask();
		 });
         
         
         
  
	
	
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



   jQuery(function() {
                //Datemask dd/mm/yyyy
                jQuery("#billdate").inputmask("dd-mm-yyyy", {"placeholder": "dd-mm-yyyy"});               
                jQuery("[data-mask]").inputmask();
		 }); 
   
 	
	
	function funDel(id)
	{  //alert(id);   
		tblname = '<?php echo $tblname; ?>';
		tblpkey = '<?php echo $tblpkey; ?>';
		pagename = '<?php echo $pagename; ?>';
		submodule = '<?php echo $submodule; ?>';
		module = '<?php echo $module; ?>';
		fromdate = '<?php echo $cmn->dateformatindia($fromdate); ?>';
		todate = '<?php echo $cmn->dateformatindia($todate); ?>';
		// alert(fromdate); 
		if(confirm("Are you sure! You want to delete this record."))
		{
			jQuery.ajax({
			  type: 'POST',
			  url: 'ajax/delete_sale.php',
			  data: 'id='+id+'&tblname='+tblname+'&tblpkey='+tblpkey+'&submodule='+submodule+'&pagename='+pagename+'&module='+module,
			  dataType: 'html',
			  success: function(data){
				  //alert(pagename+'?action=3&fromdate='+fromdate+'&todate='+todate);
				   location=pagename+'?action=3';
				}
				
			  });//ajax close
		}//confirm close
	} //fun close


	