<?php

namespace App\Controllers\City;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\City\CityModel;
use App\Models\Country\CountryModel;


class City extends BaseController
{
  private $objModel;
  private $primaryKey;
  private $nameModel;

  public function __construct()
  {
    $this->objModel = new CityModel();
    $this->primaryKey = 'City_id';
    $this->nameModel = 'cities';
  }

  public function show()
  {
    $country = new CountryModel();

    $data['meta'] = view('assets/meta');
    $data['title'] = 'Ciudades';
    $data['meta'] = view('assets/meta');
    $data['css'] = view('assets/css');
    $data['js'] = view('assets/js');

    $data['toasts'] = view('html/toasts');
    $data['sidebar'] = view('navbar/sidebar');
    $data['header'] = view('header/header');
    $data['footer'] = view('footer/footer');

    $data[$this->nameModel] = $this->objModel->findAll();
    $data['countries'] = $country->findAll();
    return view('city/city', $data);
  }

  public function create()
  {
    if ($this->request->isAJAX()) {
      $dataModel = $this->getDataModel(NULL);
      if ($this->objModel->insert($dataModel)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = $dataModel;
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error create user';
        $data['response'] = ResponseInterface::HTTP_NO_CONTENT;
        $data['data'] = '';
      }
    } else {
      $data['message'] = 'Error Ajax';
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = '';
    }
    return json_encode($data);
  }

  public function edit()
  {
    try {
      $id = $this->request->getVar($this->primaryKey);
      $getDataId = $this->objModel->where($this->primaryKey, $id)->first();
      $data['message'] = 'success';
      $data['response'] = ResponseInterface::HTTP_OK;
      $data['data'] = $getDataId;
      $data['csrf'] = csrf_hash();
    } catch (\Exception $e) {
      $data['message'] = $e;
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = 'Error';
    }
    return json_encode($data);
  }

  public function update()
  {
    try {
      $today = date("Y-m-d H:i:s");
      $id = $this->request->getVar($this->primaryKey);
      $data = $this->getDataModel($id);
      $data['updated_at'] = $today;
      $this->objModel->update($id, $data);
      $data['message'] = 'success';
      $data['response'] = ResponseInterface::HTTP_OK;
      $data['data'] = $id;
      $data['csrf'] = csrf_hash();
    } catch (\Exception $e) {
      $data['message'] = $e;
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = 'Error';
    }
    return json_encode($data);
  }

  public function delete()
  {
    try {
      $id = $this->request->getVar($this->primaryKey);
      if ($this->objModel->where($this->primaryKey, $id)->delete($id)) {
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        $data['data'] = "ok";
        $data['csrf'] = csrf_hash();
      } else {
        $data['message'] = 'Error Ajax';
        $data['response'] = ResponseInterface::HTTP_CONFLICT;
        $data['data'] = 'error';
      }
    } catch (\Exception $e) {
      $data['message'] = $e;
      $data['response'] = ResponseInterface::HTTP_CONFLICT;
      $data['data'] = 'Error';
    }
    return json_encode($data);
  }

  public function getDataModel($getShares)
  {
    $data = [
      'City_id' => $getShares,
      'City_name' => $this->request->getVar('City_name'),
      'Country_id' => $this->request->getVar('Country_id'),
      'updated_at' => $this->request->getVar('updated_at')
    ];
    return $data;
  }
}
