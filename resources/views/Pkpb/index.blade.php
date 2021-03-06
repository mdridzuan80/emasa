{{-- @inject('Flow', 'App\Flow') --}}

@extends('layouts.master')

@section('content')
<section class="content-header">
    <h1>
        <i class="fa fa-gear"></i></i> Bekerja Dari Rumah

    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= route('dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Pkpb</li>
    </ol>
</section>
<section class="content">
    <div class="box">
        <div class="table-responsive no-padding">
            <table class="table">
                <tbody>
                    <th colspan="2">
                        <b>Saya bersetuju :</b>
                    </th>

                    <tr>
                        <td colspan="2">
                            <label class="custom-control-label">
                                Mendapat kebenaran daripada Ketua Pejabat.
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="custom-control-input" id="check1" disabled checked>
                        </td>
                        <td>
                            <label class="custom-control-label" for="check1">
                                <mark>
                                    Memastikan arahan tugasan yang diberikan oleh penyelia disiapkan
                                    dalam tempoh yang
                                    ditetapkan
                                    (Arahan Pentadbiran Bil. 1 Tahun 2020 : Garis Panduan
                                    Kehadiran ke
                                    pejabat bagi
                                    Pegawai
                                    KSM).
                                </mark>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="custom-control-input" id="check1" disabled checked>
                        </td>
                        <td>
                            <label class="custom-control-label" for="check1">
                                <mark>
                                    Sentiasa berada dalam "standby mode" untuk tujuan komunikasi dengan penyelia.
                                    Sekiranya
                                    terdapat
                                    panggilan atau arahan melalui emel atau media sosial, pegawai perlu segera
                                    memberikan
                                    maklum
                                    balas kepada penyelia
                                    (Arahan Pentadbiran Bil. 1 Tahun 2020 : Garis Panduan Kehadiran ke pejabat bagi
                                    Pegawai
                                    KSM).
                                </mark>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="custom-control-input" id="check1" disabled checked>
                        </td>
                        <td>
                            <label class="custom-control-label" for="check1">
                                <p class="text-sm-left"><mark> Tindakan tegas boleh diambil kepada mana-mana pegawai
                                        yang
                                        tidak memberikan
                                        kerjasama
                                        kepada
                                        penyelia bagi perkara (i) dan (ii) (Arahan Pentadbiran Bil. 1 Tahun 2020 :
                                        Garis
                                        Panduan
                                        Kehadiran ke pejabat bagi Pegawai KSM).</mark>
                                </p>
                            </label>
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </div>
    <div class="box">
        <div id="pkp_content" class="box-body">

            {{-- select Tahun  --}}
            <div class="pull-left" style="padding-bottom:5px;">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                TAHUN&nbsp;
                            </td>

                            <td style="margin:0;padding:0;">
                                <select id="comTahun" class="form-control" name="comTahun">
                                    @foreach ($years as $item)
                                    <option value="{{ $item->year }}" {{ ($item->year == $year ) ? 'selected':'' }}>
                                        {{ $item->year }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- ! end select tahun ! --}}

            {{-- Tambah Kemaskini hapus --}}
            <div class="pull-right" style="padding-bottom:5px;">
                <table>
                    <tbody>
                        <tr>
                            <td style="margin:0;padding:0;">
                                &nbsp;<button id="top-btn-pkp-add" class="btn btn-default btn-flat btn-sm"><i
                                        class="fa fa-pencil-square-o"></i> Tambah</button>
                            </td>
                            {{-- <td style="margin:0;padding:0;">
                                &nbsp;<button id="top-btn-pkp-edit" class="btn btn-default btn-flat btn-sm"
                                    disabled=""><i class="fa fa-edit"></i> Kemaskini</button>
                            </td> --}}
                            <td style="margin:0;padding:0;">
                                &nbsp;<button id="top-btn-pkp-delete" class="btn btn-default btn-flat btn-sm"
                                    disabled=""><i class="fa fa-trash"></i> Hapus</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            {{-- ! end tambah kemaskini hapus ! --}}
            <div class="clearfix"></div>

            {{-- data untuk tarkih dah keterangan --}}
            <div id="pkp_details">

                <div id="data_pkp" class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
                                <th width="1"><b>#</b></th>
                                <th>TARIKH</th>
                                <th>KETERANGAN</th>
                            </tr>
                            @foreach ($pkpb as $pkp)
                            <tr class="row-item" data-attendance="{{$pkp->final_attendance_id}}"
                                data-id="{{ $pkp->id }}" data-tarikh="{{ $pkp->tarikh->format('d-m-Y') }}"
                                data-perihal="{{ $pkp->keterangan }}">
                                <td width="1">{{ $pkp->id }}</td>
                                <td>{{ $pkp->tarikh->format('d-m-Y') }}</td>
                                <td>{{ $pkp->keterangan }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>


                    @if ($pkpb->total())
                    <div class="clearfix">
                        <span style="display: inline-block; vertical-align: middle; line-height: normal;">Papar
                            {{ ($pkpb->currentPage() * $pkpb->perpage()) - ($pkpb->perpage() - 1) }} hingga
                            {{ ($pkpb->hasMorePages()) ? ($pkpb->currentPage() * $pkpb->perpage()) : $pkpb->total() }}
                            daripada
                            {{ $pkpb->total() }} rekod</span>
                        {{ $pkpb->links() }}
                    </div>
                    @endif
                    {{-- @endif --}}
                </div>
            </div>
            {{-- ! end untuk data untuk tarkih dah keterangan !--}}
        </div>
        {{-- <div id="pkp_details"></div> --}}
    </div>
    <div class="overlay" style="display: none;">
        <i class="fa fa-refresh fa-spin"></i>
    </div>

</section>


<!-- Modal Button untuk Tambah kemaskini hapus-->
{{-- @can('view-cuti') --}}

<div id="modal-pkp-add" class="modal fade">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header" style="background-color: steelblue; color: white;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><i class="fa fa-calendar"></i> Tambah/ Kemaskini PKP</h4>
            </div>
            <form id="frm-pkp-add">
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><b>TARIKH</b></td>
                                <td>
                                    <div class="bootstrap-timepicker">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <input id="pkpId" name="pkpId" type="hidden">
                                                <input id="finalAttendanceid" name="finalAttendanceid" type="hidden">
                                                <input id="txtTarikhPkp" name="txtTarikhPkp" type="text"
                                                    class="form-control" autocomplete="off" required>
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                            </div>
                                            <!-- /.input group -->
                                        </div>
                                        <!-- /.form group -->
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="col-md-3"><b>KETERANGAN</b></td>
                                <td>
                                    <input id="txtPerihal" class="form-control" type="text" readonly name="txtPerihal">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" style="color:#dd4b39;"
                        data-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

{{-- @endcan --}}
<!-- /.modal -->


@endsection

@section('scripts')
<script>
    $(function() {
            
            var tahun = new Date().getFullYear();     


           

            $('#txtTarikhPkp').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true
            }).on('hide', function(){
                $('.modal-backdrop').css('z-index', 1020);
            });


$('#comTahun').on('change', function(e){
tahun = $(this).val();
$.ajax({
method: 'get',
url: "/pkpb",
data:{tahun: tahun},
success: function(data, textStatus, jqXHR) {
// alert(data.success);
$('.overlay').hide();
$('#data_pkp').html(data)

// $('#top-btn-wp-edit').prop('disabled', true);
// $('#top-btn-wp-delete').prop('disabled', true);

},
error: function(jqXHR, textStatus, errorThrown) {

},
statusCode: login()
});

});



            function populateDgPkp(url, place) {
            // $('.overlay').show();
            $.ajax({
            method: 'get',
            url: url,
            data:{tahun: tahun},
            success: function(data, textStatus, jqXHR) {
            	// console.log(data);
            	// return false;
                
            $('.overlay').hide();
            $(place).html(data);
            
            // $('#top-btn-wp-edit').prop('disabled', true);
            // $('#top-btn-wp-delete').prop('disabled', true);
            
            $('#comTahun').on('change', function(e){
            
            tahun = $(this).val();
            populateDgPkp(base_url+'pkpb','#pkp_details');
            });
            },
            error: function(jqXHR, textStatus, errorThrown) {
            	console.log(jqXHR);
            },
            statusCode: login()
            });
            
            }
            
            // cuti
            // var tabCuti = $('#tab_cuti');
            // tabCuti.on('click', function(e) {
            //     e.preventDefault();
            //     $(this).tab('show');
            // });

            // tabCuti.on('shown.bs.tab', function(e) {                
            //     populateDgPkp(base_url+'rpc/cuti','#pkp_content');                
            // });

            // console.log(base_url);
            // populateDgPkp(base_url+'pkpb','#pkp_details');
            var pkpContent = $('#pkp_content');
       

            pkpContent.on('click', '.row-item', function(e) {
                   
                var rows = $('#pkp_content .row-item');
                userRow = $(this);

                Object.values(rows).forEach(function(row)
                {
                    $(row).removeAttr('style');
                });

                pkpId = $(this).data('id');
                finalAttendanceId = $(this).data('attendance');

                $('#modal-pkp-add').find('#txtTarikhPkp').val(moment($(this).data('tarikh'), "DD-MM-YYYY").format('YYYY-MM-DD'));
                $('#modal-pkp-add').find('#txtPerihal').val($(this).data('perihal'));
                $('#modal-pkp-add').find('#finalAttendanceid').val($(this).data('attendance'));
                $('#modal-pkp-add').find('#pkpId').val($(this).data('id'));
                
                $(this).css('background-color', '#c2eafe');

                $('#top-btn-pkp-edit').prop('disabled', false);
                $('#top-btn-pkp-delete').prop('disabled', false);
            });

            $('#pkp_content').on('click', '#top-btn-pkp-add', function(e){
                
                $('#modal-pkp-add').find('#txtTarikhPkp').val(null);
                $('#modal-pkp-add').find('#txtPerihal').val("Bekerja Dari Rumah");
                $('#modal-pkp-add').find('#pkpId').val(null);
                  
                $('#modal-pkp-add').modal('show');
            });

            $('#pkp_content').on('click', '#top-btn-pkp-edit', function(e){                         
                $('#modal-pkp-add').modal('show');
            });

           
            

            $('#modal-pkp-add').on('submit', '#frm-pkp-add', function(e){
                e.preventDefault();
                
                //var form = this;
                var formData = new FormData(this);

                swal({
                    title: 'Amaran!',
                    text: 'Anda pasti untuk menambah maklumat ini?',
                    type: 'warning',
                    cancelButtonText: 'Tidak',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return new Promise((resolve,reject) => {
                            $.ajax({
                                method: 'post',
                                data: formData,
                                cache       : false,
                                contentType : false,
                                processData : false,
                                url: base_url+'pkpb/add',
                                success: function() {
                                    // form.trigger('reset');
                                    resolve({value: true});
                                   populateDgPkp(base_url+'pkpb','#data_pkp')
                                },
                                error: function(jqXHR, textStatus, errorThrown) {
                                    reject(textStatus);
                                },
                                statusCode: login()
                            });
                        })
                    }
                }).then((result) => {
                    e.target.txtPerihal.value = '';

                    if (result.value) {
                        swal({
                            title: 'Berjaya!',
                            text: 'Maklumat telah dikemaskini',
                            type: 'success'
                        });
                        
                        populateDgPkp(base_url+'pkpb','#data_pkp')
                        $('#modal-pkp-add').modal('hide');
                    }
                }).catch(function (error) {
                    swal({
                        title: 'Ralat!',
                        text: 'Aktiviti tidak berjaya!. Sila berhubung dengan Pentadbir sistem',
                        type: 'error'
                    });
                });
            });
            
            $('#pkp_content').on('click', '#top-btn-pkp-delete', function(e){
                swal({
                    title: 'Amaran!',
                    text: 'Anda pasti untuk menghapuskan maklumat ini?',
                    type: 'warning',
                    cancelButtonText: 'Tidak',
                    showCancelButton: true,
                    confirmButtonText: 'Ya!',
                    showLoaderOnConfirm: true,
                    allowOutsideClick: false,
                    allowOutsideClick: () => !swal.isLoading(),
                    preConfirm: () => {
                        return new Promise((resolve, reject) => {

                            $.ajax({
                                method: 'delete',
                                data: {'pkpId': pkpId,'finalAttendanceId':finalAttendanceId},
                                url: base_url+'pkpb/destroy',                
                                success: function(data, textStatus, jqXHR) {
                                    swal({
                                        title: 'Berjaya!',
                                        text: 'Maklumat telah dihapuskan!',
                                        type: 'success'
                                    });
                                    
                                   populateDgPkp(base_url+'pkpb','#data_pkp')
                                 
                                },
                                error: function(err) {
                                    swal({
                                        title: 'Ralat!',
                                        text: 'Proses tidak berjaya!. Sila berhubung dengan Pentadbir sistem',
                                        type: 'error'
                                    });
                                },
                                statusCode: login()
                            });
                        })
                    }
                });
            });

            // $('#pkp_content').on('click', '.btn-page', function(e) {
            //     e.preventDefault();
            //     $('#top-btn-pkp-edit').prop('disabled', true);
            //     $('#top-btn-pkp-delete').prop('disabled', true);

            //     url = $(this).attr('href');
            //     populateDgPkp(url,'#pkp_content');
            // });

        
        });
</script>
@endsection