<?php 

$this->load->view('coupons/coupon_cat');  
?>
<script>
function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, positionError);
    } else {
        positionError();
    }
}
function showPosition(position){
		var x = document.getElementById("items_list");
		
		var curr = document.getElementById("curr").value;
		var dist = document.getElementById("dist").value;
		var addr = document.getElementById("addr").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var country = document.getElementById("country").value;		
		var cat = document.getElementById("cat").value;
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "/Ccoupon/coupon_list",
			dataType: 'text',
			data: { lat: position.coords.latitude, lon: position.coords.longitude, curr: curr, dist: dist, city: city, state: state, cat: cat, addr: addr, country: country },
			 success: function(res) {
				if (res)
				{
					//alert(res);
 					//obj = JSON && JSON.parse(res) || $.parseJSON(res);
					x.innerHTML = res;
					$("[data-toggle=popover]").popover();
				}
			}
		});
	
}

function positionError(){
		var x = document.getElementById("items_list");
		var curr = document.getElementById("curr").value;
		var dist = document.getElementById("dist").value;
		var addr = document.getElementById("addr").value;
		var city = document.getElementById("city").value;
		var state = document.getElementById("state").value;
		var country = document.getElementById("country").value;
		
		var cat = document.getElementById("cat").value;
		
		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "Ccoupon/coupon_list",
			dataType: 'text',
			data: { lat: '', lon: '', curr: curr, dist: dist, city: city, state: state, cat: cat, addr: addr, country: country },
			success: function(res) {
				if (res)
				{
					//alert(res);
 					//obj = JSON && JSON.parse(res) || $.parseJSON(res);
					x.innerHTML = res;
					$("[data-toggle=popover]").popover();
				}
			}
		});
}

function getThisCoupon(id,ppp){	

		jQuery.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>" + "Ccoupon/add_to_cart",
			dataType: 'text',
			data: { id: id, ppp: ppp },
			success: function(res) {
				if (res)
				{
					alert(res);
					getStatusRow();					
				}
			}
		});
}

</script>

<div id='items_list' class='row' style="padding-top:10px" >
	
</div>