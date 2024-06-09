<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("panel.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("panel/permissions*") ? "c-show" : "" }} {{ request()->is("panel/roles*") ? "c-show" : "" }} {{ request()->is("panel/users*") ? "c-show" : "" }} {{ request()->is("panel/audit-logs*") ? "c-show" : "" }} {{ request()->is("panel/user-alerts*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("anel/permissions") || request()->is("panel/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/roles") || request()->is("panel/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.users.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/users") || request()->is("anel/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('audit_log_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.audit-logs.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/audit-logs") || request()->is("panel/audit-logs/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.auditLog.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_alert_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.user-alerts.index") }}" class="c-sidebar-nav-link {{ request()->is("anel/user-alerts") || request()->is("panel/user-alerts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-bell c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.userAlert.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('payment_method_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("panel.payment-methods.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/payment-methods") || request()->is("panel/payment-methods/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.paymentMethod.title') }}
                </a>
            </li>
        @endcan
        @can('payer_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("panel/payers*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.payerManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('payer_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.payers.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/payers") || request()->is("panel/payers/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.payer.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('client_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("panel/clients*") ? "c-show" : "" }} {{ request()->is("panel/client-payment-methods*") ? "c-show" : "" }} {{ request()->is("panel/client-sites*") ? "c-show" : "" }} {{ request()->is("panel/client-site-payment-methods*") ? "c-show" : "" }} {{ request()->is("panel/client-site-tokens*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.clientManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('client_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.clients.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/clients") || request()->is("panel/clients/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.client.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('client_site_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("panel.client-sites.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/client-sites") || request()->is("panel/client-sites/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.clientSite.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('transaction_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("panel.transactions.index") }}" class="c-sidebar-nav-link {{ request()->is("panel/transactions") || request()->is("panel/transactions/*") ? "c-active" : "" }}">
                    <i class="fa-fw fas fa-cogs c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.transaction.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>
