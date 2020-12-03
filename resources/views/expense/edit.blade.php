<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Despesa</title>
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
	<link rel="stylesheet" href="{{ asset('assets/css/millenium.min.css') }}">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}">
</head>
<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="purple">
				
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
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
							<a href="{{route('user.dashboard')}}">
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
						<h4 class="page-title">Despesa</h4>
						<ul class="breadcrumbs">
						</ul>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Editar Despesa</div>
								</div>
								<div class="card-body">
									<div class="row">
										<div class="col-md-12 col-lg-12">
                                            {!! Form::model($expense,['route'=>['expense.update', $expense->id], 'method'=> 'put','enctype'=>"multipart/form-data"]) !!}
                                            <div class="row">
                                                <div class="col-md-12 col-lg-12">
                                                    <div class="form-group form-show-validation row">
                                                        <label class="text-right">Upload Image <span class="required-label">*</span></label>
                                                        <div class="col-lg-4 col-md-9 col-sm-8">
                                                            <div class="input-file input-file-image">
                                                                <img class="img-upload-preview img-circle" width="100" height="100" src="https://placehold.it/100x100" alt="preview">
                                                                {!! Form::file('image', ['name' => 'image','id '=> 'uploadImg',  'class' => 'form-control form-control-file','accept'=>"image/*", 'required' => true]) !!}
                                                                <label for="uploadImg" class="btn btn-primary btn-round btn-lg"><i class="fa fa-file-image"></i> Upload a Image</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="user_id">Usuário<span class="required-label">*</span></label></label>
                                                        {!! Form::select('user_id', $users ?? [], null, ['id '=> 'user',  'class' => 'form-control', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label for="description">Descrição<span class="required-label">*</span></label></label>
                                                        {!! Form::text('description', null, ['id '=> 'description',  'class' => 'form-control', 'placeholder' => 'Descrição', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group form-floating-label">
                                                        <label for="value">Valor<span class="required-label">*</span></label></label>
                                                        {!! Form::text('value', null, ['id '=> 'value',  'class' => 'form-control', 'placeholder' => '999999.00', 'type' => 'value', 'required' => true]) !!}
                                                    </div>
                                                </div>  
                                                <div class="col-md-6 col-lg-6">
                                                    <div class="form-group form-floating-label">
                                                        <label for="date">Data<span class="required-label">*</span></label></label>
                                                        {!! Form::date('date', null, ['id '=> 'date',  'class' => 'form-control', 'placeholder' => 'Data', 'type' => 'date', 'required' => true]) !!}
                                                    </div>
                                                </div>
                                            </div>
										</div>
									</div>
								</div>
								<div class="card-action">
                                    {!! Form::submit('Atualizar', ['class' => 'btn btn-success']) !!}
                                    {!! Form::close() !!}
									<a href="{{route('expense.index')}}" class="btn btn-danger">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
        </div>
        <!--   Core JS Files   -->
        <script src="{{ asset('assets/js/core/jquery.3.2.1.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
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
            $("#buscaCep").on('click', function(){
                var numCep = $('#cep').val();
                var url = "http://serviceweb.aix.com.br/aixapi/api/cep/"+numCep;

                $.ajax({
                    url: url,
                    type: "get",
                    dataType: 'jsonp',
                    success:function(dados){
                        $("#uf").val(dados.estado);
                        $("#city").val(dados.cidade);
                        $("#neighborhood").val(dados.bairro);
                        $("#street").val(dados.logradouro);
                    }
                });
            })
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