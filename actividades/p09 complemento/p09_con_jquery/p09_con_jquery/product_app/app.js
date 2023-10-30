

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    var JsonString = JSON.stringify(baseJSON, null, 2);
    document.getElementById("description").value = JsonString;
}
//Corrimiento del codigo con Jquery
$(document).ready(function () {
    let edit = false;
    console.log('jQuery is working');
    $('#product-result').hide();
    fetchProducts();

    $('#search').keyup(function (e) {
        if ($('#search').val()) {
            let search = $('#search').val();

            $.ajax({
                url: 'backend/product-search.php',
                type: 'GET',
                data: { search },
                success: function (response) {
                    let productos = JSON.parse(response);
                    let template = '';
                    let template_bus = '';

                    productos.forEach(producto => {
                        template += `<li>
                            ${producto.nombre}
                        </li>`
                    });

                    $('#container').html(template);
                    $('#product-result').show();

                    productos.forEach(producto => {
                        template_bus += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                                </td>
                                <td>${producto.marca}</td>
                                <td>${producto.modelo}</td>
                                <td>$${producto.precio}</td>
                                <td>${producto.detalles}</td>
                                <td>${producto.unidades}</td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>    
                                </td>
                            </tr>
                        `
                    });
                    $('#products').html(template_bus);
                }
            });
        }
    });

    $('#product-form').submit(function (e) {
        let hasError = false;

        // Validación del campo "name"
        const name = $('#name').val();
        if (name.trim() === "") {
            $('#nameError').text("Este campo no puede estar en blanco.");
            hasError = true;
        } else if (name.length > 100) {
            $('#nameError').text("El nombre debe tener menos de 100 caracteres.");
            hasError = true;
        } else {
            $('#nameError').text("");
        }

        // Validación del campo "brand"
        const brand = $('#brand').val();
        if (brand.trim() === "" || brand.length > 25) {
            $('#brandError').text("Este campo no puede estar en blanco y debe tener menos de 25 caracteres.");
            hasError = true;
        } else {
            $('#brandError').text("");
        }

        // Validación del campo "model"
        const model = $('#model').val();
        if (model.trim() === "" || model.length > 25) {
            $('#modelError').text("Este campo no puede estar en blanco y debe tener menos de 25 caracteres.");
            hasError = true;
        } else {
            $('#modelError').text("");
        }

        // Validación del campo "price"
        const price = parseFloat($('#price').val());
        if ($('#price').val().trim() === "" || price < 99.99) {
            $('#priceError').text("Este campo no puede estar en blanco y debe ser mayor a 99.99.");
            hasError = true;
        } else {
            $('#priceError').text("");
        }

        // Validación del campo "details"
        const details = $('#details').val();
        if (details.trim() === "" || details.length > 250) {
            $('#detailsError').text("Este campo no puede estar en blanco.");
            hasError = true;
        } else {
            $('#detailsError').text("");
        }

        // Validación del campo "units"
        const units = parseInt($('#units').val());
        if ($('#units').val().trim() === "" || units < 0) {
            $('#unitsError').text("Este campo no puede estar en blanco y el número no puede ser negativo.");
            hasError = true;
        } else {
            $('#unitsError').text("");
        }

        const image = $('#image').val();
        if (image.trim() === "") {
            $('#imageError').text("Este campo no puede estar en blanco.");
            hasError = true;
        } else {
            $('#imageError').text("");
        }

        // Continuar con el código de validación para otros campos si es necesario

        if (hasError) {
            e.preventDefault(); // Evita el envío del formulario si hay errores.
        } else {
            // Continuar con el envío del formulario si no hay errores.

            const postData = {
                nombre: name,
                precio: price,
                unidades: units,
                modelo: model,
                marca: brand,
                detalles: details,
                imagen: image,
            };
           
            postData['Id']= $('#id').val();;
            console.log(postData);

            let url = edit === false ? 'backend/product-add.php' : 'backend/product-edit.php';

            let productoJsonString = JSON.stringify(postData, null, 2);
            console.log(productoJsonString);

            $.post(url, productoJsonString, function (response) {
                console.log(response);
                let res = JSON.parse(response);
                fetchProducts();
                let mensaje = res.message;
                alert(mensaje);
            });
        }
    });
    
    //---------------------Buscar nombre para insercion 
    $("#name").keyup(function (e) { 
        if ($("#name").val()) {
          let name = $("#name").val();
          console.log(name);
          $.ajax({
            type: "GET",
            url: 'backend/buscarname.php',
            data: { name },
            success: function (response) {
              console.log(response);
              let productos = JSON.parse(response);
              if (Object.keys(productos).length > 0) {
                let template_bar = "";
                template_bar += `
                                  <li style="list-style: none;">status: Error </li>
                                  <li style="list-style: none;">message: Producto con el mismo nombre ya se encuenta en BD </li>
                              `;
                $("#product-result").attr("class", "card my-4 d-block");
                $("#container").html(template_bar);
              }else{
                $("#product-result").attr("class", "card my-4 d-none");
              }
            },
          });
        }
      });
   
    //--------------------Funcion para buscar producto------------------------
    function fetchProducts() {
        $.ajax({
            url: 'backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';

                productos.forEach(producto => {
                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td>
                                <a href="#" class="product-item">${producto.nombre}</a>
                            </td>
                            <td>${producto.marca}</td>
                            <td>${producto.modelo}</td>
                            <td>$${producto.precio}</td>
                            <td>${producto.detalles}</td>
                            <td>${producto.unidades}</td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>    
                            </td>
                        </tr>
                    `
                });
                $('#products').html(template);
            }
        });
    }
//------------------------------Funcion para el Boton de eliminar
    $(document).on('click', '.product-delete', function () {
        if (confirm('¿Quieres eliminar el producto?')) {
            const element = $(this)[0].parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('backend/product-delete.php', { id }, function (response) {
                let respuesta = JSON.parse(response);
                console.log(respuesta);
                fetchProducts();
                let mensaje = respuesta.message;
                alert(mensaje);
            });
        }
    });
//--------------------Funcion para editar el producto 
    $(document).on('click', '.product-item', function () {
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.post('backend/product-single.php', { id }, function (response) {
            const producto = JSON.parse(response);
            console.log(response);
            $('#name').val(producto.nombre);
            $('#product_Id').val(producto.id);

            var atributosobj = {
                "precio": producto.precio,
                "unidades": producto.unidades,
                "modelo": producto.modelo,
                "marca": producto.marca,
                "detalles": producto.detalles,
                "imagen": producto.imagen
            };

            var objstring = JSON.stringify(atributosobj, null, 2);
            $('#description').val(objstring);
            edit = true;
        })
    });
});