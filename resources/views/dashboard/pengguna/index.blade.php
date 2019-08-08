@extends('layouts.master')
@inject('Justifikasi', 'App\Justifikasi')

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-dashboard"></i></i> Dashboard
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-fw fa-calendar"></i> Kalendar</h3>
                        <div class="box-tools pull-right">
                            <!-- Buttons, labels, and many other things can be placed here! -->
                            <!-- Here is a label for example -->
                            <span id='petunjuk'><i class="fa fa-fw fa-info"></i></span>
                        </div><!-- /.box-tools -->
                    </div>
                    <div class="box-body">
                        <div id="calendar"></div>
                    </div>
                    <div class="overlay">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
            </div>
        </div>
    
        <div class="modal fade" id="modal-default" style="display: none;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: steelblue; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"><i class="fa fa-fw fa-calendar-plus-o"></i> TAMBAH ACARA</h4>
                    </div>
                    <div class="modal-body">
                        <h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <div class="modal fade" id="modal-acara-anggota" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: steelblue; color: white;">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span></button>
                        <h4 class="modal-title"></h4>
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
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(function() {
            var acara = {
                jenisAcara: '',
                perkara: '',
                masaMula: '',
                masaTamat: '',
                keterangan: '',
                hours: 0,
            }; 

            var dateClick = '';

            var acaraUrlProp = {
                schema: '',
                schema_id: ''
            };

            var frmJustifikasi = {
                    tarikh: '',
                    sama: '{{ $Justifikasi::FLAG_JUSTIKASI_TIDAK_SAMA }}',
                    medanKesalahan: '',
                    alasan: ''
                };

            var cal = $('#calendar').fullCalendar({
                firstDay: 1,
                showNonCurrentDates: false,
                /* customButtons: {
                    myCustomButton: {
                        text: 'Tambah Aktiviti',
                        click: function() {
                            $('#modal-default').modal({backdrop: 'static',});
                        }
                    }
                }, */
                header: {
                    right: 'myCustomButton prev,today,next'
                },
                dayClick: function(date, jsEvent, view) {
                    var modal = $('#modal-acara-anggota');
                    dateClick = date;

                    modal.find('.modal-title').html("MAKLUMAT ACARA PADA : " + date.format('D MMMM YYYY').toUpperCase());
                    modal.modal({backdrop: 'static',keyboard: false});
                },
                events: function(start, end, timezone, callback) {
                    $.ajax({
                        url: base_url+'rpc/kalendar/{{Auth::user()->anggota_id}}',
                        data: {
                            start: start.toISOString(),
                            end: end.toISOString()
                        },
                        success: function(events) {
                            callback(events.data);
                        }
                    });
                },
                loading: function(isLoading, view)
                {
                    if (isLoading)
                        $('.overlay').show();
                    else
                        $('.overlay').hide();
                }
            });

            $('#tambah-acara').on('click', function(e) {
                $('#modal-default').modal({backdrop: 'static',});
            })

            $('#modal-default').on('show.bs.modal', function(e) {
                var modalBody = $(this).find('.modal-body');

                $.ajax({
                    url: base_url + 'rpc/kalendar/{{Auth::user()->anggota_id}}/acara/create',
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
                $(this).find('.modal-title').html('<i class="fa fa-fw fa-calendar-plus-o"></i> TAMBAH ACARA');
                $(this).find('.modal-body').html('<h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>');
            });

            $('#modal-default').on('click', 'input[type="radio"]', function(e) {
                acara.jenisAcara = e.target.value;
            });

            $('#modal-default').on('keyup', '#txtPerkara', function(e) {
                acara.perkara = e.target.value;
                if(! e.target.value) {
                    return $('#modal-default .modal-title').html('<i class="fa fa-fw fa-calendar-plus-o"></i> TAMBAH ACARA');
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
                    text: 'Anda pasti untuk menambah acara ini?',
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
                                url: base_url + 'rpc/kalendar/{{Auth::user()->anggota_id}}/acara',
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
                    success: (resp, text, jqXHR) => {
                        $(this).find('.modal-body').html(resp);

                        $.each($('.txt-tarikh'), (key, el) => {
                            $(el).val(dateClick.format('YYYY-MM-DD')+' 00:00:00');                            
                        });
                    }
                });
            });

            $('#modal-acara-anggota').on('hidden.bs.modal', function(e) {
                $(this).find('.modal-body').html('<h4><i class="fa fa-refresh fa-spin"></i> Loading...</h4>');
            });

            /* $('#modal-acara-anggota').on('click', '.btn-justifikasi', function(e) {
                var count = $('.btn-justifikasi');
                alert(count.length);
            }); */

            $('#modal-acara-anggota').on('change', '#chk-sama-petang', function(e) {
                e.preventDefault();
                
                if ($(this).is(':checked')) {
                    return disableFormComponentPetang(true);
                }

                return disableFormComponentPetang(false);
            });

            $('#modal-acara-anggota').on('change', '#chk-sama-pagi', function(e) {
                e.preventDefault();
                
                if ($(this).is(':checked')) {
                    return disableFormComponentPagi(true);
                }

                return disableFormComponentPagi(false);
            });

            $('#modal-acara-anggota').on('submit', '#frm-mohon-justifikasi-pagi', function(e) {
                e.preventDefault();
                if ($(e.target['chk-sama-petang']).is(':checked')) {
                    frmJustifikasi.sama = '{{ $Justifikasi::FLAG_JUSTIKASI_SAMA }}'
                }
                hantarJustifikasi(e);
            });

            $('#modal-acara-anggota').on('submit', '#frm-mohon-justifikasi-petang', function(e) {
                e.preventDefault();
                if ($(e.target['chk-sama-pagi']).is(':checked')) {
                    frmJustifikasi.sama = '{{ $Justifikasi::FLAG_JUSTIKASI_SAMA }}'
                }
                hantarJustifikasi(e);
            });

            $('#cetak-laporan-bulanan').on('click', function(e) {
                var tkhSemasaView = cal.fullCalendar('getDate');
                var bulan = tkhSemasaView.format('MM');
                var tahun = tkhSemasaView.format('YYYY');
                console.log(tahun);
            });

            function disableFormComponentPetang(status) {
                $('#frm-mohon-justifikasi-petang').trigger('reset');
                $('#chk-sama-pagi').prop('disabled', status);
                $('#txt-justifikasi-petang').prop('disabled', status);
                $('#btn-justifikasi-petang').prop('disabled', status);
            }

            function disableFormComponentPagi(status) {
                $('#frm-mohon-justifikasi-pagi').trigger('reset');
                $('#chk-sama-petang').prop('disabled', status);
                $('#txt-justifikasi-pagi').prop('disabled', status);
                $('#btn-justifikasi-pagi').prop('disabled', status);
            }

            function hantarJustifikasi(e) {
                frmJustifikasi.tarikh = e.target['txt-tarikh'].value;
                frmJustifikasi.alasan = e.target['txt-justifikasi'].value;
                frmJustifikasi.medanKesalahan = e.target['txt-medan-kesalahan'].value;

                swal({
                    title: 'Amaran!',
                    text: 'Anda pasti untuk memohon justifikasi ini?',
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
                                data: frmJustifikasi,
                                url: base_url + 'rpc/justifikasi/{{Auth::user()->anggota_id}}',
                                success: function(justifikasi, extStatus, jqXHR) {
                                    resolve();
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    reject(textStatus);
                                },
                                statusCode: login()
                            });
                        });
                    }
                }).then(() => {
                    //if (result.value) {
                        //cal.fullCalendar('refetchEvents');
                        //cal.fullCalendar( 'renderEvent', result.value.acara);
                        //$('#modal-default').modal('hide');

                    swal({
                        title: 'Berjaya!',
                        text: 'Maklumat telah disimpan',
                        type: 'success'
                    });
                    //}
                }).catch((error) => {
                    swal({
                        title: 'Ralat!',
                        text: "Operasi tidak berjaya!.\nSila berhubung dengan Pentadbir sistem",
                        type: 'error'
                    });
                });
            }
        });
    </script>
@endsection