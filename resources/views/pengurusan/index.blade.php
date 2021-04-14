@extends('layouts.master')


@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i></i> Pengurusan
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" >
                    <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover">
                            <tbody>
                                <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
                                    <th><b>Bil</b></th>
                                    <th>Nama Pegawai</th>
                                    <th>Bilangan Tiada Justifikasi</th>
                                    <th>Warna Kad</th>
                                </tr>
                                <tr class="row-item">
                                    @foreach ($anggota as $anggo)
                                     <td>{{ $anggo->name }}</td>
                                    @endforeach
                                </tr>
                               
                            </tbody>
                        </table>

                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        
    </script>
@endsection