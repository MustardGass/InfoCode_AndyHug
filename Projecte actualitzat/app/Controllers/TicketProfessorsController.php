<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AlumnesModel;
use App\Models\ProfessorModel;
use App\Models\TipusDispositiuModel;
use App\Models\TiquetModel;
use App\Models\IntervencioModel;
use Faker\Factory;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketProfessorsController extends BaseController
{
    public function vista_ticket_profes()
    {
        if (!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }

        // // //verificar si l'usuari té el rol de professor
        // if(session()->get('user_rol') !== 'professor') {
        //     return redirect()->to(base_url('login'));
        // }

        // Configurar KpaCrud
        $config = [
            'numerate' => false,
            'editable' => false,
            'removable' => false,
            'add_button' => false,
            // hi ha més configuració ademés d'aquesta
        ];

        // Crear instancia KpaCrud
        $crud = new KpaCrud();
        $crud->setConfig($config);

        // $tipus_tiquet = $tiquetModel->obtindreID();

        $crud->setTable('tiquet'); // Nom de la taula
        $crud->setPrimaryKey('id_tiquet'); // Clau primària
        $crud->setRelation('idFK_dispositiu', 'tipus_dispositiu', 'id_tipus', 'tipus'); //relacio entre taula tiquet i tipus_dispositiu

        // Columnes que volem veure
        $crud->setColumns(['codi_equip', 'tipus_dispositiu__tipus', 'descripcio_avaria', 'estat_tiquet']);

        $crud->setColumnsInfo([
            'codi_equip' => [
                'name' => 'Codi del equip'
            ],
            'tipus_dispositiu__tipus' => [
                'name' => 'Tipus de dispositiu',
                'width' => '20%' // Ajustar el ancho del campo
            ],
            'descripcio_avaria' => [
                'name' => 'Descripció',
                'width' => '40%' // Ajustar el ancho del campo
            ],
            'estat_tiquet' => [
                'name' =>  'Estat'
            ]
        ]);

        $crud->addItemLink('view', 'fa-solid fa-eye text-success', base_url('pagina/veure/'), 'Veure ticket');


        // Generar la taula KpaCrud
        $data['table'] = $crud->render();

        // Passar dades a la vista
        return view('pages/TicketProfessors', $data);

    }


    public function afegirIntervencio($id_tiquet)
    {
        if (!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }

        $modelProfessor = new ProfessorModel();
        $modelAlumne = new AlumnesModel();


        $data['id_tiquet'] = $id_tiquet;

        $data['professor'] = $modelProfessor->findAll();

        $data['alumne'] = $modelAlumne->findAll();


        return view('pages/afegirIntervencio', $data);
    }

    public function inserirIntervencio($id_tiquet){
        if(!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }
    
        $fake = Factory::create("es_ES");
    
        $n_rand1 = $fake->randomNumber(8, true);
        $n_rand2 = $fake->randomNumber(8, true);
        $id_intervencio = $n_rand1 . $n_rand2;
    
        $tiquet_Model = new TiquetModel();
        $intervencio_model = new IntervencioModel();
    
        
        $descripcion_avaria = $this->request->getPost('descripcio');
        $codi_equip = $id_tiquet; 
        $profe_reparador = $this->request->getPost('professor');
        $alumne_reparador = $this->request->getPost('alumne');
        $data_intervencio = date("Y-m-d H:i:s");
    
        $intervencio_model->afegirIntervencio($id_tiquet, $descripcion_avaria, $codi_equip, $profe_reparador, $alumne_reparador, $data_intervencio, $id_intervencio);
    
        return redirect()->to("pagina/TicketProfessors");
    }



    


}
