
var hatterszin=0xf1f1f1;
var jelenet=new THREE.Scene();
jelenet.background=new THREE.Color(hatterszin);
jelenet.fog=new THREE.Fog(hatterszin,20,120); 
var felulet=document.querySelector("#vaszon");
var renderer=new THREE.WebGLRenderer({felulet,antialias: true});
renderer.shadowMap.enabled=true;
renderer.setPixelRatio(window.devicePixelRatio);
document.body.appendChild(renderer.domElement);
var kameratavolsag=40;
var kamera=new THREE.PerspectiveCamera(50,window.innerWidth/window.innerHeight,0.1,1000);
kamera.position.z=kameratavolsag;
kamera.position.x=20; //20
kamera.position.y=8; //8

//cipő hozzáadása

var cipo;
var cipoUtvonal="modell/cipo1.glb";

//új anyag és cipő részei

var ujAnyag=new THREE.MeshPhongMaterial({color: 0xf1f1f1, shininess: 10})

var cipoReszei=[
    {childID:"talp_taban001",mtl: ujAnyag},
    {childID:"sarkantyu_arka001",mtl: ujAnyag},
    {childID:"orr_Box002",mtl: ujAnyag},
    {childID:"oldalsav_gri001",mtl: ujAnyag},
    {childID:"oldala_002",mtl: ujAnyag},
    {childID:"nyelv_dil001",mtl: ujAnyag},
    {childID:"korjobb_Circle011",mtl: ujAnyag},
    {childID:"korbal_Circle014",mtl: ujAnyag},
    {childID:"fuzo3_Arc006",mtl: ujAnyag},
    {childID:"fuzo2_Arc005",mtl: ujAnyag},
    {childID:"fuzo1_Arc004",mtl: ujAnyag},
    {childID:"diszcsik_Line002",mtl: ujAnyag},
    {childID:"belso_Object002",mtl: ujAnyag},
];

//textúra hozzáadása a cipő részeihez

function initColor(parent, type, mtl) {
  parent.traverse((cipoResz) => {
   if (cipoResz.isMesh) {
     if (cipoResz.name.includes(type)) {
          cipoResz.material = mtl;
          cipoResz.nameID = type;
       }
   }
 });
}

var betolto=new THREE.GLTFLoader();
betolto.load("modell/cipo1.glb",function(gltf){
    cipo=gltf.scene;
    cipo.traverse((arnyek)=>{
        arnyek.castShadow=true;
        arnyek.receiveShadow=true;
    });
    cipo.scale.set(1,1,1);
    cipo.position.y = -5.3;
    cipo.position.x=2; //3
    cipo.position.z=5;
    cipo.rotation.y=Math.PI; //180 foknak felel meg nem támogatja a fokot
      for (let elem of cipoReszei) {
    initColor(cipo, elem.childID, elem.mtl);
  }
    jelenet.add(cipo);
});

//fény hozzáadása

var hemiFeny = new THREE.HemisphereLight( 0xffffff, 0xffffff, 0.61 );
hemiFeny.position.set( 0, 50, 0 );
jelenet.add(hemiFeny);

var pontFeny = new THREE.DirectionalLight( 0xffffff, 0.54 );
pontFeny.position.set( -8, 12, 8); //-8, 12, 8
pontFeny.castShadow = true;
pontFeny.shadow.mapSize = new THREE.Vector2(1024, 1024);
jelenet.add(pontFeny);

//körpadló hozzáadása

var koralap=new THREE.CircleGeometry(45,128);

var koranyag= new THREE.MeshPhongMaterial({
  color: 0x565656,
  shininess: 60
    
});
var padlo=new THREE.Mesh(koralap,koranyag);
padlo.receiveShadow = false;
padlo.rotation.x = -0.5 * Math.PI;
padlo.position.y = -5;
jelenet.add(padlo);

//kamera irányítása
var mozgatas=new THREE.OrbitControls(kamera,renderer.domElement);
mozgatas.maxPolarAngle=Math.PI/2; 
mozgatas.minPolarAngle=Math.PI/3;
mozgatas.enableDamping=true;
mozgatas.enablePan=false;
mozgatas.dampingFactor=0.1;
mozgatas.autoRotate=false;
mozgatas.autoRotateSpeed=1.5;
mozgatas.maxDistance=40*(window.innerWidth/window.innerHeight); // alapérték: 60
mozgatas.minDistance=18;

function animate()
{
    mozgatas.update();
    renderer.render(jelenet,kamera);
    requestAnimationFrame(animate);
    
    if (kepernyohozIgazitas(renderer)) {
    const vaszon = renderer.domElement;
    kamera.aspect = vaszon.clientWidth / vaszon.clientHeight;
    kamera.updateProjectionMatrix();
    }
}
animate();

