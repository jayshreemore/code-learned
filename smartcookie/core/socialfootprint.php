
<?php
include("cookieadminheader.php");
if(!isset($_SESSION['id']))
	{
		header('location:login.php');
	}



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- jQuery library -->
	

	<!-- Latest compiled JavaScript -->




      <script>

function callajax(){
	// $('#example').DataTable();
    $.ajax({

        url: "social_media_list.php",
        type:'post',
        success: function(result){
        $("#social_media_list").html(result);
  }});
};
callajax();
$(document).ready(function(){

	$("#edit_social_media_form").on('submit',function(e){
		e.preventDefault();
		//alert('nik');
		console.log('123');
		var edit_media_name = $('#edit_media_name').val();
		var reg1 = /^[A-Za-z A-Za-z]+$/;
		var res = reg1.test(edit_media_name);
console.log('456');
		if(res==false)
		{
			console.log('789');
			 document.getElementById('add_error').innerHTML = 'enter only a-z alphabates';
			 return false;
		}
		else {
console.log('ab');
		//alert(media_name);
		 // alert("Submitted");
		 $('#edit_loader').html('<p><img height="15px" width="15px" src="loader.gif"></p>');
			$.ajax({
					url: "edit_social_media.php",
					type:'post',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success: function(data){
						//console.log('data');
						console.log(data);
						//alert(data);
						if((data.indexOf("successfully updated")) >= 0)
						{
							$('#edit_loader').html('');
							document.getElementById('add_error').innerHTML = '';
						document.getElementById('edit_success').innerHTML = 'Record updated successfully';
						 callajax();
						}


					//$("#social_media_list").html(result);
		}});
	}
	});



$('#exampleModal').on('show.bs.modal', function (event) {
	console.log('he');
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.data('whatever');
	console.log(recipient);
	var array = recipient.split(','); // Extract info from data-* attributes
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	var modal = $(this);
	console.log(array);
	modal.find('.modal-title').text('New message to ' + recipient)
	modal.find('#edit_media_name').val(array[0])
	modal.find('#id').val(array[1])
	modal.find('#points').val(array[2])

});


	$("#add_social_media").on('submit',function(e){
		e.preventDefault();

		var media_name = $('#media_name').val();
		var reg1 = /^[A-Za-z A-Za-z]+$/;
    var res = reg1.test(media_name);

		if(res==false)
    {
       document.getElementById('add_error').innerHTML = 'enter only a-z alphabates';
       return false;
    }
    else {
	$('#add_loader').html('<p><img height="15px" width="15px"  src="loader.gif"></p>');
		//alert(media_name);
	   // alert("Submitted");
			$.ajax({
					url: "add_social_media.php",
					type:'post',
					data:new FormData(this),
					contentType:false,
					processData:false,
					success: function(data){
						console.log(data);
						$('#add_loader').html('');
						if((data.indexOf("media_name successfully added")) >= 0)
						{
							
							console.log('1');
							document.getElementById('add_error').innerHTML = '';
						 document.getElementById('add_success').innerHTML = 'Successfully Added New Media Name';
						 callajax();
						}
						else if((data.indexOf("media_name is already exists")) >= 0)
						{
							console.log('2');
							document.getElementById('add_error').innerHTML = '';
							document.getElementById('add_error').innerHTML = 'Media Name Already Exists';
						}
						else if((data.indexOf("Please upload image")) >= 0)
						{
							console.log('3');
							document.getElementById('add_error').innerHTML = '';
							document.getElementById('add_error').innerHTML = 'Please Upload Image';
						}

					//$("#social_media_list").html(result);
		}});
	}
	});

  $('#addreason').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    var recipient = button.data('whatever');
    var array = recipient.split(','); // Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
    var modal = $(this)
    modal.find('.modal-body #recipient-name').val(array[0])
    modal.find('.modal-body #nik-name').val(array[1])
  });
});

