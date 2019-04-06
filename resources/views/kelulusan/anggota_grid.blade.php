<table class="table table-bordered table-hover">
    <thead>
    <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
        <th style="width:1px;">#</th>
        {{--<th>&nbsp;</th>--}}
        <th>NAMA</th>
        <th>TARIKH</th>
        <th>WBB</th>
        <th>CHECK-IN</th>
        <th>CHECK-OUT</th>
        <th>KESALAHAN</th>
        <th>STATUS</th>
        <th>OPERASI</th>
    </tr>
    </thead>

    <tbody>
    @forelse ($senAnggota as $anggota)
        <tr class="row-user" data-userid="{{ $anggota->USERID }}" data-nama="{{ $anggota->Name }}" data-deptid="{{ $anggota->DEFAULTDEPTID }}" data-deptname="{{ $anggota->DEPTNAME }}">
            <td>{{ ($senAnggota->currentpage()-1) * $senAnggota->perpage() + $loop->index + 1 }}</td>
            <td>{{ $anggota->Name }}</td>
            <td>{{ $anggota->Name }}</td>
            <td>{{ $anggota->SSN }}</td>
            <td>{{ $anggota->TITLE }}</td>
            <td>{{ $anggota->TITLE }}</td>
            <td>{{ $anggota->TITLE }}</td>
            <td>
                <button class="btn btn-success btn-xs btn-lulus-justifikasi" type="button" title="Meluluskan Permohonan"><span class="glyphicon glyphicon-ok-sign"></span></button>
                <button class="btn btn-danger btn-xs btn-tolak-justifikasi" type="button" title="Menolak Permohonan"><span class="glyphicon glyphicon-remove-sign"></span></button>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">Rekod tidak wujud!</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{--@if ($senAnggota->total())--}}
    {{--<div class="clearfix">--}}
        {{--<span style="display: inline-block; vertical-align: middle; line-height: normal;">Papar {{ ($senAnggota->currentPage() * $senAnggota->perpage()) - ($senAnggota->perpage() - 1) }}  hingga {{ ($senAnggota->hasMorePages()) ? ($senAnggota->currentPage() * $senAnggota->perpage()) : $senAnggota->total() }}  daripada {{ $senAnggota->total() }} rekod</span>--}}
        {{--{{ $senAnggota->links() }}--}}
    {{--</div>--}}
{{--@endif--}}
