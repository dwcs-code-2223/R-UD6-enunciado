<?php


class ReservaController
{

    public $page_title;
    public $view;
    private $reservaServicio;

    public function __construct()
    {
        $this->view = 'reserva/list_reserva';
        $this->page_title = '';
        $this->reservaServicio = new ReservaServicio();
    }

    /* List all notes */

    public function list()
    {
        $this->page_title = 'Listado de reservas';

        return $this->reservaServicio->getReservas();
    }



    /* Create or update reserva */

    public function save()
    {
        $this->view = 'reserva/edit_reserva';
        $this->page_title = 'Crear reserva';

        $id = null;
        $comensales = 0;
        $tel = "";
        $restauranteId = -1;

      

        if (isset($_POST["restaurante"])) {
            $restauranteId = $_POST["restaurante"];
        }
        if (isset($_POST["tel"])) {
            $tel = $_POST["tel"];
        }
        if (isset($_POST["comensales"])) {
            $comensales = $_POST["comensales"];
        }

        $reserva = new Reserva();
        $restaurante = new Restaurante();

        $restaurante->setId($restauranteId);
        $reserva->setRestaurante($restaurante);
        $reserva->setTel($tel);
        $reserva->setComensales($comensales);

        $resevaGuardada = $this->reservaServicio->save($reserva);
        //para saber si ha habido error o no


        if ($resevaGuardada == null) {
            $resevaGuardada->setStatus(Util::OPERATION_NOK);
        } else {
            $resevaGuardada->setStatus(Util::OPERATION_OK);
        }


        return $resevaGuardada;
    }

    /* Load note for edit */

    public function edit($id = null)
    {
        $this->page_title = 'Crear reserva';
        $this->view = 'reserva' . DIRECTORY_SEPARATOR . 'edit_reserva';
        /* Id can from get param or method param */

        //para creación
        $reserva = new Reserva();
        $restaurantes = $this->reservaServicio->getRestaurantes();
        $reserva->setRestaurantes($restaurantes);

        return $reserva;
    }


    public function comprobarReservaJSON()
    {
        try {
            $response["code"] = 0;
            $json = file_get_contents('php://input');


            $data = json_decode($json, true);
            if (isset($data["tel"]) && isset($data["restId"])) {

                $code =   $this->reservaServicio->comprobarReserva($data["tel"], $data["restId"]);
                $response["code"] = $code;
            } else {
                //400 Bad Request
                http_response_code(400);
                $response["code"] = 400;
            }
        } catch (\Exception $ex) {
            //500 internal error
            http_response_code(500);
            $response["code"] = 500;
        }
        return json_encode($response);
    }
}
