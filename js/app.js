class Tarea {
	constructor(tarea, hora) {
		this.tarea = tarea;
		this.hora = hora;
	}
}
class UI {
	addTarea(tarea) {
		const listaTareas = document.querySelector("#lista");
		const elemento = document.createElement("li");
		elemento.className = "animation-li list-group-item justify-content-between";
		elemento.setAttribute("name", "item");
		elemento.innerHTML = ` <span name="tarea">${tarea.tarea}</span> <span name= "hora">${tarea.hora}</span>`
		listaTareas.appendChild(elemento);
	}
	deleteTarea(elemento, postData) {
		elemento.remove();
		this.showMessage("Tarea completada!", "success");
		 const url = "tasks-delete.php";
			$.post(url, postData, function(response){
				 console.log(response);
			});
	 }
	

	loadTareas() {
		let tareas = [];
		fetch('tasks-list.php/') //
			.then(res => {
				return res.json();
			})
			.then(data => {
				for (var i in data) {
					tareas.push(data[i]);
				}
				tareas.forEach(element => {
					this.addTarea(element);
				})
			})
	}
	saveTareas(postData){
			// console.log(postData);
			const url = "tasks-add.php/";
			$.post(url, postData, function(response){
				// console.log(response);
			});
			this.resetForm();		
	 }
	resetForm() {
		document.querySelector("#organizador").reset();
	}
	showMessage(message, cssClass) {
		const div = document.createElement("div");
		div.className = `animation alert alert-${cssClass} mt-3`
		div.appendChild(document.createTextNode(message));
		const contenedor = document.querySelector('#contenedor');
		const app = document.querySelector("#organizador");
		contenedor.insertBefore(div, app);
		setTimeout(function () {
			document.querySelector('.alert').remove();
		}, 2800);
	}
}

//DOM EVENTS
(function(){
	const loader = new UI();
	loader.loadTareas();
})();

document.querySelector("#lista").addEventListener("click", function (e) {
	if (e.target.tagName === "LI") {
		const ui = new UI();
		let tarea = e.target.children[0].innerHTML
		let hora = e.target.children[1].innerHTML
		let data = {tarea : tarea, hora: hora}

		ui.deleteTarea(e.target, data);
	}
	if (e.target.tagName === "SPAN") {
		const ui = new UI();
		let tarea = e.target.parentElement.children[0].innerHTML;
		console.log(tarea)
		let hora = e.target.innerHTML;
		let data = {tarea: tarea, hora: hora}
		ui.deleteTarea(e.target.parentElement, data);
	}
})
document.querySelector("#organizador").addEventListener("submit", function (e) {
	const texto = document.querySelector("#tarea").value;
	const hora = document.querySelector("#hora").value;
	const tarea = new Tarea(texto, hora);
	const ui = new UI();
			if (texto === '') {
		ui.showMessage("Escribí primero una tarea", "danger");

	}
	else {
		ui.addTarea(tarea);
		ui.showMessage("Tarea agregada!", "secondary");
		ui.saveTareas(tarea);

	}
	e.preventDefault();
	
});


if (getCookie("modalShow") != "1"){
	$(window).on('load', function () {
		$('#myModal').modal('show');
	});
    setCookie("modalShow","1", 7);
}

function setCookie(strName, strValue, expireDays) {
    var d = new Date();
    d.setTime(d.getTime() + (expireDays * 604800000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = strName + "=" + strValue + "; " + expires + "; path=/";
}

function getCookie(strName) {
    var name = strName + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
}
