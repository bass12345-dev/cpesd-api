<nav id="sidebar" class="sidebar js-sidebar" >
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="">
          <span class="align-middle">PESO DTS USER</span>
        </a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					 <?php $segments = Request::segments();?>

					<li class="sidebar-item <?= $segments[2] == 'dashboard' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/dashboard')}}">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'my-documents' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/my-documents')}}">
              <i class="fas fa-file align-middle" ></i> <span class="align-middle">My Documents</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'add-document' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/add-document')}}">
              <i class="align-middle" data-feather="plus"></i> <span class="align-middle">Add Documents</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'incoming' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/incoming')}}">
              <i class="align-middle" data-feather="arrow-left"></i> <span class="align-middle">Incoming</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'received' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/received')}}">
              <i class="align-middle" data-feather="arrow-down"></i> <span class="align-middle">Received</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'forwarded' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/forwarded')}}">
              <i class="align-middle" data-feather="arrow-up"></i> <span class="align-middle">Forwarded</span>
            </a>
					</li>

					<li class="sidebar-item <?= $segments[2] == 'track' ? 'active' : '' ?>">
						<a class="sidebar-link" href="{{url('/dts/user/track')}}">
              <i class="align-middle" data-feather="search"></i> <span class="align-middle">Track Documents</span>
            </a>
					</li>

					
				</ul>

				
			</div>
		</nav>