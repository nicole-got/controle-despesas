<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Dash</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="../https://via.placeholder.com/32x32" type="image/x-icon"/>
	
    <!-- Fonts and icons -->
	<script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('assets/css/fonts.min.css') }}']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/millenium.css') }}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="purple2">
				
				<div class="container-fluid">
				</div>
			</nav>
			<!-- End Navbar -->
		</div>
		<!-- Sidebar -->
		<div class="sidebar">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-secondary">
                        <li class="nav-item">
							<a href="{{route('user.dashboard')}}" onclick="button()">
								<i class="far fa-calendar-alt"></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{route('expense.index')}}">
								<i class="fas fa-desktop"></i>
								<p>Despesa</p>
							</a>
                        </li>
                        <li class="nav-item">
							<a href="{{route('user.index')}}">
								<i class="fas fa-desktop"></i>
								<p>Usuário</p>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="page-header">
						<h4 class="page-title">Dados</h4>
						<ul class="breadcrumbs">
							<li class="nav-home">
								<a href="#">
									<i class="flaticon-home"></i>
								</a>
							</li>
						</ul>
					</div>
                    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Despesas</div>
								</div>
								<div class="card-body">
									@if($expenses == "[]")
										<div class="text-center">Não há despesa cadastrados</div>
									@else
										{!! Form::open( ['route' => ['expense.search'], 'method' => 'post']) !!}
												{!! Form::text('id', null, ['id '=> 'id',  'class' => 'form-control form-control-sm', 'type' => 'search', 'placeholder' => 'ID Despesa']) !!}
													{!! Form::submit('Pesquisar', ['class'=> 'btn btn-primary btn-round ml-auto']) !!}
										{!! Form::close() !!}
										<table class="table table-head-bg-danger">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Foto</th>
													<th scope="col">Usuário</th>
													<th scope="col">Descrição</th>
													<th scope="col">Valor</th>
													<th scope="col">Data</th>
													<th scope="col">Ação</th>
												</tr>
											</thead>
											<tbody>
												@foreach($expenses as $expense)
													<tr>
                                                        <td>{{$expense->id}}</td>
                                                        <td>
                                                            <div class="notif-img"> 
                                                                <img  src="{{ asset('/storage/img/'.$expense->image.'') }}" alt="Img Profile" style="max-width: 80px;max-height: 100px;">
                                                                {{-- <img src="https://via.placeholder.com/50x50" alt="Img Profile"> --}}
                                                            </div>
                                                        </td>
														<td>{{$expense->user_id}}</td>
														<td>{{$expense->description}}</td>
														<td>{{'R$ '.number_format($expense->value,2, ',', '.' ) }}</td>
														<td>{{date('d/m/Y', strtotime($expense->date))}}</td>
														<td>
															{!! Form::open( ['route' => ['expense.destroy', $expense->id ], 'method' => 'delete']) !!}
																{!! Form::submit('Remover') !!}
															{!! Form::close() !!}
														<a href="{{ route('expense.edit', $expense->id) }}">Editar</a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
								</div>
							</div>
						</div>
                    </div>
                    <div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Usuários</div>
								</div>
								<div class="card-body">
									@if($users == "[]")
										<div class="text-center">Não há usuário cadastrados</div>
									@else
										<table class="table table-head-bg-success">
											<thead>
												<tr>
													<th scope="col">#</th>
													<th scope="col">Nome</th>
													<th scope="col">Email</th>
													<th scope="col">Ação</th>
												</tr>
											</thead>
											<tbody>
												@foreach($users as $user)
													<tr>
														<td>{{$user->id}}</td>
														<td>{{$user->name}}</td>
														<td>{{$user->email}}</td>
														<td>
															{!! Form::open( ['route' => ['user.destroy', $user->id ], 'method' => 'delete']) !!}
																{!! Form::submit('Remover') !!}
															{!! Form::close() !!}
														<a href="{{ route('user.edit', $user->id) }}">Editar</a>
														</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									@endif
								</div>
							</div>
						</div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- jQuery UI -->
	<script src="{{ asset('assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
	<script src={{ asset('"assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
	<!-- Bootstrap Toggle -->
	<script src="{{ asset('assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js') }}"></script>
	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
	<!-- Millenium JS -->
	<script src="{{ asset('assets/js/millenium.min.js') }}"></script>
	<!-- Millenium DEMO methods, don't include it in your project! -->
	<script src="{{ asset('assets/js/setting-demo2.js') }}"></script>
	<script>
		var element = document.getElementsByTagName("svg");
		element[0].removeAttribute("viewBox");
		element[1].removeAttribute("viewBox");
		element[2].removeAttribute("viewBox");
		element[3].removeAttribute("viewBox");
		$('#displayNotif').on('click', function(){
			var placementFrom = $('#notify_placement_from option:selected').val();
			var placementAlign = $('#notify_placement_align option:selected').val();
			var state = $('#notify_state option:selected').val();
			var style = $('#notify_style option:selected').val();
			var content = {};

			content.message = 'Turning standard Bootstrap alerts into "notify" like notifications';
			content.title = 'Bootstrap notify';
			if (style == "withicon") {
				content.icon = 'fa fa-bell';
			} else {
				content.icon = 'none';
			}
			content.url = 'index.html';
			content.target = '_blank';

			$.notify(content,{
				type: state,
				placement: {
					from: placementFrom,
					align: placementAlign
				},
				time: 1000,
			});
		});
	</script>
</body>
</html>