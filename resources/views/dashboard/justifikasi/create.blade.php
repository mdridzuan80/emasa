<div class="table-responsive">
    <form id="frm-acara">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="col-md-3"><b>Kursus/Bengkel</b></td>
                    <td>
                        <div class="form-group" style="margin-bottom: 0;">
                            <table style="width: 100%">
                                <tr>
                                    <td>
                                        <div class="radio" style="margin: 0;">
                                            <label>
                                            <input type="radio" name="kursus" value="{{ \App\JustifikasiKehadiran::BENGKEL_YA}}" required>
                                            Ya
                                            </label>
                                            
                                        </div>
                                    </td>
                                    <td>
                                        <div class="radio" style="margin: 0;">
                                            <label>
                                            <input type="radio" name="kursus" value="{{ \App\JustifikasiKehadiran::BENGKEL_TIDAK}}" required>
                                            Tidak
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                
                <tr>
                    <td><b>Tarikh Bengkel/Kursus</b></td>
                    <td>
                        <table style="width: 100%">
                            <tr>
                                <td style="padding-right: 5px">
                                    <input id="txtMasaMula" class="form-control" type="text" name="txtMasaMula" placeholder="Tarikh Mula"  required>
                                </td>
                                <td>
                                    <input id="txtMasaTamat" class="form-control" type="text" name="txtMasaTamat" placeholder="Tarikh Tamat"  required>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td><b>Keterangan Justifikasi</b></td>
                    <td><textarea id="txtKeterangan" class="form-control" rows="3" name="txtKeterangan" placeholder="Justifikasi anda..." required></textarea></td>
                </tr>
                <tr>
                    <td class="col-md-3"><b>Papar Justifikasi Dalam Kalendar ?</b></td>
                    <td><input id="txtPerkara" type="checkbox" name="txtPerkara" value="{{ \App\JustifikasiKehadiran::BENGKEL_YA}}"> Ya</td>
                </tr>
            </body>
        </table>
        <br>
        <button class="btn btn-success pull-right btn-acara-simpan" type="submit">SIMPAN</button>
        <button id="btn-batal" type="button" class="btn btn-link pull-right" style="color:#dd4b39;" data-dismiss="modal" >BATAL</button>
    </form>
</div>
