<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="_token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
    <title>iDentSoft :: ambitiousit.net</title>

    <!-- Toastr CSS -->
    <link href="{{ asset('assets/css/toastr.min.css') }}" rel="stylesheet">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/css/adminlte.min.css') }}">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
    <!-- overlayScrollbars -->
    <link href="{{ asset('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- .. -->
    @yield('one_page_css')

    <!-- js back -->

    <!-- jQuery -->
    <script src="{{ asset('assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Menu Plugin JavaScript -->
    @yield('one_page_js')
</head>

<body class="fix-header">
<div id="wrapper">
    <div id="page-wrapper" class="custom-page-wrapper-my">
        <div class="container-fluid">
            @php
                $version = phpversion();
                $float  = floatval($version);
                $checkphp = "7.3";
                $checkphpfloat  = floatval($checkphp);
                $phpc="Can't Checked";
                $ctype="Can't Checked";
                $json="Can't Checked";
                $fileinfo="Can't Checked";
                $mbstring="Can't Checked";
                $openssl="Can't Checked";
                $pdo="Can't Checked";
                $tokenizer="Can't Checked";
                $xml="Can't Checked";
                $set_time_limit="Can't Checked";
                $install_allow = 1;

                if($float >= $checkphpfloat) {
                    $phpc="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>PHP : </b>Version Ok</div>";
                } else {
                    $install_allow = 0;
                    $phpc="<div class='alert alert-danger'><i class='fa fa-times-circle'></i> <b>PHP : </b>Error. PHP version less than 7.3</div>";
                }

                if (extension_loaded('ctype')) {
                    $ctype="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Ctype : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $ctype="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>Ctype : </b>Error Ctype is not Enabled. Please enable it.</div>";
                }

                if (extension_loaded('fileinfo')) {
                    $fileinfo="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Fileinfo : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $fileinfo="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>Fileinfo : </b>Error Fileinfo is not Enabled. Please enable it.</div>";
                }

                if (extension_loaded('json')) {
                    $json = "<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>JSON : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $json = "<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>JSON : </b>Error JSON is not Enabled. Please enable it.</div>";
                }

                if(function_exists("mb_detect_encoding")) {
                    $mbstring="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Mbstring : </b>Ok. Enabled.</div>";
                } else{
                    $install_allow = 0;
                    $mbstring="<div class='alert alert-danger'><i class='fa fa-times-circle'></i> <b>Mbstring : </b>Error.Mbstring is not Enabled. Please enable it.</div>";
                }


                if (extension_loaded('openssl')) {
                    $openssl="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>OpenSSL : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $openssl="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>OpenSSL : </b>Error OpenSSL is not Enabled. Please enable it.</div>";
                }

                if (class_exists('PDO')) {
                    $pdo="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>PDO : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $pdo="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>PDO : </b>Error pdo is not Enabled. Please enable it.</div>";
                }


                if (extension_loaded('tokenizer')) {
                    $tokenizer = "<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>Tokenizer : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $tokenizer="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>Tokenizer : </b>Error Tokenizer is not Enabled. Please enable it.</div>";
                }

                if (extension_loaded('xml')) {
                    $xml = "<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>XML : </b>Ok. Enabled.</div>";
                } else {
                    $install_allow = 0;
                    $xml="<div class='alert alert-danger'><i class='fa fa-check-circle'></i> <b>XML : </b>Error XML is not Enabled. Please enable it.</div>";
                }

                if(function_exists('set_time_limit')) {
                    $set_time_limit="<div class='alert alert-success'><i class='fa fa-check-circle'></i> <b>set time limit: </b>OK. Supported</div>";
                } else{
                    $install_allow = 0;
                    $set_time_limit="<div class='alert alert-danger'><i class='fa fa-times-circle'></i> <b>set time limit : </b>Error. set_time_limit() is not enabled. Please enable set_time_limit() function.</div>";
                }
            @endphp

            <br>
            <div class="row ambitious-padding-left-right">
                <div class="col-sm-12 col-xs-12 col-md-7 col-lg-7 border_gray grid_content padded background_white alert">
                    <h2 class="column-title"><i class="fas fa-cog"></i> Install iDentSoft</h2>
                    <hr>
                    <br>
                    @if(request()->get('wrong'))
                        <div class='alert alert-danger'><i class='fa fa-check-circle'></i> Wrong credential!</div>
                    @endif

                    @if(Session::has('mysql_error'))
                        @if(Session::get('mysql_error') != "")
                            <?php echo "<pre class='install-php-style'><h3 class='install-color-red'>"; ?>
                            {{ Session::get('mysql_error') }}
                            @php Session::forget('mysql_error'); @endphp
                            <?php echo "</h3></pre><br/>"; ?>
                        @endif
                    @endif
                    <div class="account-wall install-text-left" id='recovery_form'>
                        <form class="form-material form-horizontal" action="{{ route('install.install') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>App URL *</label>
                                <input type="text" value="{{ old('app_url') }}" name="app_url" required class="form-control ambitious-form-loading @error('app_url') is-invalid @enderror col-xs-12"  placeholder="App URL *" pattern="https?://.+">
                                @error('app_url')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                 <small class="form-text text-muted">Start with <span class="custom-manually-color-black">http://</span> or <span class="custom-manually-color-black">https://</span> Example : <span class="custom-manually-color-black">https://yourdomain.com/</span></small>
                            </div>
                            <div class="form-group">
                                <label>Database Host Name *</label>
                                <input type="text" value="{{ old('host_name') }}" name="host_name" required class="form-control ambitious-form-loading @error('host_name') is-invalid @enderror col-xs-12"  placeholder="Host Name *">
                                @error('host_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Database Name *</label>
                                <input type="text" value="{{ old('database_name') }}" name="database_name" required class="form-control ambitious-form-loading @error('database_name') is-invalid @enderror col-xs-12"  placeholder="Database Name *">
                                @error('database_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Database Port *</label>
                                <input type="text" value="{{ old('database_port') }}" name="database_port" required class="form-control ambitious-form-loading @error('database_port') is-invalid @enderror col-xs-12"  placeholder="Database Port *" pattern="[0-9]+">
                                @error('database_port')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Database Username *</label>
                                <input type="text" value="{{ old('database_username') }}" name="database_username" required class="form-control ambitious-form-loading @error('database_username') is-invalid @enderror col-xs-12"  placeholder="Database Username *">
                                @error('database_username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Database Password </label>
                                <input type="text" value="{{ old('database_password') }}" name="database_password" class="form-control ambitious-form-loading @error('database_password') is-invalid @enderror col-xs-12"  placeholder="Database Password">
                                @error('database_password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Admin Name *</label>
                                <input type="text" value="{{ old('name') }}" name="name" class="form-control ambitious-form-loading @error('name') is-invalid @enderror col-xs-12"  placeholder="Admin Name" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Admin Email *</label>
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control ambitious-form-loading @error('email') is-invalid @enderror col-xs-12"  placeholder="Admin Email" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Admin Password *</label>
                                <input type="password" value="{{ old('password') }}" name="password" class="form-control ambitious-form-loading @error('password') is-invalid @enderror col-xs-12"  placeholder="Admin Password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-warning btn-lg install-margin-top" <?php if($install_allow == 0) echo "disabled"; ?> ><i class="fa fa-check" ></i> Install iDentSoft Now</button><br/><br/>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 border_gray grid_content padded background_white alert">
                    <h2 class="column-title"><i class="fas fa-wrench"></i> Server Requirements</h2>
                    <hr>
                    <br>
                    @php
                        echo $phpc;
                        echo $ctype;
                        echo $fileinfo;
                        echo $json;
                        echo $mbstring;
                        echo $openssl;
                        echo $pdo;
                        echo $tokenizer;
                        echo $xml;
                        echo $set_time_limit;
                    @endphp

                    @if($install_allow==1)
                        <div class="alert alert-info text-center"><b>Congratulation ! Your server is fully configured to install this application.</b></div>
                    @else
                        <div class="alert alert-danger text-center"><b>Warning ! Please fullfill the above requirements (red colored) first.</b></div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
