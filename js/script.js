function showSidenav() {
	$(".sidenav").show();
}
function hideSidenav() {
	$(".sidenav").hide();
}

$(window).on("scroll", function() {
	var y = $(window).scrollTop();

	//alert("ola");

	if(y >= $(window).height() / 3) {
			$(".menu").addClass("menu-style");
			$(".menu a").css("color", "#1c1c1c");
			$(".menu-side").css("color", "#1c1c1c");
	} else {
			$(".menu").removeClass("menu-style");
			$(".menu a").css("color", "#fff");
			$(".menu-side").css("color", "#fff");
	}
});

$("#agendar-consulta").click(function() {
	var query = window.location.search.substring(1);
	var qs = getUrlParams(query);

	if(qs.app == "1" || qs.app != null) {
		window.open("_agendar.php?app=1", "_self");
	} else {
		window.open("_agendar.php", "_self");
	}
});



//delete acount alert
$("#yes").click(function() {
	window.open("delete_acount.php", "_self");
});
$("#no").click(function() {
	$("#popup-delete-acount").hide();
});
$("#deletar-conta").click(function() {
	$("#popup-delete-acount").show();
});


$("#cadastrar-medico").click(function() {
	post("_cadastrar.php", {status: "2"});
})

//cancelar consulta
var listConsultas = []; //list of all consultas to cancel

var cancelConsulta = false;

$("#cancelar-consulta").click(function() {
	cancelConsulta = true;
	$("#agendamento-buttons").hide();
	$("#cancelamento-buttons").show();
});

$("#cancelamento-buttons #sair").click(function() {
	cancelConsulta = false;
	$("#cancelamento-buttons").hide();
	$("#agendamento-buttons").show();
	if(listConsultas.length > 0) {
		for(i = 0; i < listConsultas.length; i++) {
			$("tr#" + listConsultas[i]).css("background-color", "#FFF");
		}
		listConsultas = [];
	} 
});

$("#cancelamento-buttons #cancelar").click(function() {
	if(listConsultas.length == 0) {
		//selecione alguma consulta
	} else {
		//junta todas as ids em uma string e envia via post 	
		var idString = "";
		for (i = 0; i < listConsultas.length; i++) {
			idString += ":" + listConsultas[i] + ".-";
		}
		window.open("cancelarConsulta.php?id=" + idString, "_self");
	}
});

function cancelarConsulta(index) {
	if(cancelConsulta) {
		//ir selecionando cada um
		if(listConsultas.length > 0) {
			if(listConsultas.indexOf(index) == -1) {
				listConsultas.push(index);
				$("tr#" + (parseInt(index))).css("background-color", "#e2e2e2");
			} else {
				listConsultas.splice(listConsultas.indexOf(index), 1);
				$("tr#" + (parseInt(index))).css("background-color", "#FFFFFF");
			}
		} else {
			listConsultas.push(index);
			$("tr#" + (parseInt(index))).css("background-color", "#e2e2e2");
		}
	}
}


function doctorConsultas(id) {
	post("client-perfil.php", {doctor: id});
}

$("#back-doctor-adm").click(function() {
	window.open("client-perfil.php", "_self");
});

//return if a input in cadastrar form is empty
function cadastrarEmpty() {
	var retorno = true;
	
	var nome = $("#nome-cadastrar").val();
	var email = $("#email-cadastrar").val();
	var senha = $("#senha-cadastrar").val();
	var senha_comfirm = $("#comfirm-senha-cadastrar").val();
	
	if(nome == "" || email == "" || senha == "" || senha_comfirm == "") {
		retorno = false;
		$("#content-cadastrar #warning").html("Preencha todos os campos");
	} else {
		if(email.lastIndexOf("@") == -1 || email.length - 1 == email.lastIndexOf("@")) {
			retorno = false;
			$("#content-cadastrar #warning").html("Email invalido");
		} else {
			if(senha.length < 4) {
				retorno = false;
				$("#content-cadastrar #warning").html("A senha deve conter no minimo 4 caracteres");
			} else {
				if(senha != senha_comfirm) {
					retorno = false;
					$("#content-cadastrar #warning").html("Senha diferentes");
				}
			}
		}
	}
	
	return retorno;
}

//return if a input in logar is empty
function logarEmpty() {
	var retorno = true;
	
	var email = $("#email-logar").val();
	var senha = $("#senha-logar").val();
	
	if(email == "" || senha == "") {
		retorno = false;
		$("#content-login #warning").html("Preencha todos os campos");
	} else {
		if(email.lastIndexOf("@") == -1 || email.length - 1 == email.lastIndexOf("@")) {
			retorno = false;
			$("#content-login #warning").html("Email invalido");
		}
	}
	
	return retorno;
}


function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}

function getUrlParams(query) {
	var vars = query.split("&");
  var query_string = {};
  for (var i = 0; i < vars.length; i++) {
    var pair = vars[i].split("=");
    // If first entry with this name
    if (typeof query_string[pair[0]] === "undefined") {
      query_string[pair[0]] = decodeURIComponent(pair[1]);
      // If second entry with this name
    } else if (typeof query_string[pair[0]] === "string") {
      var arr = [query_string[pair[0]], decodeURIComponent(pair[1])];
      query_string[pair[0]] = arr;
      // If third or later entry with this name
    } else {
      query_string[pair[0]].push(decodeURIComponent(pair[1]));
    }
  }
  return query_string;
}