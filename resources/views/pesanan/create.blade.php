@extends('layouts.app')
{{-- @section('dashboard')
Catat Jumlah Pesanan Pecahan
<small>{!! auth()->user()->name !!}</small>
@endsection --}}
@section('title')
<a class="h1 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Buat Pesanan</a>
@endsection
@section('header')

@endsection


@section('content')
<div class="container-fluid mt--7">
    @include('pesanan.f_pesanan')

</div>


</div>


@endsection

@section('scripts')
<script>
    $(document).ready(function () {

        $('[data-mask]').inputmask()
        $('#seri_terakhir').inputmask()
        $('#seri_terakhir2').inputmask()
        $('#nomor_terakhir').inputmask()
         
        function changeGambar(value) {
            switch (value) {
                case 'S':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahans.jpg')}}")
                    break;
                case 'T':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahant.jpg')}}")
                    break;
                case 'U':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahanu.jpg')}}")
                    break;
                case 'V':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahanv.jpg')}}")
                    break;
                case 'W':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahanw.jpg')}}")
                    break;
                case 'X':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahanx.jpg')}}")
                    break;
                case 'Y':
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahany.jpg')}}")
                    break;
                default:
                    $('#pecahangambar').attr('src', "{{URL::asset('argon/assets/img/theme/pecahanbaru.jpg')}}")

            }
        }

        // $('#edit').click(function (event) {

        //     event.preventDefault();
        //     console.log('tes')

        //     if ($("#seri_terakhir2").prop('readonly') == true) {

        //         $("#seri_terakhir2").attr('readonly', false)
        //         $('#seri_terakhir ').attr('readonly', false)
        //         $('#nomor_terakhir ').attr('readonly', false)
        //         $('#order_terakhir ').attr('readonly', false)
        //     } else {

        //         $("#seri_terakhir2").prop('readonly', true)
        //         $('#seri_terakhir').prop('readonly', true)
        //         $('#nomor_terakhir').prop('readonly', true)
        //         $('#order_terakhir').prop('readonly', true)
        //     }
            
        // })
        // $('#insit_persen').change(function () {
        //     if ($('#jumlah_pesanan') != "") {
        //         console.log($('#insit_persen').val())
        //         console.log($('#jumlah_pesanan').val())
        //         hitungOrder(parseFloat($('#insit_persen').val()), parseFloat($('#jumlah_pesanan').val()), $('#pecahan').text());
        //     }
        // });
        $('#refresh').click(function (event) {
            event.preventDefault();

            if ($('#jumlah_pesanan') != "") {
                console.log($('#insit_persen').val())
                console.log($('#jumlah_pesanan').val())
                hitungOrder(parseFloat($('#insit_persen').val()), parseFloat($('#jumlah_pesanan')
                .val()), $('#pecahan').text());
            }
            var paramData = {
                'pecahan': $('#pecahan').val(),

            }
            $.ajax({
                url: "{{ route('pesanan.datapesanan') }}",
                method: "POST",
                data: paramData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }, 
                dataType: "json", 
                success: function (data) {
                    console.log(data)
                    if (data.data.length == 0) {
                        toastr.warning('Masukkan No Seri Terakhir',
                            'Belum ada No. Seri Di Sistem', {
                                timeOut: 5000
                            });
                        $('#lastseri ').text('Belum Ada Seri Huruf Terakhir')
                        $('#lastno ').text('Belum Ada Seri Nomor Terakhir')
                        $('#lastorder ').text('Belum Ada Order Terakhir')
                    } else {
                        var noseri=data.data[0].seri
                        var split=noseri.split('||')

                        // $("#seri_terakhir2").val(split[1])
                        $('#lastseri ').text(noseri)
                        $('#lastno ').text(data.data[0].nomor)
                        $('#lastorder ').text(data.data[0].nomor_order)
                    }
                }
            })
        })
        $('#pecahan').change(function () {
            console.log(this.value)
            $('#pecahantext').text(this.value)
            changeGambar(this.value) 
        })
        // 2089600000 
        //22500000
        // 6.50%
        // 135,824,000  
        function hitungOrder(insitpersen, jumlahpesanan, pecahan) {
            var pembagiorder = null;
            var pembagilembar = parseInt(100000);
            if (pecahan == "V" || pecahan == "W" || pecahan == "X" || pecahan == "Y") {
                pembagiorder = parseInt("4500000")
            } else {
                pembagiorder = parseInt("5000000")
            }

            var jmlhInsit = (insitpersen * jumlahpesanan) / 100
            var orderWithOinsit = Math.round(jumlahpesanan / pembagiorder)
            var orderInsit = parseFloat(jmlhInsit / pembagiorder) 
            var orderInsitrounded= Math.round(orderInsit);
            // console.log(tes)
            var lembarinsit = Math.round(orderInsit * pembagilembar)
            // var lembarinsit = orderInsitrounded * pembagilembar
            var totalorder = orderWithOinsit + orderInsit
            var totalpesanan = parseInt($('#jumlah_pesanan').val()) + jmlhInsit 
            
            $('#total_order').text(Math.round(totalorder))
            $('#jumlah_insit').text(jmlhInsit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
            $('#order_tnpinsit').text(parseInt(orderWithOinsit));
            // $('#order_tnpinsit').val(Math.round(orderWithOinsit * 10) / 10);
            $('#order_insit').text(parseInt(orderInsitrounded))

            $('#lembar_insit').text(lembarinsit.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
            $('#total_pesanan').text(totalpesanan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","))
            $('#total_pesanan1').val(parseInt(totalpesanan))
            $('#total_order1').val(parseInt(totalorder))
            $('#order_insit1').val(parseInt(orderInsit))
            $('#order_tnpinsit1').val(parseInt(orderWithOinsit))
            $('#jumlah_insit1').val(parseFloat(jmlhInsit))
            $('#lembar_insit1').val(parseInt(lembarinsit))
        }

        $('#create_pesanan').on('submit', function (event) {
            event.preventDefault();
            var form = new FormData(this)
            form.append('total_order', $('#total_order').text()) 
            $.ajax({
                url: "{{ route('pesanan.store') }}",
                method: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#simpan').val('menyimpan...');
                },
                success: function (data) {
                    var html = '';
                    console.log(data)
                    if (data.errors) {
                        toastr.error(data.errors, 'Gagal Disimpan', {
                            timeOut: 5000
                        });
                    }
                    if (data.success) {
                        toastr.success(data.success, 'Berhasil Di Simpan', {
                            timeOut: 5000
                        });
                        // setTimeout(window.location.reload(), 3000)
                        $('#create_pesanan')[0].reset();
                        $('#tahun').val('').change()
                        $('#tahun_emisi').val('').change()
                        $('#pecahan').val('').change()
                        $('#action_button').val('Simpan');
                        // $('#form_result').html('');
                    }

                }
            })
        })
    })

</script>
@endsection
