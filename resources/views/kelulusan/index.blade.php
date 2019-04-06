@inject('Flow', 'App\Flow')

@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-check-square-o"></i></i> Kelulusan
            <small>Mengurus kelulusan justifikasi</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= route('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Kelulusan</li>
        </ol>
    </section>

    <section class="content">
        <!-- Start box -->
        <div class="box">
            <div class="box-header"></div>
            <div class="box-body table-responsive">
                <div class="row" style="margin:0;">

                    <div class="col-lg-6">
                        {{-- Bahagian --}}
                        <div class="form-group row">
                            <label class="col-md-3 control-label"><i class="fa fa-sitemap fa-fw"></i>
                                Bahagian
                            </label>
                            <div class="col-md-9">
                                <div style="position: relative;">
                                    <input id="departmentDisplay" class="form-control departmentDisplay" type="text" style="background-color: #FFF;" readonly disabled placeholder="Bahagian/ Unit">
                                    <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId" type="hidden" style="background-color: #FFF;" readonly>
                                    <div id="treeDisplay" style="display:none; position: fixed;">
                                        <div id="departmentsTree" style="position:absolute; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        {{-- Tahun --}}
                        <div class="form-group row">
                            <label class="col-md-4 control-label text-md-right pt-2"><i class="fa fa-calendar-o"></i>
                                Tahun
                            </label>
                            <div class="col-md-6">
                                {{--<input type="" class="form-control" name="" required>--}}
                                <input id="txtTahun" name="txtTahun" type="text" class="form-control input-sm" placeholder="Text input" value="<?php echo date('Y')?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin:0;">

                    <div class="col-lg-6">
                        {{-- Nama --}}
                        <div class="form-group row">
                            <label class="col-md-3 control-label"><i class="fa fa-user"></i>
                                Nama
                            </label>
                            <div class="col-md-9">
                                <input type="" class="form-control" name="">
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        {{-- Bulan --}}
                        <div class="form-group row">
                            <label class="col-md-4 control-label text-md-right pt-2"><i class="fa fa-calendar"></i>
                                Bulan
                            </label>
                            <div class="col-md-6">
                                {{--<input type="" class="form-control" name="">--}}
                                <input id="txtBulan" name="txtBulan" type="text" class="form-control input-sm" placeholder="Text input" value="<?php echo date('m')?>">
                            </div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    {{--<div class="col-lg-2">--}}
                        {{--<div class="form-group row">--}}
                            {{--<div class="col-md-2 col-md-offset-2">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Hantar--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>

                <br>
                <div id="grid-kelulusan-justifikasi"></div>
            </div>

            </div>
        </div>

    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
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

                    //senarai department
                    $('#departmentsTree').on('select_node.jstree', function (e, data) {
                        var placeholder = $('#flow-bahagian-conf');
                        var id = data.instance.get_node(data.selected[0]).id;
                        var text = data.instance.get_node(data.selected[0]).text;

                        //placeholder.html('<h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>');

                        $('.departmentDisplay').val(text);
                        $('.departmentDisplayId').val(id);
                        $("#treeDisplay").hide();

                        //panggil anggota_grid
                       $.ajax({
                           url: base_url + 'rpc/kelulusan/anggota_grid/' + id,
                           success: function( result, textStatus, jqXHR ) {
                            $('#grid-kelulusan-justifikasi').html(result);
                           },
                           error: function() {
                               alert('please refresh');
                           }
                       });
                    });
                }
            });

            //onclick
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

            

            populateDg(url, '#dg-anggota');

            function populateDg(url, place) {
                $('.overlay').show();
                $.ajax({
                    method: 'post',
                    url: url,
                    data: dataSearch,
                    success: function(data, textStatus, jqXHR) {
                        $(place).html(data);
                        $('.overlay').hide();

                        if(dataSearch.searchKey) {

                            $(".table tbody tr").unmark({
                                done: function() {
                                    $(".table tbody tr").mark(dataSearch.searchKey,{debug: true});
                                }
                            });
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {

                    },
                    statusCode: login()
                });
            }

            //button setting wp/ppp
            $('#dg-anggota').on('click', '.btn-page', function(e) {
                e.preventDefault();
                $('#top-btn-profil').prop('disabled', true);
                $('#top-btn-wp').prop('disabled', true);
                $('#top-btn-ppp').prop('disabled', true);
                $('#top-btn-more').prop('disabled', true);
                $('#top-btn-more').addClass('disabled');

                url = $(this).attr('href');
                populateDg(url, '#dg-anggota');
            });

        });


    </script>
@endsection