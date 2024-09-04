@extends('master2')

@section('content')

<style>
    .swal2-modal {
        width: 850px !important;
    }

    .title-promo {
        text-align: left;
        margin-bottom: 10px;
        margin-top: 5px;
        color: #ffb800;
        font-size: 25px;
        letter-spacing: -1px;
    }

    .desc-promo {
        color: #ffffff;
        font-size: 25px;
        text-align: justify;
        margin-bottom: 0px;
    }

    .jul-one {
        font-size: 36px;
        font-weight: 800;
    }

    .spacer {
        margin-bottom: 90px;
    }

    .spacer-p0 {
        margin-bottom: 20px;
    }
    .spacer-p1 {
        margin-bottom: 35px;
    }

    .ig {
        width: 279px;
        height: 37px;
    }

    .form-title {
        text-align: left;
        font-size: 18.8px;
        max-width: 100%;
        word-wrap: break-word;
        letter-spacing: 1px;
    }

    .member-benefit {
        display: flex;
        justify-content: space-between;
        color: #ffffff;
        font-size: 17px;
        font-weight: 700;
    }

    @media only screen and (max-device-width: 640px) {
        .title-promo {
            font-size: 16px;
        }

        .desc-promo {
            font-weight: 700;
            font-size: 14px;

        }

        .jul-one {
            font-size: 18px;
        }

        .spacer {
            margin-bottom: 50px;
        }

        .ig {
            width: 200px;
            height: 25px;
        }

        .spacer-p0 {
            margin-bottom: 0;
        }
        .spacer-p1 {
            margin-bottom: 20px;
        }

        .form-title {
            text-align: left;
            font-weight: 700;
            font-size: 13px;
            word-wrap: break-word;
            letter-spacing: 1px;
        }

        .member-benefit {
            display: flex;
            justify-content: space-between;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
        }
    }
</style>

