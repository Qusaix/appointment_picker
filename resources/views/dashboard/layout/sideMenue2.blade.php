<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    {{-- <a href="index.html"><img src="{{asset('assets1/images/logo/logo.png')}}" alt="Logo" srcset=""></a> --}}
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                {{-- <li class="sidebar-title">Menu</li> --}}

                <li class="sidebar-item {{ (request()->route()->getName() == 'dashboard')?'active':'' }} ">
                    <a href="{{route('dashboard')}}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ (request()->route()->getName() == 'dashboard.appointment.index'||request()->route()->getName() == 'dashboard.appointment.edit')?'active':'' }}">
                    <a href="{{route('dashboard.appointment.index')}}" class='sidebar-link'>
                        <i class="bi bi-calendar-fill"></i>
                        <span>Appoinments</span>
                    </a>
                </li>

                <li class="sidebar-item {{ (request()->route()->getName() == 'dashboard.images.index')?'active':'' }}">
                    <a href="{{route('dashboard.images.index')}}" class='sidebar-link'>
                        <i class="bi bi-image-fill"></i>
                        <span>Images</span>
                    </a>
                </li>
                {{-- <li class="sidebar-item">
                    <a href="" class='sidebar-link'>
                        <i class="bi bi-megaphone-fill"></i>
                        <span>Announcements</span>
                    </a>
                </li> --}}
                <li class="sidebar-item {{ (request()->route()->getName() == 'dashboard.settings.index')?'active':'' }}">
                    <a href="{{route('dashboard.settings.index')}}" class='sidebar-link'>
                        <i class="bi bi-gear-fill"></i>
                        <span>Settings</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <button onclick="showLogout()" style="background:none; border:none;" href="index.html" class='sidebar-link'>
                        <i class="bi bi-door-open-fill"></i>
                        <span>Logout</span>
                    </button>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    {{-- <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button> --}}
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button onclick="hideLogout()" class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <form action="{{route('dashboad.logout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showLogout()
    {
        $('#logoutModal').modal('show');
    }
    function hideLogout()
    {
        $('#logoutModal').modal('hide');
    }
</script>