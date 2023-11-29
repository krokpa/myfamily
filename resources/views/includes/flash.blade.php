<br />
@if ($message = session()->get('success'))
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-success alert-block inverse alert-dismissible fade show">
	<i class="fa fa-check"></i>
        <p>{{ $message }}</p>
</div>
@endif


@if ($message = session()->get('error'))
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-danger alert-block inverse alert-dismissible fade show">
	<i class="fa fa-ban"></i>
        <p>{{ $message }}</p>
</div>
@endif


@if ($message = session()->get('warning'))
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-warning alert-block inverse alert-dismissible fade show">
	<i class="fa fa-exclamation-triangle"></i>
	<p>{{ $message }}</p>
</div>
@endif


@if ($message = session()->get('info'))
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-info alert-block inverse alert-dismissible fade show">
	<i class="fa fa-info-circle"></i>
	<p>{{ $message }}</p>
</div>
@endif

@if ($message = session()->get('info_array'))
	@foreach ($message as $key => $value)
		<div style="margin-left: 20px;margin-right:20px;" class="alert alert-info alert-block inverse alert-dismissible fade show">
			<i class="fa fa-info-circle"></i>
	
			<p>{{ $value['message'] }}</p>
		</div>
	@endforeach
@endif

@if ($message = session()->get('success_array'))
	@foreach ($message as $key => $value)
		<div style="margin-left: 20px;margin-right:20px;" class="alert alert-success alert-block inverse alert-dismissible fade show">
			<i class="fa fa-check"></i>
	
			<p>{{ $value['message'] }}</p>
		</div>
	@endforeach
@endif

@if ($message = session()->get('danger_array'))
	@foreach ($message as $key => $value)
		<div style="margin-left: 20px;margin-right:20px;" class="alert alert-danger alert-block inverse alert-dismissible fade show">
			<i class="fa fa-ban"></i>
	
			<p>{{ $value['message'] }}</p>
		</div>
	@endforeach
@endif

@if ($message = session()->get('warning_array'))
	@foreach ($message as $key => $value)
		<div style="margin-left: 20px;margin-right:20px;" class="alert alert-warning alert-block inverse alert-dismissible fade show">
			<i class="fa fa-exclamation-triangle"></i>
	
			<p>{{ $value['message'] }}</p>
		</div>
	@endforeach
@endif

@if ($message = session()->get('danger'))
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-danger alert-block inverse alert-dismissible fade show">
	<i class="fa fa-ban"></i>
	<p>{{ $message }}</p>
</div>
@endif


@if ($errors->any())
<div style="margin-left: 20px;margin-right:20px;" class="alert alert-danger alert-block inverse alert-dismissible fade show">
	<i class="fa fa-exclamation-triangle"></i>
	Veuillez revérifier le formulaire svp.
</div>
@endif

@if (count($errors) > 0)
	@foreach ($errors->all() as $error)
	<div style="margin-left: 20px;margin-right:20px;" class="alert alert-danger alert-block inverse alert-dismissible fade show">
		<i class="fa fa-exclamation-triangle"></i>

		<strong>{{ $error }}</strong>
	</div>
	@endforeach
@endif