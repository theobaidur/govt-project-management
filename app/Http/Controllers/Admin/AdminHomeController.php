<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Employee;
use App\Models\Project;
use App\Models\ProjectClient;
use App\Models\Stock;

class AdminHomeController extends Controller{
    public function home(){
        $departments = Department::all()->count();
        $projects = Project::all()->count();
        $stocks = Stock::all()->count();
        $employees = Employee::all()->count();
        $clients = ProjectClient::all()->count();
        return \view('admin.admin-home', [
            'total_department'=> $departments,
            'total_projects'=> $projects,
            'total_stocks'=> $stocks,
            'total_employees'=> $employees,
            'total_clients'=> $clients
        ]);
    }
}