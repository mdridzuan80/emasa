@extends('layouts.master')

@section('content')

<head>
<link rel="stylesheet" href="../../bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
</head>

{{--tambah style sebab hidden date picker--}}

<style>
    .date{
        z-index:2000;!important;
    }
</style>

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
        <form role="form" id="list_harian" method="POST">
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
                                    <div style="position: relative;">
                                        <input id="departmentDisplay" class="form-control departmentDisplay" type="text"  style="background-color: #FFF;" readonly>
                                        <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId" type="hidden"  style="background-color: #FFF;" readonly>
                                        <div id="treeDisplay" style="display:none;">
                                            <div id="departmentsTree" style="position:absolute; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                        </div>
                                    </div>
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
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right " id="tkrh_mula">
                                    </div>
                            </div>

                                <div class="form-group">
                                <label>Tarikh Hingga:</label>
                                    {{--tambah group date--}}
                                    <div class="input-group date">
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
                    <br>
                        <div id="result_list_harian"></div>
                    </div>

                    <div class="tab-pane" id="tab_2">
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
                                                    <div style="position: relative;">
                                                        <input id="departmentDisplay" class="form-control departmentDisplay" type="text"  style="background-color: #FFF;" readonly>
                                                        <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId" type="hidden"  style="background-color: #FFF;" readonly>
                                                        <div id="treeDisplay" style="display:none;">
                                                            <div id="departmentsTree" style="position:absolute; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                                        </div>
                                                    </div>
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
                                            <label>Bulan:</label>
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <!-- <select class="form-control select2 select2-hidden-accessible" disabled="" style="width: 100%;" tabindex="-1" aria-hidden="true"> -->
                                                    <option selected="selected">Sila Pilih..</option>
                                                    <option>Jan</option>
                                                    <option>Feb</option>
                                                    <option>Mac</option>
                                                    <option>April</option>
                                                    <option>Mei</option>
                                                    <option>Jun</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label>Tahun:</label>
                                            {{--tambah group date--}}
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                                    <!-- <select class="form-control select2 select2-hidden-accessible" disabled="" style="width: 100%;" tabindex="-1" aria-hidden="true"> -->
                                                    <option selected="selected">Sila Pilih..</option>
                                                    <option>2018</option>
                                                    <option>2019</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right" id="list-harian">Cetak Laporan</button>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <!-- box-footer -->
                            {{--<div class="box-footer">--}}
                                {{--<button type="submit" class="btn btn-info pull-right" id="list-harian">Jana Laporan</button>--}}
                                {{--<!-- <button type="submit" class="btn btn-default pull-right">Cetak</button> -->--}}
                            {{--</div>--}}
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                </div>
            </div>

            </div>
        </form>
    </section>

    
@endsection

@section('scripts')

<script>
  $(function () {
    
     //Date picker
     $('#tkrh_mula,#datepicker').datepicker({
      autoclose: true
    });

    //onclick
    $('#list_harian').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            method:'POST',
            url: base_url + 'rpc/laporan/list_harian',
            success: function( result, textStatus, jqXHR ) {
                $('#result_list_harian').html(result);
            },
            error: function() {
                alert('please refresh');
            }
        });
    });

      $('#departmentDisplay').on('click', function(e) {
          e.preventDefault();
          var jsTreeInstance = $('#departmentsTree').jstree(true);
          var currentDeptID = $('#departmentDisplayId').val().toString();

          $('#departmentsTree').css('width', $(this).parent().actual('width'));
          jsTreeInstance.deselect_all();
          jsTreeInstance.select_node(currentDeptID);
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


