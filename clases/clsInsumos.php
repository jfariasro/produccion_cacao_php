<?php
class Insumo
{
    public int $id;
    public string $nombre;
    public float $precio;
    public int $existencia;
    public string $imagen;

    function __construct($id, $nombre, $precio, $existencia, $imagen)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->existencia = $existencia;
        $this->imagen = $imagen;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO insumos(nombre, precio, existencia, imagen)
            VALUES('$this->nombre', '$this->precio', '$this->existencia', '$this->imagen');";
        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT * FROM insumos;";
        return mysqli_query($con, $query);
    }

    public function Modificar($con)
    {
        if (!$this->imagen) {
            $query = "UPDATE insumos set
                nombre = '$this->nombre', precio = '$this->precio', existencia = '$this->existencia'
                WHERE id = '$this->id';
            ";
        } else {
            $query = "UPDATE insumos set
                nombre = '$this->nombre', precio = '$this->precio', existencia = '$this->existencia',
                imagen = '$this->imagen'
                WHERE id = '$this->id';
            ";
        }

        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM insumos WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function ObtenerPrecio($con)
    {
        $query = "SELECT precio FROM insumos WHERE id = '$this->id';";
        $res =  mysqli_query($con, $query);
        $rowPrecio = mysqli_fetch_assoc($res);
        return $rowPrecio['precio'];
    }
}
