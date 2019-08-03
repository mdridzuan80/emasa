@extends('layouts.master')

@section('content')
    <section class="content-header">
        <h1>
            <i class="fa fa-book"></i></i> Laporan Harian
        </h1>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary" >
                    <div class="box-body table-responsive">
                        <table class="table table-bordered">
                            <input id="txtAnggotaId" type="hidden" name="txtAnggotaId" value="">
                            <tbody>
                                <tr>
                                    <td width="1"><b>BAHAGIAN/&nbsp;UNIT</b></td>
                                    <td>
                                        <div style="position: relative;">
                                            <input id="departmentDisplay" class="form-control departmentDisplay" type="text" style="background-color: #FFF;" readonly disabled="true">
                                            <input id="departmentDisplayId" name="txtDepartmentId" class="form-control departmentDisplayId" type="hidden" style="background-color: #FFF;" readonly>
                                            <div id="treeDisplay" style="display:none;">
                                                <div id="departmentsTree" style="position:relative; background-color: #FFF; overflow:auto; max-height:200px; border:1px #ddd solid"></div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="1"><b>TARIKH&nbsp;PAPARAN</b></td>
                                    <td>
                                        <input type="text" class="form-control" name="txtTarikh" id="txtTarikh" autocomplete="off" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button id="btn-ExportPDF" class="btn btn-default btn-flat">Jana PDF</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <div id="lala">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(function() {
            var margins = {
                top: 80,
                bottom: 60,
                left: 40,
                width: 522
            };

            populateDept();

            $('#txtTarikh').datepicker({
                format: 'yyyy-mm-dd',
                todayHighlight: true,
                autoclose: true
            })

            function populateDept()
            {
                var departments = '';

                $.ajax({
                    url: base_url+'rpc/department_tree',
                    dataType: 'json',
                    success: function( result, textStatus, jqXHR ) {
                        departments = result;
                        
                        $('#departmentsTree').jstree({
                            core:{
                                multiple : false,
                                check_callback: true,
                                data: departments
                            }
                        });
                        
                        $('#departmentDisplay').prop('disabled', false);

                        $('#departmentsTree').on('select_node.jstree', function (e, data) {
                            var id = data.instance.get_node(data.selected[0]).id;
                            var text = data.instance.get_node(data.selected[0]).text;

                            $('.departmentDisplay').val(text);
                            $('.departmentDisplayId').val(id);
                            $("#treeDisplay").hide();
                        });

                        $('#departmentDisplay').on('click', function(e) {
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
                    }
                });
            }

            $('#btn-ExportPDF').on('click', function() {
                $.ajax({
                    method: 'POST',
                    url: base_url+'rpc/laporan/harian',
                    dataType: 'json',
                    success: function( result, textStatus, jqXHR ) {
                        exportPDF(result);
                    }
                });
            });

            function exportPDF(datas) {
                var doc = new jsPDF('p', 'pt', 'a4');
                var head = [["ID", "Country", "Rank", "Capital"]];
                var body = [
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"],
                    [1, "Denmark", 7.526, "Copenhagen"],
                    [2, "Switzerland", 	7.509, "Bern"],
                    [3, "Iceland", 7.501, "Reykjavík"],
                    [4, "Norway", 7.498, "Oslo"],
                    [5, "Finland", 7.413, "Helsinki"]
                ];

                var totalPagesExp = "{total_pages_count_string}";

                doc.autoTable({
                    head,
                    body,
                    showHead: 'firstPage',
                    didDrawPage: function (data) {
                        // Footer
                        var str = "Page " + doc.internal.getNumberOfPages()
                        // Total page number plugin only available in jspdf v1.0+
                        if (typeof doc.putTotalPages === 'function') {
                            str = str + " of " + totalPagesExp;
                        }
                        doc.setFontSize(10);

                        // jsPDF 1.4+ uses getWidth, <1.4 uses .width
                        var pageSize = doc.internal.pageSize;
                        var pageHeight = pageSize.height ? pageSize.height : pageSize.getHeight();
                        doc.text(str, data.settings.margin.left, pageHeight - 10);
                    }
                });
                doc.output("dataurlnewwindow");
                //pdf.save();
            }
        });
    </script>
@endsection