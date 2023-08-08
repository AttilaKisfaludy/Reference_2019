
function sotet()
{
    var menu=document.getElementById("savmenu");
    var bmenu=document.getElementById("balmenu");
    var atvalt=document.getElementById("atvaltas");
    if(document.getElementById("sotetVilagos").alt=="Sötét Mód")
        {
            document.getElementById("sotetVilagos").src="media/ikonok/sotet_le.png";
            document.getElementById("sotetVilagos").alt="Világos Mód";
            document.getElementById("sotetVilagos").title="Világos Mód";
            menu.className=menu.className.replace("w3-white","");
            bmenu.className=bmenu.className.replace("w3-white","");
            atvalt.className+="atvalt";
            document.getElementById("menujel").style.color="white";
            document.getElementById("kepvalt").src="media/ikonok/menujel_feher.png";
            document.getElementById("kepvalt2").src="media/ikonok/menujel_feher.png";
            document.getElementById("menukapcsolo").style.backgroundColor="black";
            document.getElementById("menukapcsolo").style.color="white";
            document.getElementById("udvozol").style.color="white";
            document.getElementById("logokep").style.background="linear-gradient(white 10px,gray 30px)";
            document.getElementById("logokep").className+=" w3-border";
            document.getElementById("reg").style.backgroundColor="grey";
            document.getElementById("bej").style.backgroundColor="grey";

            
        }
    else
        {
            document.getElementById("sotetVilagos").src="media/ikonok/sotet_fel.png";
            document.getElementById("sotetVilagos").alt="Sötét Mód";
            document.getElementById("sotetVilagos").title="Sötét Mód";
            menu.className += " w3-white";
            bmenu.className += " w3-white";
            atvalt.className=atvalt.className.replace("atvalt","");
            document.getElementById("menujel").style.color="black";
            document.getElementById("kepvalt").src="media/ikonok/menujel.png";
            document.getElementById("kepvalt2").src="media/ikonok/menujel.png";
            document.getElementById("menukapcsolo").style.backgroundColor="#f1f1f1";
            document.getElementById("menukapcsolo").style.color="black";
            document.getElementById("udvozol").style.color="black";
            document.getElementById("logokep").style.background="none";
            document.getElementById("logokep").className=document.getElementById("logokep").className.replace("w3-border","");
            document.getElementById("reg").style.backgroundColor="lightgrey";
            document.getElementById("bej").style.backgroundColor="lightgrey";

        }
}
//gördülőmenü//
var kapcsolo=true;
function gordulomenu()
{
    if(kapcsolo)
        {
            document.getElementById("menukapcsolo").style.display="block";
            document.getElementById("felhasznalo").src="media/ikonok/felhasznalo_aktiv.png";
            kapcsolo=false;
        }
    else if(kapcsolo==false)
        {
            document.getElementById("menukapcsolo").style.display="none";
            document.getElementById("felhasznalo").src="media/ikonok/felhasznalo_inaktiv.png";
            kapcsolo=true;
        }
}

//regisztráció és bejelentkezés//
function regmenu()
{
    if(document.getElementById("bej").style.display=="block")
        {
            document.getElementById("bej").style.display="none";
        }
    if(document.getElementById("reg").style.display=="block")
        {
            document.getElementById("reg").style.display="none";
            document.getElementById("dinamikus_eltunes").style.display="block";
        }
    else
        {
            document.getElementById("dinamikus_eltunes").style.display="none";
            document.getElementById("reg").style.display="block";
        }
}
function bejmenu()
{
    if(document.getElementById("reg").style.display=="block")
        {
            document.getElementById("reg").style.display="none";
        }
    if(document.getElementById("bej").style.display=="block")
        {
            document.getElementById("bej").style.display="none";
            document.getElementById("dinamikus_eltunes").style.display="block";
        }
    else
        {
            document.getElementById("dinamikus_eltunes").style.display="none";
            document.getElementById("bej").style.display="block";
        }
}
//telefonmenu
function legorduloTelefon() {
    var menu = document.getElementById("telmenuelrejt");
    var menu2=document.getElementById("telregmenurejt");
    if (menu.className.indexOf("w3-show") == -1) 
    {
        menu.className += " w3-show";
        menu2.className=menu2.className.replace("w3-show","");
        document.getElementById("menuvalt").src="media/ikonok/nyilmenu.png";
        document.getElementById("ikoncsere").src="media/ikonok/felhasznalo_inaktiv.png";
        document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
        document.getElementById("telmenu").style.borderBottomRightRadius="0px";
    } 
    else 
        {
            menu.className = menu.className.replace(" w3-show", "");
            document.getElementById("menuvalt").src="media/ikonok/menu.png";
            document.getElementById("ikoncsere").src="media/ikonok/felhasznalo_inaktiv.png";
            document.getElementById("telmenu").style.borderBottomLeftRadius="25px";
            document.getElementById("telmenu").style.borderBottomRightRadius="25px";
        }

}

function telRegmenu()
{
    var menu = document.getElementById("telregmenurejt");
    var menu2=document.getElementById("telmenuelrejt");
    if (menu.className.indexOf("w3-show") == -1) 
    {
        menu.className += " w3-show";
        menu2.className=menu2.className.replace("w3-show","");
        document.getElementById("ikoncsere").src="media/ikonok/felhasznalo_aktiv.png";
        document.getElementById("menuvalt").src="media/ikonok/menu.png";
        document.getElementById("telmenu").style.borderBottomLeftRadius="0px";
        document.getElementById("telmenu").style.borderBottomRightRadius="0px";
    } 
    else 
        {
            menu.className = menu.className.replace(" w3-show", "");
            document.getElementById("ikoncsere").src="media/ikonok/felhasznalo_inaktiv.png";
            document.getElementById("menuvalt").src="media/ikonok/menu.png";
            document.getElementById("telmenu").style.borderBottomLeftRadius="25px";
            document.getElementById("telmenu").style.borderBottomRightRadius="25px";
        }
}
function telReglenyilo()
{
  var lenyilo = document.getElementById("regtel");
  var lenyilo2 = document.getElementById("bejtel");
  var atlatszo=document.getElementById("telregmenurejt");
  if (lenyilo.className.indexOf("w3-show") == -1) 
  {
      lenyilo2.className = lenyilo2.className.replace(" w3-show", "");
      atlatszo.className = atlatszo.className.replace(" attetszo", "");
    lenyilo.className += " w3-show";
  } 
    else 
    {
    atlatszo.className+=" attetszo";
    lenyilo.className = lenyilo.className.replace(" w3-show", "");
        
  }
}
function telBejlenyilo()
{
  var lenyilo = document.getElementById("bejtel");
  var lenyilo2 = document.getElementById("regtel");
  var atlatszo=document.getElementById("telregmenurejt");
  if (lenyilo.className.indexOf("w3-show") == -1) 
  {
    lenyilo.className += " w3-show";
    lenyilo2.className = lenyilo2.className.replace(" w3-show", "");
    atlatszo.className = atlatszo.className.replace(" attetszo", "");
  } else 
  { 
    lenyilo.className = lenyilo.className.replace(" w3-show", "");
    atlatszo.className+=" attetszo";
  }
}

function menujelzes()
{
    document.getElementById("menujel").style.display="none";
}
function menujelvissza()
{
    document.getElementById("menujel").style.display="block";
}
