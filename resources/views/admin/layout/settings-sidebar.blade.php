<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Admin Home</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/document-categories') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.document-category.title') }}</a></li>
            @if (userHasRole('Administrator'))
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/employee-designations') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.employee-designation.title') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/employees') }}"><i class="nav-icon icon-magnet"></i> {{ trans('admin.employee.title') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/projects') }}"><i class="nav-icon icon-flag"></i> {{ trans('admin.project.title') }}</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            @endif
            
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
