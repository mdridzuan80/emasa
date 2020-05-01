<div class="row">
    <div class="col-md-4">
        <div class="box box-widget widget-user-2">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-yellow">
                <div class="widget-user-image">
                    <img class="img-circle" src="{{ asset('dist/img/info.png') }}" alt="User Avatar">
                </div>
                <!-- /.widget-user-image -->
                <h3 class="widget-user-username">INFO</h3>
                <h5 class="widget-user-desc">Waktu Berperingkat</h5>
            </div>
            <div class="box-footer no-padding" style="max-height:500px; overflow:auto;">
                <ul class="nav nav-stacked">
                @foreach($shifts as $shift)
                <li><a href="#"><b>{{ $shift->name }}</b> <span class="pull-right badge bg-blue">{{ $shift->check_in->format('g:i A') }} - {{ $shift->check_out->format('g:i A') }}</span></a></li>
                @endforeach
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div id="tab-wp" class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><i class="fa fa-calendar"></i> WBB: Bulanan</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"><i class="fa fa-gear"></i> Konfigurasi</a></li>            
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    <div class="row">
                        <div class="col-md-4">
                            <form id="frmWbbBulanan" method="post" role="form">
                                <div class="form-group">
                                    <label for="comTahun">TAHUN</label>
                                    <select id="comTahun" class="form-control" name="comTahun" required>
                                        <option value="<?= date('Y') ?>"><?= date('Y') ?></option>
                                        <option value="<?= date('Y')+1 ?>"><?= date('Y')+1 ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <?php //lib('config')->load('pcrs', true) ?>
                                    <label for="comBulan">BULAN</label>
                                    <select multiple="" class="form-control" name="comBulan[]" size="12" required>
                                        @foreach(pcrsBulan() as $key => $bulan)
                                        <option value="{{ $key }}" {{ (date('m') == $key ) ? 'selected' : '' }}>{{ strtoupper($bulan) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comWbb">WBB</label>
                                    <select class="form-control" name="comWbb" required>
                                        @foreach($shifts as $shift)
                                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block" title="Simpan maklumat Waktu berperingkat">SIMPAN</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-8">
                            <div id="jadualWbbBulanan" class="table-responsive">
                                <h4>
                                    <i class="fa fa-refresh fa-spin"></i> Janaan jadual...
                                </h4>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="callout callout-warning">
                                <h4>MAKLUMAN!</h4>

                                <p>Sila masukkan pilihan untuk waktu mengandung dan bulan puasa.
                                Pilihan 'MENGANDUNG' akan diberi keutamaan jika anda memasukkan tarikh permulaan dan tamat waktu mengandung.</p>
                            </div>
                            <table class="table table-bordered">
                                <tr style="background-color: #f5f5f5;">
                                    <td><b>KONFIGURASI KETIKA BERPUASA</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="waktu-puasa">
                                            <div class="col-md-12" v-if="senPuasa.length > 0">
                                                <table class="table table-striped">
                                                    <tbody>
                                                        <tr>
                                                            <th>Tempoh Berpuasa</th>
                                                            <th>Pilihan</th>
                                                        </tr>
                                                        <tr v-for="puasa of senPuasa" :key="puasa">
                                                            <td>Tarikh Mula: @{{ puasa.tkhmula }} - Tarikh Tamat: @{{ puasa.tkhtamat }}</td>
                                                            <td>
                                                                <puasa-select-mode :conf="puasa.conf" :puasa_id="puasa.id" v-on:change-mode="addConf"></puasa-select-mode>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12" v-else>
                                                <p style="color: red">Tempoh berpuasa tidak tetapkan. Sila berhubung dengan Pentadbir Sistem.</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr style="background-color: #f5f5f5;">
                                    <td><b>KONFIGURASI KETIKA MENGANDUNG</b></td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="waktu-mengandung" class="col-md-4">
                                            <form id="frmMengandungConf" method="post" role="form" v-on:submit.prevent="addConf">
                                                <div class="form-group">
                                                    <label for="comBulan">TARIKH MULA</label>
                                                    <input type="text" class="form-control" name="txtTarikhMula" id="txtTarikhMula" autocomplete="off" v-model="tkhmula" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="comBulan">TARIKH TAMAT</label>
                                                    <input type="text" class="form-control" name="txtTarikhTamat" id="txtTarikhTamat" autocomplete="off" v-model="tkhtamat" required>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block" title="Simpan maklumat Waktu berperingkat">SIMPAN</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-md-8">
                                            <div id="jadualShiftConf" class="table-responsive">
                                                <h4>
                                                    <i class="fa fa-refresh fa-spin"></i> Janaan jadual...
                                                </h4>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>
<script>
    var puasaSelect = {
        props: ['conf', 'puasa_id'],
        template:`
            <select class="form-control input-sm" v-on:change="memilih" v-model="mode">
                <option value="{{ \App\ShiftConf::PUASA }}" >{{ \App\ShiftConf::PUASA }}</option>
                <option value="{{ \App\ShiftConf::NORMAL }}" >{{ \App\ShiftConf::NORMAL }}</option>
            </select>
        `,
        data() {
            return {
                mode: this.conf.pilihan,
            }
        },
        methods: {
            memilih() {
                this.$emit('change-mode', this.puasa_id, this.mode);
            }
        },
    }

    var puasaConf = new Vue({
        components: {
            "puasa-select-mode": puasaSelect,
        },
        el: "#waktu-puasa",
        data: {
            senPuasa: [],
            option: '{{ \App\ShiftConf::PUASA }}',
        },
        methods: {
            addConf(id, mode) {
                $.ajax({
                    url: `${base_url}rpc/anggota/puasa_conf/${mProfil.userId}`,
                    method: 'post',
                    data:{'puasa_id': id, 'jenis':'{{ \App\ShiftConf::PUASA }}', 'pilihan': mode}
                });
            }
        },
        created () {
            $.ajax({
                url: `${base_url}rpc/anggota/puasa_conf/${mProfil.userId}`,
                success: (resp) => {
                    this.senPuasa = resp.map((item)=> {
                        item.tkhmula = moment(item.tkhmula).format('DD-MM-YYYY');
                        item.tkhtamat = moment(item.tkhtamat).format('DD-MM-YYYY');
                        return item;
                    });
                }
            });
        },
    });

    var mengandungConf = new Vue({
        el: "#waktu-mengandung",
        data: {
            tkhmula: null,
            tkhtamat: null
        }
    });
</script>
