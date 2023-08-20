<?php

class Usuario
{
    public int $id;
    public string $nombre;
    public string $usuario;
    public string $email;
    public string $pass;

    private string $seguridad;

    public function getSeguridad()
    {
        return $this->seguridad;
    }

    private function setSeguridad(){
        $this->seguridad = 'b1339861926d4172f7888fbfa745485f';
    }

    function __construct($id, $nombre, $usuario, $email, $pass)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->pass = $pass;
    }

    public function RegistrarUsuario($con)
    {
        $this->setSeguridad();
        $this->seguridad = $this->pass . $this->getSeguridad();
        $this->pass = password_hash($this->seguridad, PASSWORD_DEFAULT);

        $query = "INSERT INTO usuarios(nombre, usuario, email, pass)
        VALUES('$this->nombre', '$this->usuario', '$this->email', '$this->pass')";
        
        return mysqli_query($con, $query);
    }

    public function ModificarUsuario($con)
    {

        if ($this->pass !== '') {
            $this->seguridad = $this->pass . 'b1339861926d4172f7888fbfa745485f';
            $this->pass = password_hash($this->seguridad, PASSWORD_DEFAULT);
            $query = "UPDATE usuarios SET
            nombre = '$this->nombre', usuario = '$this->usuario',
            email = '$this->email', pass = '$this->pass'
            WHERE id = '$this->id'
            ";
        } else {
            $query = "UPDATE usuarios SET
            nombre = '$this->nombre', usuario = '$this->usuario',
            email = '$this->email' WHERE id = '$this->id'
            ";
        }

        return mysqli_query($con, $query);
    }

    public function ElimimarUsuario($con){
        $query = "DELETE FROM usuarios WHERE id = '$this->id'";
        return mysqli_query($con, $query);
    }

    public function InicioSesion($con)
    {
        $this->seguridad = $this->pass . 'b1339861926d4172f7888fbfa745485f';
        $query = "SELECT id, email, nombre, usuario, pass from usuarios where email='$this->email'";
        $res = mysqli_query($con, $query);
        return mysqli_fetch_assoc($res);
    }

    public function ValidacionLogin()
    {
        $mensaje = '';
        if ($this->email == NULL || $this->pass == NULL) {
            $mensaje .= "<b>Debes llenar todos los campos para iniciar sesión.</b>";
        }

        return $mensaje;
    }

    public function ValidacionModificar()
    {
        $mensaje = '';
        if ($this->nombre == '') {
            $mensaje .= "<b>Debes Ingresar el Nombre.</b> </br>";
        }
        if ($this->usuario == '') {
            $mensaje .= "<b>Debes Ingresar el Nombre de Usuario.</b> </br>";
        }
        if ($this->email == '') {
            $mensaje .= "<b>Debes Ingresar el Email.</b> </br>";
        }

        return $mensaje;
    }

    public function ValidacionRegistro()
    {
        $mensaje = '';
        if ($this->nombre == '') {
            $mensaje .= "<b>Debes Ingresar el Nombre.</b> </br>";
        }
        if ($this->usuario == '') {
            $mensaje .= "<b>Debes Ingresar el Nombre de Usuario.</b> </br>";
        }
        if ($this->email == '') {
            $mensaje .= "<b>Debes Ingresar el Email.</b> </br>";
        }
        if ($this->pass == '') {
            $mensaje .= "<b>Debes Ingresar la Contraseña.</b> </br>";
        }

        return $mensaje;
    }
}
