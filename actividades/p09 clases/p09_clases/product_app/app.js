$(document).ready(function () {
  let editar = false;
  let validado = false;
  let nombre_valido = false;
  let precio_valido = false;
  let unidades_valido = false;
  let modelo_valido = false;
  let marca_valido = false;
  let detalles_valido = false;
  let img_valido = false;

  listarProductos();
  $("#search").keyup(function (e) {
    if ($("#search").val()) {
      let search = $("#search").val();
      console.log(search);
      $.ajax({
        type: "GET",
        url: "backend/product-search.php",
        data: { search },
        success: function (response) {
          console.log(response);
          let productos = JSON.parse(response);
          let template = "";
          let template_bar = "";

          if (Object.keys(productos).length > 0) {
            productos.forEach((element) => {
              let descripcion = "";
              descripcion += "<li>precio: " + element.precio + "</li>";
              descripcion += "<li>unidades: " + element.unidades + "</li>";
              descripcion += "<li>modelo: " + element.modelo + "</li>";
              descripcion += "<li>marca: " + element.marca + "</li>";
              descripcion += "<li>detalles: " + element.detalles + "</li>";

              template += `
                <tr productId="${element.id}">
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td><ul>${descripcion}</ul></td>
                    <td>
                        <button class="product-delete btn btn-danger">
                            Eliminar
                        </button>
                    </td>
                </tr>
                 `;
              template_bar += `
                <li>${productos.nombre}</il>
                `;
            });
            $("#products").html(template);
          }
        },
      });
    }
  });

  $("#name").blur(function () {
    var nombre_producto = $("#name").val();
    var patron_nombre = /^[a-zA-Z0-9\s]+$/;
    if (!patron_nombre.test(nombre_producto) || nombre_producto.lenght > 100) {
      $("#error_nombre").css("display", "block");
      nombre_valido = false;
    } else {
      $("#error_nombre").css("display", "none");
      nombre_valido = true;
    }
  });

  $("#precio").blur(function (e) {
    var precio_producto = $("#precio").val();
    var patron_precio = /^[0-9.]+$/;
    if (
      !patron_precio.test(precio_producto) ||
      parseFloat(precio_producto) < 99.99
    ) {
      $("#error_precio").css("display", "block");
      precio_valido = false;
    } else {
      $("#error_precio").css("display", "none");
      precio_valido = true;
    }
  });

  $("#unidades").blur(function (e) {
    var unidades_producto = $("#unidades").val();
    var patron_unidades = /^[0-9]+$/;
    if (!patron_unidades.test(unidades_producto)) {
      $("#error_unidades").css("display", "block");
      unidades_valido = false;
    } else {
      $("#error_unidades").css("display", "none");
      unidades_valido = true;
    }
  });

  $("#modelo").blur(function (e) {
    var modelo_producto = $("#modelo").val();
    var patron_modelo = /^[a-zA-Z0-9]+$/;
    if (!patron_modelo.test(modelo_producto) || modelo_producto.lenght >= 25) {
      $("#error_modelo").css("display", "block");
      modelo_valido = false;
    } else {
      $("#error_modelo").css("display", "none");
      modelo_valido = true;
    }
  });

  $("#marca").blur(function (e) {
    var marca_producto = $("#marca").val();
    if (marca_producto == 0) {
      $("#error_marca").css("display", "block");
      marca_valido = false;
    } else {
      $("#error_marca").css("display", "none");
      marca_valido = true;
    }
  });

  $("#detalles").blur(function (e) {
    var detalles_producto = $("#detalles").val();
    var patron_detalles = /^[a-zA-Z0-9.%:,\s]+$/;
    if (!patron_detalles.test(detalles_producto) || detalles_producto.lenght > 250) {
      $("#error_detalles").css("display", "block");
      detalles_valido = false;
    } else {
      $("#error_detalles").css("display", "none");
      detalles_valido = true;
    }
  });

  $("#img").blur(function (e) {
    var img_producto = $("#img").val();
    var patron_img = /^[a-zA-Z0-9./_]+$/;
    if (!patron_img.test(img_producto)) {
      $("#error_img").css("display", "block");
      img_valido = false;
    } else {
      $("#error_img").css("display", "none");
      img_valido = true;
    }
  });

  $("#name").keyup(function (e) { 
    if ($("#name").val()) {
      let name = $("#name").val();
      console.log(name);
      $.ajax({
        type: "GET",
        url: "backend/product-insertbyname.php",
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

  $("#product-form").submit(function (e) {
    var validado_total = true;
    validado_total = nombre_valido && precio_valido && unidades_valido && modelo_valido && marca_valido && detalles_valido && img_valido;
    console.log(validado_total);
    if (validado != validado_total){   
      var productoJSON = {
      marca: $("#marca").val(),
      modelo: $("#modelo").val(),
      precio: $("#precio").val(),
      detalles: $("#detalles").val(),
      unidades: $("#unidades").val(),
      imagen: $("#img").val(),
    };
    productoJSON["nombre"] = $("#name").val();
    productoJSON["id"] = $("#productId").val();
    var JsonString = JSON.stringify(productoJSON, null, 2);
    let url =
      editar == false
        ? "backend/product-add.php"
        : "backend/product-edit.php";

    $.post(url, JsonString, function (response) {
      listarProductos();
      console.log(response);
      let respuesta = JSON.parse(response);
      let template_bar = "";
      template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
      $("#product-result").attr("class", "card my-4 d-block");
      $("#container").html(template_bar);
    }); }
    e.preventDefault();
  });

  function listarProductos() {
    $.ajax({
      type: "GET",
      url: "backend/product-list.php",
      success: function (response) {
        let productos = JSON.parse(response);
        console.log(productos);
        if (Object.keys(productos).length > 0) {
          let template = "";
          productos.forEach((element) => {
            let descripcion = "";
            descripcion += "<li>precio: " + element.precio + "</li>";
            descripcion += "<li>unidades: " + element.unidades + "</li>";
            descripcion += "<li>modelo: " + element.modelo + "</li>";
            descripcion += "<li>marca: " + element.marca + "</li>";
            descripcion += "<li>detalles: " + element.detalles + "</li>";

            template += `
                        <tr productId="${element.id}">
                            <td>${element.id}</td>
                            <td><a href="#" class="product-item">${element.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `;
          });
          $("#products").html(template);
        }
      },
    });
  }

  $(document).on("click", ".product-delete", function () {
    if (confirm("Estas seguro de querer eliminarlo?")) {
      let element = $(this)[0].parentElement.parentElement;
      let id = $(element).attr("productId");
      $.ajax({
        type: "GET",
        url: "backend/product-delete.php",
        data: { id },
        success: function (response) {
          listarProductos();
          let respuesta = JSON.parse(response);
          let template_bar = "";
          template_bar += `
                            <li style="list-style: none;">status: ${respuesta.status}</li>
                            <li style="list-style: none;">message: ${respuesta.message}</li>
                        `;
          $("#product-result").attr("class", "card my-4 d-block");
          $("#container").html(template_bar);
        },
      });
    }
  });

  $(document).on("click", ".product-item", function () {
    console.log("Editando");
    let element = $(this)[0].parentElement.parentElement;
    let id = $(element).attr("productId");
    $.get(
      "backend/product-single.php",
      { id },
      function (response) {
        let datos = JSON.parse(response);
        console.log(datos);
        $("#name").val(datos.nombre);
        let editJSON = {
          precio: datos.precio,
          unidades: datos.unidades,
          modelo: datos.modelo,
          marca: datos.marca,
          detalles: datos.detalles,
          imagen: datos.imagen,
        };
        $("#description").val(JSON.stringify(editJSON, null, 2));
        $("#productId").val(datos.id);
        editar = true;
      }
    );
  });

});
