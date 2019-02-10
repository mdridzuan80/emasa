@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>Dashboard</h1>
    </section>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js"></script>
<!--<script src="/js/fastclick.js"></script>-->
<!-- NProgress -->
<!--<script src="/js/nprogress.js"></script>-->
<!-- Chart.js -->
<!--<script src="/js/Chart.min.js"></script>-->
<!-- Custom Theme Scripts -->
<!--<script src="/js/custom.min.js"></script>-->


    <!-- Main content -->
    <section class="content">
    
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-file"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Warna Kad</span>
              <span class="info-box-number">Kuning<small></small></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-car"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Lewat</span>
              <span class="info-box-number">4</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-plus-square"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Justifikasi Tiada Input</span>
              <span class="info-box-number">17</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-sun-o"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Cuti Rehat</span>
              <span class="info-box-number">6</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
       <!-- justifikasi -->
      <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">MyJustifikasi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Tarikh</th>
                    <th>Punch In</th>
                    <th>Justifikasi</th>
                    <th>Action</th>
                    <th>Punch Out</th>
                    <th>Justifikasi</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td>12/01/2019</td>
                    <td>9.00 AM</td>
                    <td>Pergi Klinik</td>
                    <td><button type="button" class="btn btn-success btn-block"><i class="fa fa-fw fa-check-square"></i>Selesai</button>
                    </td>
                    <td>Tiada</td>
                    <td></td>
                    <td><button id="justifikasi" type="button" class="btn btn-primary btn-block" data-tarikh="2019-01-12" data-jenis="out"><i class="fa fa-fw fa-plus-square"></i>Mohon</button>
                    </td>
                  </tr>
                  <tr>
                    <td>16/01/2019</a></td>
                    <td>9.08 AM <span class="label label-danger">Lewat 8 saat</span></td>
                    <td></td>
                    <td><button id="justifikasi" type="button" class="btn btn-primary btn-block" data-tarikh="2019-01-16"><i class="fa fa-fw fa-plus-square"></i>Mohon</button>
                    </td>
                    <td>Tiada</td>
                    <td></td>
                    <td><button id="justifikasi" type="button" class="btn btn-primary btn-block" data-tarikh="2019-01-16"><i class="fa fa-fw fa-plus-square"></i>Mohon</button>
                    </td>
                  </tr>
                  
                  <tr>
                    <td><a href="pages/examples/invoice.html">22/01/2019</a></td>
                    <td>9.07 AM <span class="label label-danger">Lewat 7 minit</span></td>
                    <td>Jem di jalan</td>
                    <td><button id="justifikasi" type="button" class="btn btn-warning btn-block" data-tarikh="2019-01-22"><i class="fa fa-fw fa-pencil-square" ></i>Kemaskini</button>
                    </td>
                    <td>5.00 PM <span class="label label-danger">Awal 7 minit</span></td>
                    <td></td>
                    <td><button id="justifikasi" type="button" class="btn btn-warning btn-block" data-tarikh="2019-01-22"><i class="fa fa-fw fa-pencil-square" ></i>Kemaskini</button>
                    </td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>

            <!-- jabatan : justifikasi -->
            <div class="row">
        <div class="col-md-6">
      <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Kakitangan Lewat Lebih 3 Kali</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Bilangan Lewat</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Nor Azwin</a></td>
                    <td>4</td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Hishamuddin</a></td>
                    <td>7</td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Shukrizan</a></td>
                    <td>2</td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Simon</a></td>
                    <td>9</td>
                  </tr>    
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
        </div>
        
        <div class="col-md-6">
          <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Kakitangan Yang Tidak Memberi Justifikasi</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Jabatan/Bahagian</th>
                    <th>Bil Punch In</th>
                    <th>Bil Punch Out</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Nor Azwin</a></td>
                    <td>BPM</td>
                    <td>4</td>
                    <td>6</td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Hishamuddin</a></td>
                    <td>BPM</td>
                    <td>9</td>
                    <td>6</td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Shukrizan</a></td>
                    <td>BPM</td>
                    <td>4</td>
                    <td>6</td>
                  </tr>
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
        </div>
            </div>


      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Lewat Lebih 3 Kali : Bulanan</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-box-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-wrench"></i></button>
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Separated link</a></li>
                  </ul>
                </div>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-10">
                  <p class="text-center">
                    <strong>2019 : Januari - Disember</strong>
                  </p>
                  <canvas id="myChart" width="10" height="10"></canvas>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>--}}
{{--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>--}}

