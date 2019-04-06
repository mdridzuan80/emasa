                        <div class="box box-body">
                            <div class="box-header with-border">
                                <h3 class="box-title">Senarai Staf</h3>
                            </div>

                            <!-- /.box-header -->
                            <div class="box-body" style="">
                                <div class="table-responsive">
                                    <table class="table no-margin">
                                        {{--<table class="table table-bordered table-hover">--}}
                                        <thead>
                                        <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
                                            <th style="width:1px;">#</th>
                                            <th>NAMA</th>
                                            <th>WBB</th>
                                            <th>TARIKH</th>
                                            <th>CHECK-IN</th>
                                            <th>CHECK-OUT</th>
                                            <th>NOTA</th>
                                        </tr>
                                        </thead>

                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Aslisa Bt Mat Saat</td>
                                            <td><span class="label label-success">WP4</span></td>
                                            <td>Tuesday 02/04/2019</td>
                                            <td>8:05:16 am</td>
                                            <td>8:05:16 pm</td>
                                            <td>Tidak punch Petang</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Abdul Malek</td>
                                            <td><span class="label label-warning">WPF</span></td>
                                            <td>Tuesday 02/04/2019</td>
                                            <td>8:05:16 am</td>
                                            <td>8:05:16 pm</td>
                                            <td>Tidak punch Petang</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Ena Azrina Daud</td>
                                            <td><span class="label label-danger">WP1</span></td>
                                            <td>Tuesday 02/04/2019</td>
                                            <td>8:05:16 am</td>
                                            <td>8:05:16 pm</td>
                                            <td>Tidak punch Petang</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Fa'iza Hilmi binti Aziz</td>
                                            <td><span class="label label-info">WP12</span></td>
                                            <td>Tuesday 02/04/2019</td>
                                            <td>8:05:16 am</td>
                                            <td>8:05:16 pm</td>
                                            <td>Tidak punch Petang</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- box-footer -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-info pull-right" id="/laporan/harian-pdf">Cetak Laporan</button>
                                <!-- <button type="submit" class="btn btn-default pull-right">Cetak</button> -->
                            </div>
                        </div>


@section('scripts')

    <script>
        $(function () {

            //Date picker
            $('#datepicker1').datepicker({
                autoclose: true
            })

            //Date picker
            $('#datepicker2').datepicker({
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




