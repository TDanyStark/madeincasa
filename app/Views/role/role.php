<!DOCTYPE html>
<html lang="en">

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
                NUEVO ROL
              </h4>
              <lord-icon src="<?= base_url() ?>/assets/json/wired-flat-49-plus-circle.json" trigger="hover" colors="primary:#ffffff" style="width:60px; height:60px; cursor: pointer;" onclick="showModal(1)">
              </lord-icon>
            <?php endif; ?>
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>home">Inicio</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Gestión de usuarios
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= base_url() ?>role">Roles</a>
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
                  LISTA DE ROLES
                </h5>
                <div class="table-responsive">
                  <table id="table_obj" class="table table-striped table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1 ?>
                      <?php foreach ($roles as $obj) : ?>
                        <tr>
                          <td><?= $i++; ?></td>
                          <td><?= $obj['Role_name']; ?></td>
                          <td><?= $obj['created_at']; ?></td>
                          <td>
                            <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                              <?php if (PERMITS[2] == "3") : ?>
                                <button type="button" onclick="getDataId(<?= $obj['Role_id'] ?>, 1)" class="btn btn-outline-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                  </svg>
                                </button>
                              <?php endif; ?>
                              <?php if (PERMITS[1] == "2") : ?>
                                <button type="button" class="btn btn-outline-success" onclick="getDataId(<?= $obj['Role_id'] ?>, 0)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                  </svg>
                                </button>
                              <?php endif; ?>
                              <?php if (PERMITS[3] == "4") : ?>
                                <?php if ($obj['Role_id'] > 7) : ?>
                                  <button type="button" onclick="delete_(<?= $obj['Role_id'] ?>)" class="btn btn-outline-danger">
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
                        <th>Nombre</th>
                        <th>Fecha de creación</th>
                        <th>Acciones</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="createUpdateModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <h5 class="modal-title" id="createUpdateModalLabel">NUEVO ROL</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form class="form-horizontal mt-3" id="objForm" action="" onsubmit="sendData(event,this.id)">
                  <input type="hidden" class="form-control" id="Role_id" name="Role_id" value="0">
                  <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                  <div class="mb-3">
                    <label for="DocType_name">Nombre del rol *</label>
                    <input type="text" class="form-control" id="Role_name" name="Role_name" required>
                  </div>
                  <div class=" mb-3">
                    <label>Permisos *</label>
                    <br>
                    <table class="table col-12" id="table-modules">
                      <thead>
                        <tr>
                          <th>Vista</th>
                          <?php foreach ($permits as $permit) : ?>
                            <th><?= $permit['Perm_name'] ?></th>
                          <?php endforeach; ?>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($modules as $module) : ?>
                          <tr>
                            <td data-module-id="<?= $module['Mod_id'] ?>"><?= $module['Mod_name'] ?></td>
                            <?php foreach ($permits as $permit) : ?>
                              <th>
                                <input type="checkbox" module-id="<?= $module['Mod_id'] ?>" onchange="toggleModule(<?= $module['Mod_id'] ?>, <?= $permit['Perm_id'] ?>)" class="form-check-input" value="<?= $permit['Perm_id'] ?>">
                              </th>
                            <?php endforeach; ?>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
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
  <script src="./controllers/role/role.controller.js"></script>
</body>

</html>