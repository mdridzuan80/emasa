@extends('layouts.master')

@section('content')

    <head>
        <link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    </head>
    <section class="content-header">
        <h1>
            <i class="fa fa-bar-chart-o"></i></i> Laporan
            <small>Mengurus janaan laporan berkaitan</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?= route('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li class="active">Laporan</li>
        </ol>
    </section>



    <section class="content">
        <form role="form" method="POST">
            {{ csrf_field() }}

            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Laporan Harian</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Laporan Bulanan</a></li>
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active" id="tab_1">
                        <div>
                            <div class="box-body" style="">
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label>Bahagian/Jabatan</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-sitemap fa-fw"></i>
                                                </div>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <option selected="selected">Sila Pilih..</option>
                                                    <option>Alaska</option>
                                                    <option>California</option>
                                                    <option>Delaware</option>
                                                    <option>Tennessee</option>
                                                    <option>Texas</option>
                                                    <option>Washington</option>
                                                </select>
                                                <!-- </select><span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-qt24-container"><span class="select2-selection__rendered" id="select2-qt24-container" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <!-- <select class="form-control select2 select2-hidden-accessible" disabled="" style="width: 100%;" tabindex="-1" aria-hidden="true"> -->
                                                    <option selected="selected">Sila Pilih..</option>
                                                    <option>Alaska</option>
                                                    <option>California</option>
                                                    <option>Delaware</option>
                                                    <option>Tennessee</option>
                                                    <option>Texas</option>
                                                    <option>Washington</option>
                                                </select>
                                                <!-- </select><span class="select2 select2-container select2-container--default select2-container--disabled" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" aria-labelledby="select2-ypg7-container"><span class="select2-selection__rendered" id="select2-ypg7-container" title="Alabama">Alabama</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span> -->
                                            </div>
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.col -->

                                    <div class="col-md-6">
                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Tarikh Mula:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right " id="Tkrh_mula">
                                            </div>
                                        </div>

                                        <!-- /.form-group -->
                                        <div class="form-group">
                                            <label>Tarikh Hingga:</label>
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right " id="datepicker">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <!-- box-footer -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right" id="list-harian">Jana Laporan</button>
                                <!-- <button type="submit" class="btn btn-default pull-right">Cetak</button> -->

                            </div>
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
                    <!-- /.tab-pane -->
                </div>
            </div>
            <!-- /.tab-content -->
            <br>

            </div>
        </form>

        {{--<div id="list-harian"></div>--}}

        <div class="col-lg-12">
            <div id="list-harian">
                &nbsp;
            </div>
        </div>


    </section>


@endsection

@section('scripts')

    <script>
        $(function () {

            //Date picker
            $('#Tkrh_mula').datepicker({
                autoclose: true
            })

            //Date picker
            $('#datepicker').datepicker({
                autoclose: true
            })

            //panggil list_harian
            $.ajax({
                url: base_url + 'rpc/laporan/list_harian/' + id,
                success: function( result, textStatus, jqXHR ) {
                    $('#list-harian').html(result);
                },
                error: function() {
                    alert('please refresh');
                }
            });

            //onclick
            $('#list-harian').on('click', function(e) {
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

        })
    </script>

    <!-- date-range-picker -->
    <script src="../../bower_components/moment/min/moment.min.js"></script>
    <script src="../../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
@endsection