<div class="main">

    <section class="signup">
        <div class="container-sm">
            <div class="row">
                <div class="col-sm-7">
                    <img src="assets/img/logogra.png" alt="" class="img-logo" style="margin-bottom: 20px; width: 653px; height: 69px; object-fit: contain; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.5));">
                    <br>
                    <div class="spacer-p0"></div>
                    <p class="jul-one" style="line-height: 1.2;">
                        <span style="color: #FECC09;font: Poppins; font-weight:bold">
                            Start Your Fitness Journey with <br>
                            Fitnessworks! Join Now with Special <br>
                            Presale Prices Starting at 158k/month <br>
                        </span>
                    </p>
                    <br>
                    <div class="spacer-p0"></div>
                    <p class="desc-promo" style="font-style: Poppins; font-weight: 700;">
                        FITNESSWORKS adalah GYM pertama yang menerapkan Time Based Membership dari Urban Athletes Management, yang keuntungannya anda yang hanya ngegym 1x seminggu tidak perlu membayar seperti yang ngegym 5x seminggu. Hanya selama
                        <class="form-title" style="text-align: left; font-weight: 700;color: #FECC09; font-style: poppins;">
                            Periode Presale Gabung Member mulai Rp 158.000 All Access Fitnessworks & Unlimited.
                    </p>
                    <div class="spacer-p1"></div>
                    <p>
                    <div>
                        <p class="form-title" style="text-align: left; font-weight: 700; color: #FECC09; font-family: Poppins;">
                            Member Benefit
                        </p>
                        <div class="member-benefit">
                            <ul style="list-style-type: disc;">
                                <li>Akses Lebih Dari 40+ Kelas</li>
                                <li>Gratis fasilitas area Gym premium</li>
                            </ul>
                            <ul style="list-style-type: disc;">
                                <li>Gratis konsultasi dengan Personal Trainer</li>
                                <li>Gratis cek komposisi tubuh (In Body)</li>
                            </ul>
                        </div>
                    </div>
                    </p>
                    <div class="spacer"></div>
                    <div class="ig" style="position: relative;">
                        <a href="https://www.instagram.com/fitnessworks.id/?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw%3D%3D">
                            <img src="assets/img/icon-IG-LP.png" alt="" style="position: absolute; bottom: 0; right: 0; width: 100%; height: 100%; margin-bottom: 20px; object-fit: contain;">
                    </div>
                    </a>
                </div>
                <div class="col-sm-5">
                    <div class="signup-content">

                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                            Session::forget('success');
                            @endphp
                        </div>
                        @endif

                        @if(Session::has('error'))
                        <div class="alert alert-danger">
                            {{ Session::get('error') }}
                            @php
                            Session::forget('error');
                            @endphp
                        </div>
                        @endif

                        <!-- Way 1: Display All Error Messages -->
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <form method="POST" id="signup-form" class="signup-form">
                            {{ csrf_field() }}
                            <h2 class="form-title">Hanya untuk 100orang pertama‼️ <br> Dapatkan harga spesial 158k/Bulan <br> Untuk gabung member Di Fitnessworks <br> (Berlaku 7-13 Sept 2024)
                            </h2>
                            <div class="form-group">
                                <label for="full_name" class="normal" style="font-weight: 600;margin-left: 5px;">Nama
                                    Lengkap<span style="color:red;"> *</span></label>
                                <input type="text" class="form-input" name="name" id="name" placeholder="" required />
                                @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email" class="normal" style="font-weight: 600;margin-left: 5px;">Email<span style="color:red;"> *</span></label>
                                <input type="email" class="form-input" name="email" id="email" placeholder="" required />
                                @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone" class="normal" style="font-weight: 600;margin-left: 5px;">No
                                    Handphone<span style="color:red;"> *</span></label>
                                <input type="text" class="form-input number" name="phone" id="phone" placeholder="" required />
                                @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="club_id" class="normal" style="font-weight: 600;margin-left: 5px;">Club yang
                                    dipilih<span style="color:red;"> *</span></label>
                                <!-- <select class="form-select" id="club_id" name="club_id" data-placeholder="Pilih club" <?= ($withClub ? "disabled" : "") ?>>
                                    <?php foreach ($club as $r => $v) { ?>
                                        <option value="{{ $v->id }}" <?= ($v->is_active == 0 ? "disabled" : "") ?>>
                                            {{ $v->name }}
                                            <?= ($v->is_active == 0 ? "<p style='text-align:right;font-color:red;font-size:10px;'>(Coming Soon)</p>" : "") ?>
                                        </option>
                                    <?php } ?>
                                </select> -->
                                <select class="form-select" id="club_id" name="club_id" data-placeholder="Pilih club" <?= ($withClub ? "disabled" : "readonly") ?>>
                                    <?php foreach ($club as $v) {
                                        if ($v->id == 15) { ?>
                                            <option value="<?= $v->id ?>" <?= ($v->is_active == 0 ? "disabled" : "") ?>>
                                                <?= $v->name ?>
                                                <?= ($v->is_active == 0 ? "<span style='color:red; font-size:10px;'> (Coming Soon)</span>" : "") ?>
                                            </option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="time_call" class="normal" style="font-weight: 600;margin-left: 5px;">Pilih
                                    waktu untuk dihubungi<span style="color:red;"> *</span></label>
                                <input style="display:none;" type="text" class="form-input" name="time_call" id="time_call" placeholder="" />
                                <div class="row">
                                    <div class="col" style="text-align: center;">
                                        <button onclick="selectTime(this)" value="pagi" class="btn-time" type="button" style="width:100%;border-radius: 15px;background-color: white;height: 40px;">Pagi</button>
                                    </div>
                                    <div class="col" style="text-align: center;">
                                        <button onclick="selectTime(this)" value="siang" class="btn-time" type="button" style="width:100%;border-radius: 15px;background-color: white;height: 40px;">Siang</button>
                                    </div>
                                    <div class="col" style="text-align: center;">
                                        <button onclick="selectTime(this)" value="malam" class="btn-time" type="button" style="width:100%;border-radius: 15px;background-color: white;height: 40px;">Malam</button>
                                    </div>
                                </div>
                                @if ($errors->has('time_call'))
                                <span class="text-danger">{{ $errors->first('time_call') }}</span>
                                @endif
                            </div>
                            <br>
                            <div class="form-group">
                                <!-- <input type="button" name="benefit" id="benefit" class="button-benefit" value="Member Benefit" /> -->
                                <input type="submit" name="submit" id="real-submit" class="form-submit" value="Daftar Pre-sale" />
                                <!-- <input type="submit" name="submit" id="real-submit" class="form-submit" style="display:none;" /> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>

<script>
    $(".button-benefit").click(function() {
        Swal.fire({
            html: '<p style="color:#ffffff" class="header-rule-1">Member Benefit Fitnessworks :</p>' +
                '<div class="row d-flex justify-content-center">' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-1.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis akses puluhan jenis exersice</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-2.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis fasilitas area Gym premium</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-3.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis akses fasilitas studio eksklusif</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-4.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis cek komposisi tubuh (In Body)</p></div>' +
                ' <div class="col-lg-2 col-md-6"><img src="assets/img/benefit-new-5.png" class="img-fluid" loading="lazy"><p class="benefit-font" style="color:#ffffff!important">Gratis fasilitas konsultasi dengan Personal Trainer</p></div>' +
                '</div>',
            customClass: 'swal-wide',
            showCloseButton: true,
            showConfirmButton: false,
            background: '#190f41',
        })
    });

    $(".term-service").click(function() {
        Swal.fire({
            // html: '<p style="color:#ffffff" class="header-rule-1">Syarat & Ketentuan Promo 99K :</p>' +
            //     '<table style="color:#ffffff" class="table-responsive table-rule"><tbody> ' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">1</td><td>Membership 99k berlaku <b style="color:#ffb800!important;">Single Club</b> dan mendapatkan fasilitas gym selama <b style="color:#ffb800!important;">14 hari</b> berturut-turut.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">2</td><td>Membership ini tidak mengikat setelah 14 hari usai.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">3</td><td>Hanya berlaku untuk <b style="color:#ffb800!important;">1x transaksi</b>, tidak dapat di ulang dan <b style="color:#ffb800!important;">tidak dapat pindah club</b>.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">4</td><td>Calon member berusia minimum 18 tahun.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">5</td><td>Membership hanya diberikan kepada <b style="color:#ffb800!important;">New Join Member</b> atau belum pernah join membership maupun trial di salah satu cabang dalam kurun waktu 6 bulan terakhir.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">6</td><td>Fasilitas yang didapat oleh member <b style="color:#ffb800!important;">sama seperti regular membership</b> yaitu :</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;"></td><td>a. Free In-Body Check &nbsp;&nbsp;&nbsp; b. Free 1x PT Session &nbsp;&nbsp;&nbsp; c. Free Access All Classes & Exercises</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;"></td><td>d. Latihan mandiri</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">7</td><td>Membership ini Non-Refundable atau tidak dapat diuangkan</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">8</td><td>Membership akan aktif setelah diaktifkan oleh member melalui Aplikasi</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">9</td><td>Membership dapat langsung diaktifkan setelah pembayaran selesai</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">10</td><td>Start Date dapat ditunda penggunaannya maksimal 7 hari setelah tanggal pembayaran.<br>(setelah lewat hari ke-7 setelah pembayaran, membership akan aktif secara otomatis dan berjalan hingga 14 hari kedepan)</td></tr>' +
            //     '</tbody></table>',
            html: '<p style="color:#000000;font-weight:bold;">Paket Membership</p>' +
                '<table style="color:#000000;width:100%;font-size:14px;"><tbody> ' +
                '<tr><td style="vertical-align: top;">Special Periode Presale</td><td>IDR. 225,500</td></tr>' +
                '<tr><td style="vertical-align: top;">Total</td><td>IDR. 225,500</td></tr>' +
                '</tbody></table>' +
                '<div style="text-align:left;margin-top:10px;"><input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
                '<label for="agree-term" class="label-agree-term" style="color:black;"><span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti semua update, promo, dan informasi Fitnessworks</label>' +
                '<hr>',
            showCloseButton: true,
            showConfirmButton: false,
            background: '#190f41',
        })
    });



    $('#submit').on('click', function(e) {
        e.preventDefault();
        var form = $(this).parents('form');
        Swal.fire({
            // html: '<p style="color:#ffffff" class="header-rule-1">Syarat & Ketentuan Promo 99K :</p>' +
            //     '<table style="color:#ffffff" class="table-responsive table-rule"><tbody> ' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">1</td><td>Membership 99k berlaku <b style="color:#ffb800!important;">Single Club</b> dan mendapatkan fasilitas gym selama <b style="color:#ffb800!important;">14 hari</b> berturut-turut.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">2</td><td>Membership ini tidak mengikat setelah 14 hari usai.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">3</td><td>Hanya berlaku untuk <b style="color:#ffb800!important;">1x transaksi</b>, tidak dapat di ulang dan <b style="color:#ffb800!important;">tidak dapat pindah club</b>.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">4</td><td>Calon member berusia minimum 18 tahun.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">5</td><td>Membership hanya diberikan kepada <b style="color:#ffb800!important;">New Join Member</b> atau belum pernah join membership maupun trial di salah satu cabang dalam kurun waktu 6 bulan terakhir.</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">6</td><td>Fasilitas yang didapat oleh member <b style="color:#ffb800!important;">sama seperti regular membership</b> yaitu :</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;"></td><td>a. Free In-Body Check &nbsp;&nbsp;&nbsp; b. Free 1x PT Session &nbsp;&nbsp;&nbsp; c. Free Access All Classes & Exercises</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;"></td><td>d. Latihan mandiri</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">7</td><td>Membership ini Non-Refundable atau tidak dapat diuangkan</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">8</td><td>Membership akan aktif setelah diaktifkan oleh member melalui Aplikasi</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">9</td><td>Membership dapat langsung diaktifkan setelah pembayaran selesai</td></tr>' +
            //     '<tr><td style="vertical-align: top;min-width:25px;">10</td><td>Start Date dapat ditunda penggunaannya maksimal 7 hari setelah tanggal pembayaran.<br>(setelah lewat hari ke-7 setelah pembayaran, membership akan aktif secara otomatis dan berjalan hingga 14 hari kedepan)</td></tr>' +
            //     '</tbody></table>' +
            //     '<div style="text-align:left;"><input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
            //     '<label for="agree-term" class="label-agree-term" style="color:white;"><span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti semua update, promo, dan informasi Fitnessworks <a href="#" class="term-service" style="color:#ffb800!important;">Syarat Ketentuan</a> Berlaku</label>' +
            //     '<hr>',
            // html: '<p style="color:#000000;font-weight:bold;">Paket Membership</p>' +
            //     '<table style="color:#000000;width:100%;font-size:14px;"><tbody> ' +
            //     '<tr><td style="vertical-align: top;">Special Periode Presale</td><td>IDR. 225,500</td></tr>' +
            //     '<tr><td style="vertical-align: top;">Total</td><td>IDR. 225,500</td></tr>' +
            //     '</tbody></table>' +
            //     '<div style="text-align:left;margin-top:10px;"><input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
            //     '<label for="agree-term" class="label-agree-term" style="color:black;"><span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti <br> semua update, promo, dan informasi Fitnessworks</label>' +
            //     '<hr>',
            html: '<div style="width:100%; padding:30px; box-sizing:border-box;">' +
                '<div style="display:flex; align-items:center; justify-content:space-between; margin-bottom: 20px;">' +
                '<img src="../assets/img/checkout-samator.png" alt="" style="width:100px; width:339px; height:66px; margin-right: 10px;">' +
                '<div style="color :#000000;font-size:24px; font-weight:bold; margin-left:10px;"><br>CHECKOUT SEKARANG !!!</div>' +
                '</div>' +
                '<table style="color:#000000; width:100%; font-size:14px; border-collapse:collapse; margin-top: 20px;"><tbody>' +
                '<tr style="border-bottom:1px solid #000;"><td style="vertical-align:top;color:#000000;">Paket Membership</td><td style="text-align:right;">Price</td></tr>' +
                '<tr style="border-bottom:1px solid #000;"><td style="vertical-align:top;color:#000000;">Special Periode Presale</td><td style="text-align:right;">IDR. 225,500</td></tr>' +
                '<td style="vertical-align:top;">Total</td><td style="text-align:right;">IDR. 225,500</td></tr>' +
                '</tbody></table>' +
                '<div style="text-align:left; margin-top:10px;">' +
                '<input type="checkbox" name="checkbox" id="agree-term" class="agree-term" />' +
                '<label for="agree-term" class="label-agree-term" style="color:black;">' +
                '<span><span></span></span>Dengan mencentang kotak di sebelah kiri saya menyetujui menerima dan mengikuti <br>' +
                'semua update, promo, dan informasi Fitnessworks' +
                '</label>' +
                '</div>' +
                '<hr>' +
                '</div>',
            background: '#ffff',
            showCloseButton: true,
            showConfirmButton: true,
            confirmButtonColor: '#261F53;',
            confirmButtonText: 'Pembayaran',
        }).then((result) => {
            if ($('#agree-term').is(':checked')) {
                if (result.isConfirmed) {
                    $("#club_id").prop("disabled", false);
                    $('#real-submit').trigger('click');
                }
            } else {
                Swal.fire('Syarat & Ketentuan harus di setujui', '', 'error')
            }
        });
    });

    function selectTime(elem) {
        var value = elem.getAttribute('value');
        $('.btn-time').removeClass("btn-active");
        if ($(elem).hasClass("btn-active")) {
            $(elem).removeClass("btn-active");
        } else {
            $(elem).addClass("btn-active");
            $('#time_call').val(value);
        }
    }

    // $(':input[type="submit"]').prop('disabled', true);

    // $(".agree-term").change(function() {
    //     if ($('#agree-term').is(':checked')) {
    //         $(':input[type="submit"]').prop('disabled', false);
    //     } else {
    //         $(':input[type="submit"]').prop('disabled', true);
    //     }
    // });

    (function($) {
        $.fn.inputFilter = function(inputFilter) {
            return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        };
    }(jQuery));
    $(document).ready(function() {
        $(".number").inputFilter(function(value) {
            return /^\d*$/.test(value); // Allow digits only, using a RegExp
        });
    });
</script>
@endsection