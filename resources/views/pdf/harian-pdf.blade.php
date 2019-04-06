<!DOCTYPE html>
<html>
<head>
    <style>
        #pdf-harian {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #pdf-harian td, #pdf-harian th {
            border: 1px solid #ddd;
            padding: 1px;
            text-align: center;
        }

        #pdf-harian tr:nth-child(even){background-color: #f2f2f2;}

        #pdf-harian tr:hover {background-color: #ddd;}

        #pdf-harian th {
            padding-top: 1px;
            padding-bottom: 1px;
            text-align: center;
            background-color: #130f40;
            color: white;
        }
    </style>
</head>
<body>

<table>
    <tr>
        <td width="2" rowspan="6">
            <div align="center">
                <span style="width:100%; text-align:center;">
                <img src="http://emasa.test/images/jata2.png" alt="Jata Image">
                </span>
            </div>
        </td>
        <td width="5" rowspan="6">&nbsp;</td>
        <td>LAPORAN</td>
        <td><strong>:</strong></td>
        <td>MAKLUMAT KEDATANGAN HARIAN </td>
    </tr>
    <tr>
        <td>NAMA</td>
        <td><strong>:</strong></td>
        <td></td>
    </tr>
    <tr>
        <td>BAHAGIAN</td>
        <td><strong>:</strong></td>
        <td></td>
    </tr>

    <tr>
        <td>WBB</td>
        <td><strong>:</strong></td>
        <td></td>
    </tr>
</table>

<table id="pdf-harian">
    <tr>
        <th>TARIKH</th>
        <th>HARI</th>
        <th>CHECK-IN</th>
        <th>CHECK-OUT</th>
        <th>LEWAT</th>
        <th>NOTA</th>
        <th>JUSTIFIKASI</th>
    </tr>
    <tr>
        <td>01/04/2019</td>
        <td>Isnin</td>
        <td>7:59:35 am</td>
        <td>5:00:01 pm</td>
        <td></td>
        <td>April Fool</td>
        <td></td>
    </tr>

    <tr>
        <td>02/04/2019</td>
        <td>Selasa</td>
        <td>8:59:35 am</td>
        <td>6:00:01 pm</td>
        <td></td>
        <td>Hari Raya</td>
        <td></td>
    </tr>

    <tr>
        <td>03/04/2019</td>
        <td>Rabu</td>
        <td>8:59:35 am</td>
        <td>6:00:01 pm</td>
        <td></td>
        <td>Deepavali</td>
        <td></td>
    </tr>

</table>

</body>
</html>
