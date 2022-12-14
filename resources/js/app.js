require('./bootstrap');

require('./a-metodo-rest-laravel');

require('./input-numero-mas-menos');

require('./mantener-relacion-alto');

require('sweetalert');

require('lity');

require('bootstrap-toggle');

require('select2');

//codigos generales

$(function(){
	//resaltar elemento activo del menú
	var url = window.location;
	// Will only work if string in href matches with location
	$('ul.nav a[href="'+ url +'"]').parent().addClass('active');

	// Will also work for relative and absolute hrefs
	$('ul.nav a').filter(function() {
	    return this.href == url;
	}).parent().addClass('active');

	// for treeview
	$('ul.treeview-menu a').filter(function() {
		return this.href == url;
	}).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

	
	//confirmar eliminar
	$('.axys-confirmar-eliminar').click(function(e) {
		var anchor=$(this); //para pasarle al closure

		e.preventDefault();
		swal({
		  title: "Seguro?",
		  text: "Estás a punto de eliminar este registro, querés continuar?",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Sí, eliminar!",
		  cancelButtonText: "No, cancelar",
		  closeOnConfirm: false
		},
		function(){
		  //TODO: eliminar de fondo por ajax, recargar tabla y....
		  //swal("Eliminado!", "Registro eliminado.", "success");
		  //también podría hacer la api más RESTful
		  
		  window.location.href=anchor.attr('href');

		});
	});
});