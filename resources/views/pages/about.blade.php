@extends('layouts.app')

@section('content')
<div class="
	@if(\Auth::user())
	container-fluid
	@else
	container
	@endif
">
	@if(\Auth::user())
	<div class="row">
		@include('inc.aside')
		<div class="@if(\Auth::user())
		col-md-9
		@else
		col-md-3
		@endif">
	@endif

		<header class="blog-header py-3">
		<div class="row flex-nowrap justify-content-between align-items-center">
			<div class="col-4 pt-1">
			<h3>About Us</h3>
			</div>
		</div>
		</header>

		<hr>
		
		<div class="">
		<div class="col-md-12 px-0">
			<h1 class="display-4 font-italic">Our Story</h1>
			<p class="lead my-3">Founded in 2014, we started with the goal to simplify the way hospitals deliver care to their patients. In our years of experience, we have grown from an exciting concept to the market leader in remote care platforms – serving customers nationwide, including the largest systems in the country. How have we done it? A compelling vision, an empowering culture, and a world-class team.</p>
		</div>
		</div>

		<hr>

		<div class="">
			<div class="col-md-12 px-0">
			<h1 class="display-4 font-italic">Our values</h1>
			<p class="lead my-3">We believe we’re only as good as the team around the table. We’re building a diverse culture with team members who are hungry to make an impact and challenge the status quo. How do we do that? We hire for culture fit, align to the vision, then get out of the way.</p>
		</div>
		</div>

		<hr>

		<div class="">
			<div class="col-md-12 px-0">
			<h1 class="display-4 font-italic">Why choose Us?</h1>
			<p class="lead my-3">We offer much more than just the technology you need to efficiently manage your practice. We offer a unique, all-inclusive experience that gives you all that you need now, and all that you will need in the future. We design everything with patient engagement in mind so that your patients can maintain an active role in their healthcare.</p>
		</div>
		</div>

		<hr>

		<div class="">
			<div class="col-md-12 px-0">
			<h1 class="display-4 font-italic">What makes us different.</h1>
			<p class="lead my-3">We're not just another healthcare management company. Our goal is to be a proactive partner and a personal support system that consistently helps you make the most out of your profession. With us, you can rely on a familiar, human and straightforward companion that provides you and your patients with the means to experience healthcare better. From your first call, to going live and beyond, we'll be there for you every step of the way.</p>
		</div>
		</div>

		<hr>

		<div class="">
			<div class="col-md-12 px-0">
			<h1 class="display-4 font-italic">What can <em>we</em> do for you?</h1>
			</div>
		</div>

		<div class="row mb-2">
		<div class="col-md-6">
			<div class="card flex-md-row mb-4 box-shadow h-md-250">
			<div class="card-body d-flex flex-column align-items-start">
				<h3 class="mb-0">
				Health Insurance & 401k
				</h3>
				<div class="mb-1 text-muted"></div>
				<p class="card-text mb-auto">Single? Family? We’ve got you all covered with a generous health care plan. After all, we’re in the healthcare business and know the importance of staying healthy.

				</p>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card flex-md-row mb-4 box-shadow h-md-250">
			<div class="card-body d-flex flex-column align-items-start">
				<h3 class="mb-0">
					The best team
				</h3>
				<div class="mb-1 text-muted"></div>
				<p class="card-text mb-auto">We’ve got the most dedicated team in health tech. We’re smart, driven and love to have a good time. We hire by committee and love to meet talented, driven people who challenge the status quo.</p>
			
			</div>
			
			</div>
		</div>
		</div>
	</div>
	@if(\Auth::user())
		</div>
	</div>
	@endif
  <div class="row col-md-12 mx-auto bg-dark text-light mb-n4">
    <footer class="container mx-auto">
        <p class="text-center">&copy; Company 2019-2020</p>
    </footer>
</div>
@endsection