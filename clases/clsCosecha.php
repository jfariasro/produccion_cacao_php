<?php

class Cosecha
{
    public int $id;
    public int $idtipocosecha;
    public int $cantidad_quintal;
    public int $cantidad_tacho;
    public string $codigo;

    public function __construct(int $id, int $idtipocosecha, int $cantidad_quintal, int $cantidad_tacho, string $codigo)
    {
        $this->id = $id;
        $this->idtipocosecha = $idtipocosecha;
        $this->cantidad_quintal = $cantidad_quintal;
        $this->cantidad_tacho = $cantidad_tacho;
        $this->codigo = $codigo;
    }

    public function Registro($con)
    {
        if ($this->cantidad_tacho !== -1) {
            $query = "INSERT INTO cosecha(idtipocosecha, cantidad_tacho, fecha)
            VALUES('$this->idtipocosecha', '$this->cantidad_tacho', NOW())";
        } else if ($this->cantidad_quintal !== -1) {
            $query = "INSERT INTO cosecha(idtipocosecha, cantidad_quintal, fecha)
            VALUES('$this->idtipocosecha', '$this->cantidad_quintal', NOW())";
        }
        return mysqli_query($con, $query);
    }

    public function Modificar($con)
    {
        if ($this->cantidad_tacho !== -1) {
            $query = "UPDATE cosecha SET cantidad_tacho = '$this->cantidad_tacho' WHERE id = '$this->id'";
        } else if ($this->cantidad_quintal !== -1) {
            $query = "UPDATE cosecha SET cantidad_quintal = '$this->cantidad_quintal' WHERE id = '$this->id'";
        }
        return mysqli_query($con, $query);
    }

    public function Consultar($con)
    {
        $query = "SELECT c.id, c.codigo, tp.nombre AS tipo_cosecha,
        tp.descripcion, c.estado, c.cantidad_tacho, c.cantidad_quintal, fecha FROM
        cosecha AS c JOIN tipo_cosecha AS tp ON c.idtipocosecha = tp.id
        ORDER BY fecha DESC";
        return mysqli_query($con, $query);
    }

    public function ConsultarCodigo($con){
        $query = "SELECT c.id, c.codigo, tp.nombre AS tipo_cosecha,
        tp.descripcion, c.estado, c.cantidad_tacho, c.cantidad_quintal, fecha FROM
        cosecha AS c JOIN tipo_cosecha AS tp ON c.idtipocosecha = tp.id WHERE c.codigo = '$this->codigo'";
        return mysqli_query($con, $query);
    }

    public function ObtenerTipoCosecha($con)
    {
        $query = "SELECT * FROM tipo_cosecha";
        return mysqli_query($con, $query);
    }

    public function Eliminar($con){
        $query = "DELETE FROM cosecha WHERE id = '$this->id'";
        return mysqli_query($con, $query);
    }
}
