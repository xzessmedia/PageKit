<?php

$settings = Settings("localhost","dbname","username","password");

/**
 * NewPage($title) 
 * This will create and return a new HTML Page
 */
function NewPage($title) {
	$page = new PageKit($title);
	return $page;
}
/**
 * NewForm($url)
 * This will create and return a new http form
 */
function NewForm($url) {
	$form = new Form($url);
	return $form;
}

function NewPagination($previouslink,$nextlink) {
	$pagination = new Pagination($previouslink,$nextlink);
	return $pagination;
}

/**
 * NewListbox($id,$name, $size,$multiple)
 * This will create and return a new http form ListBox
 */
function NewListbox($id,$name, $size,$multiple) {
	$list = new Listbox($id,$name, $size,$multiple);
	return $list;
}
/**
 * NewDBConnection($settings)
 * This takes your settings and create and return a new database connection
 */
function NewDBConnection($settings)
{
	$db = new DBKit($settings->host,$settings->dbuser,$settings->dbpassword,$settings->dbname);
	return $db;
}
/**
 * Settings
 * This creates and returns database settings needed for DB Connection
 */
function Settings($dbhost,$dbname,$dbuser,$dbpassword) {
	$set = new KitSettings($dbhost,$dbname,$dbuser,$dbpassword);
	return $set;
}

/**
 * PageKit Settings are stored here
 */
class KitSettings
{
public $host;
public $dbname;
public $dbuser;
public $dbpassword;

	/**
	 * Initialises the Kit automatically
	 */
	function  __construct($host,$dbname,$dbuser,$dbpassword) {
	$this->host = $host;
	$this->dbuser=$dbuser;
	$this->dbpassword = $dbpassword;
	$this->dbname = $dbname;
	}
}

/**
 * Colors to use on pages
 * use it like this: $page->D(Color::Green,"Green Panel");
 */
abstract class Color
{
const Green = "alert alert-success";
const Blue = "alert alert-info";
const Yellow = "alert alert-warning";
const Red = "alert alert-danger";
}

/**
 * HTTP Form Class
 */
class Form extends HTMLElement
{
	function  __construct($url) {
		$this->InitHTML('<form action="'.$url.'" method="post" role="form">');
		$this->FinishHTML('</form>');
	}	
	public function StartFieldset() {
		$c = '<fieldset>';
	$this->AddContent($c);
	}
	
	public function EndFieldset() {
		$c = '</fieldset>';
	$this->AddContent($c);
	}
	public function StartGroup() {
	$c = '<div class="form-group">';
	$this->AddContent($c);
		
	}
	public function EndGroup() {
	$c = '</div>';
	$this->AddContent($c);
		
	}
	public function AddLabel($caption, $forID) {
	$c = '<label for="'.$forID.'">'.$caption.'</label>';
	$this->AddContent($c);	
	}
	public function AddInput($id,$name,$placeholder)
	{
	$c = '<input type="text" id="'.$id.'" name="'.$name.'" class="form-control" placeholder="'.$placeholder.'">';
	$this->AddContent($c);
	}
	public function AddTextarea($id,$name,$rows,$content)
	{
	$c = '<textarea rows="'.$rows.'" id="'.$id.'" class="form-control" name="'.$name.'">'.$content.'</textarea>';
	$this->AddContent($c);
	}

	public function AddRadiobox($id,$name,$value,$checked) {
	$c = "";
		if($checked == true)
		{
			$c = '<input type="radio"  id="'.$id.'" class="form-control" name="'.$name.'" value='.$value.' checked>';
		} else {
			$c = '<input type="radio"  id="'.$id.'" class="form-control" name="'.$name.'" value='.$value.'>';
		}
	$this->AddContent($c);	
	}
	public function AddCheckbox($id,$name,$value,$checked) {
	$c = "";
		if($checked == true)
		{
			$c = '<input type="checkbox"  id="'.$id.'" class="form-control" name="'.$name.'" value='.$value.' checked>';
		} else {
			$c = '<input type="checkbox"  id="'.$id.'" class="form-control" name="'.$name.'" value='.$value.'>';
		}
	$this->AddContent($c);	
	}
	public function AddSubmit($caption) {
	//$c = '<input type="submit" value="'.$caption.'">';
	$c = '<button class="btn btn-large btn-primary" type="submit">'.$caption.'</button><br/>';	
	$this->AddContent($c);	
	}
	
}

