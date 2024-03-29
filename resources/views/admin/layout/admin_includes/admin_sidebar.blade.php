<nav id="sidebar" class="sidebar js-sidebar" >
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="">
          <span class="align-middle">PESO DTS Administrator</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>
					 <?php $segments = Request::segments();?>
					<li class="sidebar-item <?= $segments[2] == 'dashboard' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/dashboard')}}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'all-documents' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/all-documents')}}">
              <i class=" fas fa-file align-middle" ></i> <span class="align-middle">All Documents</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'offices' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/offices')}}">
              <i class="fas fa-building align-middle" ></i> <span class="align-middle">Manage Offices</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'doc-types' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/doc-types')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Document Types</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'final-actions' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/final-actions')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Final Action Taken</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'manage-users' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/manage-users')}}">
              <i class="align-middle" data-feather="users"></i> <span class="align-middle">Manage Users</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'back-up' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/admin/back-up')}}">
              <i class="align-middle" data-feather="database"></i> <span class="align-middle">Back Up Database</span>
            </a>
					</li>

					
				</ul>

				
			</div>
		</nav>