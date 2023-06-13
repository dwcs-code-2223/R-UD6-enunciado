<?php




class RestauranteRepository implements IRestauranteRepository {

    const RUTA_FICHERO = "config" . DIRECTORY_SEPARATOR . "restaurantes.json";

    private $filePath;
    private $restaurantesArray = [];

    public function __construct() {
        $this->filePath = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . self::RUTA_FICHERO;
        $this->restaurantesArray = $this->getRestaurantes();
    }

    public function getRestaurantes(): array {

        //Leemos el fichero JSON y se devuelve array con índices numéricos con tantos índices como reservas haya.
        // El valor del array es a su vez un array asociativo 
        $arrayFromJSON = json_decode(file_get_contents($this->filePath), true);
        $arrayRestaurantes = [];
        if ($arrayFromJSON != null) {
            foreach ($arrayFromJSON as $index => $reservasArrayAsoc) {

                $restaurante = Util::json_decode_array_to_class($reservasArrayAsoc, "Restaurante");
                array_push($arrayRestaurantes, $restaurante);
            }
        }

        return $arrayRestaurantes;
    }

       
}
