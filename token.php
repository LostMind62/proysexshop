<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">

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

function gtoken() {
    return (random()+random()).substr(0,20); // Para hacer el token más largo
};

opcion = confirm(token);
    if (opcion == true) {
    	X =gtoken();
        $.ajax({
	 	url:'tokenoracle.php',
		 method:'POST',
		 data:{'token':X},
		 success: function(data) {
   		 alert(data);
    }
  });
	} else {
	    mensaje = "Has clickado Cancelar";
	}
}
</script>
<button onclick="myFunct()">Token</button>





 