function delete_social_media(id)
{
  //alert('srsr');
  //alert(id);
  if(window.confirm("Do you want to delete reason"))
  {
    //alert('yes');
    $.ajax({
    url: "delete_social_media.php",
    type:'post',
    data:({id:id}),
    success: function(result){
      if(result == true)
      {
        alert('Record Deleted Successfully');
        callajax();
      }
      else {
        alert('Error In Deletion');
      }
  }
})
  }

}

function removedata()
{
	//alert('nik');
//  document.getElementById('edit_error').innerHTML = '';
//  document.getElementById('edit_success').innerHTML = '';
  //document.getElementById('add_reason_name').value = '';
	document.getElementById('add_success').innerHTML = '';
	document.getElementById('add_error').innerHTML = '';
	document.getElementById('filename').value = '';
	document.getElementById('media_name').value = '';
	document.getElementById('points').value = '';
	document.getElementById('edit_success').innerHTML = '';
	document.getElementById('edit_error').innerHTML = '';
	document.getElementById('edit_media_name').value = '';
	document.getElementById('points').value = '';
	document.getElementById('edit_media_logo').value = '';
}



        </script>
</head>
<body>
	<div class="container">
    <div class="radius " style="height:50px; width:100%; background-color:#694489;" align="center">
            	<h2 style="padding-left:20px;padding-top:15px; margin-top:20px;color:white">Social Footprints</h2>
            </div>
    <div class="panel panel-default">
      <div class="panel-heading" align='center'>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#reason" data-whatever="@mdo,nik">Add Social Footprint</button>
          <div class="modal fade" id="reason" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">

                </div>
                <div class="modal-body">
                  <form method='post' id='add_social_media'>
                    <div class="form-group">
                      <div class="radius " style="height:30px; width:100%; background-color:#9F5F9F;" align="center">
                               	<h4 style="padding-left:20px;padding-top:5px; margin-bottom:20px;color:white">Add Social Media</h4>
                               </div>
                      <input type="text" class="form-control" id="media_name" name='media_name' placeholder='Media name'>
											<input type="number" class="form-control" id="points" placeholder='Points'>
											<input type="file" name='filUpload' class="form-control" id="filename">
                    </div>
                    <h5 id='add_error' style='color:red'></h5>
                    <h5 id='add_success' style='color:green'></h5>
					<div align='center' id='add_loader'></div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" onclick="removedata()"  data-dismiss="modal">Close</button>
                   <input type="submit" value="Submit">
                </div>
              </form>
                </div>
              </div>
            </div>
          </div>
      </div>
	<div class="panel-body" align='center'>
		<table id="example" class="display "  width="80%" cellspacing="0">
				<thead>


        			<tr style='background-color:#9F5F9F;color:white;font-size:20px;padding:10px' align='center'>
                	<th >Sr. No.</th>
                    <th >Media Name</th>
                    <th>Media Logo</th>

                     <th>Points</th>
                      <th>Edit</th>
                       <th>Delete</th>

                </tr>
                </thead>

								<tbody id='social_media_list'>


</tbody>
        	</table>
        </div>

</div>

</div>
</div>

</div>
</div>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id='edit_social_media_form' method='post'>
					<div class="form-group">
						 <div class="radius " style="height:30px; width:100%; background-color:#9F5F9F;" align="center">
												<h4 style="padding-left:20px;padding-top:5px; margin-bottom:20px;color:white">Edit Reason</h4>
											</div>
						<input type="text" class="form-control" id="edit_media_name" name='edit_media_name'>
						<input type="file" class="form-control" id="edit_media_logo" name='filUpload'>
						<input type="number" class="form-control" id="points" name='points'>
						<input type="hidden" class="form-control" id="id" name='id'>
					</div>
					<h5 id='edit_error' style='color:red'></h5>
					<h5 id='edit_success' style='color:green'></h5>
					<div align='center' id='edit_loader'></div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" onclick="removedata()"  data-dismiss="modal">Close</button>
				<input type="submit" value="Submit">
			</div>
		</form>
		</div>
	</div>
</div>



</body>
</html>
