<div id="sidebar-disable" class="sidebar-disable hidden"></div>

<div id="sidebar" class="sidebar-menu transform -translate-x-full ease-in">
    <div class="flex items-center justify-center mt-4">
        <div class="flex items-center">
            <span class="text-white text-2xl mx-2 font-semibold">{{ trans('panel.site_title') }}</span>
        </div>
    </div>
    <nav class="mt-4">
        <a class="nav-link{{ request()->is('admin') ? ' active' : '' }}" href="{{ route("admin.home") }}">
            <i class="fas fa-fw fa-tachometer-alt">

            </i>

            <span class="mx-4">Dashboard</span>
        </a>


        {{-- @can('project_access')
            <a class="nav-link{{ request()->is('admin/projects*') ? ' active' : '' }}" href="{{ route('admin.projects.index') }}">
                <i class="fa-fw fas fa-project-diagram">

                </i>

                <span class="mx-4">{{ trans('cruds.project.title') }}</span>
            </a>
        @endcan --}}
        {{-- @can('folder_access')
            <a class="nav-link{{ request()->is('admin/folders*') ? ' active' : '' }}" href="{{ route('admin.folders.index') }}">
                <i class="fa-fw fas fa-folder">

                </i>

                <span class="mx-4">{{ trans('cruds.folder.title') }}</span>
            </a>
        @endcan --}}
        @can('sales_access')
            <a class="nav-link{{ request()->is('admin/sales*') ? ' active' : '' }}" href="{{ route('admin.sales.index') }}">
                <i class="fa fa-money" aria-hidden="true"></i>

                <span class="mx-4">{{ trans('cruds.sale.title') }}</span>
            </a>
        @endcan
        @can('categories_access')
            <a class="nav-link{{ request()->is('admin/categories*') ? ' active' : '' }}" href="{{ route('admin.categories.index') }}">
                <i class="fa fa-bars" aria-hidden="true"></i>

                <span class="mx-4">{{ trans('cruds.category.title') }}</span>
            </a>
        @endcan
        @can('units_access')
            <a class="nav-link{{ request()->is('admin/units*') ? ' active' : '' }}" href="{{ route('admin.units.index') }}">
                <i class="fa fa-bars" aria-hidden="true"></i>

                <span class="mx-4">{{ trans('cruds.unit.title') }}</span>
            </a>
        @endcan
        @can('suppliers_access')
            <a class="nav-link{{ request()->is('admin/suppliers*') ? ' active' : '' }}" href="{{ route('admin.suppliers.index') }}">
                <i class="fa fa-truck" aria-hidden="true"></i>

                <span class="mx-4">{{ trans('cruds.supplier.title') }}</span>
            </a>
        @endcan
        @can('products_access')
            <a class="nav-link{{ request()->is('admin/products*') ? ' active' : '' }}" href="{{ route('admin.products.index') }}">

                <i class="fa fa-medkit" aria-hidden="true"></i>

                <span class="mx-4">{{ trans('cruds.product.title') }}</span>
            </a>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            <a class="nav-link{{ request()->is('profile/password') ? ' active' : '' }}" href="{{ route('profile.password.edit') }}">
                <i class="fa-fw fas fa-key">

                </i>

                <span class="mx-4">{{ trans('global.change_password') }}</span>
            </a>
        @endif
        @can('user_management_access')
            <div class="nav-dropdown">
                <a class="nav-link" href="#">
                    <i class="fa-fw fas fa-users">

                    </i>

                    <span class="mx-4">{{ trans('cruds.userManagement.title') }}</span>
                    <i class="fa fa-caret-down ml-auto" aria-hidden="true"></i>
                </a>
                <div class="dropdown-items mb-1 hidden">
                        @can('permission_access')
                        <a class="nav-link{{ request()->is('admin/permissions*') ? ' active' : '' }}" href="{{ route('admin.permissions.index') }}">
                            <i class="fa-fw fas fa-unlock-alt">

                            </i>

                            <span class="mx-4">{{ trans('cruds.permission.title') }}</span>
                        </a>
                    @endcan
                    @can('role_access')
                        <a class="nav-link{{ request()->is('admin/roles*') ? ' active' : '' }}" href="{{ route('admin.roles.index') }}">
                            <i class="fa-fw fas fa-briefcase">

                            </i>

                            <span class="mx-4">{{ trans('cruds.role.title') }}</span>
                        </a>
                    @endcan
                    @can('user_access')
                        <a class="nav-link{{ request()->is('admin/users*') ? ' active' : '' }}" href="{{ route('admin.users.index') }}">
                            <i class="fa-fw fas fa-user">

                            </i>

                            <span class="mx-4">{{ trans('cruds.user.title') }}</span>
                        </a>
                    @endcan
                </div>
            </div>
        @endcan
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
            <i class="fa-fw fas fa-sign-out-alt">

            </i>

            <span class="mx-4">{{ trans('global.logout') }}</span>
        </a>
    </nav>
</div>
