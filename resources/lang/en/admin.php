<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'department' => [
        'title' => 'Departments',

        'actions' => [
            'index' => 'Departments',
            'create' => 'New Department',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'income-category' => [
        'title' => 'Income Categories',

        'actions' => [
            'index' => 'Income Categories',
            'create' => 'New Income Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'expense-category' => [
        'title' => 'Expense Categories',

        'actions' => [
            'index' => 'Expense Categories',
            'create' => 'New Expense Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'project-client' => [
        'title' => 'Project Clients',

        'actions' => [
            'index' => 'Project Clients',
            'create' => 'New Project Client',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            
        ],
    ],

    'document-category' => [
        'title' => 'Document Categories',

        'actions' => [
            'index' => 'Document Categories',
            'create' => 'New Document Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'department' => [
        'title' => 'Departments',

        'actions' => [
            'index' => 'Departments',
            'create' => 'New Department',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'income-category' => [
        'title' => 'Income Categories',

        'actions' => [
            'index' => 'Income Categories',
            'create' => 'New Income Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'expense-category' => [
        'title' => 'Expense Categories',

        'actions' => [
            'index' => 'Expense Categories',
            'create' => 'New Expense Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'document-category' => [
        'title' => 'Document Categories',

        'actions' => [
            'index' => 'Document Categories',
            'create' => 'New Document Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],
    'department' => [
        'title' => 'Departments',

        'actions' => [
            'index' => 'Departments',
            'create' => 'New Department',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'document' => [
        'title' => 'Documents',

        'actions' => [
            'index' => 'Documents',
            'create' => 'New Document',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'document_category_id' => 'Document category',
            
        ],
    ],

    'document-category' => [
        'title' => 'Document Categories',

        'actions' => [
            'index' => 'Document Categories',
            'create' => 'New Document Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'employee' => [
        'title' => 'Employees',

        'actions' => [
            'index' => 'Employees',
            'create' => 'New Employee',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'department_id' => 'Department',
            'employee_designation_id' => 'Employee designation',
            
        ],
    ],

    'employee-designation' => [
        'title' => 'Employee Designations',

        'actions' => [
            'index' => 'Employee Designations',
            'create' => 'New Employee Designation',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'expense-category' => [
        'title' => 'Expense Categories',

        'actions' => [
            'index' => 'Expense Categories',
            'create' => 'New Expense Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'income-category' => [
        'title' => 'Income Categories',

        'actions' => [
            'index' => 'Income Categories',
            'create' => 'New Income Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            
        ],
    ],

    'project' => [
        'title' => 'Projects',

        'actions' => [
            'index' => 'Projects',
            'create' => 'New Project',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'amount' => 'Contract Amount',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'department_id' => 'Department',
            'project_client_id' => 'Project client',
            'project_director_id' => 'Project Director',
            'bank_guarantee_amount' => 'Bank Gurantee Amount',
        ],
    ],

    'project-client' => [
        'title' => 'Project Clients',

        'actions' => [
            'index' => 'Project Clients',
            'create' => 'New Project Client',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'description' => 'Description',
            
        ],
    ],

    'stock' => [
        'title' => 'Stocks',

        'actions' => [
            'index' => 'Stocks',
            'create' => 'New Stock',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'project_id' => 'Project',
        ],
    ],

    'stock-entry' => [
        'title' => 'Stock Entries',
        'options'=> [
            'load'=> 'Load',
            'unload'=> 'Unload'
        ],
        'actions' => [
            'index' => 'Stock Entries',
            'create' => 'New Stock Entry',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'type' => 'Type',
            'quantity' => 'Quantity',
            'unit_name' => 'Unit Name',
            'unit_price' => 'Unit price',
            'stock_id' => 'Stock',
            
        ],
    ],

    'transaction' => [
        'title' => 'Transactions',
        'options'=> [
            'debit'=> 'Debit',
            'credit'=> 'Credit'
        ],
        'actions' => [
            'index' => 'Transactions',
            'create' => 'New Transaction',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'amount' => 'Amount',
            'note' => 'Note',
            'type' => 'Type',
            'income_category_id' => 'Income category',
            'expense_category_id' => 'Expense category',
            'project_id' => 'Project',
            
        ],
    ],

    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],
    'investor' => [
        'title' => 'Investors',

        'actions' => [
            'index' => 'Investors',
            'create' => 'New Investor',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'user_id' => 'User',
            'project_id' => 'Project',
            'investment_amount' => 'Investment Amount',
            'enabled'=> 'Enabled'
        ],
    ],
    'billing-account' => [
        'title' => 'Billing Accounts',
        'actions' => [
            'index' => 'Billing Accounts',
            'create' => 'New Billing Account',
            'edit' => 'Edit :name',
        ],
        'columns' => [
            'id' => 'ID',
            'name'=> 'Name',
            'address'=> 'Address',
            'phone'=> 'Phone',
            'email'=> 'Email',
        ],
    ],
    'invoice' => [
        'title' => 'Invoices',
        'options'=> [
            'debit_voucher'=> 'Debit Voucher',
            'credit_voucher'=> 'Credit Voucher'
        ],
        'actions' => [
            'index' => 'Invoices',
            'create' => 'New Invoice',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'user_id' => 'User',
            'project_id' => 'Project',
            'billing_invoice_no' => 'Billing Invoice No',
            'system_invoice_no' => 'System Invoice No',
            'discount' => 'Discount',
            'cash'=> 'Cash',
            'amount'=> 'Amount',
            'type' => 'Invoice Type',
            'invoice_type' => 'Invoice Type',
            'note' => 'note',
            'billing_account_id' => 'Billing Account'
        ],
    ],
    'invoice-item' => [
        'title' => 'Invoice Items',
        'options'=> [
            'add'=> '+',
            'sub'=> '-'
        ],
        'actions' => [
            'index' => 'Invoice Items',
            'create' => 'New Invoice Item',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'type' => 'Add/Sub',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'unit_name' => 'Unit Name',
            'unit_price' => 'Unit Price',
            'amount' => 'Amount',
            'invoice_id' => 'Invoice',
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];