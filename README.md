# PageKit
PHP Bootstrap HTML Kit Framework


Example:

<?php
require("pagekit.php");



 
 

$page = NewPage("Dreams");
$page->D("jumbotron","<h1>Chonga Dreams</h1><h2>Die Traumbibliotek</h2>");
$page->AddMenu();
$page->L();
$page->AddContent("<h1>Traumgeschichten</h1>");


$db = NewDBConnection($settings);
$data = $db->FetchDataExec("dreams","*","order by RAND() LIMIT 1");
$result = $db->ExecSQL("SELECT * from dreams order by RAND() LIMIT 1");
$page->AddContent("Anzahl gespeicherter Träume: ");
$dreamcount = $db->CountTable("dreams");

$page->Num($dreamcount);
$page->NL();
while ($obj = $data->fetch_object()) {


   	$page->D("alert alert-info","<h2>Es war einmal in einem Traum...</h2><br>...".$obj->story);
   }
      
    
 
$page->Button("index.php","Zufälligen Traum lesen","large","primary");
$page->Render();
?>
