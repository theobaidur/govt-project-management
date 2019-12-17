<?php

use App\Models\BillingAccount;
use App\Models\Department;
use App\Models\EmployeeDesignation;
use App\Models\Invoice;
use App\Models\Project;
use App\Models\ProjectClient;
use App\Models\Stock;
use Brackets\AdminAuth\Models\AdminUser;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker\Generator $faker)
    {
        //  generate department
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name()
            ];
        }
        DB::table('departments')->insert($tmp);
        // generate expense category
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name()
            ];
        }
        DB::table('document_categories')->insert($tmp);
        // generate employee designation
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name()
            ];
        }
        DB::table('employee_designations')->insert($tmp);
        // generate employee
        $tmp = [];
        $designationIds = EmployeeDesignation::all()->pluck('id');
        $departmentIds = Department::all()->pluck('id');
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name(),
                'email'=> $faker->email(),
                'phone'=> $faker->phoneNumber(),
                'department_id'=> $departmentIds->random(),
                'employee_designation_id'=> $designationIds->random(),
            ];
        }
        DB::table('employees')->insert($tmp);
        // generate project client
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name(),
                'email'=> $faker->email(),
                'phone'=> $faker->phoneNumber(),
            ];
        }
        DB::table('project_clients')->insert($tmp);
        // generate project
        $tmp = [];
        $clientIds = ProjectClient::all()->pluck('id');
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name(),
                'description'=> $faker->paragraphs(2, true),
                'amount'=> $faker->randomNumber(6, false),
                'department_id'=> $departmentIds->random(),
                'project_client_id'=> $clientIds->random(),
            ];
        }
        DB::table('projects')->insert($tmp);
        
        // generate stock
        $projectIds = Project::all()->pluck('id');
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name'=> $faker->name(),
                'description'=> $faker->paragraphs(2, true),
                'project_id'=> $projectIds->random()
            ];
        }
        DB::table('stocks')->insert($tmp);
        // generate stock entry
        $tmp = [];
        $stockIds = Stock::all()->pluck('id');
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'type' => $i % 2 ? 'load' : 'unload',
                'quantity'=> $faker->randomDigit(),
                'unit_price'=> $faker->numberBetween(1000, 10000),
                'stock_id'=> $stockIds->random()
            ];
        }
        DB::table('stock_entries')->insert($tmp);

        // generate billing account entry
        $tmp = [];
        for($i=0; $i<20; $i++){
            $tmp[] = [
                'name' => $faker->name(),
                'address'=> $faker->address,
                'phone'=> $faker->phoneNumber,
                'email'=> $faker->email
            ];
        }
        DB::table('billing_accounts')->insert($tmp);
        $billingAccounts = BillingAccount::all();
        $projectClients = ProjectClient::all();
        
        $billingAccounts->map(function($account) use ($faker, $projectClients){
            $projectAmount = $faker->numberBetween(100000, 1000000);
            $bankGurantee = $projectAmount * .5;
            $client = $projectClients->random();
            // create project first
            $project = Project::create([
                'name'=> $faker->words(3, true),
                'description'=> $faker->sentences(3, true),
                'amount' => $projectAmount,
                'bank_guarantee_amount'=> $bankGurantee,
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addYear(1),
                'project_client_id'=> $client->id,
            ]);
            $account->project_id = $project->id;
            $account->save();
        });

        
    }
}
