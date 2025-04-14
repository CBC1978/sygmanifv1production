

//$(document).ready(function () {
//console.log("chargement de codeJQuery");

var nombre_ligne = 0;
var nb_ligne = 0;

//$(document).on("click", "#btnAfficherNew", function (e) {
function Ajouter_ligne() {
    var m_tbody = document.getElementById("m_tbody");
    ++nombre_ligne;

    var tr = document.createElement('tr');
    tr.id = "ligne" + nombre_ligne;

    var td0 = document.createElement('td');
    td0.innerHTML = nombre_ligne;
  
	
    //input pour la prestation
	
	var td2 = document.createElement('td');
	var select_idprod = document.createElement('select');
    select_idprod.name = "idprod[]";
    select_idprod.id = "idprod" + nombre_ligne;
	select_idprod.setAttribute("required", "required");
	//select_idpresta.setAttribute("onmouseout", "Prester(" + nombre_ligne + ")");
    var option_idprod = document.createElement('option');
    option_idprod.innerHTML = "Veuillez choisir le nom du Produit";
    select_idprod.appendChild(option_idpresta);

    var i = 0;
    for (i = 0; i < idprod.length; i++) {
        option_idprod = document.createElement('option');
        option_idprod.innerHTML = nomprod[i];
        option_idprod.value = idprod[i];
		select_idprod.appendChild(option_idprod);
    }
	td2.appendChild(select_idprod);
	
	//-------------------
	
	   
    //bouton supprimer
    var td8 = document.createElement('td');
    var button_supprimer = document.createElement('input');
    button_supprimer.type = "button";
    button_supprimer.value = "Supprimer";
    button_supprimer.setAttribute("onclick", "retirerLigne(" + nombre_ligne + ")");
    td8.appendChild(button_supprimer);


    //on ajoute les td au tr
    tr.appendChild(td0);
   // tr.appendChild(td1);
	
    tr.appendChild(td2);
   
  
	// tr.appendChild(td7);
    tr.appendChild(td8);

    //on ajoute le tr � la table
    m_tbody.appendChild(tr);
	kkkk.disabled=false;
		
       }
// });
function VerifierSaisie(numero){
//var ligneAretirer = document.getElementById('ligne' + numero);
 var filiere=document.getElementById('idfiliere' + numero).value;
 //=document.getElementById("idfiliere").value;
var Codefiliere=filiere.substring(0,6);
if (isNaN(Codefiliere) == true)
{
	alert('filiere n\'est pas dans la nomenclature des produits - Veuillez Ressaisir');
	document.getElementById('idfiliere').focus(); return;
}

}

function Ajouter_lignem(champ) {

    var m_tbody = document.getElementById("m_tbody");
    ++nb_ligne;

    var tr = document.createElement('tr');
    tr.id = "ligne" + nb_ligne;

    var td0 = document.createElement('td');
    td0.innerHTML = nb_ligne;
    //var td1 = document.createElement('td');

	///////////////////////////////////
    var td2 = document.createElement('td');
	var select_idprod = document.createElement('select');
    select_idprod.name = "idprod[]";
    select_idprod.id = "iddprod" + nb_ligne;
	select_idprod.setAttribute("required", "required");
	select_idprod.setAttribute("onchange", "ModifierLignem(" + nb_ligne + ")");
    var option_idprod = document.createElement('option');
    option_idprod.innerHTML = "Veuillez choisir le nom du produit";
    select_idprod.appendChild(option_idprod);

    var i = 0;
    for (i = 0; i < idprod.length; i++) {
        option_idprod = document.createElement('option');
        option_idprod.innerHTML = nomprod[i];
        option_idprod.value = idprod[i];
		select_idprod.appendChild(option_idprod);
    }
	td2.appendChild(select_idprod);	
  

	 //bouton supprimerglyphicon glyphicon-minus
    var td8 = document.createElement('td');
    var button_supprimer = document.createElement('input');
    button_supprimer.type = "button";
    button_supprimer.value = "Supprimer";
	//button_supprimer.setAttribute('class', 'glyphicon glyphicon-minus');
    button_supprimer.setAttribute("onclick", "retirerLignem(" + nb_ligne + ")");
    td8.appendChild(button_supprimer);

    //bouton etat 

    var td9 = document.createElement('td');
    var text_description = document.createElement('input');
    text_description.type = "hidden";
    text_description.id = "etat" + nb_ligne;
    text_description.name = "etat[]";
    text_description.value = champ;

    
    // text_description.setAttribute("placeholder","Entrer le volume");
    td9.appendChild(text_description);
    //bouton numero d'ordre
    var td10 = document.createElement('td');
    var text_description = document.createElement('input');
    text_description.type = "hidden";
    text_description.id = "numeroter" + nb_ligne;
    text_description.name = "numeroter[]";
    td10.appendChild(text_description);

    //on ajoute les td au tr
    tr.appendChild(td0);
    tr.appendChild(td2);

    tr.appendChild(td8);
    tr.appendChild(td9);
    tr.appendChild(td10);
    
    //on ajoute le tr � la table
    m_tbody.appendChild(tr);
}

function changerNumeroOrdre()
{
    var tbody_lot = document.getElementById('m_tbody');
    var children = tbody_lot.childNodes;
    var cellule = new Array();
    var j = 0;
    for (var i = 0, c = children.length; i < c; i++) {
        if (children[i].nodeType === 1 && children[i].style.display != 'none') { // C'est pas un �l�ment HTML
            if (children[i].firstElementChild.nodeType === 1) {
                cellule[j] = children[i].firstElementChild;
                j++;
            }
        }
    }

    var i = 0;
    while (i < j)
    {
        cellule[i].innerHTML = ++i;
    }
}

function changerNumeroOrdrem()
{
    var tbody_lot = document.getElementById('m_tbody');
    var children = tbody_lot.childNodes;
    var cellule = new Array();
    var j = 0;
    for (var i = 0, c = children.length; i < c; i++) {
        if (children[i].nodeType === 1 && children[i].style.display != 'none') { // C'est pas un �l�ment HTML
            if (children[i].firstElementChild.nodeType === 1) {
                cellule[j] = children[i].firstElementChild;
                j++;
            }
        }
    }

    var i = 0;
    while (i < j)
    {
        cellule[i].innerHTML = ++i;
    }
}


function retirerLigne(numero) {
    var ligneAretirer = document.getElementById('ligne' + numero);
    document.getElementById('m_tbody').removeChild(ligneAretirer);
    changerNumeroOrdre();
    --nombre_ligne;
}
function retirerLignem(numero) {
    var ligneAretirer = document.getElementById('ligne' + numero);
    //document.getElementById('my_tbody').removeChild(ligneAretirer);
    document.getElementById('etat' + numero).value = 'S';
    document.getElementById('ligne' + numero).style.display = 'none';
    //changerNumeroOrdrem();
    //--nb_ligne;

}
function ModifierLignem(numero) {
    var ligneAretirer = document.getElementById('ligne' + numero);
    //document.getElementById('my_tbody').removeChild(ligneAretirer);
    document.getElementById('etat' + numero).value = 'M';
    //document.getElementById('ligne'+numero).style.display='none';
    //changerNumeroOrdrem();
    //--nb_ligne;

}


/*
function Presta(numero){
	var Vidpresta = document.getElementById('idpresta' + numero);
				
			
	var Vprix = document.getElementById('prixunitaire' + numero);
	var i=0; j=1;
	while (i < idprestation.length and j==1) {
	if (idprestation==Vidpresta) Vprix.value=prixprestation;
	i++;
	j=5;} 
				
	} */


//});
