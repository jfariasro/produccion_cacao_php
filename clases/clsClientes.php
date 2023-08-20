<?php
class Cliente
{
    public int $id;
    public string $nombre;
    public string $email;
    public string $direccion;

    function __construct($id, $nombre, $email, $direccion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->direccion = $direccion;
    }

    public function Registro($con)
    {
        $query = "INSERT INTO clientes(nombre, email, direccion)
        VALUES('$this->nombre', '$this->email', '$this->direccion');";

        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT * FROM clientes;";
        return mysqli_query($con, $query);
    }

    public function Buscar($con){
        $query = "SELECT * FROM clientes WHERE id = $this->id;";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function Modificar($con)
    {
        $query = "UPDATE clientes
        SET nombre = '$this->nombre', email = '$this->email',
        direccion = '$this->direccion' WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }

    public function Eliminar($con)
    {
        $query = "DELETE FROM clientes WHERE id = '$this->id';";
        return mysqli_query($con, $query);
    }
}
