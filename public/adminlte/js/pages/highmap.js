$(function() {

    'use strict';
    $('#refresh').click(function(){
        alert("tes")
    })

    // $.ajax({
    //     url: "{{ route('saksiahli.update') }}",
    //     method: "POST",
    //     data: new FormData(this),
    //     contentType: false,
    //     cache: false,
    //     processData: false,
    //     dataType: "json",
    //     beforeSend: function () {
    //         $('#action_button').val('menyimpan...');
    //     },
    //     success: function (data) {
    //         var html = '';
    //         if (data.errors) {
    //             html = '<div id=error class="alert alert-danger">';
    //             for (var count = 0; count < data.errors.length; count++) {
    //                 html += '<p>' + data.errors[count] + '</p>';
    //             }
    //             html += '</div>';
    //             $('#action_button').val('Edit');
    //         }
    //         if (data.success) {
    //             toastr.success(data.success, 'Success Alert', {
    //                 timeOut: 5000
    //             });
    //             $('#formEdit')[0].reset();
    //             $('#action_button').val('Edit');
    //             $('#saksiahli').DataTable().ajax.reload();

    //             setTimeout(function () {
    //                 $('#formEdit').modal('toggle');

    //             }, 1000);
    //         }
    //     }
    // });

    // Prepare demo data
    // Data is joined to map using value of 'hc-key' property by default.
    // See API docs for 'joinBy' for more info on linking data and map.
    var data = [
        ['id-3700', 0],
        ['id-ac', 1],
        ['id-ki', 2],
        ['id-jt', 3],
        ['id-be', 4],
        ['id-bt', 5],
        ['id-kb', 6],
        ['id-bb', 7],
        ['id-ba', 8],
        ['id-ji', 9],
        ['id-ks', 10],
        ['id-nt', 11],
        ['id-se', 12],
        ['id-kr', 13],
        ['id-ib', 14],
        ['id-su', 15],
        ['id-ri', 16],
        ['id-sw', 17],
        ['id-la', 18],
        ['id-sb', 19],
        ['id-ma', 20],
        ['id-nb', 21],
        ['id-sg', 22],
        ['id-st', 23],
        ['id-pa', 24],
        ['id-jr', 25],
        ['id-1024', 26],
        ['id-jk', 27],
        ['id-go', 28],
        ['id-yo', 29],
        ['id-kt', 30],
        ['id-sl', 31],
        ['id-sr', 32],
        ['id-ja', 33]
    ];

    // Create the chart
    Highcharts.mapChart('container', {
        chart: {
            map: 'countries/id/id-all'
        },

        title: {
            text: 'Peta Kantor Pemohon Direktorat Jendral Bea Cukai Indonesia'
        },

        // subtitle: {
        //     text: 'Source map: <a href="/adminlte/highmaps/id-all.js">Indonesia</a>'
        // },

        mapNavigation: {
            enabled: true,
            buttonOptions: {
                verticalAlign: 'bottom'
            }
        },

        colorAxis: {
            min: 0
        },

        series: [{
                data: data,
                name: 'Random data',
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },

                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                },

            },
            {
                // Specify points using lat/lon
                type: 'mappoint',
                name: 'Kantor Pemohon',
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                },
                tooltip: {
                    headerFormat: '',
                    pointFormat: '<b>{point.name}</b><br>Lat: {point.lat}<br> Lon: {point.lon}'
                },
                color: Highcharts.getOptions().colors[1],
                data: [
                    { name: 'DIREKTORAT P2 KANPUS DJBC',lat: -6.189048259618696, lon: 106.90223708294657 },
{ name: 'KANWIL DJBC BANTEN',lat: -6.19084338728022, lon: 106.61223109182953 },
{ name: 'KANWIL DJBC ACEH',lat: 4.9855563676867645, lon: 96.31493005616315 },
{ name: 'KANWIL DJBC JABAR',lat: -6.744244487756159, lon: 107.4187370650039 },
{ name: 'KANWIL DJBC JAKARTA',lat: -6.125867524931717, lon: 106.86566474909044 },
{ name: 'KANWIL DJBC JATENG DIY',lat: -7.0065745419656675, lon: 110.3197965504199 },
{ name: 'KANWIL DJBC JATIM I',lat: -8.0191173761758, lon: 114.16655569650865 },
{ name: 'KANWIL DJBC JATIM II',lat: -7.808547062258364, lon: 112.35839989379929 },
{ name: 'KANWIL DJBC KALBAGTIM',lat: -1.3685409144909653, lon: 116.39803053102506 },
{ name: 'KANWIL DJBC KHUSUS PAPUA',lat: -0.8955593791102494, lon: 131.48353752521265 },
{ name: 'KANWIL DJBC MALUKU', lat: -3.6537772176906387, lon: 128.22267753283558 },
{ name: 'KANWIL DJBC SULBAGSEL',lat: -5.298832068450465, lon: 119.68618167055912 }, 
{ name: 'KANWIL DJBC SULBAGUT',lat: 1.2807513336892533, lon: 124.8318398659735 }, 
{ name: 'KANWIL DJBC SUMBAGBAR',lat: -5.407683013336394, lon: 105.0296556795791 },  
{ name: 'KANWIL DJBC SUMBAGTIM',lat: -3.3390017680283623, lon: 104.50727965288543 },
{ name: 'KANWIL DJBC SUMBAGUT',lat: 3.385526645363115, lon: 98.88914383959225 },  
{ name: 'KPPBC TMC KUDUS',lat: -6.752067765275111, lon: 110.90502828230247 }, 
{ name: 'KPPBC TMC MALANG',lat: -7.973156629393573, lon: 112.5449543386739 }, 
{ name: 'KPPBC TMP A DENPASAR',lat: -8.642569218493172, lon: 115.21549923213585 }, 
{ name: 'KPPBC TMP A MARUNDA',lat: -6.098878070238682, lon: 106.82928442866616 }  ,
{ name: 'KPPBC TMP A PASURUAN',lat: -7.405908248114333, lon: 112.44171856480347 },
{ name: 'KPPBC TMP A SEMARANG',lat: -7.034781303905997, lon: 110.34916913448323 },
{ name: 'KPPBC TMP A TANGERANG',lat: -6.202885963680802, lon: 106.59386417648793 },
{ name: 'KPPBC TMP B BALIKPAPAN',lat: -1.2361619471466587, lon: 116.83000816550474 },
{ name: 'KPPBC TMP B BANDAR LAMPUNG',lat: -5.475848467465392, lon: 105.34026517685042 },
{ name: 'KPPBC TMP B BANJARMASIN',lat: -3.2760744659896712, lon: 114.6334982362791 },
{ name: 'KPPBC TMP B MAKASSAR',lat: -5.130477864749717, lon: 119.43480859218371 },
{ name: 'KPPBC TMP B MEDAN',lat: 3.5850621198661377, lon: 98.69016028521703 },
{ name: 'KPPBC TMP B PALEMBANG',lat: -3.037374164751862, lon: 104.81324022220511 },
{ name: 'KPPBC TMP B PONTIANAK',lat: -0.23193585397069338, lon: 109.45665431660414 },
{ name: 'KPPBC TMP B SAMARINDA',lat: -0.4097198142540213, lon: 117.05616945371153 },
{ name: 'KPPBC TMP B SIDOARJO',lat: -7.457094053328557, lon: 112.74485750172997 } ,
{ name: 'KPPBC TMP B TANJUNGPINANG',lat: 0.952741789830658, lon: 104.48782609335458 },
{ name: 'KPPBC TMP B TARAKAN',lat: 3.3421035005906528, lon: 117.6279870758523 },
{ name: 'KPPBC TMP B TELUK BAYUR',lat: 2.029033498991798, lon: 117.42189717456102 },
{ name: 'KPPBC TMP B YOGYAKARTA',lat: -7.848735986213808, lon: 110.39258018041764 } ,
{ name: 'KPPBC TMP C BANDA ACEH',lat: 5.5183090957765515, lon: 95.3270861706122 },
{ name: 'KPPBC TMP C BENGKULU',lat: -3.9264282141376934, lon: 102.37775414202754 },
{ name: 'KPPBC TMP C BLITAR',lat: -8.031416376566947, lon: 112.2641224433312 } ,
{ name: 'KPPBC TMP C BOJONEGORO',lat: -7.113268030120771, lon: 111.9289368492554 },
{ name: 'KPPBC TMP C ENTIKONG',lat: 0.7541272023526098, lon: 110.54398397626558 }, 
{ name: 'KPPBC TMP C GORONTALO',lat: 0.7569437884680198, lon: 123.3994451863527 }, 
{ name: 'KPPBC TMP C JAGOI BABANG',lat: 1.5455931755138064, lon: 109.95007177750361 }, 
{ name: 'KPPBC TMP C KENDARI',lat: -4.0736375112883145, lon: 122.68197678548395 }, 
{ name: 'KPPBC TMP C KETAPANG',lat: -1.706660362355975, lon: 110.14102227166832 }, 
{ name: 'KPPBC TMP C KUALA LANGSA',lat: 4.698659075674042, lon: 97.71660372120323 }, 
{ name: 'KPPBC TMP C LHOKSEUMAWE',lat: 5.128704895032091, lon: 96.6439112392781 }, 
{ name: 'KPPBC TMP C LUWUK',lat: -0.7512584510626059, lon: 123.02456443677943 }, 
{ name: 'KPPBC TMP C MADIUN',lat: -7.353275215587038, lon: 113.0909265969624 }, 
{ name: 'KPPBC TMP C MADURA',lat: -6.865216574871167, lon: 115.04255297114551 } ,
{ name: 'KPPBC TMP C MANADO',lat: 1.0984425995425346, lon: 124.46478974306677 },
{ name: 'KPPBC TMP C MAUMERE',lat: -8.654015435635948, lon: 122.31166049156663 },
{ name: 'KPPBC TMP C MEULABOH',lat: 5.486541809140657, lon: 95.42332616539548 },
{ name: 'KPPBC TMP C NANGA BADAU',lat: 0.7584500659913551, lon: 110.82358532703543 },
{ name: 'KPPBC TMP C PANGKAL PINANG',lat: -2.06512031681845, lon: 106.14460936257224 },
{ name: 'KPPBC TMP C PANTOLOAN',lat: -0.6354403480125962, lon: 119.85542834397077 },
{ name: 'KPPBC TMP C PAREPARE',lat: -4.043095283658761, lon: 119.6612403841649 },
{ name: 'KPPBC TMP C PEMATANGSIANTAR',lat: 2.7459092476893954, lon: 99.0509143205784 },
{ name: 'KPPBC TMP C SABANG',lat: 5.838932076742512, lon: 95.34249183724492 },
{ name: 'KPPBC TMP C SAMPIT',lat: -2.4234626059677904, lon: 113.01532685051826 },
{ name: 'KPPBC TMP C SANGATTA',lat: 0.6777984488160796, lon: 117.46593938973542 },
{ name: 'KPPBC TMP C SIBOLGA',lat: 2.0797132312531184, lon: 98.49725427087647 },
{ name: 'KPPBC TMP C SINTETE',lat: 0.652357983174179, lon: 109.21294670811794 },
{ name: 'KPPBC TMP C TEGAL',lat: -7.0340184788146765, lon: 110.69562113339664 },
{ name: 'KPPBC TMP C TEMBILAHAN',lat: 0.915256540078079, lon: 102.0635355589522 },
{ name: 'KPPBC TMP MERAK',lat: -5.937111320666495, lon: 106.01723583707744 },
                ]

            }
        ]
    });

    var areaChartData = {
        labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli','Agustus','September','Oktober','November','Desember'],
        datasets: [{
                label: 'Jumlah Pemohon Uji',
                fillColor: 'rgba(210, 214, 222, 1)',
                strokeColor: 'rgba(210, 214, 222, 1)',
                pointColor: 'rgba(210, 214, 222, 1)',
                pointStrokeColor: '#c1c7d1',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(220,220,220,1)',
                data: [65, 59, 80, 81, 56, 55, 40]
            },
            {
                label: 'Jumlah Uji Selesai',
                fillColor: 'rgba(60,141,188,0.9)',
                strokeColor: 'rgba(60,141,188,0.8)',
                pointColor: '#3b8bba',
                pointStrokeColor: 'rgba(60,141,188,1)',
                pointHighlightFill: '#fff',
                pointHighlightStroke: 'rgba(60,141,188,1)',
                data: [28, 48, 40, 19, 86, 27, 90]
            }
        ]
    }
    var ctx = document.getElementById('pieChart');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: ["Asli", "Palsu", "Salah Personalisasi", "Salah peruntukan"],
          datasets: [
            {
              label: "Executive Summary Hasil Pengujian",
              backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#c45850"],
              data: [2478,5267,734,784]
            }
          ]
        },
        options: {
          
        }
    });
 
    //-------------
    //- BAR CHART -
    //------------- 
    new Chart(document.getElementById("barChart"), {
        type: 'bar',
        data: {
          labels: ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"],
          datasets: [
            {
              label: "Permohonan Pengujian",
              backgroundColor: "#3e95cd",
              data: [133,221,783,2478]
            }, {
              label: "Pengujian Selesai",
              backgroundColor: "#3cba9f",
              data: [408,547,675,734]
            }
          ]
        },
        options: {
          
        }
    });
})