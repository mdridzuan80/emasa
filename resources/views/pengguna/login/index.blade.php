<div class="table-responsive">
    <table class="table table-bordered">
        <tbody>
            <tr>
                <td class="col-md-3"><b>ID Pengguna</b></td>
                <td>{{ $profil->user->username }}</td>
            </tr>
            <tr>
                <td class="col-md-3"><b>Domain</b></td>
                <td>{{ $profil->user->domain }} </td>
            </tr>
        </tbody>
    </table>

    <div id="tab-wp" class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            @if(Auth::user()->can('add-peranan') || Auth::user()->can('view-peranan'))
            <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-lock"></i> Peranan</a></li>
            @endif
            @if ($profil->user->ableChangePassword())
            <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-key"></i> Reset Katalaluan</a></li> 
            @endif           
        </ul>
        <div class="tab-content">
            @can('add-peranan')
            <div class="tab-pane active" id="tab_1">
                <div class="row">
                    <div class="col-md-12">
                        <div style="padding-bottom:5px;">
                            <span><b>PADANAN PERANAN PENGGUNA</b></span>
                            <form id="frm-add-peranan" class="form-inline">
                                <div class="form-group">
                                    <select class="form-control input-sm" name="comPeranan" style="padding-right: 5px;">
                                        <option value="0">Peranan</option>
                                        @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="width: 60%;">
                                    <div style="position: relative;">
                                        <input id="departmentDisplay" class="form-control departmentDisplay input-sm" type="text" value="{{ $profil->xtraAttr->department->deptname }}" style="width: 100%; background-color: #FFF;" readonly>
                                        <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId input-sm" type="hidden" value="{{ $profil->xtraAttr->basedept_id }}" style="background-color: #FFF;" readonly>
                                        <div id="treeDisplay" style="display:none;">
                                            <div id="departmentsTree" style="position:absolute; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm">Tambah</button>
                            </form>
                        </div>  

                        @can('view-peranan')
                        <table class="table table-bordered">
                            <thead>
                                <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
                                    <th style="width: 10px">#</th>
                                    <th>PERANAN</th>
                                    <th>JABATAN/ UNIT</th>
                                    <th style="width:1px;">OPERASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($profil->user->roles()->orderBy('priority')->get() as $role)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->pivot->department->deptname }}</td>
                                    <td style="width:1px;">
                                        @if ($role->key !== \App\Role::PENGGUNA)
                                        <a title="Hapus Peranan" class="btn btn-danger btn-xs btn-hapus-peranan" data-role_user="{{ $role->pivot->id }}" href="#" style="margin: auto; display: block;"><i class="fa fa-trash-o"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endcan
                    </div>              
                </div>
            </div>
            @endcan
            @if ($profil->user->ableChangePassword())
            <div class="tab-pane" id="tab_2">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <form id="frm-tukar-katalaluan-personal">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td><b>KATALALUAN BARU</b></td>
                                            <td><input id="txtKatalaluanBaruPersonal" class="form-control" type="password" name="txtKatalaluanBaruPersonal" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>RE-KATALALAUAN BARU</b></td>
                                            <td><input id="txtReKatalaluanLamaPersonal" class="form-control" type="password" name="txtReKatalaluanLamaPersonal" required></td>
                                        </tr>
                                        <tr>
                                            <td><b>METER KOMPLEKSITI</b></td>
                                            <td>
                                                <div id="meter_wrapper_personal">
                                                    <div id="meter-personal"></div>
                                                </div>
                                                <br>
                                                <span id="pass_type_personal"></span>
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
            </div>
            @endif           
        </div>
    </div>
</div>