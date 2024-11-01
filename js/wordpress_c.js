
	var wi_c_text_al = window.wi_c_text_al;
	var	wi_c_text_an = window.wi_c_text_an;
	var	wi_c_text_untergewicht = window.wi_c_text_untergewicht;
	var	wi_c_text_normalgewicht = window.wi_c_text_normalgewicht;
	var	wi_c_text_uebergewicht = window.wi_c_text_uebergewicht;
	var	wi_c_text_adipositas = window.wi_c_text_adipositas;
	var	wi_c_text_str_adipositas  = window.wi_c_text_str_adipositas;
	var	wi_c_gender=window.wi_c_gender;
	var	wi_c_ampu1=window.wi_c_ampu1;
	var	wi_c_ampu2=window.wi_c_ampu2;
	var wi_text_alert_no=window.wi_text_alert_no;
	var	wi_button_back=window.wi_button_back;
	var wi_language=window.wi_language;
	var wi_c_external_links=window.wi_external_links;

	var ampu = window.ampu;
	var kind= window.kind; 
	
	
	if (wi_language=="de") {
		var wi_c_link_untergewicht = wi_c_text_untergewicht;
		var wi_c_link_normalgewicht = wi_c_text_normalgewicht;
		var wi_c_link_uebergewicht = wi_c_text_uebergewicht;
		var wi_c_link_adipositas = wi_c_text_adipositas;
		var wi_c_link_str_adipositas = wi_c_text_str_adipositas;
		
		if (wi_c_external_links == "1") {
			wi_c_link_untergewicht ="<a href='http://body-mass-index.org/body-mass-index-bmi-untergewicht/' title='Informationen zu Untergewicht' onclick=\"this.target='_blank'\">"+wi_c_text_untergewicht+"</a>";
			wi_c_link_normalgewicht = wi_c_text_normalgewicht;
			wi_c_link_uebergewicht ="<a href='http://body-mass-index.org/body-mass-index-bmi-uebergewicht/' title='Informationen zu &Uuml;bergewicht' onclick=\"this.target='_blank'\">"+wi_c_text_uebergewicht+"</a>";
			wi_c_link_adipositas ="<a href='http://body-mass-index.org/body-mass-index-bmi-adipositas/' title='Informationen zu Adipositas' onclick=\"this.target='_blank'\">"+wi_c_text_adipositas+"</a>";
			wi_c_link_str_adipositas ="<a href='http://body-mass-index.org/body-mass-index-bmi-adipositas/' title='Informationen zu Adipositas' onclick=\"this.target='_blank'\">"+wi_c_text_str_adipositas+"</a>";
		}
	
	var bmi_e_tab_text= new Array();
	bmi_e_tab_text[0] = wi_c_text_an+" "+ wi_c_link_untergewicht +".";
	bmi_e_tab_text[1] = wi_c_text_an+" "+wi_c_link_normalgewicht +".";
	bmi_e_tab_text[2] = wi_c_text_an+" "+wi_c_link_uebergewicht+".";
	bmi_e_tab_text[3] = wi_c_text_an+" "+wi_c_link_adipositas +".";
	bmi_e_tab_text[4] = wi_c_text_an+" "+wi_c_link_str_adipositas+".";
	}
	
	if (wi_language=="en") {
	var bmi_e_tab_text= new Array();
	bmi_e_tab_text[0] = wi_c_text_an+" "+wi_c_text_untergewicht+".";
	bmi_e_tab_text[1] = wi_c_text_an+" "+wi_c_text_normalgewicht;
	bmi_e_tab_text[2] = wi_c_text_an+" "+wi_c_text_uebergewicht+".";
	bmi_e_tab_text[3] = wi_c_text_an+" "+wi_c_text_adipositas+".";
	bmi_e_tab_text[4] = wi_c_text_an+" "+wi_c_text_str_adipositas+".";	
	}

function checkBMIc(form)
{
	var groesse 	= form.c_groesse.value;
	var gewicht 	= form.c_gewicht.value;
	var geschlecht 	= form.c_geschlecht.selectedIndex;
	var alter 		= form.c_alter.selectedIndex;

	if(document.getElementById("c_ampu1"))
		var ampu1 		= form.c_ampu1.selectedIndex;
	else 
		var ampu1 		= 0;
		
	if(document.getElementById("c_ampu2")) 
		var ampu2 		= form.c_ampu2.selectedIndex;
	else
		var ampu2		= 0;
	
	gewicht = gewicht.replace(",",".");
	gewicht = gewicht.replace(",",".");
	
	if (groesse=="" || gewicht=="" )  {
		alert(unescape(wi_text_alert_no));	
	}
	
	var def1=1;
	var def2=1;
	def1=1 - ampu[ampu1];
	def2=1 - ampu[ampu2];
	gewicht=gewicht / def1;
	gewicht=gewicht / def2 ;

	if (groesse!="" && gewicht !="") {
	var groesse2=groesse * groesse / 100 / 100;
	var	meinbmi=gewicht / groesse2;
	var meinbmi = Math.round( meinbmi * 100 ) / 100;
		
		
	var myarray=kind[geschlecht][alter+1];
		for (var i = 0; i < myarray.length; i++) {
			var wert=myarray[i];
			if (meinbmi>=wert) {
				var test =bmi_e_tab_text[i+1]	;
			}	

			if (test) {

			} else {
				if (meinbmi<wert) var test=bmi_e_tab_text[0];
				if (meinbmi>wert) var test=bmi_e_tab_text[3];	
			}
		}
		
		document.getElementById("c_bmimain_content").style.display = "none";
		document.getElementById("c_bmiergebnis").style.display = "block";
		document.getElementById("c_bmiergebnis").innerHTML="<p><b>"+wi_c_text_al+": "+meinbmi+"</b></p><p>"+ test +"</p><button type='button' onclick='returnBMIc()'>"+wi_button_back+"</button><br /><br />" ;
	}
	
}

function returnBMIc()
{
		document.getElementById("c_bmiergebnis").style.display = "none";
		document.getElementById("c_bmimain_content").style.display = "block";
}