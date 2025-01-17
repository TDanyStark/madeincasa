<?php
namespace App\Controllers\Details;

use App\Controllers\BaseController;
use App\Models\Project\ProjectModel;
use App\Models\ProjectProduct\ProjectProductModel;
use App\Models\Product\ProductModel;
use App\Models\UserStatus\UserStatusModel;
use App\Models\User\UserModel;
use App\Utils\Email;
use App\Models\Activities\ActivitiesModel;
use App\Models\ProjectTracking\ProjectTrackingModel;
use CodeIgniter\HTTP\ResponseInterface;

class Details extends BaseController{

    private $userId;
    private $roleId;
    private $objUserModel;

    public function __construct()
    {
        $this->objUserModel = new UserModel();
        $this->userId = session()->UserId;
        $this->roleId = $this->objUserModel->sp_select_user_role($this->userId);
    }

    public function show(){
        $project = new ProjectModel();
        $projectProduct = new ProjectProductModel();
        $projecttracking = new ProjectTrackingModel();
        $product = new ProductModel();
        $activities = new ActivitiesModel();
        $projectId = $this->request->getGet('projectId');
        $userstatus = new UserStatusModel();
        $status = new UserStatusModel();

        $data['meta'] = view('assets/meta');
        $data['title'] = 'Detalles';
        $data['css'] = view('assets/css');
        $data['js'] = view('assets/js');

        $data['toasts'] = view('html/toasts');
        $data['sidebar'] = view('navbar/sidebar');
        $data['header'] = view('header/header');
        $data['footer'] = view('footer/footer');

        $data['data'] = ['project' => $project->sp_select_all_project($projectId)[0],
                          'percent' => $project->sp_select_percent_project($projectId)[0],
                         'products' => $projectProduct->sp_select_all_project_product($projectId)];
        for ($i = 0; $i < count($data['data']['products']); $i++) {
            $productProjectId = $data['data']["products"][$i]->Project_product_id;
            if ($data['data']["products"][$i]->Project_product_percentage == 100) {
                $updateProduct = [
                    'Project_product_percentage' => '100',
                    'Stat_id' => '5'
                ];
                $projectProduct->update($productProjectId, $updateProduct);
            } else {
                $updateProduct = [
                    'Project_product_percentage' => '0',
                    'Stat_id' => '4'
                ];
                $projectProduct->update($productProjectId, $updateProduct);
            } 
        }
        $data['products'] = $product->findAll();
        $data['activities'] = $activities->sp_select_activities_project($projectId);
        $data['projecttrackings'] = $projecttracking->where('Project_id', $projectId)->find();
        $data['userstatuses'] = $userstatus->where('StatType_id', 4)->find();
        $data['statuses'] = $status->sp_select_status_users();
        $data['roleUser'] = $this->roleId;
        return view('details/details', $data);
    }
  
    public function updateUrl(){
        $projectModel = new ProjectModel();
        $userModel = new UserModel();
        $email = new Email();
        $id = $this->request->getVar('Project_id');
        $data['Project_url'] = $this->request->getVar('Project_url');
        $projectModel->update($id, $data);
        $project = $projectModel->sp_select_all_project($id);
        $commercial = $userModel->where('User_id', $project[0]->User_id)->find();       
        $email->sendEmail($project, $commercial[0]['User_email'], 9);
        $data['data'] = $project[0]->User_id;
        $data['csrf'] = csrf_hash();
        $data['message'] = 'success';
        $data['response'] = ResponseInterface::HTTP_OK;
        return json_encode($data);
    }
}