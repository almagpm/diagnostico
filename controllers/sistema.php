<?php
/**
 * Clase principal del sistema.
 *
 * @autor 2023 Escribe tu nombre
 */
session_start();

require_once(__DIR__.'/../config.php');
require_once(__DIR__.'/../configpsql.php');
class Sistema
{
   var $db = null;
   /**
    * Conexión a la base de datos
    *
    * @return PDOObject en $this->db
    * @param del archivo de configuracion config.php
    */
   public function db()
   {
      $dsn = DBDRIVER . ':host=' . DBHOST . ';dbname=' . DBNAME . ';port=' . DBPORT;
      $this->db = new PDO($dsn, DBUSER, DBPASS);
   }
  

   /**
    * Imprime un mensaje usando alerts de bootstrap
    *
    * @param $color el color del alert
    *        $msg el mesaje a imprimir
    */
   public function flash($color, $msg)
   {
      include('views/flash.php');
   }

}
$sistema = new sistema;
?>