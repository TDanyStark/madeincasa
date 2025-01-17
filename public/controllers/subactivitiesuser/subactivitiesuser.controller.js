showPreload();

$("#table_obj").DataTable({
  "language": {
    "url": "//cdn.datatables.net/plug-ins/1.10.16/i18n/Spanish.json"
  }
});

const arRoutes = AR_ROUTES_GENERAL;
const arMessages = new Array('Revise la información suministrada', 'Subactividad creada exitosamente', 'Subactividad actualizada exitosamente', 'Subactividad eliminada exitosamente', 'La subactividad no pudo ser eliminada', 'Se ha copiado el link', 'No pudo ser copiado el link', 'Notificación enviada con éxito', 'E-mail enviado con éxito');
const ruteContent = "subactivitiesuser/";
const nameModel = 'subactivitiesUser';
const dataModel = 'data';
const dataResponse = 'response';
const dataMessages = 'message';
const dataCsrf = 'csrf';

const primaryId = 'SubAct_id';
const URL_ROUTE = BASE_URL + ruteContent;

const myModalObjec = '#createUpdateModal';
const idForm = 'objForm';
const idEmailForm = 'objEmailForm';
const idFinForm = 'objFinForm';
const infoUrl = 'https://ior.ad/9paG';

var sTForm = null;
var sTFormEmail = null
var sTFormFin = null
var url = "";
var assignmentAction = 0;
var formData = new Object();

let collaborators = [];

function toogleCollaborator(email) {
  const isExists = !!collaborators.find(collaborator => collaborator === email);
  if (isExists) collaborators = collaborators.filter(collaborator => collaborator !== email)
  else collaborators.push(email);
}

function finish(formId) {
  showPreload();
  let form = document.getElementById(formId);
  url = URL_ROUTE + 'finish';
  const id = form.querySelector(`#${primaryId}`).value;
  let duration = form.querySelector(`#SubAct_duration`).value;
  let description = form.querySelector(`#SubAct_description`).value;
  const formData = {
    'SubAct_id' : id,
    'SubAct_duration' : duration,
    'SubAct_description' : description
  };
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  }).then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: arMessages[8],
          showConfirmButton: false,
          timer: 1500
        });
        $(finModal).modal("hide");
        window.location.reload();
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        );
      }
      hidePreload();
    }).catch(() => hidePreload());
}

function sendNotification() {
  showPreload();
  url = URL_ROUTE + 'notification';
  const form = SingletonClassSTFormEmail.getInstance();
  const formData = form.getDataForm();
  formData['collaborators'] = collaborators.join(',');
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  }).then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: arMessages[7],
          showConfirmButton: false,
          timer: 1500
        });
        $(emailModal).modal("hide");
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        );
      }
      form.inputButtonEnable();
      hidePreload();
    });
}

function update(formData) {
  url = URL_ROUTE + arRoutes[2];
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: arMessages[2],
          showConfirmButton: false,
          timer: 1500
        });
        hideModal();
        setTimeout(function(){
          window.location.reload();
        }, 2000);  
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        );
      }
      sTForm.inputButtonEnable();
      hidePreload();
    });
}

function delete_(id) {
Swal.fire({
    title: '¿Está seguro?',
    text: "¡Esta acción no se puede revertir!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#7460ee',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, eliminar!'
  }).then((result) => {
    if (result.isConfirmed) {
      showPreload();
      url = URL_ROUTE + arRoutes[3];
      formData[primaryId] = id;
      formData['activityId'] = document.getElementById('Activi_id').value;
      fetch(url, {
        method: "POST",
        body: JSON.stringify(formData),
        headers: {
          "Content-Type": "application/json",
          "X-Requested-With": "XMLHttpRequest"
        }
      })
        .then(response => response.json())
        .catch(error => console.error('Error:', error))
        .then(response => {
          if (response[dataResponse] == 200) {
            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: arMessages[3],
              showConfirmButton: false,
              timer: 1500
            });
            window.location.reload();
  
          } else {
            Swal.fire(
              '¡No pudimos hacer esto!',
              arMessages[4],
              'error'
            );
          }
          hidePreload();
        });
    }
  })
}

function sendData(e, formObj) {
  let obj = formObj;
  sTForm = SingletonClassSTForm.getInstance();
  if (sTForm.validateForm()) {
    showPreload();
    update(sTForm.getDataForm());
    sTForm.inputButtonDisable();
  } else {
    Swal.fire(
      '¡No pudimos hacer esto!',
      arMessages[0],
      'error'
    );
  }
  e.preventDefault();
}