class Listbox extends HTMLElement
{
function  __construct($id,$name, $size,$multiple) {
		if($multiple==true)
		{
		$this->InitHTML('<select id="'.$id.'" name="'.$name.'"  class="form-control" size="'.$size.'" multiple>');
		} else {
		$this->InitHTML('<select id="'.$id.'" name="'.$name.'" class="form-control" size="'.$size.'">');
		}
		
		$this->FinishHTML('</select>');
	}	
 function StartGroup($title)
 {
 	$this->html .= '<optgroup label="'.$title.'">';
 }
  function EndGroup()
 {
 	$this->html .= '</optgroup>';
 }
function AddOption($option,$value,$selected)
{
	if($selected==true)
	{
	$this->html .= '<option value="'.$value.'" selected>'.$option.'</option>';
	} else {
	$this->html .= '<option value="'.$value.'">'.$option.'</option>';
	}
    
}
  
}
abstract class HTMLElement
{
protected $html;
protected $init;
protected $finish;

	public function InitHTML($init) {
		$this->init = $init;
	}
	public function FinishHTML($finish) {
		$this->finish = $finish;
	}
	public function AddContent($content)
	{
		$this->html .= $content;
	}
	public function AddMenu() {
		$this->DS();
		$this->Button("index.php","Videostream","large","primary");
		$this->Button("add.php","Video hinzufügen","large","primary");
		$this->Button("http://www.chomba.tk","Zurück zum Chomba Netzwerk","large","primary");
		$this->DE();
	}
	public function IFrame($width,$height,$src,$border)
	{
	$this->html.='<iframe class="embed-responsive-item" width="'.$width.'" height="'.$height.'" src="'.$src.'" frameborder="'.$border.'" allowfullscreen></iframe>';
	}
	public function Text($content)
	{
	 $this->html.=$content;
	}
	public function NL()
	{
	$this->html.= '<br>';
	}
	public function L()
	{
	$this->html.= '<hr>';
	}
	public function Num($number)
	{
	$this->html .= '<span class="badge">'.$number.'</span>';
	}
	public function B($content)
	{
	$this->html.='<b>'.$content.'</b>';
	}
	public function U($content)
	{
	$this->html.='<u>'.$content.'</u>';
	}
	public function K($content)
	{
	$this->html.='<i>'.$content.'</i>';
	}
	public function D($class,$content)
	{
	$this->html.='<div class="'.$class.'">'.$content.'</div>';
	}
	public function DS()
	{
	$this->html.='<div>';
	}
	public function DE()
	{
	$this->html.='</div>';
	}
	public function P($content)
	{
	$this->html.='<p>'.$content.'</p>'; 
	}
	public function Link($url,$txt,$target)
	{
	if (!isset($target)) {
		$targt = "_self";
	}
	$this->html.= '<a href="'.$url.'" target="'.$target.'">'.$txt.'</a>' ;
	}
	
	public function Button($url,$text,$size,$color)
	{
	$_size = "btn-lg";
	$_color = "btn-primary";
	
	switch ($size) {
		case "large":
		$_size = "btn-lg";
		break; 
		case "medium":
		$_size = "btn-md";
		break;
		case "small":
		$_size = "btn-sm";
		break;
		case "xsmall":
		$_size = "btn-xs";
		break;
		default:
		$_size = "btn-lg";
		break;
	}
	
	switch ($color) {
		case "default":
		$_color = "btn-default";
		break;
		case "primary":
		$_color = "btn-primary";
		break;
		case "success":
		$_color ="btn-success";
		break;  
		case "info":
		$_color ="btn-info";
		break;  
		case "warning":
		$_color ="btn-warning";
		break; 
		case "danger":
		$_color ="btn-danger";
		break;  
		case "link":
		$_color ="btn-link";
		break;  
		default:
		$_color = "btn-primary";
		break;
	}
	
	$this->html .= '<a class="btn '.$_size.' '.$_color.'" href="'.$url.'" role="button">'.$text.'</a>';
	}
	public function SetHTML($content)
	{
		$this->html = $content;
	}
	public function GetContent()
	{
		return $this->html;
	}
	public function GetHTML()
	{
		$all = $this->init;
		$all .= $this->html;
		$all .= $this->finish;
		return $all;
	}
	public function Clear() {
		$this->html = "";
	}
	public function Render()
	{
		echo($this->init);
		echo($this->html);
		echo($this->finish);
	}
}
abstract class HTMLPage extends HTMLElement
{
protected $title;
protected $header;
protected $scripts;
protected $html;


	 function __construct($title) {
      	$this->title = $title;
 	}
 	
