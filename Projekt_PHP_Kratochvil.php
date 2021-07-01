<!DOCTYPE html>
<html>

<head>
 <!-- Required meta tags -->
 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<link href="Projekt_PHP_Kratochvil.css" rel="stylesheet" />
	<script type="text/javascript" src="Projekt_PHP_Kratochvil.js"></script>

<title>Projekt Medientechnik-Pos Kratochvil</title>

<?php
	//Funktion Rückgabe an Formular
	
	function writeback($n)
	{
		if (isset($_POST[$n]))
		{echo ($_POST[$n]);}
	}
	
	function assarrayfill(&$bergehm)
	{
		for($k=2; $k<=6; $k++)
		{
			if(!empty($_POST["berg".$k]))	
			{
			$bergehm[$_POST["berg".$k]]=$_POST["hoehm".$k];
			
			}	
		}
	}
	
	//FUNKTION SEARCH
	function search($bergehm, $s, $file)
	{
			$sucherg=array();
			$suchstring= null;
			$s=strtoupper($s);
			$l3sstring=null;
			
			$findindex=0;
				foreach($bergehm as $berg=>$hm)   
				{
					// wenn erster Buchstabe mit Suchbuchstaben übereinstimmt:
					if (strtoupper($berg[0])==$s[0])
					{
						//Wenn nur ein Buchstabe eingegeben wird
						if (strlen($s)==1)
						{
						
						//$sucherg[$berg]=$hm;
						$suchstring=$suchstring." ".$berg." ".$hm." hm ";
						
						//***** Aufruf last3Function*******
						$l3sstring=$berg."*".$hm."#";
						last3save($file, $l3sstring);			
						}
						else
						{
						$_POST["output"]="Es kann nur ein Buchstabe eingegeben werden!";
						}
						
						$findindex++;
					}			
				}
				
				//wenn kein Berg mit dem Anfbuchst gefunden wurde:
			if($findindex==0)
			{
				$_POST["output"]="Es wurde keine Übereinstimmung gefunden!";
				
			}
			else
			{
				$_POST["output"]=$suchstring;
				
			}

	}
	
// XXXXX Ende Funktion search XXXX


// XXXXX Anfang Funktion funfacts

function funfacts()
{
	//if(!isset($_POST["suchen"])&& !isset($_POST["sort"]))
	//{
	
$ff= file_get_contents("funfacts.txt");

$ffarray=  explode('#', $ff);
//print_r($ffarray);


//index variabel machen, random muss Zahl zw 0 und 9 werden
$random=(rand(0,9));
$eintrag= utf8_encode($ffarray[$random]);

//echo($eintrag);
$spliteintrag=  explode('*', $eintrag);
$title= $spliteintrag[0];
$utitle= $spliteintrag[1];
$texteintr= $spliteintrag[2];

echo ("<h3>".($title)."</h3>");
echo ("<h4>".($utitle)."</h4>");
echo ($texteintr);

//}
}

// XXXXX Ende Funktion funfacts

//XXXXX Anf Funktion Array befüllen last3save  XXXXXXX
 function last3save($file, $l3sstring)
 { 
	//File schreiben
		if(!file_exists($file))
			{
				file_put_contents($file, $l3sstring);
			}
		
		else
			{
				if(is_file($file))
					{
					file_put_contents($file, $l3sstring, FILE_APPEND);
						
					}
			}
 }

//XXXXX Ende Funktion Array befüllen last3save  XXXXXXX

//XXXXX Anf Funktion Array in Tabelle  XXXXXXX
 function tablel3write($file)
 {
	 $array= file_get_contents($file);
			
			$sparr=  explode('#', $array);
		
			$count= count($sparr);	
		if($count<=3 ) //wenn noch keine 3 vorhanden sind
			{
			echo "<table>";
			echo "<tr><th>Berg</th><th>hm</th></tr>";
			
				for($i=0; $i<($count-1); $i++)
			{
				$eintrag= ($sparr[$i]);
				
				$innerarray= explode('*', $eintrag);
				
				$a=$innerarray[0];
				$e=$innerarray[1];
				
				echo "<tr><td>$a</td><td>$e</td></tr>";
			
			}
				echo"</table>";
				
			}
			else //ab 3 Einträgen
			{
				
			echo "<table>";
			echo "<tr><th>Berg</th><th>hm</th></tr>";
			//for($i=$count-1; $i>($count-4); $i--)
			for($i=$count-4; $i<($count-1); $i++)
			{
			
				$eintrag= ($sparr[$i]);
				
				$innerarray= explode('*', $eintrag);
				
				$a=$innerarray[0];
				$e=$innerarray[1];
				
				echo "<tr><td>$a</td><td>$e</td></tr>";
			}
			echo"</table>";
			}
 }

