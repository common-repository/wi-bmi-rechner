
	var wi_text_al = window.wi_text_al;
	var	wi_text_an = window.wi_text_an;
	var	wi_text_untergewicht = window.wi_text_untergewicht;
	var	wi_text_normalgewicht = window.wi_text_normalgewicht;
	var	wi_text_uebergewicht = window.wi_text_uebergewicht;
	var	wi_text_adipositas = window.wi_text_adipositas;
	var	wi_text_str_adipositas  = window.wi_text_str_adipositas;
	var	wi_gender=window.wi_gender;
	var	wi_ampu1=window.wi_ampu1;
	var	wi_ampu2=window.wi_ampu2;
	var wi_text_alert_no=window.wi_text_alert_no;
	var	wi_button_back=window.wi_button_back;
	var wi_language=window.wi_language;
	var wi_external_links=window.wi_external_links;

	var ampu = window.ampu;
	var bmi_tab_x = window.bmi_tab_x;
	
	if (wi_language=="de") {
		var wi_link_untergewicht = wi_text_untergewicht;
		var wi_link_normalgewicht = wi_text_normalgewicht;
		var wi_link_uebergewicht = wi_text_uebergewicht;
		var wi_link_adipositas = wi_text_adipositas;
		var wi_link_str_adipositas = wi_text_str_adipositas;
		
		if (wi_external_links == "1") {
			wi_link_untergewicht ="<a href='http://body-mass-index.org/body-mass-index-bmi-untergewicht/' title='Informationen zu Untergewicht' onclick=\"this.target='_blank'\">"+wi_text_untergewicht+"</a>";
			wi_link_normalgewicht = wi_text_normalgewicht;
			wi_link_uebergewicht ="<a href='http://body-mass-index.org/body-mass-index-bmi-uebergewicht/' title='Informationen zu &Uuml;bergewicht' onclick=\"this.target='_blank'\">"+wi_text_uebergewicht+"</a>";
			wi_link_adipositas ="<a href='http://body-mass-index.org/body-mass-index-bmi-adipositas/' title='Informationen zu Adipositas' onclick=\"this.target='_blank'\">"+wi_text_adipositas+"</a>";
			wi_link_str_adipositas ="<a href='http://body-mass-index.org/body-mass-index-bmi-adipositas/' title='Informationen zu Adipositas' onclick=\"this.target='_blank'\">"+wi_text_str_adipositas+"</a>";
		}
	
	var bmi_e_tab= new Array();
	bmi_e_tab[0] = wi_text_an+" "+ wi_link_untergewicht +".";
	bmi_e_tab[1] = wi_text_an+" "+wi_link_normalgewicht +".";
	bmi_e_tab[2] = wi_text_an+" "+wi_link_uebergewicht+".";
	bmi_e_tab[3] = wi_text_an+" "+wi_link_adipositas +".";
	bmi_e_tab[4] = wi_text_an+" "+wi_link_str_adipositas+".";
	}
	
	if (wi_language=="en") {
	var bmi_e_tab= new Array();
	bmi_e_tab[0] = wi_text_an+" "+wi_text_untergewicht+".";
	bmi_e_tab[1] = wi_text_an+" "+wi_text_normalgewicht;
	bmi_e_tab[2] = wi_text_an+" "+wi_text_uebergewicht+".";
	bmi_e_tab[3] = wi_text_an+" "+wi_text_adipositas+".";
	bmi_e_tab[4] = wi_text_an+" "+wi_text_str_adipositas+".";	
	}



function checkBMI(form)
{
	var groesse 	= form.groesse.value;
	var gewicht 	= form.gewicht.value;
	
	if(document.getElementById("geschlecht"))
		var geschlecht 	= form.geschlecht.selectedIndex;
	else
		var geschlecht 	= 0;
	
	
	if(document.getElementById("ampu1"))
		var ampu1 		= form.ampu1.selectedIndex;
	else 
		var ampu1 		= 0;
		
	if(document.getElementById("ampu2")) 
		var ampu2 		= form.ampu2.selectedIndex;
	else
		var ampu2		= 0;
	
	gewicht = gewicht.replace(",",".");
	gewicht = gewicht.replace(",",".");
	var def1=1;
	var def2=1;
	def1=1 - ampu[ampu1];
	def2=1 - ampu[ampu2];
	gewicht=gewicht / def1;
	gewicht=gewicht / def2 ;
	gewicht=Math.round( gewicht * 100 ) / 100;
	
	var groesse2=groesse * groesse / 100 / 100;
	var	meinbmi=gewicht / groesse2;
	var meinbmi = Math.round( meinbmi * 100 ) / 100;
	
	if (groesse=="" || gewicht=="" )  {
		alert(unescape(wi_text_alert_no));		
	}
	
	if (groesse!="" && gewicht !="") {
	for (var i = 0; i < bmi_tab_x.length; i++) {
		if (geschlecht==1){
			wert=bmi_tab_x[i] -1;
		} else {
			wert=bmi_tab_x[i];	
		}
		if (meinbmi>wert) {
			var test =bmi_e_tab[i]	
		}	
	}
			
		document.getElementById("bmimain_content").style.display = "none";
		document.getElementById("bmiergebnis").style.display = "block";
		document.getElementById("bmiergebnis").innerHTML="<p><b>"+wi_text_al+": "+meinbmi+"</b></p><p>"+ test +"</p><button type='button' onclick='returnBMI()'>"+wi_button_back+"</button><br /><br />" ;

	}
}

function returnBMI()
{
		document.getElementById("bmiergebnis").style.display = "none";
		document.getElementById("bmimain_content").style.display = "block";	
}