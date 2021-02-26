// <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

function generatetoken() {
function random() {
    return Math.random().toString(36).substr(2); 
};

function token() {
    return random() ; // Para hacer el token más largo
};
return JSON.stringify(token());
}

function myFunct() {


    var token;
     $.ajax({
	 	url:'gettoken.php',
	 	async: false,
		 success: function(data) {
   		token= JSON.stringify(data);
    }
  });


function random() {
    return Math.random().toString(36).substr(2); // Eliminar `0.`
};

function token() {
    return random() ; // Para hacer el token más largo
};
opcion = confirm(token);
    if (opcion == true) {
        $.ajax({
	 	url:'tokenoracle.php',
		 method:'POST',
		 data:{'token':token()},
		 success: function(data) {
   		 alert(data);
    }
  });
	} else {
	    mensaje = "Has clickado Cancelar";
	}
}






 