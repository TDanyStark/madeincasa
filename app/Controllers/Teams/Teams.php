<?php

namespace App\Controllers\Teams;

use App\Controllers\BaseController;
use App\Models\UserStatus\UserStatusModel;

class Teams extends BaseController
{
    private $objModel;
    private $primaryKey;
    private $nameModel;

    public function __construct()
    {
        $this->objModel = new UserStatusModel();
        $this->primaryKey = 'Stat_id';
        $this->nameModel = 'userstatuses';
    }

    public function show(){
        $data['title'] = 'Teams de colaboradores';
        $data['meta'] = view('assets/meta');
        $data['css'] = view('assets/css');
        $data['js'] = view('assets/js');

        $data['toasts'] = view('html/toasts');
        $data['sidebar'] = view('navbar/sidebar');
        $data['header'] = view('header/header');
        $data['footer'] = view('footer/footer');

        $data[$this->nameModel] = $this->objModel->sp_select_status_users();

        return view('teams/teams', $data);
    }
}
