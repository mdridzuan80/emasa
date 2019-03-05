@inject('Flow', 'App\Flow')

@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
        <i class="fa fa-gear"></i></i> Konfigurasi
        <small>Menguruskan konfigurasi sistem yang berkaitan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= route('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Konfigurasi</li>
        </ol>
    </section>

            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_1" data-toggle="tab">Sistem</a></li>
                            <li><a href="#tab_2" data-toggle="tab">Emel</a></li>
                            <li><a id="tab_waktu_bekerja" href="#tab_3" >Waktu Bekerja</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="box-body table-responsive no-padding">
                                        <table class="table table-striped">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 40%">
                                                        <b>Flow Kelulusan Bahagian/ Unit</b>
                                                        <p class="help-block">
                                                            Memastikan flow kelulusan mengikut keperluan bahagian atau unit.
                                                            <ul class="list-unstyled">
                                                                <li>'BIASA' adalah flow mengikut Penilai Pertama. (*)</li>
                                                                <li>'KETUA' adalah flow semua permohonan diluluskan oleh Ketua Bahagian/ Unit.</li>
                                                            </ul>
                                                            
                                                        </p>
                                                    </td>
                                                    <td style="width: 60%">
                                                        <table class="table" style="width: 100%; background-color: transparent;">
                                                            <tr>
                                                                <td>
                                                                    <div style="position: relative;">
                                                                        <input id="departmentDisplay" class="form-control departmentDisplay" type="text" style="background-color: #FFF;" readonly disabled placeholder="Bahagian/ Unit">
                                                                        <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId" type="hidden" style="background-color: #FFF;" readonly>
                                                                        <div id="treeDisplay" style="display:none; position: fixed;">
                                                                            <div id="departmentsTree" style="position:absolute; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <div id="flow-bahagian-conf">
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_2">
                                    The European languages are members of the same family. Their separate existence is a myth.
                                    For science, music, sport, etc, Europe uses the same vocabulary. The languages only differ
                                    in their grammar, their pronunciation and their most common words. Everyone realizes why a
                                    new common language would be desirable: one could refuse to pay expensive translators. To
                                    achieve this, it would be necessary to have uniform grammar, pronunciation and more common
                                    words. If several languages coalesce, the grammar of the resulting language is more simple
                                    and regular than that of the individual languages.
                                </div>

                                <div class="tab-pane" id="tab_3">
                                    <div id="waktu_bekerja_content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="overlay" style="display: none;">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            var shiftID = '';

            $.ajax({
                url: base_url+'rpc/department_tree',
                dataType: 'json',
                success: function( result, textStatus, jqXHR ) {
                    departments = result;
                    $('#departmentDisplay').prop('disabled', false);

                    $('#departmentsTree').jstree({
                        core:{
                            multiple : false,
                            check_callback: true,
                            data: departments
                        }
                    });

                    $('#departmentsTree').on('select_node.jstree', function (e, data) {
                        var placeholder = $('#flow-bahagian-conf');
                        var id = data.instance.get_node(data.selected[0]).id;
                        var text = data.instance.get_node(data.selected[0]).text;

                        $('.departmentDisplay').val(text);
                        $('.departmentDisplayId').val(id);
                        $("#treeDisplay").hide();

                        $.ajax({
                            url: base_url + 'rpc/konfigurasi/flow_bahagian/' + id,
                            success: function( result, textStatus, jqXHR ) {
                                var option = $('<select id="com-flow-bahagian" class="form-control"></select>');
                                option.append('<option value="{{ $Flow::BIASA }}" ' + ((result.data.flow == '{{ $Flow::BIASA }}') ? '"selected"' : '') + '>{{ $Flow::BIASA }}</option>');
                                option.append('<option value="{{ $Flow::KETUA }}" ' + ((result.data.flow == '{{ $Flow::KETUA }}') ? '"selected"' : '') + '>{{ $Flow::KETUA }}</option>');
                                placeholder.html(option.val(result.data.flow));
                            }
                        });

                        $('#flow-bahagian-conf').on('change', '#com-flow-bahagian', function(e) {
                            e.preventDefault();
                            
                            $.ajax({
                                method: 'post',
                                data:{'flag': e.target.value},
                                url: base_url + 'rpc/konfigurasi/flow_bahagian/' + id,
                                success: function( result, textStatus, jqXHR ) {
                                    
                                }
                            });
                        });
                    });
                }
            });

            $('#departmentDisplay').on('click', function(e) {
                e.preventDefault();
                $('#departmentsTree').css('width', $(this).parent().actual('width'));
                $('#departmentsTree').jstree('select_node', $('.departmentDisplayId').val().toString());
                $('#treeDisplay').toggle();

                $(document).click(function (e) {
                    if (!$(e.target).hasClass("departmentDisplay") 
                        && $(e.target).parents("#treeDisplay").length === 0) 
                    {
                        $("#treeDisplay").hide();
                    }
                });
            });

            $('#tab_waktu_bekerja').on('click', function(e) {
                e.preventDefault();
                $(this).tab('show');
            });

            $('#tab_waktu_bekerja').on('shown.bs.tab', function(e) {
                var placeholder = $('#waktu_bekerja_content');
                //e.target;
                //e.relatedTarget;
                //console.log(e.relatedTarget);
                //$('#waktu_bekerja_content').html('Hello World');

                populateDg(base_url+'rpc/waktu_bekerja','#waktu_bekerja_content')
            });

            $('#waktu_bekerja_content').on('click', '.btn-page', function(e) {
                e.preventDefault();
                $('#top-btn-wp-edit').prop('disabled', true);
                $('#top-btn-wp-delete').prop('disabled', true);

                url = $(this).attr('href');
                populateDg(url, '#waktu_bekerja_content');
            });

            $('#waktu_bekerja_content').on('click', '.row-shift', function(e) {
                var rows = $('#waktu_bekerja_content .row-shift');
                userRow = $(this);

                Object.values(rows).forEach(function(row)
                {
                    $(row).removeAttr('style');
                });

                shiftID = $(this).data('shiftid');
                
                $(this).css('background-color', '#c2eafe');

                $('#top-btn-wp-edit').prop('disabled', false);
                $('#top-btn-wp-delete').prop('disabled', false);

            });

            function populateDg(url, place) {
                $('.overlay').show();
                $.ajax({
                    method: 'get',
                    url: url,
                    success: function(data, textStatus, jqXHR) {
                        $('.overlay').hide();
                        $(place).html(data);

                        $('#top-btn-wp-edit').prop('disabled', true);
                        $('#top-btn-wp-delete').prop('disabled', true);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    },
                    statusCode: login()
                });
            }
        });
    </script>
@endsection