<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mac", "Apr", "Mei", "Jun", "Jul", "Ogo","Sept","Okt","Nov","Dis"],
            datasets: [{
                label: 'Pegawai Lewat Melebihi 3 kali',
                data: [6, 7, 8, 15, 8, 3, 5, 4, 0, 2, 10, 5],
                backgroundColor: [
                    '#c0392b',
                    '#0c2461',
                    '#f1c40f',
                    '#833471',
                    '#78e08f',
                    '#fd79a8',
                    '#00a8ff',
                    '#c0392b',
                    '#0c2461',
                    '#f1c40f',
                    '#833471',
                    '#78e08f'
                ],
                borderColor: [
                    '#c0392b',
                    '#0c2461',
                    '#f1c40f',
                    '#833471',
                    '#78e08f',
                    '#fd79a8',
                    '#00a8ff',
                    '#c0392b',
                    '#0c2461',
                    '#f1c40f',
                    '#833471',
                    '#78e08f'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script>

                 
                  <!-- /.chart-responsive -->
                </div>
                <!-- /.col -->
                <div class="col-md-2">
                  <p class="text-center">
                    <strong>Jumlah Kehadiran</strong>
                  </p>

                  <div class="progress-group">
                    <span class="progress-text">Hadir</span>
                    <span class="progress-number"><b>14</b>/24</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Tidak Hadir</span>
                    <span class="progress-number"><b>10</b>/24</span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: 80%"></div>
                    </div>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
      <div class="col-md-8">
      <div class="box box-danger">
            <div class="box-header with-border">
              <h3 class="box-title">Warna Kad : Hijau & Merah</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Warna Kad</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Nor Azwin</a></td>
                    <td><span class="label label-success">8</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Hishamuddin</a></td>
                    <td><span class="label label-success">8</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Shukrizan</a></td>
                    <td><span class="label label-danger">8</span></td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">Simon</a></td>
                    <td><span class="label label-success">8</span></td>
                  </tr>    
                  
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
          </div>
        </div>
            
      
      <div class="col-md-4">
          <!-- Info Boxes Style 2 -->
          <div class="info-box bg-yellow">
            <span class="info-box-icon"><i class="fa fa-battery-4"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Kuning</span>
              <span class="info-box-number">18</span>

              <div class="progress">
                <div class="progress-bar" style="width: 50%"></div>
              </div>
              <span class="progress-description">
                    70%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-battery-half"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Hijau</span>
              <span class="info-box-number">2</span>

              <div class="progress">
                <div class="progress-bar" style="width: 20%"></div>
              </div>
              <span class="progress-description">
                    20% 
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-battery-0"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Merah</span>
              <span class="info-box-number">1</span>

              <div class="progress">
                <div class="progress-bar" style="width: 70%"></div>
              </div>
              <span class="progress-description">
                    10%
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div>
      </div>

<div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: steelblue; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><i class="fa fa-fw fa-calendar-plus-o"></i> MOHON JUSTIFIKASI</h4>
                    </div>
                    <div class="modal-body">
                        <h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
</section>
@endsection

@section('scripts')
    <script>
        $(function() {
            var tarikh_justifikasi = '';
            var jenis_justifikasi = '';

            $('#justifikasi').on('click', function(e) {
                tarikh_justifikasi = $(this).data('tarikh');
                jenis_justifikasi = $(this).data('jenis');
                $('#modal-default').modal({backdrop: 'static',});
            })

            $('#modal-default').on('show.bs.modal', function(e) {
                var modalBody = $(this).find('.modal-body');

                $.ajax({
                    url: base_url + 'rpc/anggota/{{ Auth::user()->anggota_id }}/justifikasi/create/'+ tarikh_justifikasi + '/' + jenis_justifikasi,
                    success: function(data, textStatus, jqXHR) {
                        modalBody.html(data);
                        $('#txtMasaMula').datetimepicker({
                            format: 'DD/MM/YYYY h:mm A'
                        });

                        $('#txtMasaTamat').datetimepicker({
                            useCurrent: false, //Important! See issue #1075
                            format: 'DD/MM/YYYY h:mm A'
                        });
                        $("#txtMasaMula").on("dp.change", function (e) {
                            acara.masaMula = e.date.format('YYYY-MM-DD HH:mm:00.000');
                            $('#txtMasaTamat').data("DateTimePicker").minDate(e.date);
                        });
                        $("#txtMasaTamat").on("dp.change", function (e) {
                            var duration = moment.duration(moment(e.date.format('YYYY-MM-DD HH:mm:00.000')).diff(acara.masaMula));
                            duration = duration.asHours();

                            if (acara.jenisAcara == '{{ \App\Acara::JENIS_ACARA_TIDAK_RASMI}}' && duration > 4)
                            {
                                e.target.value = '';
                                alert('Tempoh masa lebih 4 jam');
                                return;
                            }

                            acara.masaTamat = e.date.format('YYYY-MM-DD HH:mm:00.000');
                            $('#txtMasaMula').data("DateTimePicker").maxDate(e.date);
                        });
                    },
                });
            });

            $('#modal-default').on('hidden.bs.modal', function(e) {
                e.preventDefault();
                $(this).find('.modal-title').html('<i class="fa fa-fw fa-calendar-plus-o"></i> MOHON JUSTIFIKASI');
                $(this).find('.modal-body').html('<h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>');
            });

            $('#modal-default').on('click', 'input[type="radio"]', function(e) {
                acara.jenisAcara = e.target.value;
            });

            $('#modal-default').on('keyup', '#txtPerkara', function(e) {
                acara.perkara = e.target.value;
                if(! e.target.value) {
                    return $('#modal-default .modal-title').html('<i class="fa fa-fw fa-calendar-plus-o"></i> MOHON JUSTIFIKASI');
                }

                return $('#modal-default .modal-title').html('<i class="fa fa-fw fa-calendar"></i>' + e.target.value.toUpperCase());
            });

            $('#modal-default').on('change', '#txtKeterangan', function(e) {
                acara.keterangan = e.target.value;
            });

            $('#modal-default').on('submit', '#frm-acara', function(e) {
                e.preventDefault();

                swal({
                    title: 'Amaran!',
                    text: 'Anda pasti untuk nyatakan justifikasi ini?',
                    type: 'warning',
                    cancelButtonText: 'Tidak',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return new Promise((resolve,reject) => {
                            $.ajax({
                                method: 'POST',
                                data: acara,
                                url: base_url + 'rpc/anggota/{{Auth::user()->anggota_id}}/justifikasi/create/'+ tarikh_justifikasi + '/' + jenis_justifikasi,
                                success: function(acara, extStatus, jqXHR) {
                                    resolve({'acara': acara.data});
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    reject(textStatus);
                                },
                                statusCode: login()
                            });
                        });
                    }
                }).then((result) => {
                    console.log(result.value);
                    if (result.value) {
                        //cal.fullCalendar('refetchEvents');
                        cal.fullCalendar( 'renderEvent', result.value.acara);
                        $('#modal-default').modal('hide');

                        swal({
                            title: 'Berjaya!',
                            text: 'Maklumat telah disimpan',
                            type: 'success'
                        });
                    }
                }).catch((error) => {
                    swal({
                        title: 'Ralat!',
                        text: "Operasi tidak berjaya!.\nSila berhubung dengan Pentadbir sistem",
                        type: 'error'
                    });
                });
            });

            // modal acara
             $('#modal-acara-anggota').on('show.bs.modal', function(e) {                
                $.ajax({
                    url: base_url+'rpc/kalendar/{{ Auth::user()->anggota_id }}/acara/' + dateClick.format('YYYY-MM-DD'),
                    success: (resp, textStatus, jqXHR) => {
                        $(this).find('.modal-body').html(resp);
                    }
                });
            });

            $('#modal-acara-anggota').on('hidden.bs.modal', function(e) {
                $(this).find('.modal-body').html('<h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>');
            });

            $('#cetak-laporan-bulanan').on('click', function(e) {
                var tkhSemasaView = cal.fullCalendar('getDate');
                var bulan = tkhSemasaView.format('MM');
                var tahun = tkhSemasaView.format('YYYY');
                console.log(tahun);
            });
        });
    </script>
@endsection