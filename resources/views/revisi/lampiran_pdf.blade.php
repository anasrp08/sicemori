<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{$pecahan}} {{$nomor_order}}</title>
</head>

<body>
    <style type="text/css">
        table tr td,
        table tr th {
            font-size: 12pt;

        }

        td.tblbawah {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
            width:120px;
        }
        td.tblbawah1 {
            border: 2px solid black;
            text-align: center;
            padding: 10px;
            width:100px;
        }

        td.row3 {
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: bold;
            /* padding: 10px; */

        }
        td.row3right {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px; 
            font-weight: bold;
            /* padding: 10px; */

        }

        td.row2 {
            font-size: 20pt;
            text-align: center;
            font-weight: bold;

        }

        td.row1 {
            font-size: 12pt;
            font-weight: bold;

        }
    </style>
    


        <table class="table table-bordered">
            <tr>
                <td class="row1"   colspan="4">
                    Perum Percetakan Uang R.I
                </td>
                <td style="  font-weight: bold;" colspan="4">
                    Seksi Cetak Nomor
                </td>
            </tr>
            <tr>
                <td class="row1"   colspan="4">
                    Divisi SBU Uang RI
                </td>
                <td style="padding-left:25px;font-weight: bold;" >
                    {{$keterangan}}
                </td>
            </tr>
            <tr>
                <td class="row2"  colspan="4">
                    Lembar Perintah Kerja
                </td>
                <td class="row2" style="border: 2px solid black; padding:20px">
                        {{$pecahan1}}
                </td>
            </tr>
            <tr>
                <td class="row3" colspan="2" >
                    Pecahan {{$pecahan}}
                </td>


                <td class="row3" colspan="1" >
                    Berisi : {{$jumlah_bilyet}} bilyet
                </td>


                <td class="row3right" colspan="2">
                    No. Order: {{$nomor_order}}
                </td>
            </tr>
            @foreach($arrCollect as $isiColumn)
            <tr>
                <td class="tblbawah">
                    {{$isiColumn->column1}}
                </td>
                <td class="tblbawah">
                    {{$isiColumn->column2}}
                </td>

                <td class="tblbawah1">
                    {{$isiColumn->column3}}
                </td>
                <td class="tblbawah">
                    {{$isiColumn->column4}}
                </td>
                <td class="tblbawah">
                    {{$isiColumn->column5}}
                </td>
            </tr>
            @endforeach
            <tr>
                <td class="row1" style="  padding-top:10px;">
                    Dimulai dari No.
                </td>
                <td style="font-weight: bold; text-align:left;padding-top:10px;" colspan=2>
                    : {{$nomor}}
                </td>

            </tr>
            <tr>
                <td style="  font-weight: bold; ">
                    Dimulai dari No.
                </td>
                <td style="font-weight: bold; text-align:left" colspan=2>
                    :
                </td>
                <td style="font-weight: bold; text-align:left">
                    Dilanjutkan
                </td>
                <td style="font-weight: bold; text-align:left">
                    :
                </td>

            </tr>
            <tr>
                    <td style="  font-weight: bold; ">
                        Mulai dicetak tanggal
                    </td>
                    <td style="font-weight: bold; text-align:left" colspan=2>
                        :
                    </td>
                    <td style="font-weight: bold; text-align:left">
                        Dilanjutkan dari nomor
                    </td>
                    <td style="font-weight: bold; text-align:left">
                        :
                    </td>
    
                </tr>
                <tr>
                        <td style=" font-weight: bold; ">
                            Selesai dicetak tanggal
                        </td>
                        <td style="font-weight: bold; text-align:left" colspan=2>
                            :
                        </td>
                        <td style="font-weight: bold; text-align:left">
                            Dicetak di Mesin
                        </td>
                        <td style="font-weight: bold; text-align:left">
                            :
                        </td>
        
                    </tr>
                    <tr>
                            <td style="  font-weight: bold; ">
                                Ditunda tanggal
                            </td>
                            <td style="font-weight: bold; text-align:left" colspan=2>
                                :
                            </td>
                            <td style="font-weight: bold; text-align:left">
                                Mulai dicetak tanggal
                            </td>
                            <td style="font-weight: bold; text-align:left">
                                :
                            </td>
            
                        </tr>
                        <tr>
                                <td style="  font-weight: bold; ">
                                    No terakhir
                                </td>
                                <td style="font-weight: bold; text-align:left" colspan=2>
                                    :
                                </td>
                                <td style="font-weight: bold; text-align:left">
                                    Selesai dicetak tanggal
                                </td>
                                <td style="font-weight: bold; text-align:left">
                                    :
                                </td>
                
                            </tr>

                            <tr>
                               <td colspan="3" style="padding-top:7px;">
                                        
                                    </td>
                                    <td colspan="2" style="font-weight: bold; text-align:right;padding-top:7px;">
                                        Seksi Cetak Nomor
                                    </td>
                                    
                    
                                </tr>
                                <tr>
                                        <td colspan="4" style="padding-top:17px;">
                                                 
                                             </td>
                                             <td style="font-weight: bold; text-align:center;padding-top:55px;">
                                                 Sunaryo
                                             </td>
                                             
                             
                                         </tr>

        </table>


 
    <script>
        $(document).ready(function () {
            window.onafterprint = function(){
                myfunction()
   
}
function myfunction(){
    alert("tes")
}

        })
    </script>
</body>

</html>