function detail(idData) {
  getDataId(idData);
  // toogleDisabledFields();
}

function getDataIdFinish(idData) {
  showPreload();
  formData[primaryId] = idData;
  url = URL_ROUTE + arRoutes[4];
  sTForm = SingletonClassSTFormFin.getInstance();
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        showFinModal(0);
        sTForm.setDataForm(response[dataModel]);
        hidePreload();
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        );
      }
    });
}

function getDataId(idData, type) {
  showPreload();
  formData[primaryId] = idData;
  url = URL_ROUTE + arRoutes[4];
  sTForm = SingletonClassSTForm.getInstance();
  fetch(url, {
    method: "POST",
    body: JSON.stringify(formData),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        showModal(0);
        sTForm.setDataForm(response[dataModel]);
        if(type == 0){
          sTForm.inputButtonDisable();
        } 
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        );        
      }
      hidePreload();
    });
}

function addData() {
  showModal(1);
}

function hideModal() {
  $(myModalObjec).modal("hide");
}

function showModal(type) {
  if (type == 1) {
    sTForm = SingletonClassSTForm.getInstance();
    sTForm.inputButtonEnable();
    disableFormProject();
  }
  sTForm.clearDataForm();
  $(myModalObjec).modal("show");
}

function showPreload() {
  $(".preloader").fadeIn();
}

function hidePreload() {
  $(".preloader").fadeOut();
}

var SingletonClassSTForm = (function () {
  var objInstance;
  function createInstance() {
    var object = new STForm(idForm);
    return object;
  }
  return {
    getInstance: function () {
      if (!objInstance) {
        objInstance = createInstance();
      }
      return objInstance;
    }
  }
})();

function showEmailModal(type, idData) {
  if (type == 1) {
    sTFormEmail = SingletonClassSTFormEmail.getInstance();
    sTFormEmail.inputButtonEnable();
    document.getElementById('not_subId').value = idData;
  }
  sTFormEmail.clearDataForm();
  $(emailModal).modal("show");
}

var SingletonClassSTFormEmail = (function () {
  var objInstance;
  function createInstance() {
    var object = new STForm(idEmailForm);
    return object;
  }
  return {
    getInstance: function () {
      if (!objInstance) {
        objInstance = createInstance();
      }
      return objInstance;
    }
  }
})();

function showFinModal(type) {
  $(finModal).modal("show");
}

var SingletonClassSTFormFin = (function () {
  var objInstance;
  function createInstance() {
    var object = new STForm(idFinForm);
    return object;
  }
  return {
    getInstance: function () {
      if (!objInstance) {
        objInstance = createInstance();
      }
      return objInstance;
    }
  }
})();

function changePercent() {
  document.getElementById('SubAct_percentage').addEventListener('change', function (e) {
    const value = +e.target.value;
    const options = document.getElementById('Stat_id');
    if (value === 0) {
      for (let i = 0; i < options.length; i++) {
        const text = options[i].innerText.trim();
        if (text === 'Sin asignar') {
          options[i].selected = "true";
        }
      }
    } else if (value > 0 && value < 100) {
      for (let i = 0; i < options.length; i++) {
        const text = options[i].innerText.trim();
        if (text === 'Pendiente') {
          options[i].selected = "true";
        }
      }
    } else {
      for (let i = 0; i < options.length; i++) {
        const text = options[i].innerText.trim();
        if (text === 'Realizado') {
          options[i].selected = "true";
        }
      }
    }
  });
}

function disableFormProject() {
  let readInputs = document.getElementsByClassName('read');
  for (element of readInputs) {
    element.setAttribute("disabled", "true");
  }
}

document.getElementById("SubAct_percentage").addEventListener('focusout', function(){
  let percent = document.getElementById("SubAct_percentage").value;
  if (percent == 100){
    Swal.fire({
      title: 'Revise la información',
      html: "Si desea marcar la subactividad como completada, por favor use el botón de <button class='btn btn-outline-primary'><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-check2-square' viewBox='0 0 16 16'>"
      +"<path d='M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z'></path>"+
      "<path d='m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z'></path>"+
    "</svg></button>",
      icon: 'warning'
    });
  }
})

document.getElementById('btn-info').href = infoUrl;