	public function Add($content)
	{
	 $this->html.=$content;
	}
	public function AddHeader($content)
	{
	 $this->header.=$content;
	}
	public function PlaySound($soundurl)
	{
	$audio = '<audio autoplay><source src="'.$soundurl.'" type="audio/mpeg">
	Your browser does not support the audio element.
	</audio>';
	$this->html.=$audio;
	}
	public function ClearPage()
	{
		$this->html = "";
	}
	public function Render()
	{
	echo $this->GeneratePageStart($this->title);
	echo $this->html;
	echo $this->GeneratePageEnd();
	}
	public function SaveFile($filename)
	{
	$file = new FileKit($filename,"a+");
	$file->SetContent($this->GetHTML());
	$file->WriteFile();
	}
	private function GeneratePageStart($title)
	{
	$start = '
		<!DOCTYPE html>
	<html lang="en">
	  <head>
	  <link rel="stylesheet" type="text/css" href="pagekit.css">
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	    <title>'.$title.'</title>
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	    <!-- Bootstrap -->
	    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
	    
	<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha256-IsefKVCcMUlgpXQgIMRsqbIqC6aP153JkybxTa7W7/8= sha512-mCNEsmR1i3vWAq8hnHfbCCpc6V5fP9t0N1fEZ1wgEPF/IKteFOYZ2uk7ApzMXkT71sDJ00f9+rVMyMyBFwsaQg==" crossorigin="anonymous">
	
	
	    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesnt work if you view the page via file:// -->
	    <!--[if lt IE 9]>
	      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	    <![endif]-->
	    ';
	    $start .= $this->header;
	    $start .= '</head><body>';
	    return $start;
	}
	private function GeneratePageEnd()
	{
		$end = '
		    <!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		    <!-- Include all compiled plugins (below), or include individual files as needed -->
		    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>';
		    $end .= $this->scripts;
		    $end .= '</body></html>';
		    return $end;
	}
}



class DBKit
{
private $host;
private $dbname;
private $dbuser;
private $dbpassword;
private $IsConnected;
private $mysqli_connection;
private $lastquery;
public $result;

function  __construct($host,$dbuser,$dbpassword,$dbname) {
	$this->host = $host;
	$this->dbuser = $dbuser;
	$this->dbpassword = $dbpassword;
	$this->dbname = $dbname;
	$this->IsConnected = FALSE;
	$this->Connect();
}	
	
public function Connect() {
$this->mysqli_connection = new mysqli($this->host, $this->dbuser, $this->dbpassword, $this->dbname);
if ($this->mysqli_connection->connect_errno) {
   $this->IsConnected = FALSE;
} else {
 $this->IsConnected = true;
}
}
public function Disconnect() {
	//mysqli_free_result($this->mysqli_connection);
	$this->mysqli_connection->close();
}
public function ExecSQL($sql) {
$result = $this->mysqli_connection->query($sql);
$this->lastquery = $result;
$this->result = $result;
return $result;
}
//! Insert Data into a table
/*! Usage example: $database->InsertData("mytable","col1,col2,col3","var1,var2,var3");
 */
public function InsertData($table,$sqlcolumns,$vars) {
  $res =   $this->ExecSQL("INSERT INTO ".$table." (".$sqlcolumns.") VALUES (".$vars.")")or die (mysqli_error($this->mysqli));	

$this->mysqli_connection -> commit();
  return $res;
}
/*! \brief Fetch Data into an array.
 *         Usage example: $data = $database->FetchData("mytable","*","ORDER BY id asc");
 *
 *  foreach ($data as $row) {
 *     $username = $row['username'];
 *  }
 */
public function FetchData($table,$sqlcolumns,$selector)
{
$query = $this->ExecSQL("SELECT ".$sqlcolumns." FROM ".$table." ".$selector);


// Fetch all
return $query->fetch_array(MYSQLI_ASSOC);

}
public function FetchDataExec($table,$sqlcolumns,$selector)
{
$query = $this->ExecSql("SELECT ".$sqlcolumns." FROM ".$table." ".$selector);


// Fetch all
return $query;

}
public function Count() {
	return $this->lastquery->num_rows;
}
public function CountTable($table)
{
	$result = $this->ExecSQL("SELECT COUNT(*) AS ResultCount FROM ".$table);
	$row = $result->fetch_assoc();
	return $row['ResultCount'];

$result->close();
}

public function Mysql()
{
return $this->mysqli_connection;
}

}

class FileKit
{
private $filename;
private $content;
private $lines;
private $mode;
private $file;

