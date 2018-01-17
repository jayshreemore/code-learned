<?php 
	$this->load->view('coupons/suggested_cat');  
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
			url: "<?php echo base_url(); ?>" + "Ccoupon/suggested_list",
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
			url: "<?php echo base_url(); ?>" + "Ccoupon/suggested_list",
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

function likeThisSponsor(id){	
		if(id!=''){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url(); ?>" + "Ccoupon/likeThisSponsor",
				dataType: 'text',
				data: { id: id },
				success: function(res){
					if(res){
						getLocation();
					}
				}
			});
		}

}

</script>
<div class='row' style="padding-top:10px; padding-bottom:10px" >
<div class='col-md-12'>
	<a href="<?php echo base_url("Ccoupon/suggest_sponsor");?>"><button class='btn btn-success btn-sm'>Suggest Sponsor</button></a>
</div></div>
<div id='items_list' class='row' style="padding-top:10px" >
	
</div>