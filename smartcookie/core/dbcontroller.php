<?php
$server_name = $_SERVER['SERVER_NAME'];


if($server_name == 'localhost.smartcookie.in')
{
class DBController {


//$con=mysql_connect("127.0.0.1.","root","") or die('conn failed');
        //mysql_select_db("smartcookie",$con) or die('db failed');
/* private $host = "localhost";
private $user = "root";
private $password = "";
private $database = "smartcookies"; */
private $host = "127.0.0.1.";
private $user = "root";
private $password = "";
private $database = "smartcookie";

function __construct() {
$conn = $this->connectDB();
if(!empty($conn)) {
$this->selectDB($conn);
}
}

function connectDB() {
$conn = mysql_connect($this->host,$this->user,$this->password);
return $conn;
}

function selectDB($conn) {
mysql_select_db($this->database,$conn);
}

function runQuery($query) {
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)) {
$resultset[] = $row;
}
if(!empty($resultset))
return $resultset;
}

function numRows($query) {
$result  = mysql_query($query);
$rowcount = mysql_num_rows($result);
return $rowcount;
}
}

}



elseif($server_name == 'smartcookie.in')
{
class DBController {

/* private $host = "localhost";
private $user = "root";
private $password = "";
private $database = "smartcookies"; */
private $host = "50.63.166.149";
private $user = "techindi_admin";
private $password = "2Cr%0OsVG95n";
private $database = "techindi_Prod";

function __construct() {
$conn = $this->connectDB();
if(!empty($conn)) {
$this->selectDB($conn);
}
}

function connectDB() {
$conn = mysql_connect($this->host,$this->user,$this->password);
return $conn;
}

function selectDB($conn) {
mysql_select_db($this->database,$conn);
}

function runQuery($query) {
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)) {
$resultset[] = $row;
}
if(!empty($resultset))
return $resultset;
}

function numRows($query) {
$result  = mysql_query($query);
$rowcount = mysql_num_rows($result);
return $rowcount;
}
}

}
elseif($server_name == 'test.smartcookie.in')
{
class DBController {

/* private $host = "localhost";
private $user = "root";
private $password = "";
private $database = "smartcookies"; */
private $host = "50.63.166.149";
private $user = "techindi_tester";
private $password = "{1Sl=f8#Kg~U";
private $database = "techindi_Test";

function __construct() {
$conn = $this->connectDB();
if(!empty($conn)) {
$this->selectDB($conn);
}
}

function connectDB() {
$conn = mysql_connect($this->host,$this->user,$this->password);
return $conn;
}

function selectDB($conn) {
mysql_select_db($this->database,$conn);
}

function runQuery($query) {
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)) {
$resultset[] = $row;
}
if(!empty($resultset))
return $resultset;
}

function numRows($query) {
$result  = mysql_query($query);
$rowcount = mysql_num_rows($result);
return $rowcount;
}
}

}
elseif($server_name == 'dev.smartcookie.in')
{
class DBController {

/* private $host = "localhost";
private $user = "root";
private $password = "";
private $database = "smartcookies"; */
private $host = "50.63.166.149";
private $user = "techindi_Develop";
private $password = "A*-fcV6gaFW0";
private $database = "techindi_Dev";

function __construct() {
$conn = $this->connectDB();
if(!empty($conn)) {
$this->selectDB($conn);
}
}

function connectDB() {
$conn = mysql_connect($this->host,$this->user,$this->password);
return $conn;
}

function selectDB($conn) {
mysql_select_db($this->database,$conn);
}

function runQuery($query) {
$result = mysql_query($query);
while($row=mysql_fetch_assoc($result)) {
$resultset[] = $row;
}
if(!empty($resultset))
return $resultset;
}

function numRows($query) {
$result  = mysql_query($query);
$rowcount = mysql_num_rows($result);
return $rowcount;
}
}

}






?>