//XXXXX Ende Funktion Array in Tabelle  XXXXXXX

//XXXXX Anf Funktion Array für Tabelle löschen XXXXXXX
function tableerase($file)
	{
		unlink($file);
	}
//XXXXX Ende Funktion Array für Tabelle löschen XXXXXXX


//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
//XXXXX Anf "Main"  XXXXXXX

// Aufruf Funfact Fenster
	$file="merkliste.txt";


if(!empty($_POST["berg1"]))

{
	$arraycount=1;
	
	$bergehm= array ($_POST["berg1"]=>$_POST["hoehm1"]);
	$sucherg=array();
	
	//Weiteres Befüllen vom array
	assarrayfill($bergehm);


// Suchfunktion aufrufen:
	if(isset($_POST["suchen"]))	
	{
		if (!empty($_POST["suchfeld"]))
		{	
			$s=$_POST["suchfeld"];
			search($bergehm, $s, $file);
		}

		
		else
		{
		$_POST["output"]="Es wurde nichts ins Suchfeld eingegeben"; 
		}
	}
}
//FUNKTION sort
function sortier($bergehm)
{
	//$bcopy= array(array());
	$i=0;
	$getauscht=true;
	$tauschhm;
	$arrlaenge=count($bergehm);
	$sostr=null;

	//Spielen des ass arrays in multidimens. Array

	foreach($bergehm as $berg=>$hm)
	{
	$bcopy[$i][0]=$berg;
	$bcopy[$i][1]=$hm;
	
	$i++;	
	}
	
if($_POST["sortart"]=="hm")
{
	// Sortieren nach hm mit bubble sort
	for($l=1; $l<$arrlaenge && $getauscht==true; $l++)
	{	
		$getauscht=false;
		for($k=0; $k<$arrlaenge-$l; $k++)
		{
			if(($bcopy[$k][1])>($bcopy[$k+1][1]))
			{
			
			$tauschhm=$bcopy[$k][1];
			$bcopy[$k][1]=$bcopy[$k+1][1];
			$bcopy[$k+1][1]=$tauschhm;
			
			$tauschhm=$bcopy[$k][0];
			$bcopy[$k][0]=$bcopy[$k+1][0];
			$bcopy[$k+1][0]=$tauschhm;
			
			$getauscht=true;
			}	
		}
	}
}

	else
	{
		//Sortieren nach Namen
		for($l=1; $l<$arrlaenge && $getauscht==true; $l++)
		{	
		$getauscht=false;
			for($k=0; $k<$arrlaenge-$l; $k++)
			{
				$u=strtoupper($bcopy[$k][0]);
				$o=strtoupper($bcopy[$k+1][0]);
				
				if($u[0]>$o[0])
				{
				
				$tauschhm=$bcopy[$k][0];
				$bcopy[$k][0]=$bcopy[$k+1][0];
				$bcopy[$k+1][0]=$tauschhm;
				
				$tauschhm=$bcopy[$k][1];
				$bcopy[$k][1]=$bcopy[$k+1][1];
				$bcopy[$k+1][1]=$tauschhm;
				
				$getauscht=true;
			
				}
			}
		}
	}	
	echo "<div id=\"sortausg\">";
	echo "<table>";
	echo "<tr><th>Berg</th><th>Hm</th></tr>";
	for($i=0; $i<$arrlaenge; $i++)
	{
		$b=$bcopy[$i][0];
		$h=$bcopy[$i][1];
		echo "<tr><td>$b</td><td>$h</td></tr>";	
	}		
	echo "</table>";
	echo "</div >";
	
}
// XXXXX Ende Funktion sort XXXX

?>
</head>

<body>
<!-- XXX Beginn Formular XXX-->
<div id=all class="container">

<div class="row">
<div class="col">

<h1>Höhenmeter Berge </h1>

<form action="<?php echo $_SERVER["SCRIPT_NAME"];?>" method="POST" name="bergform" onsubmit="return pruef()">

<label>Berg 1: <input type="text" id="b1" name="berg1"
value="
<?php //funct zurückschreiben:
writeback("berg1");
 ?>"
 /></label>
