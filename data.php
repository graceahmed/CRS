<?php
session_start();
$_SESSION['CFAPPLICATION']="DataLandscape";
include ("pdo_con.php");
try {
    $dbh = new PDO($db_conn, $db_user, $db_pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}
?>

<!doctype html>

<html lang="en">
<head>
<meta NAME="KEYWORDS" CONTENT="US Census Bureau, Vermont State Data Center, Vermont, State, Data, Center, Census, Indicators, 
Information, Census Training, Training, Census Updates">
<meta NAME="description" CONTENT="The website of the US Census Bureau's Vermont State Data Center, with information on data resources, data updates, training opportunities, and more.">
<title>Vermont State Data Center - Data Landscape</title>
</head>

<body>

<div class="headlines">
<img style="float:left; padding-right:5px;" alt="map of vermont" src="../images/vt_sdc4.gif">
	<h1>Vermont State Data Center - Data Landscape</h1>
	<p style="font-size:16px">
    Data Function: <?php echo $_POST["data_function"];?><br>
    Subject: <?php echo $_POST["subject"];?><br>
    Organization Type: <?php echo $_POST["org_type"];?><br><br>
    <a href="http://www.uvm.edu/crs/?Page=datalandscape/index.php"><< Start a new search</a>
  </p>

	</div>
<div id="box">

<h2>Data Providers:</h2>

<?php
//get strings from posted variables 
$data_func = $_POST["data_function"];
$subj = $_POST["subject"];
$orgtype = $_POST["org_type"];

//sql query builder 
$sql = "SELECT * FROM `DATAHOLDERS` WHERE `Approved`=1"; //base query
$sql_datafunc = " AND `{$data_func}`=1";
$sql_subject = " AND `Subject`='{$subj}'";
$sql_orgtype = " AND `OrgType`='{$orgtype}'";
$sql_end = "\";";
//check users choices on index.php to determine correct SQL query to filter data
if ($data_func != "All"){
  $sql = $sql . $sql_datafunc;
}
if ($subj != "All"){
  $sql = $sql . $sql_subject;
}
if ($orgtype != "All"){
  $sql = $sql . $sql_orgtype;
}

//print SQL query for testing
//echo $sql;
//echo nl2br (" \n ");

//get query resuts from mySQL database
foreach($dbh->query($sql) as $row) {
    echo $row['Entity']; 
    echo nl2br (" \n ");//etc...
}



?>

</div>



    
</body>
</html>