function kepernyohozIgazitas(renderer) {
  const vaszon = renderer.domElement;
  var szelesseg = window.innerWidth;
  var magassag = window.innerHeight;
  var vaszonSzelesseg = vaszon.width / window.devicePixelRatio;
  var vaszonMagassag = vaszon.height / window.devicePixelRatio;

  const MeretezniKell = vaszonSzelesseg !== szelesseg || vaszonMagassag !== magassag;
  if (MeretezniKell) {
    
    renderer.setSize(szelesseg, magassag, false);
  }
  return MeretezniKell;
}

//színkör

var szinKor=new iro.ColorPicker(".szinDoboz",{
  width:280,
    borderWidth:0,
    borderColor:"#fff",
    color:színrgb,
});

function szinkorMeretez()
{
    var szelesseg=window.innerWidth;
    var magassag=window.innerHeight;
    if(szelesseg<1100||magassag<600)
    {
        szinKor.resize(160);
    }
    else
        szinKor.resize(280);
}
szinkorMeretez();

//részek színének változtatása

var jelenlegi="talp_taban001";
var alapertelmezettTextura="media/textura/bor.jpg";
var jelenlegiTextura=alapertelmezettTextura;
window.onload=function()
{
    document.addEventListener("click",function(e){
        if(e.target.className=="cipoGombok")
            { 
                document.getElementById("kerekit").style.display="block";
                var opciok = document.getElementsByClassName("texturaValasztas");
                for(var i = 0; i < opciok.length; i++) {
                    if(opciok[i].style.display=="none")
                        {
                            opciok[i].style.display="flex";
                        }      
                }
                fenyesseg=10;
                document.getElementById("elrejt").style.display="block";
                document.getElementById("fehergomb").style.display="block";
                document.getElementById("kerekit").style.height="400px";
                jelenlegiTextura=alapertelmezettTextura;
                szinKor.on('color:change', onColorChange);
                jelenlegi=e.target.id;
                //"#ffffff"
                switch(jelenlegi)
                    {
                    case "talp_taban001":
                            document.getElementById("media/textura/gyapju.jpg").style.display="none";
                            document.getElementById("media/textura/kotottrombusz.jpg").style.display="none";
                            document.getElementById("media/textura/fur.jpg").style.display="none";
                            if(anyagokTomb[0]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[0];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                            else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[0]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    //szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[0];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "sarkantyu_arka001":
                            document.getElementById("media/textura/egyedi2.jpg").style.display="none";
                            document.getElementById("media/textura/farmer.jpg").style.display="none";
                            if(anyagokTomb[1]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[1];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[1]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[1];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "orr_Box002":
                            document.getElementById("media/textura/gyapju.jpg").style.display="none";
                            if(anyagokTomb[2]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[2];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[2]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[2];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "oldalsav_gri001":
                            if(anyagokTomb[3]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[3];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[3]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[3];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "oldala_002":
                            document.getElementById("media/textura/fur.jpg").style.display="none";
                            document.getElementById("media/textura/gumi.jpg").style.display="none";
                            if(anyagokTomb[4]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[4];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[4]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[4];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "nyelv_dil001":
                            document.getElementById("media/textura/gyapju.jpg").style.display="none";
                            document.getElementById("media/textura/kotottrombusz.jpg").style.display="none";
                            if(anyagokTomb[5]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[5];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura=alapertelmezettTextura;
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[5]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[5];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "korjobb_Circle011":
                            document.getElementById("kerekit").style.display="none";
                            jelenlegiTextura="media/textura/feher.jpg";
                            anyagokTomb[6]="1";
                            textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            fenyesseg=500;
                            if(szinekTomb[6]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[6];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "korbal_Circle014":
                            document.getElementById("kerekit").style.display="none";
                            jelenlegiTextura="media/textura/feher.jpg";
                            anyagokTomb[7]="1";
                            textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            fenyesseg=500;
                            if(szinekTomb[7]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[7];
                            //szinKor.off('color:change', onColorChange);
                            break;
                            
                    case "fuzo3_Arc006":
                            document.getElementById("media/textura/bor.jpg").style.display="none";
                            document.getElementById("media/textura/bronson.jpg").style.display="none";
                            document.getElementById("media/textura/bronson1.jpg").style.display="none";
                            document.getElementById("media/textura/fur.jpg").style.display="none";
                            document.getElementById("media/textura/gumi.jpg").style.display="none";
                            document.getElementById("media/textura/farmer.jpg").style.display="none";
                            document.getElementById("media/textura/egyedi2.jpg").style.display="none";
                            
                            document.getElementById("kerekit").style.height="auto";
                            if(anyagokTomb[8]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[8];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura="media/textura/gyapju.jpg";
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[8]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[8];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "fuzo2_Arc005":
                            document.getElementById("media/textura/bor.jpg").style.display="none";
                            document.getElementById("media/textura/bronson.jpg").style.display="none";
                            document.getElementById("media/textura/bronson1.jpg").style.display="none";
                            document.getElementById("media/textura/fur.jpg").style.display="none";
                            document.getElementById("media/textura/gumi.jpg").style.display="none";
                            document.getElementById("media/textura/farmer.jpg").style.display="none";
                            document.getElementById("media/textura/egyedi2.jpg").style.display="none";
                            document.getElementById("media/textura/bor.jpg").style.display="none";
                            
                            document.getElementById("kerekit").style.height="auto";
                            if(anyagokTomb[9]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[9];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura="media/textura/gyapju.jpg";
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[9]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[9];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "fuzo1_Arc004":
                            document.getElementById("media/textura/bor.jpg").style.display="none";
                            document.getElementById("media/textura/bronson.jpg").style.display="none";
                            document.getElementById("media/textura/bronson1.jpg").style.display="none";
                            document.getElementById("media/textura/fur.jpg").style.display="none";
                            document.getElementById("media/textura/gumi.jpg").style.display="none";
                            document.getElementById("media/textura/farmer.jpg").style.display="none";
                            document.getElementById("media/textura/egyedi2.jpg").style.display="none";
                            document.getElementById("media/textura/bor.jpg").style.display="none";
                            
                            
                            document.getElementById("kerekit").style.height="auto";
                            if(anyagokTomb[10]!=undefined)
                                {
                                    jelenlegiTextura=anyagokTomb[10];
                                    textura=new THREE.TextureLoader().load(jelenlegiTextura);   
                                }
                             else{
                                jelenlegiTextura="media/textura/gyapju.jpg";
                                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            }
                            if(szinekTomb[10]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[10];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    case "diszcsik_Line002":
                            document.getElementById("kerekit").style.display="none";
                            jelenlegiTextura="media/textura/feher.jpg";
                            anyagokTomb[11]="1";
                            textura=new THREE.TextureLoader().load(jelenlegiTextura);
                            fenyesseg=15;
                            if(szinekTomb[11]==null)
                                {
                                    onColorChange();
                                    szinKor.reset();
                                    szinKor.on('color:change', onColorChange);
                                }
                            szinKor.color.hexString=szinekTomb[11];
                            //szinKor.off('color:change', onColorChange);
                            break;
                    }
                //okgomb
                for(var i=0;i<11;i++)
                    {
                        if(anyagokTomb[i]==undefined)
                            {
                                document.getElementById("ok").style.display="none";
                                break;
                            }
                        else
                            document.getElementById("ok").style.display="block";
                    }
                

            }
       if(e.target.className=="texturaValasztas")
           {
               jelenlegiTextura=e.target.id;
               textura=new THREE.TextureLoader().load(jelenlegiTextura);
               onColorChange();
           }
        if(e.target.className=="fehergomb")
            {
                szinKor.reset();
            }
    });
    
}
var textura=new THREE.TextureLoader().load(jelenlegiTextura); //ezt ide ki kell rakni különben fekete villogás fogad
var texturaIsmetles=5;
var valtozott=0;
var szinekTomb=new Array(12);
var anyagokTomb=new Array(11);
var fenyesseg=10;
var szinezettAnyag;
var színek=szinKor.color.hexString;
var színrgb=szinKor.color.rgbString;
function onColorChange(){
    valtozott=texturaIsmetles;
    switch(jelenlegi)
        {
            case "talp_taban001":texturaIsmetles=5;szinekTomb[0]=színek;anyagokTomb[0]=jelenlegiTextura;break;
            case "sarkantyu_arka001": texturaIsmetles=5;szinekTomb[1]=színek;anyagokTomb[1]=jelenlegiTextura;break;
            case "orr_Box002":texturaIsmetles=1;szinekTomb[2]=színek;anyagokTomb[2]=jelenlegiTextura;break;
            case "oldalsav_gri001":texturaIsmetles=5;szinekTomb[3]=színek;anyagokTomb[3]=jelenlegiTextura;break;
            case "oldala_002":texturaIsmetles=1;szinekTomb[4]=színek;anyagokTomb[4]=jelenlegiTextura;break;
            case "nyelv_dil001":texturaIsmetles=5;szinekTomb[5]=színek;anyagokTomb[5]=jelenlegiTextura;break;
            case "korjobb_Circle011":texturaIsmetles=64;szinekTomb[6]=színek;break;
            case "korbal_Circle014":texturaIsmetles=64;szinekTomb[7]=színek;break;
            case "fuzo3_Arc006":texturaIsmetles=5;szinekTomb[8]=színek;anyagokTomb[8]=jelenlegiTextura;break;
            case "fuzo2_Arc005":texturaIsmetles=5;szinekTomb[9]=színek;anyagokTomb[9]=jelenlegiTextura;break;
            case "fuzo1_Arc004":texturaIsmetles=5;szinekTomb[10]=színek;anyagokTomb[10]=jelenlegiTextura;break;
            case "diszcsik_Line002":texturaIsmetles=64;szinekTomb[11]=színek;break;
        }
    if(texturaIsmetles!=valtozott)
        {
            textura=new THREE.TextureLoader().load(jelenlegiTextura);
        }
    
    textura.wrapS = THREE.RepeatWrapping;
    textura.wrapT = THREE.RepeatWrapping;
    textura.repeat.set( texturaIsmetles, texturaIsmetles );
    színek=szinKor.color.hexString;
    szinezettAnyag=new THREE.MeshPhongMaterial({
    color:színek,
    map:textura,
    shininess: fenyesseg
    });
    reszekValtoztatasa(cipo,jelenlegi,szinezettAnyag);
}

function reszekValtoztatasa(modell, reszei, anyag) {
  modell.traverse((o) => {
   if (o.isMesh && o.nameID != null) {
     if (o.nameID == reszei) {
          o.material = anyag;
       }
   }
 });
}
//szinKor.on('color:change', onColorChange);

//sütik szétválasztása

function mentes()
{
    document.cookie="anyagok=;expires=Thu, 18 Dec 1900 12:00:00 UTC";
    document.cookie="szinek=;expires=Thu, 18 Dec 1900 12:00:00 UTC";
    var szovegesitesAnyagok=JSON.stringify(anyagokTomb);
    var szovegesitesSzinek=JSON.stringify(szinekTomb);
    document.cookie="anyagok="+szovegesitesAnyagok;
    document.cookie="szinek="+szovegesitesSzinek;
    window.location.replace("PHP/szerkesztes_mentese.php");
}

function egySuti(snev) 
{
  var nev = snev + "=";
  var dekodol = decodeURIComponent(document.cookie);
  var suti = dekodol.split(';');
  for(var i = 0; i <suti.length; i++) 
  {
    var ertek = suti[i];
    while (ertek.charAt(0) == ' ')
    {
      ertek = ertek.substring(1);
    }
    if (ertek.indexOf(nev) == 0) 
    {
      return ertek.substring(nev.length, ertek.length);
    }
  }
}

//sütiből betöltés ha van   

var anyagvan=egySuti("anyagok");
var szinvan=egySuti("szinek");
if(anyagvan!=null&&szinvan!=null)
    {
        var anyagvanTomb=new Array();
        var szinvanTomb=new Array();
        var tiszta=anyagvan.substring(1,anyagvan.length-1);
        var szetvag=tiszta.split(",");
        for(var i=0;i<szetvag.length;i++)
            {
                anyagvanTomb[i]=szetvag[i];
            }
        tiszta=szinvan.substring(1,szinvan.length-1);
        szetvag=tiszta.split(',');
        for(var i=0;i<szetvag.length;i++)
            {
                szinvanTomb[i]=szetvag[i];
            }
        //szinekTomb=new Array();
        for(var i=0;i<szinvanTomb.length;i++)
            {
                if(szinvanTomb[i]!=null)
                    szinekTomb[i]=JSON.parse(szinvanTomb[i]);
            }
        //anyagokTomb=new Array();
        for(var i=0;i<anyagvanTomb.length;i++)
            {
                if(anyagvanTomb[i]!=null)
                    anyagokTomb[i]=JSON.parse(anyagvanTomb[i]);
                
            }
        var jelenlegiTomb=["talp_taban001","sarkantyu_arka001","orr_Box002","oldalsav_gri001","oldala_002","nyelv_dil001","korjobb_Circle011","korbal_Circle014","fuzo3_Arc006","fuzo2_Arc005","fuzo1_Arc004","diszcsik_Line002"];
        var i = 0;                     
        function megjegyez() 
        {           
        setTimeout(function () 
                   { 
        if(anyagokTomb[i]!=null&&szinekTomb[i]!=null)
            {
                jelenlegi=jelenlegiTomb[i];
                jelenlegiTextura=anyagokTomb[i];
                fenyesseg=10;
                if(anyagokTomb[i]=="1")
                    {
                        jelenlegiTextura="media/textura/feher.jpg";
                        if(jelenlegiTomb[i]=="diszcsik_Line002")
                            {
                                fenyesseg=15;
                            }
                        if(jelenlegiTomb[i]=="korjobb_Circle011"||jelenlegiTomb[i]=="korbal_Circle014")
                            {
                                fenyesseg=500;
                            }
                    }
                színek=szinekTomb[i];
                szinKor.color.hexString=szinekTomb[i];
                textura=new THREE.TextureLoader().load(jelenlegiTextura);
                onColorChange(); 
            }          
        i++;                     
        if (i < 13) {            
         megjegyez();             
        }                        
        }, 200)
        }

        megjegyez(); 
    }