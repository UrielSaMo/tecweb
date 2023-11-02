<?php

require_once 'API/database.php';

class Productos extends DataBase{
    private $response;

    public function __construct($database='marketzone'){
        parent::__construct($database);
        $this->response = array();
    }

    public function add($jsonOBJ){
        $this->response = array(
            'status'  => 'Error',
            'message' => 'Ya existe el producto con ese nombre'
        );
        $data = json_decode($jsonOBJ->data, true);
        $sql = "SELECT * FROM productos WHERE nombre = '{$data['nombre']}' AND eliminado = 0";
        $result = $this->conexion->query($sql);

        if($result->num_rows > 0){
            $this->response['message'] = "Error, ya existe un producto con ese nombre";
        }else{
            $sql = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen) VALUES ('{$data['nombre']}', '{$data['marca']}', '{$data['modelo']}', {$data['precio']}, '{$data['detalles']}', {$data['unidades']}, '{$data['imagen']}')";
            $this->conexion->set_charset("utf8");
            if($this->conexion->query($sql)){
                $this->response['status'] = "Exitoso";
                $this->response['message'] = "Producto insertado correctamente";
            }else{
                $this->response['message'] = "Error, no se ejecutó el query:". mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function delete($id){
        $this->response = array(
            'status'  => 'Error',
            'message' => 'Fallo la consulta'
        );
        if(isset($id)){
            $sql="UPDATE productos SET eliminado = 1 WHERE id = {$id}";
            if($this->conexion->query($sql)){
                $this->response['status'] = "Exitoso";
                $this->response['message'] = "Producto eliminado correctamente";
            }else{
                $this->response['message'] = "Error, no se ejecuto el query:". mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }
    }

    public function edit($jsonOBJ){
        $this->response = array(
            'status'  => 'Error',
            'message' => 'Fallo la consulta'
        );
    
        $data = json_decode($jsonOBJ->data, true); 
        if(isset($data['id'])){
            $id = $data['id'];
    
            $sql = "UPDATE productos SET nombre ='{$data['nombre']}', marca ='{$data['marca']}', modelo = '{$data['modelo']}', precio = {$data['precio']}, detalles = '{$data['detalles']}', unidades = {$data['unidades']}, imagen = '{$data['imagen']}' WHERE id = {$id}";
            $this->conexion->set_charset("utf8");
            if($this->conexion->query($sql)){
                $this->response['status'] = "Exitoso";
                $this->response['message'] = "Producto actualizado correctamente";
            }else{
                $this->response['message'] = "Error, no se ejecutó el query:". mysqli_error($this->conexion);
            }
            $this->conexion->close();
        }else{
            $this->response['message'] = "Error, no se proporcionó un ID válido para actualizar el producto";
        }
    }

    public function list(){
        if($result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0")){
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)){
                foreach($rows as $num => $row){
                    foreach($row as $key => $value){
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }
            $result->free();
        }else{
            die('Error, no se ejecuto el query:'. mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    public function search($search){
        if(isset($search)){
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '{$search}%' OR marca LIKE '{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if($result = $this->conexion->query($sql)){
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)){
                    foreach($rows as $num => $row){
                        foreach($row as $key => $value){
                            $this->response[$num][$key] = utf8_encode($value);
                        }
                    }
                }
                $result->free();
            }
            else{
                die('Error, no se ejecuto el query:'. mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function single($id){
        if(isset($id)){
            if($result=$this->conexion->query("SELECT * FROM productos WHERE id={$id}")){
                $row = $result->fetch_assoc();

                if(!is_null($row)){
                    foreach($row as $key => $value){
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            }else{
                die('Error, no se ejecuto el query:'. mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function singleByName($name){
        if(isset($name)){
            if($result=$this->conexion->query("SELECT * FROM productos WHERE nombre = '{$name}'")){
                $row = $result->fetch_assoc();

                if(!is_null($row)){
                    foreach($row as $key => $value){
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            }else{
                die('Error, no se ejecuto el query:'. mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    public function getResponse(){
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }
}

?>