<!DOCTYPE html>
<html dir="ltr">

<head>
  <?= $meta ?>
  <title>
    <?= $title ?>
  </title>
  <?= $css ?>
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
            <?php if (PERMITS[0] == "1") : ?>
              <h4 class="page-title">
                NUEVO PROYECTO
                <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="showModal(1)">
                  <lord-icon src="<?= base_url() ?>/assets/json/system-outline-44-folder.json" trigger="hover" colors="primary:#ffffff" style="width:25px;height:25px">
                  </lord-icon>
                </button>
              </h4>
            <?php endif; ?>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>home">Inicio</a>
                  </li>
                  <li class="breadcrumb-item">
                    Gestión de proyectos
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= base_url() ?>project">Proyectos</a>
                  </li>
                </ol>
              </nav>
            </div>
          </div>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">
                  LISTA DE PROYECTOS
                </h5>
                <div class="table-responsive  card-pp">
                  <table id="table_obj" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Gerente</th>
                        <th>Marca</th>
                        <?php if ($roleUser != "3") : ?>
                          <th>Comercial</th>
                        <?php endif?>
                        <th>Prioridad</th>
                        <th>Fecha de creación</th>
                        <th>%</th>
                        <th>Orden compra</th>
                        <th>Factura</th>
                        <th>Fecha factura</th>
                        <th>Estado factura</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1 ?>
                      <?php foreach ($projects as $obj) : ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= $obj->Project_code; ?></td>
                          <td><?= $obj->Project_name; ?></td>
                          <td><?= $obj->Client_name; ?></td>
                          <td><?= $obj->Manager_name; ?></td>
                          <td><?= $obj->Brand_name; ?></td>
                          <?php if ($roleUser != "3") : ?>
                            <td><?= $obj->User_name; ?></td>
                          <?php endif?>
                          <td class="priorities-text" style="color: <?= $obj->Priorities_color ?>"><?= $obj->Priorities_name; ?></td>
                          <td><?= $obj->Created_at; ?></td>
                          <td><?= $obj->Project_percentage == NULL ? 0 : $obj->Project_percentage; ?></td>
                          <td><?= $obj->Project_purchaseOrder; ?></td>
                          <td><?= $obj->Project_invoice == null ? '' : $obj->Project_invoice; ?></td>
                          <td><?= $obj->Project_invoiceDate == null ? '' : $obj->Project_invoiceDate; ?></td>
                          <td><?= $obj->Project_invoiceState == null ? '' : $obj->Project_invoiceState; ?></td>
                          <td>                            
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              <?php if (PERMITS[2] == "3") : ?>
                                <?php if ($obj->Stat_id != 10) : ?>
                                <button type="button" class="btn btn-outline-warning" onclick="getDataId(<?= $obj->Project_id ?>)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                  </svg>
                                </button>
                                <?php endif; ?>
                              <?php endif; ?>
                              <?php if (PERMITS[1] == "2") : ?>
                                <button type="button" class="btn btn-outline-success" onclick="details(<?= $obj->Project_id ?>)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                  </svg>
                                </button>
                              <?php endif; ?>
                              <?php if (PERMITS[3] == "4") : ?>
                                <?php if ($obj->Project_percentage != 100) : ?>
                                  <button type="button" class="btn btn-outline-danger" onclick="delete_(<?= $obj->Project_id ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                      <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                    </svg>
                                  </button>
                                <?php endif; ?>
                              <?php endif; ?>
                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Cliente</th>
                        <th>Gerente</th>
                        <th>Marca</th>
                        <?php if ($roleUser != "3") : ?>
                          <th>Comercial</th>
                        <?php endif?>
                        <th>Prioridad</th>
                        <th>Fecha de creación</th>
                        <th>%</th>
                        <th>Orden compra</th>
                        <th>Factura</th>
                        <th>Fecha factura</th>
                        <th>Estado factura</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" data-bs-backdrop="static" id="createUpdateModal" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <h5 class="modal-title" id="createUpdateModalLabel">NUEVO PROYECTO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="row">
                  <form class="form-horizontal mt-3 row" id="objForm" action="" onsubmit="sendData(event,this.id)">
                    <input type="hidden" class="form-control" id="Project_id" name="Project_id" value="0">
                    <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                    <div class="col-12 col-md-6 mb-3">
                      <label for="Project_name" class="bmd-label-floating">Nombre del Proyecto *</label>
                      <input type="text" class="form-control" id="Project_name" name="Project_name" required>
                    </div>
                    <div class="col-12 col-md-6 mb-3">
                      <label for="Client_id">Cliente *</label>
                      <select name="Client_id" id="Client_id" class="form-control form-disabled form-select" required>
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($clients as $client) : ?>
                          <option value="<?= $client['Client_id'] ?>">
                            <?= $client['Client_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Manager_id">Gerente *</label>
                      <select name="Manager_id" id="Manager_id" class="form-control form-select read" required>
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($managers as $manager) : ?>
                          <option value="<?= $manager['Manager_id'] ?>">
                            <?= $manager['Manager_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Brand_id">Marca *</label>
                      <select name="Brand_id" id="Brand_id" class="form-control form-select read" required>
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($brands as $brand) : ?>
                          <option value="<?= $brand['Brand_id'] ?>">
                            <?= $brand['Brand_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Country_id">País</label>
                      <select name="Country_id" id="Country_id" class="form-control form-disabled form-select read">
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($countries as $country) : ?>
                          <option value="<?= $country['Country_id'] ?>">
                            <?= $country['Country_name'] ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_commercial">Nombre del comercial *</label>
                      <select name="Project_commercial" id="Project_commercial" class="form-control form-select" required>
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($commercial as $user) : ?>
                          <option value="<?= $user->User_id; ?>">
                            <?= $user->User_name; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_purchaseOrder">Orden de compra *</label>
                      <input type="text" class="form-control" id="Project_purchaseOrder" name="Project_purchaseOrder" maxlength="100" required>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_ddtStartDate">Fecha Inicio DDT</label>
                      <input type="date" class="form-control" id="Project_ddtStartDate" name="Project_ddtStartDate">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <label for="Project_ddtEndDate">Fecha Máxima DDT</label>
                      <input type="date" class="form-control" id="Project_ddtEndDate" name="Project_ddtEndDate">
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <label for="Project_startDate">Fecha Inicio Proyecto *</label>
                      <input type="date" class="form-control" id="Project_startDate" name="Project_startDate" required>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <label for="Project_estimatedEndDate">Fecha Finalización Estimada *</label>
                      <input type="date" class="form-control" id="Project_estimatedEndDate" name="Project_estimatedEndDate" required>
                    </div>
                    <div class="col-12 col-md-3 mb-3">
                      <label for="User_id">Notificar a: *</label>
                      <select name="User_id" id="User_id" class="form-control form-select" required>
                        <option value="">
                          Seleccione...
                        </option>
                        <?php foreach ($users as $user) : ?>
                          <option value="<?= $user['User_id']; ?>">
                            <?= $user['User_name']; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Priorities_id">Prioridad *</label>
                      <select class="form-control form-select" id="Priorities_id" name="Priorities_id" required>
                        <option value="">Seleccione...</option>
                        <?php foreach ($priorities as $priorities) : ?>
                          <option value="<?= $priorities['Priorities_id']; ?>">
                            <?= $priorities['Priorities_name']; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_activitiEndDate">Fecha Finalización de Actividades</label>
                      <input type="date" class="form-control form-disabled read" id="Project_activitiEndDate" name="Project_activitiEndDate">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_invoice">Número de factura</label>
                      <input type="text" class="form-control" id="Project_invoice" name="Project_invoice" maxlength="30">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_invoiceDate">Fecha de la factura</label>
                      <input type="date" class="form-control" id="Project_invoiceDate" name="Project_invoiceDate">
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Project_invoiceState">Estado de la factura</label>
                      <select class="form-control form-select" id="Project_invoiceState" name="Project_invoiceState">
                        <option value="">Seleccione</option>
                        <option value="No facturado">No facturado</option>
                        <option value="Facturado">Facturado</option>
                        <option value="En seguimiento">En seguimiento</option>
                        <option value="Cancelada">Cancelada</option>
                      </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                      <label for="Stat_id">Estado del proyecto</label>
                      <select class="form-control form-select read" id="Stat_id" name="Stat_id">
                        <?php foreach ($projectstatuses as $projectstatus) : ?>
                          <option value="<?= $projectstatus->Stat_id; ?>">
                            <?= $projectstatus->Stat_name; ?>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="col-12 col-md-12 mb-3">
                      <label for="Project_observation">Observaciones</label>
                      <textarea class="form-control" id="Project_observation" name="Project_observation" maxlength="1000" rows="5"></textarea>
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
        </div>
        <?= $footer ?>
        <?= $toasts ?>
      </div>
    </div>
    <?= $js ?>
    <script src="./controllers/project/project.controller.js"></script>
</body>