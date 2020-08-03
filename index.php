<?php
use Phppot\DataSource;
use League\Csv\Reader;
use League\Csv\Writer;
require_once 'functions.php';
require_once 'DataSource.php';
        
global $db;
$db= new DataSource();
$conn = $db->getConnection();  
ini_set('max_execution_time', 300);
?>
<!DOCTYPE html>
<html>

<head>
<script src="jquery-3.2.1.min.js"></script>

<style>
body {
    font-family: Arial;
    width: 550px;
}

.outer-scontainer {
    background: #F0F0F0;
    border: #e0dfdf 1px solid;
    padding: 20px;
    border-radius: 2px;
}

.input-row {
    margin-top: 0px;
    margin-bottom: 20px;
}

.btn-submit {
    background: #333;
    border: #1d1d1d 1px solid;
    color: #f0f0f0;
    font-size: 0.9em;
    width: 100px;
    border-radius: 2px;
    cursor: pointer;
}

.outer-scontainer table {
    border-collapse: collapse;
    width: 100%;
}

.outer-scontainer th {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

.outer-scontainer td {
    border: 1px solid #dddddd;
    padding: 8px;
    text-align: left;
}

#response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {

	    $("#response").attr("class", "");
        $("#response").html("");
        var fileType = ".csv";
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
        if (!regex.test($("#file").val().toLowerCase())) {
        	    $("#response").addClass("error");
        	    $("#response").addClass("display-block");
            $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
            return false;
        }
        return true;
    });
});
</script>
</head>

<body>
    <h2>Import Data</h2>
        <p>

        <div id=files">
               <?php
               ProcessBrandFile($db, "C:\wamp64\www\Import-DataNew\Template\brand - ITA.txt", "it");
               ProcessBrandFile($db, "C:\wamp64\www\Import-DataNew\Template\brand - ENG.txt", "en");
               ProcessCategoryFile($db, "C:\wamp64\www\Import-DataNew\Template\cat - ITA.txt", "it");
               // non esistono descrizioni di categorie in inglese - ProcessCategoryFile($db, "C:\wamp64\www\Import-DataNew\Template\cat - ENG.txt", "en");
                ?>
        </div>
    </p>
</body>

</html>