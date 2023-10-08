<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario pra insertar nuevos productos a la base de datos</title>
</head>
<body>
    <h1 aling="center">Datos del nuevo producto</h1>
    <p>Evita dejar espacios.</p>
    <form   method="post" onsubmit=" return validarFormulario()" action="set_producto.php">
        <fieldset>
            <legend>Datos a insertar del  nuevo producto</legend>
            <ul>
                <li><label for="form-nombre">Nombre: <input type="text" id="nombre" name="nombre" value="<?=$_POST['nombre']?>" required></label></li>
                <li><label for="form-marca">Marca:</label>
                <select type="text" id="marca" name="marca" required>
                  <option value="">Seleccione una opción</option>
                  <option value="Xiaomi">Xiaomi</option>
                  <option value="Samsung">Samsung</option>
                  <option value="Apple">Apple</option>
                  <option value="Huawei">Huawei</option>
                  <option value="OPPO">OPPO</option>
                  <option value="Honor">Honor</option>
                  <option value="POCO">POCO</option>
                </select>
              </li>
                <li><label for="form-modelo">Modelo: <input type="text" name="modelo" id="modelo" value="<?=$_POST['model']?>" required></label></li>
                <li><label for="form-precio">Precio: <input type="number" step="0.01" name="precio" id="precio" value="<?= $_POST['precio']?>" required></label></li>
                <li><label for="detalles">Detalles: <input type="text" name="detalles" id="detalles" value="<?= $_POST['detalles'] ?>"></label></li>
                <li><label for="form-unidades">Unidades: <input type="number" name="unidades" id="unidades" value="<?= $_POST['unidades']?>" required></label></li>
                <li><label for="form-imagen">Imagen: <input type="text" name="imagen" id="imagen" value="<?= $_POST['imagen']?>"></label></li>
            </ul>
        </fieldset>
        <p>
            <input type="submit" value="Modificar">
            <input type="reset">
        </p>
    </form>

    <script>
        function validarFormulario() {
          var nombre = document.getElementById("nombre").value;
          var marca = document.getElementById("marca").value;
          var modelo = document.getElementById("modelo").value;
          var precio = document.getElementById("precio").value;
          var detalles = document.getElementById("detalles").value;
          var unidades = document.getElementById("unidades").value;
          var imagen = document.getElementById("imagen");
          var errores = "";
      
          if (nombre.length === 0 || nombre.length > 100) {
            alert("El nombre debe tener entre 1 y 100 caracteres.");
            return false;
          }
      
          if (marca === "") {
            alert("Debe seleccionar una marca.");
            return false;
          }
      
          if (modelo.length === 0 || modelo.length > 25) {
            alert("El modelo debe tener entre 1 y 25 caracteres.");
            return false;
          }
      
          if (precio <= 99.99) {
            alert("El precio debe ser mayor a 99.99.");
            return false;
          }
      
          if (detalles.length > 250) {
            alert("Los detalles no pueden tener más de 250 caracteres.");
            return false;
          }
      
          if (unidades < 0) {
            alert("Las unidades no pueden ser negativas.");
            return false;
          }
      
          imagen.defaultValue = "img/cat.jpg";
      
          return true;
        }
      </script>
</body>
</html>