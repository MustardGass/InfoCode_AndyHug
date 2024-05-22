<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AlumnesModel;
use App\Models\CentreModel;
use App\Models\LoginModel;
use App\Models\ProfessorModel;
use App\Models\RolsModel;
use App\Models\UsersRolsModel;
use Faker\Factory;

class UsuarisController extends BaseController
{

    public function registre() {
        //verificar si el usuari es admin
        // if(session()->get('rol') !== 'admin') {
        //     return redirect()->to(base_url('login'));
        // }
        if(!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }
        
        $modelProfessor = new ProfessorModel();
        $modelCentre = new CentreModel();
        $modelLogin = new LoginModel();
        $modelRols = new RolsModel();
        $model_UsersRols = new UsersRolsModel();
        
        
        $fake = Factory::create("es_ES");

        $data['centre_profe'] = $modelCentre->select('codi_centre, nom')->findAll();

        if($this->request->getMethod() === 'POST') {

            $data = [
                'id_xtec' => $this->request->getPost('correu_xtec'),
                'nom' => $this->request->getPost('nom'),
                'cognoms' => $this->request->getPost('apellido'),
                'correu' => $this->request->getPost('correu'),
                'idFK_codi_centre'=> $this->request->getPost('centre')
            ];

            $modelProfessor->registrarProfessor($data);

            //guardar correu_xtec y password a la taula Login
            $pass_hash = password_hash($this->request->getPost('contrasenya'), PASSWORD_DEFAULT);
            
            $data = [
                'idFK_user' => $this->request->getPost('correu_xtec'),
                'password' => $pass_hash
            ];

            $modelLogin->registroUser($data);

            //Guardar correu_xtec y rol a la taula UsersRols
            $rolProfe = $modelRols->where('tipus_rol', 'professor')->first();
            $id_rol = $rolProfe['id_rol'];

            $data = [
                'idFK_user' => $this->request->getPost('correu_xtec'),
                'idFK_rol' => $id_rol
            ];

            $model_UsersRols->addUserRols($data);

            return redirect()->to(base_url("login")); 
        }

        return view("pagines/registre", $data);
    }

    public function registre_alumne() {

        $modelAlumnes = new AlumnesModel();
        $modelLogin = new LoginModel();
        $modelRols = new RolsModel();
        $model_UsersRols = new UsersRolsModel();
        
        if($this->request->getMethod() === 'POST'){
            $data = [
                'correu_alumne' => $this->request->getPost('correu'),
                'idFK_codi_centre' => session()->get('user_centre')
            ];

            $modelAlumnes->registrarAlumne($data);

            // $pass_hash = password_hash($this->request->getPost('contrasenya'), PASSWORD_DEFAULT);
            
            // $data = [
            //     'idFK_user' => $this->request->getPost('correu_xtec'),
            //     'password' => $pass_hash
            // ];

            // $modelLogin->registroUser($data);

            // $rolProfe = $modelRols->where('tipus_rol', 'professor')->first();
            // $id_rol = $rolProfe['id_rol'];

            // $data = [
            //     'idFK_user' => $this->request->getPost('correu_xtec'),
            //     'idFK_rol' => $id_rol
            // ];

            // $model_UsersRols->addUserRols($data);

            return redirect()->to(base_url('pagina/TicketProfessors'));
        }
        


        return view('pages/alumnes/registreAlumnes');
    }

    public function login() {
        
        //Instanciar els models
        $modelAdmin = new AdminModel();
        $modelLogin = new LoginModel();
        $modelUsersRols = new UsersRolsModel();
        $modelProfessor = new ProfessorModel();
        $data = [];

        if($this->request->getPost()){

            $user = $this->request->getPost('usuari');
            $password = $this->request->getPost('contrasenya');

            $usuari_admin = $modelAdmin->obtindreAdmin($user);

            if($usuari_admin){
                if($usuari_admin && password_verify($password, $usuari_admin['password'])){
                    session()->set('isLogged', true);
                    session()->set('user_id', $usuari_admin['id_admin']);
                   
                    return redirect()->to('/pagina/TicketSSTT');
                } else {
                    $data['msg_error'] = "Credencials incorrectes";
                }

            }elseif(!$usuari_admin) {
                $usuari_profe = $modelLogin->obtindreProfessor($user);
                $rol = $modelUsersRols->obtindreRols($user);
                $info_profe = $modelProfessor->obtindreProfessor($user);

                if($usuari_profe && password_verify($password, $usuari_profe['password'])) {
                    session()->set('isLogged', true);
                    session()->set('user_id', $usuari_profe['idFK_user']);
                    session()->set('user_rol', $rol['idFK_rol']);
                    session()->set('user_nom', $info_profe['nom']);
                    session()->set('user_cognoms', $info_profe['cognoms']);
                    session()->set('user_correu', $info_profe['correu']);
                    session()->set('user_centre', $info_profe['idFK_codi_centre']);
    
                    return redirect()->to(base_url('/pagina/TicketProfessors'));
                } else {
                    $data['msg_error'] = "Credencials incorrectes";
                } 
            } else {    //este else se deberia arreglar para el login de usuario alumno
                $data['error'] = "Usuari i contrasenya incorrectes";
            } 
                  
        }
        return view("pages/session/login", $data);
    }


    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

}