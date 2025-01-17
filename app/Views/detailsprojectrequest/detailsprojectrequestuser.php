<!DOCTYPE html>
<html dir="ltr">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="keywords" content="Made in casa, Market Support" />
  <meta name="description" content="Made in Casa - Construyendo el futuro. Plataforma de gestión proyectos." />
  <meta name="robots" content="noindex,nofollow" />
  <title><?= $title ?></title>
  <?= $css ?>
  <!-- Custom CSS -->

</head>

<body>
  <div class="preloader">
    <div class="lds-ripple">
      <div class="lds-pos"></div>
      <div class="lds-pos"></div>
    </div>
  </div>
  <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
    <?= $header ?>
    <?= $sidebar ?>
    <div class="page-wrapper">
      <div class="page-breadcrumb">
        <div class="row">
          <div class="col-12 d-flex no-block align-items-center">
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>home">Inicio</a>
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    Gestión de proyectos
                  </li>
                  <li class="breadcrumb-item" aria-current="page">
                    <a href="<?= base_url() ?>projectrequest">Solicitudes</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= base_url() ?>projectrequestproduct">Detalle de la solicitud</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="card-details">
          <div class="row percentaje">
            <div class="col-12 col-md-4">
              <h6>Detalle de la solicitud</h6>
            </div>
          </div>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Información del Proyecto</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
              <div class="form-horizontal mt-3">
                <div class="row">
                  <div class="col-12 col-md-6 mb-3">
                    <label for="ProjReq_name">Nombre del proyecto</label>
                    <input type="text" class="form-control" disabled id="ProjReq_name" name="ProjReq_name" value="<?= $data["projectrequest"]->ProjReq_name ?>" required>
                  </div>
                  <div class="col-12 col-md-6 mb-3">
                    <label for="Client_name">Cliente</label>
                    <input type="text" class="form-control" disabled id="Client_name" name="Client_name" value="<?= $data["projectrequest"]->Client_name ?>" required>
                  </div>
                  <div class="col-12 col-md-4 mb-3">
                    <label for="Country_name">País</label>
                    <input type="text" class="form-control" disabled id="Country_name" name="Country_name" value="<?= $data["projectrequest"]->Country_name ?>" required>
                  </div>
                  <div class="col-12 col-md-4 mb-3">
                    <label for="User_name">Gerente</label>
                    <input type="text" class="form-control" disabled id="User_name" name="User_name" value="<?= $data["projectrequest"]->User_name ?>" required>
                  </div>
                  <div class="col-12 col-md-4 mb-3">
                    <label for="Brand_name">Marca</label>
                    <input type="text" class="form-control" disabled id="Brand_name" name="Brand_name" value="<?= $data["projectrequest"]->Brand_name ?>" required>
                  </div>
                  <div class="col-12 mb-3">
                    <label for="ProjReq_observation">Observaciones</label>
                    <input type="text" class="form-control" size="15" maxlength="30" disabled id="ProjReq_observation" value="<?= $data["projectrequest"]->ProjReq_observation ?>" name="Project_observation" required>
                  </div>
                </div>
              </div>

              <!-- TABLA DE PROYECT_PRODUCT -->

              <div class="card-pp">
                <?php if($data['projectrequest']->Stat_id == 6): ?>
                <h4 class="page-title text-end">
                  Agregar Producto
                  <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="showModal(1)"><i class="mdi mdi-plus"></i></button>
                </h4>
                <?php endif; ?>
                <div class="table-responsive table-pp">
                  <table id="table_product" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1 ?>
                      <?php foreach ($data['projectrequestproducts'] as $obj) : ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= $obj->Prod_name; ?></td>
                          <td><?= $obj->ProjReq_product_amount; ?></td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              <?php if ($data['projectrequest']->Stat_id == 6) : ?>
                                <button type="button" class="btn btn-outline-warning" onclick="getDataId(<?= $obj->ProjReq_product_id ?>, 1)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                  </svg>
                                </button>
                              <?php endif; ?>
                              <button type="button" class="btn btn-outline-success" onclick="getDataId(<?= $obj->ProjReq_product_id ?>, 0)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                  <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                  <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                </svg>
                              </button>
                              <?php if ($data['projectrequest']->Stat_id == 6) : ?>
                                <button type="button" class="btn btn-outline-danger" onclick="delete_(<?= $obj->ProjReq_product_id ?>)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"></path>
                                  </svg>
                                </button>
                              <?php endif; ?>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <div class="row text-end">
            <h4 class="col-12 page-title ">
              <input type="button" onclick="history.back()" class="btn btn-primary" name="volver atrás" value="VOLVER">
            </h4>
          </div>
        </div>
      </div>

      <div class="modal fade" id="createUpdateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
          <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
              <h5 class="modal-title" id="createUpdateModalLabel">AGREGAR PRODUCTO</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form class="form-horizontal mt-3 row" id="objForm" action="POST" onsubmit="sendData(event,this.id)">
                <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                <input type="hidden" class="form-control" id="ProjReq_product_id" name="Project_product_id" value="NULL">
                <input type="hidden" class="form-control" id="ProjReq_id" name="ProjReq_id" value="<?= $data['projectrequest']->ProjReq_id ?>">
                <div class="col-12 col-md-8 mb-3">
                  <label for="Prod_id">Producto *</label>
                  <select class="form-control form-select" name="Prod_id" id="Prod_id" required>
                    <option value="">
                      Seleccionar...
                    </option>
                    <?php foreach ($products as $product) : ?>
                      <option value="<?= $product['Prod_id']; ?>">
                        <?= $product['Prod_name']; ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-12 col-md-4 mb-3">
                  <label for="ProjReq_product_amount">Cantidad *</label>
                  <input type="number" class="form-control" id="ProjReq_product_amount" name="ProjReq_product_amount" min="1" required>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary mx-auto w-50" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" id="btn-submit" form="objForm" class="btn btn-primary mx-auto w-50">Guardar</button>
            </div>
          </div>
        </div>
      </div>
      <?= $footer ?>
      <?= $toasts ?>
    </div>.
  </div>
  <?= $js ?>
  <script src="./controllers/detailprojectuser/detailprojectuser.controller.js"></script>
</body>