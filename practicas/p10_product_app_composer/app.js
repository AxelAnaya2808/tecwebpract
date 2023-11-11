
$(document).ready(function(){
    let edit = false;
    listarProductos();
    $('#task-result').show();


    function listarProductos() {
        $.ajax({
            url: './app/product-list.php',
            type: 'GET',
            success: function(response) {
                console.log(response);
                // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                const productos = JSON.parse(response);
            
                // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                if(Object.keys(productos).length > 0) {
                    // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                    let template = '';

                    productos.forEach(producto => {
                        // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr taskId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="task-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="task-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                    $('#tasks').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './app/product-search.php?search='+$('#search').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
                        const productos = JSON.parse(response);
                        
                        // SE VERIFICA SI EL OBJETO JSON TIENE DATOS
                        if(Object.keys(productos).length > 0) {
                            // SE CREA UNA PLANTILLA PARA CREAR LAS FILAS A INSERTAR EN EL DOCUMENTO HTML
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                // SE CREA UNA LISTA HTML CON LA DESCRIPCIÓN DEL PRODUCTO
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr taskId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="task-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="task-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // SE HACE VISIBLE LA BARRA DE ESTADO
                            $('#task-result').show();
                            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
                            $('#container').html(template_bar);
                            // SE INSERTA LA PLANTILLA EN EL ELEMENTO CON ID "productos"
                            $('#tasks').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#task-result').hide();
        }
    });

    //se agrega un producto
    $('#task-form').submit(e => {
        e.preventDefault();
        let postData = {
            id: $('#taskId').val(),
            nombre: $('#name').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            precio: $('#precio').val(),
            detalles: $('#detalles').val(),
            unidades: $('#unidades').val(),
            imagen: $('#imagen').val(),
        }
        
        const url = edit === false ? './app/product-add.php' : './app/product-edit.php';
        if(campos.marca && campos.nombre && campos.modelo && campos.precio  && campos.unidades){
            
        $.post(url, postData, (response) => {
            //console.log(response);
            // SE OBTIENE EL OBJETO DE DATOS A PARTIR DE UN STRING JSON
            let respuesta = JSON.parse(response);
            // SE CREA UNA PLANTILLA PARA CREAR INFORMACIÓN DE LA BARRA DE ESTADO
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            
            // SE HACE VISIBLE LA BARRA DE ESTADO
            $('#task-result').show();
            // SE INSERTA LA PLANTILLA PARA LA BARRA DE ESTADO
            $('#container').html(template_bar);
            // SE LISTAN TODOS LOS PRODUCTOS
            listarProductos();
            // SE REGRESA LA BANDERA DE EDICIÓN A false
            edit = false;
        });
        }
    
    });

    //Buscar coincidencias en el nombre
    $('#name').keyup(function() {
        if($('#name').val()) {
            let search = $('#name').val();
            $.ajax({
                url: './app/product-searchname.php?search='+$('#name').val(),
                data: {search},
                type: 'GET',
                success: function (response) {
                    if(!response.error) {
                        console.log(response);

                        const productos = JSON.parse(response);
                        
                        //Se verifica que el objeto no este vacio
                        if(Object.keys(productos).length > 0) {
                            // Se crea la plantilla para insertar los elementos
                            let template = '';
                            let template_bar = ''; //Plantilla de la barra de estado

                            productos.forEach(producto => {
                                let descripcion = '';
                                descripcion += '<li>precio: '+producto.precio+'</li>';
                                descripcion += '<li>unidades: '+producto.unidades+'</li>';
                                descripcion += '<li>modelo: '+producto.modelo+'</li>';
                                descripcion += '<li>marca: '+producto.marca+'</li>';
                                descripcion += '<li>detalles: '+producto.detalles+'</li>';
                            
                                template += `
                                    <tr taskId="${producto.id}">
                                        <td>${producto.id}</td>
                                        <td><a href="#" class="task-item">${producto.nombre}</a></td>
                                        <td><ul>${descripcion}</ul></td>
                                        <td>
                                            <button class="task-delete btn btn-danger">
                                                Eliminar
                                            </button>
                                        </td>
                                    </tr>
                                `;

                                template_bar += `
                                    <span>Se encontraron coincidencias</span>
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            // Se hace visible la barra de estado
                            $('#task-result').show();
                            // Se inserta la plantilla en el elemento "container"
                            $('#container2').html(template_bar);
                            // Se inserta la plantilla en el elemento "products"
                            $('#tasks').html(template);    
                        }
                    }
                }
            });
        }
        else {
            $('#task-result').show(); //Se muestra la barra de estado
            $('#container2').html("No se encontraron coincidencias"); //Se manda a imprimir que no se encontraron coincidencias
        }
    });

    

    $(document).on('click', '.task-delete', (e) => {
        if(confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('taskId');
            $.post('./app/product-delete.php', {id}, (response) => {
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>
                `;
                listarProductos();
                $('#task-result').show();
                $('#container').html(template_bar);
            });
        }
    }); 

    $(document).on('click', '.task-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('taskId');
        $.post('./app/product-single.php', {id}, (response) => {
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#marca').val(product.marca);
            $('#modelo').val(product.modelo);
            $('#precio').val(product.precio);
            $('#detalles').val(product.detalles);
            $('#unidades').val(product.unidades);
            $('#imagen').val(product.imagen);
            $('#taskId').val(product.id);
            edit = true;
        });
        e.preventDefault();
    });


    //Validaciones 
//se obtiene todos los elementos que contiene el formulario
const formulario = document.getElementById('task-form');
const inputs = document.querySelectorAll('#task-form input');
const select = document.querySelectorAll('#task-form select');

//Las expresiones regulares serviran para poder realizar de manera satisfactoria las validaciones
const expresiones = {
	//se debe tener cuidado al poner que tipo de caracteres contiene ya que causaria que en el formulario no sirvan
	nombre: /^[a-zA-ZÀ-ÿ0-9\s]{1,100}$/, // Letras,espacios,numeracion del 0 al 9, pueden llevar acentos y de 1 a 100.
	modelo: /^[a-zA-Z0-9\s_.+-]{1,25}$/, // 1 a25 carcateres y ademas es alfanumerico y sin espacios.
	detalles: /^\d{0,250}$/, //debe contener almenos 250 caracteres
	precio:  /^[0-9]+.[0-9][0-9]$/, //contiene numeros
	marca: /Adidas|Nike|Vans|Pirma|Charlie|Lacoste|DC|Bubble Gummers/,
  unidades: /^[0-9]{1,}$/ //numeros del 0 al 9 y numeros formados de 1 a 5 digitos
}

//serviran de guia para poder enviar el formulario por una que se encuentre en false
//este no se enviara
const campos = {
	nombre: false,
	modelo: false,
	detalles: false,
	marca: false,
	unidades: false
}

const validarFormulario = (e) => { //este seria como el principal que hace que valide las casilles y los datos
	switch (e.target.name) {
		case "nombre":
		validarCampo(expresiones.nombre, e.target, 'nombre');
        validarNombre();
        console.log($('#name').val());
		break;
		case "marca":
		validarCampo(expresiones.marca, e.target, 'marca');
        validarMarca();
        console.log($('#marca').val());
		break;
		case "modelo":
		validarCampo(expresiones.modelo, e.target, 'modelo'); //esos son los mentira son las expresiones
        validarModelo();
        console.log($('#modelo').val());
		break;
		case "precio":
		validarCampo(expresiones.precio, e.target, 'precio');
		validaPrecio();
    console.log($('#precio').val());
		break;
		case "detalles":
		validarCampo(expresiones.detalles, e.target, 'detalles');
		validaDetalles();
    console.log($('#detalles').val());
		break;
		case "unidades":
		validaUnidad();
		validarCampo(expresiones.unidades, e.target, 'unidades');
    validaUnidad();
    console.log($('#unidades').val());
		break;
	}
}


//validacion general para el llenado de los campos
//esto quiere decir que debe de cumplir con la validaciones delas expresiones regulares
const validarCampo = (expresion, input, campo) => {
	if(expresion.test(input.value)){
		document.getElementById(`grupo__${campo}`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__${campo} .task-form__input-error`).classList.remove('task-form__input-error-activo');
        $('#container').html("Campo correcto");
		campos[campo] = true;
	} else {
		document.getElementById(`grupo__${campo}`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__${campo}`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__${campo} .task-form__input-error`).classList.add('task-form__input-error-activo');
		$('#container').html("Campo incorrecto"); 
		campos[campo] = false;
	}
}

let template = ''; 
const validarMarca = () =>{
	const marcaP = document.getElementById('marca'); 
	console.log(marcaP.value);
	if(marcaP.value == "" || marcaP.value == null){
		document.getElementById(`grupo__marca`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__marca`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__marca .task-form__input-error`).classList.add('task-form__input-error-activo');
		template += `<li>Campo marca : incorrecto</li> `;
		$('#container').html(template);
		campos['marca'] = false;
	}else {
		document.getElementById(`grupo__marca`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__marca`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__marca .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo marca : correcto</li> `;
		$('#container').html(template);
		campos['marca'] = true;
	}
}

const validarNombre = () =>{
	const nombre = document.getElementById("name");
	if(nombre.value == "" || nombre.value==null){
		document.getElementById(`grupo__nombre`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__nombre`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__nombre .task-form__input-error`).classList.add('task-form__input-error-activo');
		template += `<li>Campo nombre : incorrecto</li>`;
		$('#container').html(template);
		campos['nombre'] = false;
	}else {
		document.getElementById(`grupo__nombre`).classList.remove('task-form__grupo-incorrecto');
	    document.getElementById(`grupo__nombre`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__nombre .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo nombre : correcto</li>`;
		$('#container').html(template);
		campos['nombre'] = true;
	}
}

//todas validan que no esten vacios, y en unidades y precios sean numeros
const validarModelo = () =>{
	const modelo = document.getElementById("modelo");
	if(modelo.value == "" || modelo.value==null){
		document.getElementById(`grupo__modelo`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__modelo`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__modelo .task-form__input-error`).classList.add('task-form__input-error-activo');
		template += `<li>Campo modelo : incorrecto</li>`;
		$('#container').html(template);
		campos['modelo'] = false;
	}else {
		document.getElementById(`grupo__modelo`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__modelo`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__modelo .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo modelo : correcto</li>`;
		$('#container').html(template);
		campos['modelo'] = true;
	}
}


const validaPrecio = () =>{
	const precioP =document.getElementById('precio');
	if(precioP.value == null || precioP.value <= 99.98 || precioP.value==""){
		document.getElementById(`grupo__precio`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__precio`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__precio .task-form__input-error`).classList.add('task-form__input-error-activo');
		template += `<li>Campo precio : incorrecto</li>`;
		$('#container').html(template);
		campos['precio'] = false;
	}else {
		document.getElementById(`grupo__precio`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__precio`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__precio .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo precio : correcto</li>`;
		$('#container').html(template);
		campos['precio'] = true;
	}
}

const validaDetalles = () =>{
	const detalles =document.getElementById('detalles').value.length;

	if(detalles>250 ){
		document.getElementById(`grupo__detalles`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__detalles`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__detalles .task-form__input-error`).classList.add('task-form__input-error-activo');
        template += `<li>Campo detalles : incorrecto</li>`;
		$('#container').html(template);
		campos['detalles'] = false;
	}else {
		document.getElementById(`grupo__detalles`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__detalles`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__detalles .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo detalles : correcto</li>`;
		$('#container').html(template);
        campos['detalles'] = true;
	}
}

const validaUnidad = () =>{
	const unidad =document.getElementById('unidades');
	if(unidad.value == "" || unidad.value ==null){  //|| unidad.value != isNaN(unidad.value)){
		document.getElementById(`grupo__unidades`).classList.add('task-form__grupo-incorrecto');
		document.getElementById(`grupo__unidades`).classList.remove('task-form__grupo-correcto');
		document.querySelector(`#grupo__unidades .task-form__input-error`).classList.add('task-form__input-error-activo');
		template += `<li>Campo unidades : incorrecto</li> `;
		$('#container').html(template);
		campos['unidades'] = false;
	}else {
		document.getElementById(`grupo__unidades`).classList.remove('task-form__grupo-incorrecto');
		document.getElementById(`grupo__unidades`).classList.add('task-form__grupo-correcto');
		document.querySelector(`#grupo__unidades .task-form__input-error`).classList.remove('task-form__input-error-activo');
		template += `<li>Campo unidades : correcto</li>`;
		$('#container').html(template);
		campos['unidades'] = true;
	}
}

//validan cuando se les hace click a los campos
inputs.forEach((input) => {
	input.addEventListener('keyup', validarFormulario);
	input.addEventListener('blur', validarFormulario);
});

select.forEach((select) => {
	select.addEventListener('keyup', validarFormulario);
	select.addEventListener('blur', validarFormulario);
});


formulario.addEventListener('submit', (e) => {
	e.preventDefault();
	alert(campos.unidades);
	//todos los campos deben ser true para que se envie el formulario
	if(campos.marca && campos.nombre && campos.modelo && campos.precio  && campos.unidades){
		formulario.reset();

		document.getElementById('task-form__mensaje-exito').classList.add('task-form__mensaje-exito-activo');
		//muestra el mensaje de exito por segundos donde:
		//1 segundo = 1000 
		setTimeout(() => {
			document.getElementById('task-form__mensaje-exito').classList.remove('task-form__mensaje-exito-activo');
		}, 10000);

		document.querySelectorAll('.task-form__grupo-correcto').forEach((icono) => {
			icono.classList.remove('task-form__grupo-correcto');
		});
	} else {
		document.getElementById('task-form__mensaje').classList.add('task-form__mensaje-activo');
	}
});

});