	function __construct($filename,$mode) {
      	$this->filename = $filename;
      	$this->mode = $mode;
      	$this->file = fopen($filename, $mode) or die("Unable to open file!");
      	echo("fopen($filename, $mode)");
 	}
	public function SetContent($content) {
		$this->content = $content;
	}
	
	public function AddLine($line) {
		$this->content .= $line."\n";
	}
	public function Clear() {
		$this->content = "";
	}
	
	
	public function ReadFile() {
		$this->Clear();
		$this->content = file_get_contents($this->filename);
		$this->lines = file($this->filename);
		return $this->lines;
	}

	public function WriteFile() {
		
		fwrite($this->file, $this->content);
		fclose($this->file);
	}
	public function CloseFile() {
		fclose($this->file);
	}

}
class PageKit extends HTMLPage
{
	
	function __construct($title) {
      	$this->title = $title;
 	}
	

	public function LargeButton($url,$text)
	{
	echo '<a class="btn btn-primary btn-lg" href="'.$url.'" role="button">'.$text.'</a>';
	}
	public function MediumButton($url,$text)
	{
	echo '<a class="btn btn-primary btn-md" href="'.$url.'" role="button">'.$text.'</a>';
	}
	public function SmallButton($url,$text)
	{
	echo '<a class="btn btn-primary btn-sm" href="'.$url.'" role="button">'.$text.'</a>';
	}
	
}

class CryptKit extends HTMLPage
{
	public function encrypt($string, $key) {
	  $result = '';
	  for($i=0; $i<strlen ($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($key, ($i % strlen($key))-1, 1);
	    $char = chr(ord($char)+ord($keychar));
	    $result.=$char;
	  }
	
	  return base64_encode($result);
	}
	
	public function decrypt($string, $key) {
	  $result = '';
	  $string = base64_decode($string);
	
	  for($i=0; $i<strlen($string); $i++) {
	    $char = substr($string, $i, 1);
	    $keychar = substr($key, ($i % strlen($key))-1, 1);
	    $char = chr(ord($char)-ord($keychar));
	    $result.=$char;
	  }
	
	  return $result;
	}

}

class Pagination extends HTMLPage
{
function __construct($previouslink,$nextlink) {
	      	$this->title = $title;
	      	$this->description = $description;
	      	$this->InitHTML('
	      	<nav>
  		<ul class="pagination">
    		<li>
      		<a href="'.$previouslink.'" aria-label="Previous">
        		<span aria-hidden="true">&laquo;</span>
     		 </a>
    		</li>
');
		$this->FinishHTML('
		<li>
      		<a href="'.$nextlink.'" aria-label="Next">
        		<span aria-hidden="true">&raquo;</span>
      		</a>
    		</li>
  		</ul>
		</nav>
		');
	 	}
public function AddPage($link,$number,$active)
{
	if($active == true)
	{
	$this->html .= '<li class="active"><a href="'.$link.'">'.$number.'</a></li>';
	} else {
		$this->html .= '<li class="disabled"><a href="'.$link.'">'.$number.'</a></li>';
	} 	
}
}
class Accordion extends HTMLPage
{
function __construct($title,$description) {
	      	$this->title = $title;
	      	$this->description = $description;
	      	$this->InitHTML('
	      	<div class="row">
    		<div class="col-lg-12">
      		<h3 class="text-center">'.$title.'</h3>
      		<p>'.$description.'</p>
      		<ul class="timeline">');
		$this->FinishHTML('</ul></div></div>');
	 	}
}
class Timeline extends HTMLPage
{
public $title;
public $description;

	function __construct($title,$description) {
	      	$this->title = $title;
	      	$this->description = $description;
	      	$this->InitHTML('
	      	<div class="row">
    		<div class="col-lg-12">
      		<h3 class="text-center">'.$title.'</h3>
      		<p>'.$description.'</p>
      		<ul class="timeline">');
		$this->FinishHTML('</ul></div></div>');
	 	}



public function Event($imgsrc,$heading,$subtitle,$content)
{
$this->html .= '
          <div class="line"></div>
        </li>
        <li class="timeline-inverted">
          <div class="timeline-image">
            <img class="img-circle img-responsive" src="'.$imgsrc.'" alt="">
          </div>
          <div class="timeline-panel">
            <div class="timeline-heading">
              <h4>'.$heading.'</h4>
              <h4 class="subheading">'.$subtitle.'</h4>
            </div>
            <div class="timeline-body">
              <p class="text-muted">
                '.$content.'
              </p>
            </div>
          </div>
';
}

        

}


?>