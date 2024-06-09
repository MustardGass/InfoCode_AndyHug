<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.min.js"> </script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">

  <link rel="stylesheet" href="<?= base_url("css/style.css") ?>">
  <title>Editar</title>

  <style>
    #wrapper {
      margin: 0 auto;
      padding: 0px;
      text-align: center;
    }

    #wrapper h1 {
      margin-top: 50px;
      font-size: 45px;
      color: #585858;
    }

    #wrapper h1 p {
      font-size: 20px;
    }

    #table_detail {
      max-width: 100%;
      text-align: left;
      border-collapse: collapse;
      color: #2E2E2E;
    }

    #table_detail tr:hover {
      background-color: #000000;
    }

    #table_detail .hidden_row {
      display: none;
      max-width: 100%;
    }

    .headerColor {
      background-color: #005187;
    }

    .menuEsquerra {
      background-color: #344450;
    }
  </style>


</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light headerColor ">
    <div class="container-fluid">
      <a> <img src=<?= base_url('img/logo.png'); ?> alt="Logo" style="max-height: 50px;"> </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active text-white" aria-current="page"
              href="<?= base_url('/pagina/TicketSSTT'); ?>"><?= lang('TicketProfessors.sstt_header'); ?></a>
          </li>
        </ul>
        <div class="d-flex">
          <li class="nav-item dropdown d-flex ">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <img src=<?= base_url('img/user.png'); ?> alt="User" style="max-height: 30px;">
              <?= session()->get('user_id') ?>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?= base_url("/pagina/panelSSTT") ?>"><?= lang('TicketProfessors.opt1'); ?></a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="<?= base_url("logout") ?>"><?= lang('TicketProfessors.desconnectar'); ?></a></li>
            </ul>
          </li>
        </div>
      </div>
    </div>
  </nav>

  <div class="container-fluid">

    <div class="row ">
      <!-- MENÚ VERTICAL ESQUERRA -->
      <div class="container-fluid ps-0">
        <div class="row flex-nowrap">
          <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
              <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-start ms-0 text-start" id="menu">
                <li class="nav-item mt-3">
                  <a class="nav-link text-white" href="<?= base_url('/pagina/TicketSSTT'); ?>"> <img
                      src=<?= base_url('img/iconMenuRosca.png'); ?> alt="Logo"
                      style="max-height: 30px;"><?= lang('TicketProfessors.reparacions_menu'); ?></a>
                </li>

                <li class="nav-item mt-3">
                  <a class="nav-link text-white" href="#"> <img src=<?= base_url('img/iconInventari.png'); ?> alt="Logo"
                      style="max-height: 30px;"><?= lang('TicketProfessors.inventari_menu'); ?></a>
                </li>
              </ul>
            </div>
          </div>


          <div class="col py-3">

            <div class="mt-3 mb-5">
              <h1><?= lang('TicketProfessors.titol_veureTicket'); ?></h1>
            </div>
            
            
            <!-- Mostrar los datos del ticket -->

            <form>

              <div class="container">
                <div class="row">
                  <div class="col">
                    <label for="id_tiquet" class="form-label h5">ID del Tiquet</label>
                    <input type="text" class="form-control" id="id_tiquet" value="<?= esc($id_tiquet) ?>" readonly />
                  </div>
                  <div class="col">
                    <label for="codi_equip" class="form-label h5">Codi de l'equip</label>
                    <input type="text" class="form-control" id="codi_equip" value="<?= esc($codi_equip) ?>" readonly />
                  </div>
                  <div class="col">
                    <label for="idFK_dispositiu" class="form-label h5">ID Dispositiu</label>
                    <input type="text" class="form-control" id="idFK_dispositiu" value="<?= esc($idFK_dispositiu) ?>"
                      readonly />
                  </div>

                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <label for="data_alta" class="form-label h5">Data d'Alta</label>
                    <input type="text" class="form-control" id="data_alta" value="<?= esc($data_alta) ?>" readonly />
                  </div>
                  <div class="col">
                    <label for="estat_tiquet" class="form-label h5">Estat del Tiquet</label>
                    <input type="text" class="form-control" id="estat_tiquet" value="<?= esc($estat_tiquet) ?>"
                      readonly />
                  </div>
                  <div class="col">
                    <label for="idFK_idProfessor" class="form-label h5">ID Professor</label>
                    <input type="text" class="form-control" id="idFK_idProfessor" value="<?= esc($idFK_idProfessor) ?>"
                      readonly />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col">
                    <label for="centre_emitent" class="form-label h5">Centre Emitent</label>
                    <input type="text" class="form-control" id="centre_emitent" value="<?= esc($centre_emitent) ?>"
                      readonly />
                  </div>
                  <div class="col">
                    <label for="centre_reparador" class="form-label h5">Centre Reparador</label>
                    <input type="text" class="form-control" id="centre_reparador" value="<?= esc($centre_reparador) ?>"
                      readonly />
                  </div>
                </div>
                <br>
                
                
                <div class="row">
                  <div class="col">
                    <label for="descripcio_avaria" class="form-label h5">Descripció de l'Avaria</label>
                    <input type="text" class="form-control" id="descripcio_avaria"
                      value="<?= esc($descripcio_avaria) ?>" readonly />
                  </div>
                  
                  
                </div>

                
                <?php
                  if(session()->get('user_id') != "admin"){
                    echo '
                    <div class="row my-5">
                        <div>
                            <a href="' . base_url("pagina/afegirIntervencio/{$id_tiquet}") . '" class="btn btn-primary">+ Afegir intervenció</a>
                        </div>
                    </div>
                    ';
                }
                ?>
                


              </div>

            

            </form>
            <h1>Intervencions</h1>

            <div class="my-5 mx-5">
              <?php foreach ($intervencions as $intervencio): ?>
                <div class="card mb-3">
                  <div class="card-header" style="background-color: #70c1fa;">
                    Id intervenció: <?= esc($intervencio['id_intervencio']); ?>
                  </div>
                  <div class="card-body">
                    <h5 class="card-title">Descripcio: <?= esc($intervencio['descripcio']); ?></h5>
                    <p class="card-text">
                      <strong>Data Intervencio:</strong> <?= esc($intervencio['data_intervencio']); ?><br>
                      <strong>Tiquet:</strong> <?= esc($intervencio['idFK_tiquet']); ?><br>
                      <strong>Alumne reparador:</strong> <?= esc($intervencio['idFK_alumne']); ?><br>
                      <strong>Professor reparador:</strong> <?= esc($intervencio['idFK_professor']); ?>
                    </p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>




          </div>

          


          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>