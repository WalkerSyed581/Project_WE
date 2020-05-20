<div class="docHeader col-md-3 bg-dark vh-100 mt-n4 py-4" >
	<h1 class="text-center " style="color:white">{{Auth::user()->name}}'s Dashboard</h1>
	<aside class="col-md-9 p-0 flex-shrink-1 sticky-top" style="margin-top:30px">
		<!--fixed-top/sticky-top-->
		<nav class="navbar navbar-expand navbar-dark  flex-md-column flex-row align-items-start py-2">
			<div class="collapse navbar-collapse">
				<ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between ">
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('DoctorController@index')}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Home</span></a>
					</li>
					@if(\Auth::user()->role == 'd')
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('DoctorController@addAppointment',['id'=>\Auth::user()->doctor->id])}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Add Appointment</span></a>
					</li>
					@elseif(\Auth::user()->role == 'p')
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('PatientController@appoinmentArchive',['id'=>\Auth::user()->patient->id])}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">View All Appointments</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('PatientController@showCurrentAdmission',['id'=>\Auth::user()->patient->id])}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">View Current Admission</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('PatientController@showAllAdmissions',['id'=>\Auth::user()->patient->id])}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">View Previous Admissions</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('PatientController@showBill',['id'=>\Auth::user()->patient->id])}}"><i class="fa fa-book fa-fw"></i> <span class="d-none d-md-inline">Show Bill</span></a>
					</li>
					@elseif(\Auth::user()->role == 'a')
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('AdminController@showRegisterForm',['id'=>\Auth::id()])}}">Register User</a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('AdminController@showSupportGroups',['id'=>\Auth::id()])}}">Show Support Groups</a>
					</li>
					<li class="nav-item">
						<a class="nav-link pl-0" href="{{action('UsersController@index',['id'=>\Auth::id()])}}">Manage Users</a>
					</li>
					@elseif(\Auth::user()->role =='hs')
						@if(\Auth::user()->helpingStaff->role == 'ws')
							<li class="nav-item">
								<a class="nav-link pl-0" href="{{action('HelpingStaffController@showWardForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Ward</a>
							</li>
						@elseif(\Auth::user()->helpingStaff->role == 'ls')
							<li class="nav-item">
								<a class="nav-link pl-0" href="{{action('HelpingStaffController@showTestForm',['id'=>\Auth::user()->helpingStaff->id])}}">Add Test</a>
							</li>
						@endif
					@endif
				</ul>
			</div>
		</nav>
	</aside>
</div> 

