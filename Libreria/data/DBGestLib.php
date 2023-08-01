<?php
class DBGestLib {

     private function getConexion(){
        $servidor = 'localhost:3306';
        $dataBase = 'dblibreria';
        $dns = "mysql:host=$servidor;dbname=$dataBase";
        $user = 'root';
        $password = '';

        $obPDO = new PDO ($dns, $user, $password);
        return $obPDO;
     }

     public function getLibros(){
        $objBD = $this->getConexion();
        $sql = "SELECT `id_titulo`, `titulo`, `tipo`, `precio`, `notas` FROM titulos order by titulo";
        $consulta = $objBD->query($sql);
        return $consulta;
     }

     public function getAutores(){
        $objBD = $this->getConexion();
        $sql = "SELECT `nombre`, `apellido`, `ciudad`, `estado` FROM autores order by nombre";
        $consulta = $objBD->query($sql);
        return $consulta;
     }

     public function insertContacto($nombre, $correo, $asunto, $comentario) {
        $objBD = $this->getConexion();
        $sql = "INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (:nombre, :correo, :asunto, :comentario)";
        $stmt = $objBD->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':asunto', $asunto);
        $stmt->bindParam(':comentario', $comentario);

        try {
            $stmt->execute();
            return true; // Si se ejecuta con éxito, devuelve verdadero
        } catch (PDOException $e) {
            return false; // Si hay algún error, devuelve falso
        }
     }

}
?>