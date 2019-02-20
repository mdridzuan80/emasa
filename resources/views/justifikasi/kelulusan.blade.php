@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>Kelulusan Justifikasi Pegawai</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Bahagian/Jabatan : Bahagian Pengurusan Maklumat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap"><div class="row"><div class="col-sm-6"><div class="dataTables_length" id="example1_length"><label>Show <select name="example1_length" aria-controls="example1" class="form-control input-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label></div></div><div class="col-sm-6"><div id="example1_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control input-sm" placeholder="" aria-controls="example1"></label></div></div></div><div class="row"><div class="col-sm-12"><table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Nama: activate to sort column descending" style="width: 201px;">Nama</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Tarikh Kesalahan: activate to sort column ascending" style="width: 246px;">Tarikh Kesalahan</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Masa : activate to sort column ascending" style="width: 219px;">Masa</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jenis : activate to sort column ascending" style="width: 172px;">Jenis</th>
                                    <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Justifikasi Pegawai: activate to sort column ascending" style="width: 126px;">Justifikasi Pegawai</th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Action: activate to sort column descending" style="width: 201px;">Action</th></tr>
                                </thead>
                                <tbody>
                                @foreach ($justifikasis as $justifikasi)
                                <tr role="row" class="odd">
                                    <td class="sorting_1">{{ $justifikasi->user->name }}</td>
                                    <td>{{ $justifikasi->justifikasi_tarikh }}</td>
                                    <td>{{ $justifikasi->justifikasi_jenis }}</td>
                                    <td>{{ $justifikasi->justifikasi_jenis }}</td>
                                    <td>{{ $justifikasi->justifikasi_keterangan }}</td>
                                    <td>
                                        <button type="button" class="btn btn-success btn-block"><i class="fa fa-fw fa-check-square"></i>Lulus</button>
                                        <button type="button" class="btn btn-danger btn-block"><i class="fa fa-fw fa-minus-square"></i>Tolak</button>
                                    </td>

                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr><th rowspan="1" colspan="1">Nama</th><th rowspan="1" colspan="1">Tarikh Kesalahan</th><th rowspan="1" colspan="1">Masa</th><th rowspan="1" colspan="1">Jenis</th><th rowspan="1" colspan="1">Justifikasi Pegawai</th><th rowspan="1" colspan="1">Action</th></tr>
                                </tfoot>
                            </table></div></div><div class="row"><div class="col-sm-5"><div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers" id="example1_paginate"><ul class="pagination"><li class="paginate_button previous disabled" id="example1_previous"><a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0">Previous</a></li><li class="paginate_button active"><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0">1</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0">2</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0">3</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0">4</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0">5</a></li><li class="paginate_button "><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0">6</a></li><li class="paginate_button next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="7" tabindex="0">Next</a></li></ul></div></div></div></div>
            </div>
            <!-- /.box-body -->
        </div>
        </div>
    </section>
    @endsection