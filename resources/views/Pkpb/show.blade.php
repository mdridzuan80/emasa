<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <tbody>
            <tr style="background-image: linear-gradient(to bottom, #fafafa 0, #f4f4f4 100%);">
                <th width="1"><b>#</b></th>
                <th>TARIKH</th>
                <th>KETERANGAN</th>
            </tr>
            @foreach ($pkpb as $pkp)
            <tr class="row-item" data-attendance="{{$pkp->final_attendance_id}}" data-id="{{ $pkp->id }}"
                data-tarikh="{{ $pkp->tarikh->format('d-m-Y') }}" data-perihal="{{ $pkp->keterangan }}">
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