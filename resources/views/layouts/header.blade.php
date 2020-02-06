<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('dashboard') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>eMasa</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>eMasa</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{ asset('images/nobody_m_160x160.jpg') }}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{(Auth::user()->xtraAnggota) ? Auth::user()->xtraAnggota->nama : Auth::user()->name }}</span>
                </a>
                <ul class="dropdown-menu">
                    <!-- User image -->
                    <li class="user-header">
                    <img src="{{ asset('images/nobody_m_160x160.jpg') }}" class="img-circle" alt="User Image">

                    <p>
                        @if (Auth::user()->email === env('PCRS_DEFAULT_USER_ADMIN', 'admin@internal'))
                            <small>Sistem Administrator</small>
                        @else
                            <small>{{ ucfirst(Auth::user()->xtraAnggota->jawatan) }}</small>
                        @endif
                        <small>Member since {{ Auth::user()->created_at->shortLocaleMonth }} {{ Auth::user()->created_at->year }}</small>
                    </p>
                    </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-xs-12">
                                Peranan Semasa : <b>{{ strtoupper(Auth::user()->perananSemasa()->name) }}</b>
                            </div>
                        </div>
                        <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                    @if (Auth::user()->ableChangePassword())
                        <div class="pull-left">
                            <a id="btn-tukar-password" href="#" class="btn btn-default btn-default btn-flat">Tukar Katalaluan</a>
                        </div>
                    @endif
                    <div class="pull-right">
                        <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">Sign out</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                    </li>
                </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Modal --> 
<div class="modal fade" id="modal-tukar-katalaluan">
    <div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header" style="background:steelblue;color:white">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" >TUKAR KATALALUAN</h4>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <form id="frm-tukar-katalaluan">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="col-md-3"><b>KATALALUAN LAMA</b></td>
                                <td><input id="txtKatalaluanLama" class="form-control" type="password" name="txtKatalaluanLama" required></td>
                            </tr>
                            <tr>
                                <td><b>KATALALUAN BARU</b></td>
                                <td><input id="txtKatalaluanBaru" class="form-control" type="password" name="txtKatalaluanBaru" required></td>
                            </tr>
                            <tr>
                                <td><b>RE-KATALALAUAN BARU</b></td>
                                <td><input id="txtReKatalaluanLama" class="form-control" type="password" name="txtReKatalaluanLama" required></td>
                            </tr>
                            <tr>
                                <td><b>METER KOMPLEKSITI</b></td>
                                <td>
                                    <div id="meter_wrapper">
                                        <div id="meter"></div>
                                    </div>
                                    <br>
                                    <span id="pass_type"></span>
                                </td>
                            </tr>
                        </body>
                    </table>

                    <button class="btn btn-success pull-right" type="submit">HANTAR</button>
                    <button id="btn-batal" type="button" class="btn btn-link pull-right" style="color:#dd4b39;" >BATAL</button>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
