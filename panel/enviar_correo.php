require 'vendor/autoload.php';
include '/../config/config.ini';

$sql = $cn->prepare(" SELECT productos.id, `referencia`,`foto`,`categoria_id` ,`precio`,`stock` 
FROM `productos` WHERE productos.stock <= '5' ");

if ($sql->execute())

    return $sql->fetchAll();

return false;
