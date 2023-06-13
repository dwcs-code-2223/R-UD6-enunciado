<?php



class Reserva implements \JsonSerializable {

    use ViewData;


    private ?int $id = null;
    private string $tel ="";
    private ?Restaurante $restaurante =null;
    private int $comensales = 1;

    
 
  

    public function getTel(): string {
        return $this->tel;
    }

    public function getRestaurante(): ?Restaurante {
        return $this->restaurante;
    }

    public function getComensales(): int {
        return $this->comensales;
    }

    public function setTel(string $tel): void {
        $this->tel = $tel;
    }

    public function setRestaurante(Restaurante $restaurante): void {
        $this->restaurante = $restaurante;
    }

    public function setComensales(int $comensales): void {
        $this->comensales = $comensales;
    }

  
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }




    public function jsonSerialize() {
        //Especificamos qué propiedades no públicas queremos que pasen a formar parte del objeto JSON
        return array(
            'id' => $this->id,
            'restauranteId' => $this->restaurante->getId(),
            'tel' => $this->tel,
            'comensales' => $this->comensales
          
        );
    }
    
 

}
