function offColumn(){


	columns = [
		document.getElementsByClassName("gid"),
		document.getElementsByClassName("nombre"),
		document.getElementsByClassName("email"),
		document.getElementsByClassName("fecha"),
		document.getElementsByClassName("descripcion"),
		document.getElementsByClassName("direccion"),
		document.getElementsByClassName("barrio"),
		document.getElementsByClassName("numerocomuna")
	];

	checks = [
		document.getElementById("fechaCheck"),
		document.getElementById("horaCheck"),
		document.getElementById("veloCheck"),
		document.getElementById("radCheck"),
		document.getElementById("tempCheck"),
		document.getElementById("dirCheck"),
		document.getElementById("barCheck"),
		document.getElementById("comCheck")
	];


	for (j = 0; j< 8; j++) {
		column=columns[j];
		checkBox=checks[j];

		for (i = 0; i < column.length; i++) {

			if (checkBox.checked == true){
		    	column[i].style.display = "table-cell";
		  	} else {
		    	column[i].style.display = "none";
		 	}
		};


		
	};

};