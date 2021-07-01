

function pruef()
{
	//Eingabeprüfung b1, hm1, suchf
	//Eingabeprüfung berg1 name b1 - nicht leer
	
	var b=document.forms["bergform"]["berg1"].value;
	
	if(b=="") 
	{
		alert("Das Feld Berg 1 muss ausgefüllt sein");
		return false;
	}

	
	//Eingabeprüfung berg1 höhenmeter hm1 - nicht leer und schon Zahl
	
	var h1=document.forms["bergform"]["hoehm1"].value;
	if(h1=="")
	{
		alert("Das Feld Berg 1-hm: muss ausgefüllt sein");
		return false;
	}
	
	else
	{
		if(isNaN(h1))
			{
				alert("Sie müssen eine Zahl ins Feld hm 1 eingeben");	
				 return false;
			}
		else
		{
			if(h1<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 1 eingeben");	
			return false;
			}
		}
	}
	
	//Eingabeprüfung berg2 höhenmeter hm2 - ist Zahl wenn ausgefüllt
	var h2=document.forms["bergform"]["hoehm2"].value;
	if(!h2=="")
	{
		if(isNaN(h2))
			{
				alert("Sie müssen eine Zahl ins Feld hm 2 eingeben");			
				 return false;
			}
		else
		{
			if(h2<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 2 eingeben");	
			return false;
			}
		}
			
	}
	
	
	//Eingabeprüfung berg3 höhenmeter hm3 - ist Zahl wenn ausgefüllt
	var h3=document.forms["bergform"]["hoehm3"].value;
	if(!h3=="")
	{
		if(isNaN(h3))
			{
				alert("Sie müssen eine Zahl ins Feld hm 3 eingeben");	
				 return false;
			}
		else
		{
			if(h3<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 3 eingeben");	
			return false;
			}
		}
	}
	
	//Eingabeprüfung berg4 höhenmeter hm4 - ist Zahl wenn ausgefüllt
	var h4=document.forms["bergform"]["hoehm4"].value;
	if(!h4=="")
	{
		if(isNaN(h4))
			{
				alert("Sie müssen eine Zahl ins Feld hm 4 eingeben");	
				 return false;
			}
		else
		{
			if(h4<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 4 eingeben");	
			return false;
			}
		}
	}
	
	//Eingabeprüfung berg5 höhenmeter hm5 - ist Zahl wenn ausgefüllt
	var h5=document.forms["bergform"]["hoehm5"].value;
	if(!h5=="")
	{
		if(isNaN(h5))
			{
				alert("Sie müssen eine Zahl ins Feld hm 5 eingeben");	
				 return false;
			}
		else
		{
			if(h5<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 5 eingeben");	
			return false;
			}
		}
	}
	
	//Eingabeprüfung berg4 höhenmeter hm6 - ist Zahl wenn ausgefüllt
	var h6=document.forms["bergform"]["hoehm6"].value;
	if(!h6=="")
	{
		if(isNaN(h6))
			{
				alert("Sie müssen eine Zahl ins Feld hm 6 eingeben");	
				 return false;
			}
		else
		{
			if(h6<0)
			{
			alert("Sie müssen eine positive Zahl ins Feld hm 6 eingeben");	
			return false;
			}
		}
	}
}
//methode pruef ende

//Eingabeprüfung suchfeld - nur ein Buchstabe
	
function suchfeldpruef()
{
    var s=document.forms["bergform"]["suchf"].value;
    
    if(s=="")
        {
        alert("Das Suchfeld muss ausgefüllt sein");
        return false;
        }
    else
    {
        if(s.length > 1)
        {
        alert("Nicht mehr als einen Buchstaben eingeben");	
        return false;
        }
    }
}
	
	
