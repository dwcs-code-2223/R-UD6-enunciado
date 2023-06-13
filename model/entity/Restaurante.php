<?php



class Restaurante implements \JsonSerializable {




    private string $nombre ="";
    private ?int $id=null;

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function setNombre(string $nombre): void {
        $this->nombre = $nombre;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    

    public function jsonSerialize() {
        //Especificamos qué propiedades no públicas queremos que pasen a formar parte del objeto JSON
        return array(
            'id' => $this->id,
            'nombre' => $this->nombre
          
          
        );
    }
    
 

}
