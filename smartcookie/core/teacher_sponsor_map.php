<?php
/**
 * Created by PhpStorm.
 * User: Rohit
 * Date: 9/3/2017
 * Time: 5:32 PM
 */
include_once('header.php');
$id=$_SESSION['id'];
$latlong = "";
if (isset($_POST['submit'])) {
    // To Fetch lat long given address
    function get_lat_long($address)
    {
        $address = str_replace(" ", "+", $address);
        $json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address");
        $json = json_decode($json);
        $lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
        $long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
        $results = array(
            "lat" => "$lat",
            "lng" => "$long"
        );
        return $results;
    }
    $Address = $_POST['Address'];
    $distance = $_POST['distance'];
    $latlong = get_lat_long($Address);
}
$SponsorResults = mysql_query("SELECT sp_company,sp_name,sp_date,sp_address,sp_country,sp_city,sales_p_lat,sales_p_lon FROM tbl_sponsorer where sales_p_lon!='' AND sales_p_lat!=''");
$data_array = array();
/* For Sponsors Data */
while ($row = mysql_fetch_assoc($SponsorResults)) {
    /* Each row is added as a new array */
    $data_array[] = $row;
    $res[] = $row;
    $locations[] = array(
        "title" => $row['sp_company'],
        "lat" => $row['sales_p_lat'],
        "lng" => $row['sales_p_lon'],
        "description" => "Sponsor Name : <b>" . $row['sp_name'] . "</b><br>Shop Name : <b>" . $row['sp_company'] . "</b><br>Address : <b>" . $row['sp_address'] . "," . $row['sp_city'] . "," . $row['sp_country'] . "</b><br> Reg.Date : <b>" . $row['sp_date']
    );
}
/* For School Data */
$SchoolResults = mysql_query("SELECT * FROM Institution_directory where calculated_lat!='' AND calculated_lon!='' limit 0,460;");
while ($row = mysql_fetch_assoc($SchoolResults)) {
    /* Each row is added as a new array */
    $data_array[] = $row;
    $res[] = $row;
    $locations[] = array(
        "title" => "@SCH@" . $row['college_name'],
        "lat" => $row['calculated_lat'],
        "lng" => $row['calculated_lon'],
        "description" => "School name : <b>" . $row['college_name']
    );
}
$markers = json_encode($locations);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Sponsor and Schools Map</title>
</head>
<body>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
<script >
</script>
<script type="text/javascript">
    var markers = <?php echo $markers;?>;
    window.onload = function () {
        // When map display first time
        var mapOptions = {
            center: new google.maps.LatLng(markers[0].lat, markers[0].lng),
            zoom: 3,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        // get lat lon given address and display/Zoom map given address
        var getlat = document.getElementById("getlat").value;
        var getlng = document.getElementById("getlng").value;
        var yourSelect = document.getElementById( "distance" );
        if (getlng) {
            var zoomvalue=yourSelect.options[ yourSelect.selectedIndex ].value;
            var mapOptions = {
                center: new google.maps.LatLng(getlat, getlng),
                zoom: Number(zoomvalue),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
        }
        var map = new google.maps.Map(document.getElementById("dvMap"), mapOptions);
        function moveToLocation(lat, lng) {
            var center = new google.maps.LatLng(lat, lng);
            //map.panTo(center);
        }
        var infoWindow = new google.maps.InfoWindow();
        var lat_lng = new Array();
        var latlngbounds = new google.maps.LatLngBounds();
        var marker_length = markers.length;
        var end_marker_length = markers.length - 1;
        for (i = 0; i < markers.length; i++) {
            var data = markers[i];
            var myLatlng = new google.maps.LatLng(data.lat, data.lng);
            lat_lng.push(myLatlng);
            var x = data.title;
            if (x.match("^@SCH@")) {
                var iconBase = 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|6FA804|18|_|SC';
            } else {
                var iconBase = 'http://chart.apis.google.com/chart?chst=d_map_spin&chld=1|0|CC7ED8|18|_|SP';
            }
            var maptitle = x.replace("@SCH@", "");
            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                icon: iconBase,
                title: maptitle,
            });
            latlngbounds.extend(marker.position);
            (function (marker, data) {
                google.maps.event.addListener(marker, "click", function (e) {
                    infoWindow.setContent(data.description);
                    infoWindow.open(map, marker);
                });
            })(marker, data);
        }
        //map.setCenter(latlngbounds.getCenter());
        //map.fitBounds(latlngbounds);
    }
	
</script>
<link href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel='stylesheet'/>
<script src='//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js' type='text/javascript'></script>

<script>
    $(document).ready(function () {

        $('#myTable').DataTable();

    });
</script>
<div class="container">
    <div class="page-header">
        <b><h2 style="text-align: center;"><font face="verdana" color="#3d004d">Sponsor & School Map</font></h2></b>
    </div>
	<div class="row">
<div class="col-sm-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-title">Local Sponsors</div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive" id="no-more-tables">
                        <table class='table table-bordered table-striped table-condensed cf' id='myTable'>
                            <thead>
                            <tr>
                                <td></td>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $rows = mysql_query("select * from tbl_sponsorer where sp_city like '$city' and sp_country like '$country' ");
                            while ($result = mysql_fetch_array($rows)) {
                                if ($result['sp_company'] != "") { ?>
                                    <tr>
                                        <td title="<?= $result['sp_address']; ?>"><?= $result['sp_company']; ?></td>
                                    </tr>
                                <?php }
                            } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
<div class="col-sm-8">
    <div class="panel panel-default" style="background-color:#428BCA;">
        <form method="POST">
            <div class="panel-body">
		  <div class="row">
    <div class="col-sm-4">
    <input id="autocomplete" type="text" onFocus="geolocate()" name="Address" value="<?php if ($_POST['Address']) {echo $_POST['Address'];}?>" class="form-control" placeholder="Enter the address" >
     <input id="getlat" type="hidden" name="getlat" value="<?php echo $latlong['lat']; ?>"
                       class="form-control" placeholder="lat">
                         <input id="getlng" type="hidden" name="getlng" value="<?php echo $latlong['lng']; ?>"
                       class="form-control" placeholder="lan">
    
    
    </div>
    <div class="col-sm-4">
    <select name="distance" id="distance" class="dropdown-select" style="height: 30px; color: #0a819c;">
                        <option value="13" >Distance</option>
                        <option value="15">10 KM</option>
                        <option value="11" >50 KM</option>
                        <option value="9" >100 KM</option>
                    </select>
    </div>
    <div class="col-sm-4">
      <button class="btn btn-default" type="submit" name="submit"><i class="glyphicon glyphicon-search"></i></button>
    </div>
  </div>
</div>
			</div>
        </form>
   



    <div id="dvMap" style="width: 800px; height: 500px; margin-top: 20px;">
 </div>
  </div>
	</div>
	</div>
    <script>
        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete(
                (document.getElementById('autocomplete')),
                {types: ['geocode']});
            autocomplete.addListener('place_changed', fillInAddress);
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD9mTakYV_bf4cn_hXg166uytj-OBn9zMo&libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>