<label>hm: <input type="text" id="hm1" name="hoehm1" 
value="
<?php //funct zurückschreiben:
writeback("hoehm1");
 ?>"
/></label>
</br>

<label>Berg 2: <input type="text" id="b2" name="berg2"
value="
<?php //funct zurückschreiben:
writeback("berg2");
 ?>"
 /></label>
<label>hm: <input type="text" id="hm2" name="hoehm2"
value="
<?php //funct zurückschreiben:
writeback("hoehm2");
 ?>"
 /></label>
</br>

<label>Berg 3: <input type="text" id="b3" name="berg3" 
value="
<?php //funct zurückschreiben:
writeback("berg3");
 ?>"
/></label>
<label>hm: <input type="text" id="hm3" name="hoehm3"
value="
<?php //funct zurückschreiben:
writeback("hoehm3");
 ?>"
 /></label>
</br>

<label>Berg 4: <input type="text" id="b4" name="berg4"
value="
<?php //funct zurückschreiben:
writeback("berg4");
 ?>"
 /></label>
<label>hm: <input type="text" id="hm4" name="hoehm4"
value="
<?php //funct zurückschreiben:
writeback("hoehm4");
 ?>"
 /></label>
</br>

<label>Berg 5: <input type="text" id="b5" name="berg5"
value="
<?php //funct zurückschreiben:
writeback("berg5");
 ?>"
 /></label>
<label>hm: <input type="text" id="hm5" name="hoehm5"
value="
<?php //funct zurückschreiben:
writeback("hoehm5");
 ?>"
 /></label>
</br>

<label>Berg 6: <input type="text" id="b6" name="berg6"
value="
<?php //funct zurückschreiben:
writeback("berg6");
 ?>"
 /></label>
<label>hm: <input type="text" id="hm6" name="hoehm6"
value="
<?php //funct zurückschreiben:
writeback("hoehm6");
 ?>"
 /></label>

</br>
</div>

<div class="col">
<div>

<!--Eingabefeld Suche -->
<label id="suchfeld">Anfangsbuchstabe gesuchter Berg <input  type="text" id="suchf" name="suchfeld"
value="
<?php //Ins Suchfeld zurückschreiben
writeback("suchfeld");
 ?>"
/></label>
<!--Button suchen -->
<input id="button1" type="submit" name="suchen" value="Suchen" onclick="return suchfeldpruef()"/>
</br>

<!--Ausgabefeld Suche -->
<label id="outputfeld">Suchergebnisse: <input  type="text" id="outp" name="output" 
value="
<?php //Ausgabe in Feld
	writeback("output");
 ?>"
/></label>
</br>
</div>


<!--Ausgabefeld Sortieren -->

<div id="sort">
Berge aufsteigend sortieren nach </br>

</br>
<input type="radio" name="sortart" value="hm"
<?php //gecheckten Radiobutton zurückgeben
	if(isset($_POST["sortart"]))
	{		
		if($_POST["sortart"]=="hm")
		{echo (" checked=\"checked\"");}
	}	
	else if(!isset($_POST["sortart"]))
	{
		echo (" checked=\"checked\"");
	}	
	?>
>
Höhenmetern </br>


<input type="radio" name="sortart" value="bergname"
<?php //gecheckten Radiobutton zurückgeben
if(isset($_POST["sortart"]))
	{
 	if($_POST["sortart"]=="bergname")
		{
		echo (" checked=\"checked\"");
		}
	}
	?>
>
Namen des Berges</br>

<!--Button sortieren -->
<input id="button2" type="submit" name="sort" value="Sortieren"  />

<div>
	<?php
		// Sortierfunktion aufrufen
		 if (isset($_POST["sort"]))
		{ 	
			sortier($bergehm);
		}
	?>
</div>
</div>
</div>

<!-- Fun? Fact Fenster-->
<div id="fufafe">
<p id="fufafetitle">Fun?-Fact</p>
<?php
	funfacts();
?>
</div>

<!--Block für last3search html, Funktionsaufruf und Tabelle-->
<div id="blockl3search">

<h3>Letzte 3 Suchergebnisse</h3>
<?php
if(isset($_POST["erase"]))
{		
	if(file_exists($file))
	{
		tableerase($file);	
	}	
}

 // Aufruf der Tabelle l3search
if(file_exists($file))
{	
		tablel3write($file);
}
?>

<input id="er" name="erase" class="btn" type="submit" value="Liste leeren"/>

</form>
</div>
</div>

<!--Link für Bootstrap-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>