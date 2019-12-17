<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">
                {{ empty(_project()) ?: _project()->name }}
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/documents') }}"><i class="nav-icon icon-diamond"></i> {{ trans('admin.document.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/stocks') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.stock.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/stock-entries') }}"><i class="nav-icon icon-energy"></i> {{ trans('admin.stock-entry.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/billing-accounts') }}"><i class="nav-icon icon-puzzle"></i> {{ trans('admin.billing-account.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/invoices') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.invoice.title') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ _url('admin/investors') }}"><i class="nav-icon icon-globe"></i> {{ trans('admin.investor.title') }}</a></li>
            <li class="nav-item"><a href="{{ _project_home() }}" class="nav-link"><i class="nav-icon icon-home"></i> Project Summery</a></li>
            <li class="nav-item"><a href="{{ _project_edit() }}" class="nav-link"><i class="nav-icon icon-pencil"></i> Edit Project</a></li>
        </ul>
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
