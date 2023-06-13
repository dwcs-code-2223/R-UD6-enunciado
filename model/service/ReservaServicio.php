<?php



class ReservaServicio
{

    private IReservaRepository $repository;
    private IRestauranteRepository $restauranteRepository;


    public function __construct()
    {
        $this->repository = new ReservaRepository();
        $this->restauranteRepository = new RestauranteRepository();
    }

    /* Get all reservations */

    public function getReservas(): array
    {

        $reservas = $this->repository->getReservas();

        $restaurantes = $this->restauranteRepository->getRestaurantes();
        $restaurantes_assoc = array();

        foreach ($restaurantes as $r) {
            $restaurantes_assoc[$r->getId()] = $r->getNombre();
        }


        // echo '<pre>';
        // print_r($restaurantes_assoc);
        // echo '</pre>';

        foreach ($reservas as $reserva) {
            $restaurante = $reserva->getRestaurante();
            $restaurante->setNombre($restaurantes_assoc[$restaurante->getId()]);
        }
        // echo '<pre>';
        // print_r($reservas);
        // echo '</pre>';

        return $reservas;
    }

   



    public function save(Reserva $reserva)
    {

        $reservaToVista = null;
        
        $code = $this->comprobarReserva($reserva->getTel(), $reserva->getRestaurante()->getId());
        if($code==0){
            throw new \Exception("Se ha reservado en otro restaurante");
        }
        else if($code ==2){
            $updated = $this->repository->update($reserva);
            if($updated){
                $reservaToVista=$reserva;
            }
        }
        else if($code=1){
        $reservaToVista = $this->repository->create($reserva);
        }
        
        return $reservaToVista;
    }

    public function getRestaurantes(): array
    {

        $reservas = $this->restauranteRepository->getRestaurantes();

        return $reservas;
    }


    public function comprobarReserva(string $tel, int $restId){
        
        $reserva = $this->repository->getReservaByTel($tel);
        if ($reserva!=null) {
            
            if($reserva->getRestaurante()->getId()!=$restId){
                //si ha creado una reserva en otro restaurante, debe devolver 0,
            return 0;
            }
            else{
                //si ha creado una reserva en este mismo restaurante debe devolver 2
                return 2;
            }
        }
        else{
           //Si no ha creado una reserva en ningún otro restaurante debe devolver 1,
            return 1;
        }
    }

    
}
