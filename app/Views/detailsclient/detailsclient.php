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
            <div class="ms-auto text-end">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item">
                    <a href="<?= base_url() ?>home">Inicio</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    <a href="<?= base_url() ?>client">Clientes</a>
                  </li>
                  <li class="breadcrumb-item active" aria-current="page">
                    Detalle del cliente
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
            <div class="col-4">
              <h6>Datos de Cliente</h6>
            </div>
          </div>
          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button" role="tab" aria-controls="details" aria-selected="true">Información de Clientes</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Marca</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Gerente de Marca</button>
            </li>
          </ul>

          <!-- GESTIÓN DE CLIENTES -->


          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">

              <!-- DETALLES DE CLIENTES -->

              <div class="form-horizontal mt-3 row">
                <input type="hidden" class="form-control" id="Client_id" name="Client_id" value="<?= $clients->Client_id ?>">
                <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                <div class="fmb-3 col-4">
                  <label for="Client_name">Nombre</label>
                  <input type="text" class="form-control" disabled id="Client_name" name="Client_name" value="<?= $clients->Client_name ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="DocType_id">Tipo de documento</label>
                  <input type="text" class="form-control" disabled id="DocType_id" name="DocType_id" value="<?= $clients->DocType_name ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Client_identification">Identificación</label>
                  <input type="text" class="form-control" disabled id="Client_identification" name="Client_identification" value="<?= $clients->Client_identification ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Client_email">Correo Electronico</label>
                  <input type="text" class="form-control" disabled id="Client_email" name="Client_email" value="<?= $clients->Client_email ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Client_phone">Telefono</label>
                  <input type="text" class="form-control" disabled id="Client_phone" name="Client_phone" value="<?= $clients->Client_phone ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Client_address">Dirección</label>
                  <input type="text" class="form-control" disabled id="Client_address" name="Client_address" value="<?= $clients->Client_address ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Comp_id">Empresa</label>
                  <input type="text" class="form-control" disabled id="Comp_id" name="Comp_id" value="<?= $clients->Comp_name ?>" required>
                </div>
                <div class="mb-3 col-4">
                  <label for="Stat_id">Estado</label>
                  <input type="text" class="form-control" disabled id="Stat_id" name="Stat_id" value="<?= $clients->Stat_name ?>" required>
                </div>
                <div class=" mb-3 col-4">
                  <label for="Country_id">Pais</label>
                  <input type="text" class="form-control" disabled id="Country_id" name="Country_id" value="<?= $clients->Country_name ?>" required>
                </div>
              </div>
            </div>

            <!-- GESTIÓN DE MARCA -->

            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

              <!-- TABLA DE MARCA-->

              <div class="card-app">
                <h4 class="page-title text-end">
                  Agregar Marca
                  <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="showBrandModal(1)"><i class="mdi mdi-plus"></i></button>
                </h4>
                <div class="card-body">
                  <h5 class="card-title">
                    LISTADO DE MARCAS
                  </h5>
                  <div class="table-responsive">
                    <table id="table_obj_brand" class="table table-striped table-bordered">
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
                        <?php foreach ($brands as $obj) : ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $obj['Brand_name']; ?></td>
                            <td><?= $obj['created_at']; ?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-outline-warning" onclick="getBrandDataId(<?= $obj['Brand_id'] ?>, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                  </svg></button>
                                <button type="button" class="btn btn-outline-success" onclick="getBrandDataId(<?= $obj['Brand_id'] ?>, 0)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                  </svg></button>
                                <button type="button" class="btn btn-outline-danger" onclick="deleteBrand(<?= $obj['Brand_id'] ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                  </svg></button>
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

              <!-- MODAL DE MARCA -->

              <div class="modal fade" id="BrandModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                  <div class="modal-content" style="width: 100%;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="createUpdateModalLabel">NUEVA MARCA</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal mt-3 row" id="objBrandForm" action="" onsubmit="sendBrandData(event,this.id)">
                        <input type="hidden" class="form-control" id="Brand_id" name="Brand_id" value="0">
                        <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                        <div class="col-12 mb-3">
                          <label for="Brand_name">Nombre *</label>
                          <input type="text" class="form-control" id="Brand_name" name="Brand_name" required autocomplete="off">
                        </div>
                        <div class="col-12 mb-3">
                          <label for="Brand_description">Descripción</label>
                          <input type="text" class="form-control" id="Brand_description" name="Brand_description">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary mx-auto w-50" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" id="btn-submit" form="objBrandForm" class="btn btn-primary mx-auto w-50">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

            </div>

            <!-- GESTIÓN DE GERENTE DE MARCA -->

            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

              <!-- TABLA DE GERENTE DE MARCA-->

              <div class="card-app row">
                <h4 class="page-title text-end">
                  Agregar Gerente
                  <button type="button" class="btn btn-primary btn-circle btn-lg" onclick="showManagerModal(1)"><i class="mdi mdi-plus"></i></button>
                </h4>
                <div class="card-body">
                  <h5 class="card-title">
                    LISTADO DE GERENTES
                  </h5>
                  <div class="table-responsive">
                    <table id="table_obj" class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Teléfono</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i = 1 ?>
                        <?php foreach ($managers as $obj) : ?>
                          <tr>
                            <td><?= $i++; ?></td>
                            <td><?= $obj['Manager_name']; ?></td>
                            <td><?= $obj['Manager_email']; ?></td>
                            <td><?= $obj['Manager_phone']; ?></td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-outline-warning" onclick="getManagerDataId(<?= $obj['Manager_id'] ?>, 1)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                  </svg></button>
                                <button type="button" class="btn btn-outline-success" onclick="getManagerDataId(<?= $obj['Manager_id'] ?>, 0)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                  </svg></button>
                                <button type="button" class="btn btn-outline-info" onclick="activeUser(<?= $obj['Manager_id'] ?>)">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill-check" viewBox="0 0 16 16">
                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z" />
                                  </svg>
                                </button>
                                <button type="button" class="btn btn-outline-danger" onclick="deleteManager(<?= $obj['Manager_id'] ?>)"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                  </svg>
                                </button>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>#</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Teléfono</th>
                          <th>Acciones</th>
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>

              <!-- MODAL DE GERENTE DE MARCA-->

              <div class="modal fade" id="ManagerModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="createUpdateModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                  <div class="modal-content card-pp" style="width: 100%;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="createUpdateModalLabel">AGREGAR GERENTE</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal mt-3 row" id="objManagerForm" action="" onsubmit="sendManagerData(event,this.id)">
                        <input type="hidden" class="form-control" id="Manager_id" name="Manager_id" value="0">
                        <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                        <div class="col-12 mb-3">
                          <label for="Manager_name">Nombre *</label>
                          <input type="text" class="form-control" id="Manager_name" name="Manager_name" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                          <label for="Manager_email">Correo *</label>
                          <input type="text" class="form-control" id="Manager_email" name="Manager_email" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                          <label for="Manager_phone">Teléfono *</label>
                          <input type="text" class="form-control" id="Manager_phone" name="Manager_phone" required>
                        </div>
                        <div class="col-12 mb-3">
                          <label for="brand_id">Marcas</label>
                          <ul class="row" id="managerBrands" style="list-style-type: none;">
                            <?php foreach ($managerBrands as $brand) : ?>
                              <li class="col-4">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" onchange="toggleBrand(<?= $brand->Brand_id ?>)">
                                  <label class="form-check-label text-break"><?= $brand->Brand_name ?></label>
                                </div>
                              </li>
                            <?php endforeach; ?>
                          </ul>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary mx-auto w-50" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" id="btn-submit" form="objManagerForm" class="btn btn-primary mx-auto w-50">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Modal usuario -->
              <div class="modal fade" id="userModal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable modal-lg">
                  <div class="modal-content card-pp" style="width: 100%;">
                    <div class="modal-header">
                      <h5 class="modal-title" id="userModalLabel">ACTIVAR USUARIO PARA GERENTE</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form class="form-horizontal mt-3 row" id="objUserForm" action="" onsubmit="sendUserData(event,this.id)">
                        <input type="hidden" class="form-control" id="UserManager_id" name="UserManager_id" value="0">
                        <input type="hidden" class="form-control" id="Manager_id" name="Manager_id" value="0">
                        <input type="hidden" class="form-control" id="updated_at" name="updated_at" value="NULL">
                        <div class="col-12 col-md-6 mb-3">
                          <label for="User_email">Correo *</label>
                          <input type="text" class="form-control form-disabled" id="User_email" name="User_email" required>
                        </div>
                        <div class="col-12 col-md-6 mb-3">
                          <label for="Stat_id">Estado de usuario *</label>
                          <select class="form-select form-select-sm read" id="Stat_id" name="Stat_id" aria-label=".form-select-sm " required>
                            <?php foreach ($status as $statu) : ?>
                              <option value="<?= $statu->Stat_id; ?>"> <?= $statu->Stat_name; ?></option>
                            <?php endforeach; ?>
                          </select>
                        </div>
                        <div id="userPassword-div" class="col-12 col-md-6 mb-3 user-password">
                          <label for="User_password">Contraseña</label>
                          <input type="password" class="form-control" id="User_password" name="User_password" placeholder="Contraseña" required>
                        </div>
                        <div id="userPassword-div" class="col-12 col-md-5 mb-3 user-password">
                          <label for="confirmPassword">Confirmar contraseña</label>
                          <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirmar contraseña" required>
                        </div>
                        <div id="userPassword-div" class="col-1 mb-3 align-self-end user-password">
                          <button type="button" class="btn btn-outline-primary" id="showPassword" name="showPassword" data-bs-toggle="tooltip" data-bs-placement="top" title="Ver/Ocultar" style="border: none;">
                            <i class="bi bi-eye" style="font-size: 1.6rem;"></i>
                          </button>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary mx-auto w-50" data-bs-dismiss="modal">Cerrar</button>
                      <button type="submit" id="btn-submit" form="objUserForm" class="btn btn-primary mx-auto w-50">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <h4 class="page-title text-end">
            <input type="button" onclick="history.back()" class="btn btn-primary" name="volver atrás" value="VOLVER">
          </h4>
        </div>
      </div>
      <?= $footer ?>
      <?= $toasts ?>
    </div>.
  </div>
  <?= $js ?>
  <script src="./controllers/client/client.controller.js"></script>
  <script src="./controllers/manager/manager.controller.js"></script>
  <script src="./controllers/usermanager/usermanager.controller.js"></script>
  <script src="./controllers/brand/brand.controller.js"></script>
</body>