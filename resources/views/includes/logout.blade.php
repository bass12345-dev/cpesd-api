


<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                 <span class="text-dark">{{session('name')}}</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
							<!-- 	<a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								
								<div class="dropdown-divider"></div> -->
								<a class="dropdown-item text-danger" href="{{url('/logout')}}">Log out</a>
							</div>
						</li>