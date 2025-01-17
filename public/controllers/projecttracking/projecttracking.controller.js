
const ruteContentTracking = "projecttracking/";
const nameModelTracking = 'projecttrackings';
const dataModelTracking = 'data';
const dataResponseTracking = 'response';
const dataMessagesTracking = 'message';
const dataCsrfTracking = 'csrf';

const primaryIdTracking = 'ProjectTrack_id';
const URL_ROUTETracking = BASE_URL + ruteContentTracking;

const TrackingModal = '#TrackingModal';
const idTrackingForm = 'objTrackingForm';

var sTFormTracking = null
var urlTracking = "";
var assignmentActionTracking = 0;
var formDataTracking = new Object();
var selectInsertOrUpdateTracking = true;

function createTracking(formData) {
  urlTracking = URL_ROUTETracking + arRoutes[0];
  formData['Project_id'] = document.getElementById('Project_id').value;
  fetch(urlTracking, {
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
        })
        hidelTrackingModal();
        setTimeout(function(){
          window.location.reload();
        }, 2000);  
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        )
      }
      sTFormTracking.inputButtonEnable();
      hidePreload();
    });
}

function updateTracking(formData) {
  urlTracking = URL_ROUTETracking + arRoutes[2];
  formData['Project_id'] = document.getElementById('Project_id').value;
  fetch(urlTracking, {
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
          title: arMessages[5],
          showConfirmButton: false,
          timer: 1500
        })
        hidelTrackingModal();
        setTimeout(function(){
          window.location.reload();
        }, 2000);  
      } else {
        Swal.fire(
          '¡No pudimos hacer esto!',
          arMessages[0],
          'error'
        )
      }
      sTFormTracking.inputButtonEnable();
      hidePreload();
    });
}

function deleteTracking(id) {
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
      urlTracking = URL_ROUTETracking + arRoutes[3];
      formData[primaryIdTracking] = id;
      fetch(urlTracking, {
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
              title: arMessages[8],
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function(){
              window.location.reload();
            }, 2000);  
          } else {
            Swal.fire(
              '¡No pudimos hacer esto!',
              arMessages[11],
              'error'
            )
          }
          hidePreload();
        });
    }
  })
}

function sendTrackingData(e, formObj) {
  let obj = formObj;
  sTFormTracking = SingletonClassSTFormTracking.getInstance();
  if (sTFormTracking.validateForm()) {
    showPreload();
    if (selectInsertOrUpdateTracking) {
      createTracking(sTFormTracking.getDataForm());
    } else {
      updateTracking(sTFormTracking.getDataForm());
    }
    sTFormTracking.inputButtonDisable();
  } else {
    Swal.fire(
      '¡No pudimos hacer esto!',
      arMessages[11],
      'error'
    );
  }
  e.preventDefault();
}

function getTrackingProjectId(idData) {
  showPreload();
  selectInsertOrUpdateTracking = false;
  formDataTracking[primaryIdTracking] = idData;
  urlTracking = URL_ROUTETracking + arRoutes[4];
  sTFormTracking = SingletonClassSTFormTracking.getInstance();
  fetch(urlTracking, {
    method: "POST",
    body: JSON.stringify(formDataTracking),
    headers: {
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest"
    }
  })
    .then(response => response.json())
    .catch(error => console.error('Error:', error))
    .then(response => {
      if (response[dataResponse] == 200) {
        showTrackingModal(0);
        sTFormTracking.setDataForm(response[dataModel]);
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

function addTrackingData() {
  selectInsertOrUpdateTracking = true;
  showTrackingModal(1);
}

function hidelTrackingModal() {
  $(TrackingModal).modal("hide");
}

function showTrackingModal(type) {
  if (type == 1) {
    sTFormTracking = SingletonClassSTFormTracking.getInstance();
    sTFormTracking.inputButtonEnable();
  }
  sTFormTracking.clearDataForm();
  $(TrackingModal).modal("show");
}

var SingletonClassSTFormTracking = (function () {
  var objInstance;
  function createInstance() {
    var object = new STForm(idTrackingForm);
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