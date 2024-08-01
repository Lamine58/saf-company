<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simulation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- favicons Icons -->
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset("assets/images/logo-saf-short.png")}}">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">

    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,wght@0,400;0,500;0,700;1,400;1,500;1,700&amp;display=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/bootstrap/css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/animate/animate.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/animate/custom-animate.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/fontawesome/css/all.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/jarallax/jarallax.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/nouislider/nouislider.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/nouislider/nouislider.pips.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/odometer/odometer.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/swiper/swiper.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/insur-icons/style.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/insur-two-icon/style.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/tiny-slider/tiny-slider.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/reey-font/stylesheet.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/owl-carousel/owl.carousel.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/owl-carousel/owl.theme.default.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/bxslider/jquery.bxslider.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/bootstrap-select/css/bootstrap-select.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/vegas/vegas.min.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/jquery-ui/jquery-ui.css")}}">
    <link rel="stylesheet" href="{{asset("simulator/assets/vendors/timepicker/timePicker.css")}}">

    <!-- template styles -->
    <link rel="stylesheet" href="{{asset("simulator/assets/css/insur.css")}}">
</head>

<style>
    .main-menu__wrapper-inner {
        display: block;
        padding: 0px 0;
    }
    table{
        margin: auto;
    }
    .contact-page {
        position: relative;
        display: block;
        padding: 0px 0 20px;
    }
    .custom-cursor__cursor {
        display: none;
        height: 0px;
        width: 0px;
    }
    td,tr{
		border:1px solid #6a6a6a !important;
	}
</style>

<body class="custom-cursor">

    <div class="custom-cursor__cursor hidden"></div>
    <div class="custom-cursor__cursor-two hidden"></div>

    <div class="page-wrapper ">
        <header class="main-header clearfix print_this">
            <div class="main-header__top">
                <div class="container">
                    <div class="main-header__top-inner">
                        <div class="main-header__top-address">
                            <ul class="list-unstyled main-header__top-address-list">
                                <li>
                                    <i class="icon">
                                        <span class="icon-pin"></span>
                                    </i>
                                    <div class="text">
                                        <p>Côte d'Ivoire, Abidjan Cocody</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="icon">
                                        <span class="icon-email"></span>
                                    </i>
                                    <div class="text">
                                        <p><a href="mailto:needhelp@company.com">info@saf-company.ci</a></p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="main-header__top-right">
                            <div class="main-header__top-social-box">
                                <div class="main-header__top-social">
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                    <a href="#"><i class="fab fa-facebook"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="main-menu clearfix print_this">
                <div class="main-menu__wrapper clearfix">
                    <div class="container">
                        <div class="main-menu__wrapper-inner clearfix">
                            <div class="main-menu__left">
                                <div class="main-menu__logo" style="padding:0px">
                                    <a href=""><img src="{{asset("assets/images/logo-saf-short.png")}}" height="70" alt=""></a>
                                </div>
                            </div>
                            <div class="main-menu__right">
                                <div class="main-menu__call" style="padding-top: 10px;">
                                    <div class="main-menu__call-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="main-menu__call-content">
                                        <a href="tel:9200368090">(+225) 0102030405</a>
                                        <p>Centre d'appel</p>
                                    </div>
                                </div>
                            </div>
                            <div class="main-menu__right logo-insurance" style="float: right;"></div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="stricky-header stricked-menu main-menu">
            <div class="sticky-header__content"></div><!-- /.sticky-header__content -->
        </div><!-- /.stricky-header -->

        <style>
            .comment-form__input-box input[type=text], .comment-form__input-box input[type=email] {
                height: 50px;
                padding-left: 8px;
            }
            .hidden{
                display: none;
            }
            .page-header__inner h2 {
                font-size: 40px;
                color: #ffffff !important;
                font-weight: 700;
                line-height: 52px;
                letter-spacing: -0.04em;
            }
            .thm-breadcrumb li a {
                position: relative;
                display: inline-block;
                color: #ffffff !important;
                font-size: 14px;
                font-weight: 400;
                -webkit-transition: all 500ms ease;
                transition: all 500ms ease;
            }

            .thm-breadcrumb li {
                color: #ffffff !important;
            }
            .page-header {
                position: relative;
                display: block;
                padding: 45px;
                background-color: #1d73b8 !important;
                z-index: 1;
            }
            .comment-form__input-box select {
                width: 100%;
                border: none;
                height: 50px;
                background-color: var(--insur-extra);
                padding-left: 8px;
                padding-right: 8px;
                outline: none;
                font-size: 14px;
                color: var(--insur-gray);
                display: block;
                border-radius: var(--insur-bdr-radius);
                font-weight: 500;
                letter-spacing: var(--insur-letter-spacing);
            }
            .visibilty{
                display: none;
            }
            .comment-form__input-box .div {
                padding: 7px;
                min-height: 50px;
                border-bottom: 1px solid #cdcdcd;
                background-color: var(--insur-extra);
                outline: none;
                font-size: 14px;
                color: var(--insur-gray);
                border-radius: 0px;
                font-weight: 500;
                letter-spacing: var(--insur-letter-spacing);
                margin: 0px;
                margin-bottom: 0px;
            }

            .comment-form__input-box .input {
                padding: 7px;
                min-height: 50px;
                border: none;
                background-color: var(--insur-extra);
                outline: none;
                font-size: 14px;
                color: var(--insur-gray);
                border-radius: var(--insur-bdr-radius);
                font-weight: 500;
                letter-spacing: var(--insur-letter-spacing);
                margin: 0px;
                margin-bottom: 15px;
            }
            input[type="radio"],input[type="checkbox"] {
                margin-top:5px;
                width:20px;
                height:20px;
            }
            @media print {
                body * {
                    visibility:hidden;
					color:black !important;
                }
                body {
                    visibility:hidden;
                }
                body * {
                    visibility:hidden;
                }
                .remove{
                    display:none;
                }
                body *:has(.print_this), body .print_this, body .print_this * {
                    /* display:block; */
                    visibility:visible;
                }
                body .print_this {
                    visibility:visible;
                }
                .data-insurance,.data-customer,#text-insurance{
                    display: block;
                }
                @page {
                    size: 1024px auto;
                    margin: 0;
                }
            }
            .name{
                padding: 7px;
            }
            table{
                width: 100%;
            }
            .comment-form__input-box .select_important {
                width: 100%;
                background-color: var(--insur-extra);
                padding-left: 8px;
                padding-right: 8px;
                outline: none;
                font-size: 14px;
                color: var(--insur-gray);
                display: block;
                border-radius: var(--insur-bdr-radius);
                font-weight: 500;
                letter-spacing: var(--insur-letter-spacing);
                /* border: 1px solid; */
                padding: 5px;
                border-radius: 3px;
            }
            input[type="date"]:before{
                rgb(125 121 121);
                content:attr(placeholder);
            }

            input[type="date"].full:before {
                color:black;
                content:""!important;
            }
            .thm-btn{
                margin-top: 5px;
            }
            .main-menu__call-icon {
                position: relative;
                height: 50px;
                width: 50px;
                border: 2px solid var(--insur-bdr-color);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #189cd8;
                font-size: 20px;
                -webkit-transition: all 500ms ease;
                transition: all 500ms ease;
            }
            .title{
                padding: 14px;
                background: #1d73b8;
                color: white;
                font-size: 17px;
                font-weight: bold;
                text-align: center;
            }
            .sub-title {
                padding: 7px;
                background: #189cd8;
                color: white;
                font-size: 13px;
                font-weight: bold;
                text-align: start;
                margin-bottom: 10px;
            }
        </style>

        <!--Page Header Start-->
        <section class="page-header remove">
            <div class="container">
                <div class="page-header__inner">
                    <ul class="thm-breadcrumb list-unstyled">
                        <li><a href="">SAF COMPANY</a></li>
                        <li><span>/</span></li>
                        <li>SIMULATEUR</li>
                    </ul>
                    <h2>SIMULATEUR</h2>
                </div>
            </div>
        </section>
        <!--Page Header End-->

        <!--Contact Page Start-->
        <section class="contact-page">

            <div class="container">
                <div style="color:black !important">
                    <p class="hidden print_this data-customer">
                        Nom et prénom : <span class="full_name"></span><br>
                        <!--<span class="age" style="color:white"></span>
                        <span class="age_conjoint" style="color:white"></span><br>-->
                        Contact : <span class="phone"></span><br>
                        Formule : <span class="formule_name"></span>
                    </p>
                    <br>
                </div>
            </div>
            {{-- <div class="data-insurance hidden print_this"></div> --}}
            <div class="container">
                <p class="remove">Veuillez fournir vos informations afin d'obtenir une estimation approximative de votre prime d'assurance annuelle.<br><br></p>
                <div class="row">
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                           <input type="text" class="form-control" id="full_name" placeholder="Nom et prénom">
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                           <input type="tel" class="form-control input" id="phone" placeholder="Contact">
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                            <select name="insurance_id" class="form-control" id="insurance_id">
                                <option value="">Types d'assurances</option>
                                @foreach($insurances as $insurance)
                                    <option value="{{$insurance->id}}">{{$insurance->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                            <select name="" class="form-control" id="insurance_type">
                                <option value="">Maison d'assurance</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                            <select name="option" class="form-control" id="option">
                                <option value="">Options</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                            <select name="formule" class="form-control" id="formule">
                                <option value="">Formules</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box">
                           <input type="date" placeholder="Date de naissance" style="height: 60px;" class="form-control input age" id="age" oninput="amount()">
                        </div>
                    </div>
                    <div class="col-xl-6 remove">
                        <div class="comment-form__input-box ">
                           <input type="date" placeholder="Date de naissance conjoint(e)" style="height: 60px;" class="form-control input age visibilty" id="age_conjoint" oninput="amount()">
                        </div>
                    </div>
                    <hr>
                    <div class="comment-form__input-box col-xl-12 remove" >
                        <div id="div-ensure"></div>
                        <div id="div-spouse"></div>
                        <div id="div"></div>
                    </div>
                    <div class="comment-form__input-box col-xl-12" >
                        <table class="table table-striped print_this">
                            <tbody id="data">
                            </tbody>
                            <tbody id="age_data">
                            </tbody>
                            <tbody id="age_data_conjoint">
                            </tbody>
                        </table>
                       <div class="row">
                            <div class="col-md-12 print_this hidden total">
                                <h5 style="padding: 12px;background: #1d73b8;color: white !important;font-size: 17px;">TOTAL : <span id="amount">0</span> FCFA</h5>
                            </div>
                            <div class="col-md-12 text-end mt-2 remove">
                                <a class="thm-btn error-page__btn hidden care_network" target="_blank" href="" style="border:none">Réseau de soins <i class="fa fa-heartbeat"></i></a>
                                <a class="thm-btn error-page__btn hidden file_description" target="_blank" href="" style="border:none">Brochure <i class="fa fa-file-pdf"></i></a>
                                <a class="thm-btn error-page__btn hidden newsletter" target="_blank" href="" style="border:none">Télécharger le bulletin d'adhésion <i class="fa fa-download"></i></a>
                                <button onclick="window.print()" class="thm-btn error-page__btn hidden printer" style="border:none">Imprimer la simulation <i class="fa fa-print"></i></button>
                            </div>
                       </div>
                       <br>
                       <div id="text-insurance" class="hidden print_this"></div>
                    </div>
                </div>
            </div>
        </section>
        <!--Contact Page End-->

        <!--CTA One Start-->
        <section class="cta-one cta-three remove">
            <div class="container">
                <div class="cta-one__content">
                    <div class="cta-one__inner">
                        <div class="cta-one__left">
                            <h3 class="cta-one__title">Prêt à obtenir une couverture ?</h3>
                        </div>
                        <div class="cta-one__right">
                            <div class="cta-one__call">
                                <div class="cta-one__call-icon">
                                    <i class="fas fa-phone"></i>
                                </div>
                                <div class="cta-one__call-number">
                                    <a href="tel:9200368090">(+225) 0102030405</a>
                                    <p>Centre d'appel</p>
                                </div>
                            </div>
                        </div>
                        <div class="cta-one__img">
                            <img src="simulator/assets/images/resources/cta-one-img.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section><br>
        <!--CTA One End-->
        <footer class="site-footer">
            <div class="site-footer-bg">
            </div>
            <div class="container">
                <div class="site-footer__bottom">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="site-footer__bottom-inner">
                                <p class="site-footer__bottom-text">©  {{date('Y')}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!--Site Footer End-->


    </div><!-- /.page-wrapper -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


    <script src="{{asset("simulator/assets/vendors/jquery/jquery-3.6.0.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jarallax/jarallax.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-ajaxchimp/jquery.ajaxchimp.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-appear/jquery.appear.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-circle-progress/jquery.circle-progress.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-magnific-popup/jquery.magnific-popup.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-validate/jquery.validate.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/nouislider/nouislider.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/odometer/odometer.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/swiper/swiper.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/tiny-slider/tiny-slider.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/wnumb/wNumb.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/wow/wow.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/isotope/isotope.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/countdown/countdown.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/owl-carousel/owl.carousel.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/bxslider/jquery.bxslider.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/bootstrap-select/js/bootstrap-select.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/vegas/vegas.min.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/jquery-ui/jquery-ui.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/timepicker/timePicker.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/circleType/jquery.circleType.js")}}"></script>
    <script src="{{asset("simulator/assets/vendors/circleType/jquery.lettering.min.js")}}"></script>


    <!-- template js -->
    <script src="{{asset("simulator/assets/js/insur.js")}}"></script>
    <script>

        $('#full_name').on('change',function (){
            $('.full_name').text($(this).val())
        });
        $('#age').on('change',function (){

            $('.age').text('');
            // $('.age').text($(this).val());
            var birthdate = new Date($(this).val());
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var m = today.getMonth() - birthdate.getMonth();
            
            if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }
            if(age>0)
                $('.age').text('Age : '+age+' ans');

        });

        $('#age_conjoint').on('change',function (){

            var birthdate = new Date($(this).val());
            var today = new Date();
            var age = today.getFullYear() - birthdate.getFullYear();
            var m = today.getMonth() - birthdate.getMonth();
            
            if (m < 0 || (m === 0 && today.getDate() < birthdate.getDate())) {
                age--;
            }

            if(age>0)
                $('.age_conjoint').text('Age conjoint(e): '+age+' ans');

        });

        
        $('#phone').on('change',function (){
            $('.phone').text($(this).val())
        });
        

        $('#insurance_id').on('change',function(){

            var insurance_id = $(this).val();

            $.ajax({
                url: '/type-assurance/' + insurance_id + '/insurance-types',
                type: 'GET',
                dataType:"json",
                success: function(response) {

                    var options = '<option value="">Maison d\'assurance</option>';
                    $.each(response.insurance_types, function(index, insurance_type) {
                        options += '<option data-name="' + insurance_type.name + '" value="' + insurance_type.id + '" >' + insurance_type.name + '</option>';
                    });
                    $('#insurance_type').html(options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        });

        $('#insurance_type').on('change',function(){

            var insurance_type_id = $(this).val();

            if($(this).val()=='')
                return false;

            $.ajax({
                url: '/type-assurance/' + insurance_type_id + '/options',
                type: 'GET',
                dataType:"json",
                success: function(response) {

                    var options = '<option value="">Options</option>';
                    $.each(response.options, function(index, option) {
                        options += '<option value="' + option + '" >' + option + '</option>';
                    });

                    $('.total').removeClass('hidden');
                    $('.printer').removeClass('hidden');
					
					
                    // $('#text-insurance').html(response.text);

                    $('#option').html(options);

                    $('.logo-insurance').html('<img height="73" src="'+response.logo+'">');

                    if(response.care_network!=null){
                        $('.care_network').removeClass('hidden');
                        $('.care_network').attr('href',response.care_network);
                    }else{
                        $('.care_network').addClass('hidden');
                    }

                    if(response.file_description!=null){
                        $('.file_description').removeClass('hidden');
                        $('.file_description').attr('href',response.file_description);
                    }else{
                        $('.file_description').addClass('hidden');
                    }

                    if(response.newsletter!=null){
                        $('.newsletter').removeClass('hidden');
                        $('.newsletter').attr('href',response.newsletter);
                    }else{
                        $('.newsletter').addClass('hidden');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });



        $('#option').on('change',function(){

            var option = $(this).val();
            var insurance_type_id = $('#insurance_type').val();

            if($(this).val()=='')
                return false;

            $.ajax({
                url: '/type-assurance/' + option + '/' + insurance_type_id + '/insurance-types-data',
                type: 'GET',
                dataType:"json",
                success: function(response) {

                    var options = '<option value="">Formules</option>';
                    $.each(response.formules, function(index, formule) {
                        options += '<option value="' + formule.formule_name_original + '"  data-data="' + formule.formule_data + '"  data-limit="' + formule.formule_limit + '"  data-name="' + formule.formule_name + '" data-amount="' + formule.formule_amount + '">' + formule.formule_name + '</option>';
                    });
                    $('#formule').html(options);
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });

        function select_affection(self){

            var condition = $(self).find(':selected');

            console.log(condition.data('condition'));
            console.log(condition.data('value'));

            if(condition.data('condition')=='percente_plus')
                name = "+"+formatNumberWithSpaces(condition.data('value'))+"%";
            if(condition.data('condition')=='percente_minus')
                name = "-"+formatNumberWithSpaces(condition.data('value'))+"%";
            if(condition.data('condition')=='amount_plus')
                name = "+"+formatNumberWithSpaces(condition.data('value'))+" FCFA";
            if(condition.data('condition')=='amount_minus')
                name = "-"+formatNumberWithSpaces(condition.data('value'))+" FCFA";

            $(self).parent().parent().find('.name').text(name);

            amount();
        }

        $('#formule').on('change',function(){

            var formule_name = $(this).val();
            var insurance_type_id = $('#insurance_type').val();
            $('#text-insurance').html($(this).find(':selected').data('data'));

            $.ajax({
                url: '/type-assurance/' + formule_name +'/' + insurance_type_id + '/conditions',
                type: 'GET',
                dataType:"json",
                success: function(response) {
                    
                    $('#div').html('');
                    $('#div-ensure').html('');
                    $('#div-spouse').html('');

                    if(response.datas==1){
                        
                        $('#age_conjoint').addClass('visibilty');
                        $('.age_conjoint_').addClass('visibilty');

                        $('#div').append('<div class="container title">ASSURÉ(E) PRINCIPAL</div>');

                        $.each(response.conditions, function(index, condition) {

                            var name = '';
                            var input = '';

                            if(condition.condition_condition=='percente_plus')
                                name = "+"+formatNumberWithSpaces(condition.condition_value)+"%";
                            if(condition.condition_condition=='percente_minus')
                                name = "-"+formatNumberWithSpaces(condition.condition_value)+"%";
                            if(condition.condition_condition=='amount_plus')
                                name = "+"+formatNumberWithSpaces(condition.condition_value)+" FCFA";
                            if(condition.condition_condition=='amount_minus')
                                name = "-"+formatNumberWithSpaces(condition.condition_value)+" FCFA";

                            if(condition.condition_option!='option_age'){

                                if(condition.condition_option=='option_value')
                                    input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="number form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';

                                if(condition.condition_option=='option_unique')
                                    input = '<input type="radio" onchange="amount()" class="radio" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';

                                if(condition.condition_option=='option_mutiple')
                                    input = '<input onchange="amount()" type="checkbox" class="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';


                                $('#div').append('<div class="div row"><div class="col-6">' + condition.condition_name + 
                                '</div><div class="col-3">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                                
                            }

                            if(condition.condition_option=='option_age'){
                                input = '<input type="hidden" min="1" class="time form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';
                                $('#div').append(input);
                            }
                        });

                        var options_affections = '<option value="">Affections</option>';


                        $.each(response.affections, function(index, condition) {
                            options_affections += '<option value="' + condition.condition_name + '"  data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">' + condition.condition_name + '</option>';
                        });

                        for(var i = 0; i<3; i++) {

                            var name = '';
                            var input = '';

                            var select = '<select  style="height: 40px !important;" class="select_affection select_important" onchange="select_affection(this)">'+options_affections+'</select>';

                            input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="select_value form-control" name="select_value">';

                            $('#div').append('<div class="div row"><div class="col-6">' + select + 
                            '</div><div class="col-3 name">' + name + '</div> <div class="col-3">' + input + '</div></div>');

                        };


                        $('#div').append('<div class="container sub-title">TOTAL SURPRIME ASSURÉ(E) PRINCIPAL : <span id="div-amount">0</span></div>');

                    }else if(response.datas==2){

                        $('#age_conjoint').removeClass('visibilty');
                        $('.age_conjoint_').addClass('visibilty');

                        $('#div').append('<div class="container title">AYANTS DROIT</div>');

                        $.each(response.conditions, function(index, condition) {

                            var name = '';
                            var input = '';
                            
                            if(condition.condition_condition=='percente_plus')
                                name = "+"+formatNumberWithSpaces(condition.condition_value)+"%";
                            if(condition.condition_condition=='percente_minus')
                                name = "-"+formatNumberWithSpaces(condition.condition_value)+"%";
                            if(condition.condition_condition=='amount_plus')
                                name = "+"+formatNumberWithSpaces(condition.condition_value)+" FCFA";
                            if(condition.condition_condition=='amount_minus')
                                name = "-"+formatNumberWithSpaces(condition.condition_value)+" FCFA";

                            if(condition.condition_option!='option_age'){

                                if(condition.condition_option=='option_value')
                                    input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="number form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';

                                if(condition.condition_option=='option_unique')
                                    input = '<input type="radio" onchange="amount()" class="radio" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';

                                if(condition.condition_option=='option_mutiple')
                                    input = '<input onchange="amount()" type="checkbox" class="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';


                                $('#div').append('<div class="div row"><div class="col-6">' + condition.condition_name + 
                                '</div><div class="col-3">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                                
                            }

                            if(condition.condition_option=='option_age'){
                                input = '<input type="hidden" min="1" class="time form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';
                                $('#div').append(input);
                            }

                        });

                        var options_affections = '<option value="">Affections</option>';

                        $.each(response.affections, function(index, condition) {

                            options_affections += '<option value="' + condition.condition_name + '"  data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">' + condition.condition_name + '</option>';
                        });

                        for(var i = 0; i<3; i++) {

                            var name = '';
                            var input = '';

                            if(options_affections!=''){

                                var select = '<select  style="height: 40px !important;" class="select_affection select_important" onchange="select_affection(this)">'+options_affections+'</select>';

                                input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="select_value form-control" name="select_value">';

                                $('#div').append('<div class="div row"><div class="col-6">' + select + 
                                '</div><div class="col-3 name">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                            }

                        };

                        $('#div').append('<div class="container sub-title">TOTAL SURPRIME AYANTS DROIT : <span id="div-amount">0</span></div>');

                        $('#div-ensure').append('<div class="container title">ASSURÉ(E) PRINCIPAL</div>');

                        $.each(response.conditions, function(index, condition) {

                            var name = '';
                            var input = '';


                            if(condition.condition_type!='have_right'){
                                
                                if(condition.condition_condition=='percente_plus')
                                    name = "+"+formatNumberWithSpaces(condition.condition_value)+"%";
                                if(condition.condition_condition=='percente_minus')
                                    name = "-"+formatNumberWithSpaces(condition.condition_value)+"%";
                                if(condition.condition_condition=='amount_plus')
                                    name = "+"+formatNumberWithSpaces(condition.condition_value)+" FCFA";
                                if(condition.condition_condition=='amount_minus')
                                    name = "-"+formatNumberWithSpaces(condition.condition_value)+" FCFA";

                                if(condition.condition_option!='option_age'){

                                    if(condition.condition_option=='option_value')
                                        input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="number form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';

                                    if(condition.condition_option=='option_unique')
                                        input = '<input type="radio" onchange="amount()" class="radio" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';

                                    if(condition.condition_option=='option_mutiple')
                                        input = '<input onchange="amount()" type="checkbox" class="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';


                                    $('#div-ensure').append('<div class="div row"><div class="col-6">' + condition.condition_name + 
                                    '</div><div class="col-3">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                                    
                                }
                            }

                        });

                        var options_affections = '<option value="">Affections</option>';

                        console.log(response.affections);

                        $.each(response.affections, function(index, condition) {
                            
                            if(condition.condition_type!='have_right'){
                                options_affections += '<option value="' + condition.condition_name + '"  data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">' + condition.condition_name + '</option>';
                            }
                        });

                        for(var i = 0; i<3; i++) {

                            var name = '';
                            var input = '';

                            if(options_affections!=''){

                                var select = '<select  style="height: 40px !important;" class="select_affection select_important" onchange="select_affection(this)">'+options_affections+'</select>';

                                input = '<input placeholder="Qte" type="hidden" oninput="amount()" min="1" value="1" class="select_value form-control" name="select_value">';

                                $('#div-ensure').append('<div class="div row"><div class="col-6">' + select + 
                                '</div><div class="col-3 name">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                            }

                        };

                        $('#div-ensure').append('<div class="container sub-title">TOTAL SURPRIME ASSURÉ(E) PRINCIPAL : <span id="ensure-amount">0</span></div>');
                        $('#div-spouse').append('<div class="container title">CONJOINT(E)</div>');

                        $.each(response.conditions, function(index, condition) {

                            var name = '';
                            var input = '';

                            if(condition.condition_type!='have_right'){
                                
                                if(condition.condition_condition=='percente_plus')
                                    name = "+"+formatNumberWithSpaces(condition.condition_value)+"%";
                                if(condition.condition_condition=='percente_minus')
                                    name = "-"+formatNumberWithSpaces(condition.condition_value)+"%";
                                if(condition.condition_condition=='amount_plus')
                                    name = "+"+formatNumberWithSpaces(condition.condition_value)+" FCFA";
                                if(condition.condition_condition=='amount_minus')
                                    name = "-"+formatNumberWithSpaces(condition.condition_value)+" FCFA";

                                if(condition.condition_option!='option_age'){

                                    if(condition.condition_option=='option_value')
                                        input = '<input placeholder="Qte" type="number" oninput="amount()" min="1" class="number form-control" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">';

                                    if(condition.condition_option=='option_unique')
                                        input = '<input type="radio" onchange="amount()" class="radio" name="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';

                                    if(condition.condition_option=='option_mutiple')
                                        input = '<input onchange="amount()" type="checkbox" class="check" data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                        + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '" >';


                                    $('#div-spouse').append('<div class="div row"><div class="col-6">' + condition.condition_name + 
                                    '</div><div class="col-3">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                                    
                                }
                            }

                        });

                        var options_affections = '<option value="">Affections</option>';

                        console.log(response.affections);

                        $.each(response.affections, function(index, condition) {
                            if(condition.condition_type!='have_right'){
                                options_affections += '<option value="' + condition.condition_name + '"  data-name="' + condition.condition_name + '" data-condition="' + condition.condition_condition 
                                    + '" data-option="' + condition.condition_option + '" data-value="' + condition.condition_value + '">' + condition.condition_name + '</option>';
                            }
                        });

                        for(var i = 0; i<3; i++) {

                            var name = '';
                            var input = '';

                            if(options_affections!=''){

                                var select = '<select  style="height: 40px !important;" class="select_affection select_important" onchange="select_affection(this)">'+options_affections+'</select>';

                                input = '<input placeholder="Qte" type="hidden" oninput="amount()" min="1" value="1" class="select_value form-control" name="select_value">';

                                $('#div-spouse').append('<div class="div row"><div class="col-6">' + select + 
                                '</div><div class="col-3 name">' + name + '</div> <div class="col-3">' + input + '</div></div>');
                            }

                        };

                        $('#div-spouse').append('<div class="container sub-title">TOTAL SURPRIME CONJOINT(E) : <span id="spouse-amount">0</span></div>');
                    };

                    amount();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });

        function amount(){

            var amount = 0;
            $('#data').html('');
            
            var formule = $('#formule').find(":selected");
            var insurance_type = $('#insurance_type').find(":selected");
            var amount_formule = parseInt(formule.data('amount'));
            var radio = $('.radio:checked');
            var value = radio.data('value');

            $('.data-insurance').html(formule.data('data'));
            
            amount_formule = amount_formule>0 ? amount_formule : 0;
            amount += amount_formule>0 ? amount_formule : 0;

            if(amount_formule>0){
                $('.formule_name').text(insurance_type.text()+" "+formule.data('name'));
                $('#data').append(
                    "<tr><td>"+insurance_type.text()+" "+formule.data('name')+" <br> "+formule.data('limit')+"</td><td>"+formatNumberWithSpaces(amount_formule)+"</td></tr>"
                );
            }

            if(radio.data('condition')=='percente_plus'){    
                amount += amount_formule*(value/100);
                $('#data').append(
                    "<tr><td>"+radio.data('name')+"</td><td> + "+formatNumberWithSpaces(amount_formule*(value/100))+"</td></tr>"
                );
            }
            if(radio.data('condition')=='percente_minus'){
                amount -= amount_formule*(value/100);
                $('#data').append(
                    "<tr><td>"+radio.data('name')+"</td><td> - "+formatNumberWithSpaces(amount_formule*(value/100))+"</td></tr>"
                );
            }
            if(radio.data('condition')=='amount_plus'){
                amount += value;
                $('#data').append(
                    "<tr><td>"+radio.data('name')+"</td><td> + "+formatNumberWithSpaces(value)+"</td></tr>"
                );
            }
            if(radio.data('condition')=='amount_minus'){
                amount -= value;
                $('#data').append(
                    "<tr><td>"+radio.data('name')+"</td><td> - "+formatNumberWithSpaces(value)+"</td></tr>"
                );
            }

            var checks = $('.check:checked');

            $.each(checks, function(index, element) {

                var check = $(element);
                var value = check.data('value');

                if(check.data('condition')=='percente_plus'){    
                    amount += amount_formule*(value/100);
                    $('#data').append(
                        "<tr><td>"+check.data('name')+"</td><td> + "+formatNumberWithSpaces(amount_formule*(value/100))+"</td></tr>"
                    );
                }
                if(check.data('condition')=='percente_minus'){
                    amount -= amount_formule*(value/100);
                    $('#data').append(
                        "<tr><td>"+check.data('name')+"</td><td> - "+formatNumberWithSpaces(amount_formule*(value/100))+"</td></tr>"
                    );
                }
                if(check.data('condition')=='amount_plus'){
                    amount += value;
                    $('#data').append(
                        "<tr><td>"+check.data('name')+"</td><td> + "+formatNumberWithSpaces(value)+"</td></tr>"
                    );
                }
                if(check.data('condition')=='amount_minus'){
                    amount -= value;
                    $('#data').append(
                        "<tr><td>"+check.data('name')+"</td><td> - "+formatNumberWithSpaces(value)+"</td></tr>"
                    );
                }
            });

            var numbers = $('.number');

            $.each(numbers, function(index, element) {

                var number = $(element);

                if(number.val()!=''){

                    var val = parseInt(number.val());
                    var value = number.data('value');

                    if(number.data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);
                        $('#data').append(
                            "<tr><td>"+number.data('name')+" ("+val+")</td><td> + "+formatNumberWithSpaces(amount_formule*((val*value)/100))+"</td></tr>"
                        );
                    }
                    if(number.data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                        $('#data').append(
                            "<tr><td>"+number.data('name')+" ("+val+")</td><td> - "+formatNumberWithSpaces(amount_formule*(val*value/100))+"</td></tr>"
                        );
                    }
                    if(number.data('condition')=='amount_plus'){
                        amount += val*value;
                        $('#data').append(
                            "<tr><td>"+number.data('name')+" ("+val+")</td><td> + "+formatNumberWithSpaces(val*value)+"</td></tr>"
                        );
                    }
                    if(number.data('condition')=='amount_minus'){
                        amount -= val*value;
                        $('#data').append(
                            "<tr><td>"+number.data('name')+" ("+val+")</td><td> - "+formatNumberWithSpaces(val*value)+"</td></tr>"
                        );
                    }
                }

            });

            var age = parseInt($('.age').html());
            age = age>0 ? age : age;

            var age_conjoint = parseInt($('.age_conjoint').html());
            age_conjoint = age_conjoint>0 ? age_conjoint : age_conjoint;

            // var ages = $('.time').get().reverse();
            var ages = $('.time');

            $('#age_data').html('');
            $('#age_data_conjoint').html('');

            $.each(ages, function(index, element) {

                var number = $(element);

                if(number.data('value')!='' && age!=''){

                    var val = 1;
                    var value = number.data('value');
                    var name = number.data('name');

                    if(name<age && age>0 && age<100){

                        if(number.data('condition')=='percente_plus'){    
                            amount += amount_formule*(val*value/100);
                            $('#age_data').html(
                                "<tr><td>Taux de surprime âge supérieur à "+number.data('name')+" ans assuré(e) principal</td><td> + "+formatNumberWithSpaces(amount_formule*((val*value)/100))+"</td></tr>"
                            );
                        }

                        if(number.data('condition')=='percente_minus'){
                            amount -= amount_formule*(val*value/100);
                            $('#age_data').html(
                                "<tr><td>Taux de surprime âge supérieur à "+number.data('name')+" ans assuré(e) principal</td><td> - "+formatNumberWithSpaces(amount_formule*(val*value/100))+"</td></tr>"
                            );
                        }
                        
                    }

                    //conjoint(e)

                    if(name<age_conjoint && age_conjoint>45 && age_conjoint<100){


                        if(number.data('condition')=='percente_plus'){    
                            amount += amount_formule*(val*value/100);
                            $('#age_data_conjoint').html(
                                "<tr><td>Taux de surprime âge supérieur à "+number.data('name')+" ans conjoint(e)</td><td> + "+formatNumberWithSpaces(amount_formule*((val*value)/100))+"</td></tr>"
                            );
                        }

                        if(number.data('condition')=='percente_minus'){
                            amount -= amount_formule*(val*value/100);
                            $('#age_data_conjoint').html(
                                "<tr><td>Taux de surprime âge supérieur à "+number.data('name')+" ans conjoint(e)</td><td> - "+formatNumberWithSpaces(amount_formule*(val*value/100))+"</td></tr>"
                            );
                        }

                    }
                }

            });
            
            var select_affection = $('.select_value');

            $.each(select_affection, function(index, element) {

                var number = $(element);
                var select = $(element).parent().parent().find('.select_affection');

                if(number.val()!=''){

                    var val = number.val();
                    var value = select.find(':selected').data('value');

                    console.log(val);
                    console.log(value);

                    if(select.find(':selected').data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);   
                        $('#data').append(
                            "<tr><td>"+select.find(':selected').data('name')+" ("+val+")</td><td> + "+formatNumberWithSpaces(amount_formule*((val*value)/100))+"</td></tr>"
                        );
                    }

                    if(select.find(':selected').data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                        $('#data').append(
                            "<tr><td>"+select.find(':selected').data('name')+"</td><td> - "+formatNumberWithSpaces(amount_formule*(value/100))+"</td></tr>"
                        );
                    }

                    if(select.find(':selected').data('condition')=='amount_plus'){
                        amount += val*value;
                        $('#data').append(
                            "<tr><td>"+select.find(':selected').data('name')+" ("+val+")</td><td> + "+formatNumberWithSpaces(val*value)+"</td></tr>"
                        );
                    }

                    if(select.find(':selected').data('condition')=='amount_minus'){
                        amount -= val*value;
                        $('#data').append(
                            "<tr><td>"+select.find(':selected').data('name')+" ("+val+")</td><td> - "+formatNumberWithSpaces(val*value)+"</td></tr>"
                        );
                    }
                }

            });
            ensure();
            spouse();
            div();
            $("#amount").text(formatNumberWithSpaces(amount));
        }

        function ensure(){

            var amount = 0;
            
            var formule = $('#formule').find(":selected");
            var insurance_type = $('#insurance_type').find(":selected");
            var amount_formule = parseInt(formule.data('amount'));
            var radio = $('#div-ensure').find('.radio:checked');
            var value = radio.data('value');
            
            amount_formule = amount_formule>0 ? amount_formule : 0;

            if(radio.data('condition')=='percente_plus'){    
                amount += amount_formule*(value/100);
            }
            if(radio.data('condition')=='percente_minus'){
                amount -= amount_formule*(value/100);
            }
            if(radio.data('condition')=='amount_plus'){
                amount += value;
            }
            if(radio.data('condition')=='amount_minus'){
                amount -= value;
            }

            var checks = $('#div-ensure').find('.check:checked');

            $.each(checks, function(index, element) {

                var check = $(element);
                var value = check.data('value');

                if(check.data('condition')=='percente_plus'){    
                    amount += amount_formule*(value/100);
                }
                if(check.data('condition')=='percente_minus'){
                    amount -= amount_formule*(value/100);
                }
                if(check.data('condition')=='amount_plus'){
                    amount += value;
                }
                if(check.data('condition')=='amount_minus'){
                    amount -= value;
                }
            });

            var numbers = $('#div-ensure').find('.number');

            $.each(numbers, function(index, element) {

                var number = $(element);

                if(number.val()!=''){

                    var val = parseInt(number.val());
                    var value = number.data('value');

                    if(number.data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='amount_plus'){
                        amount += val*value;
                    }
                    if(number.data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            var select_affection = $('#div-ensure').find('.select_value');

            $.each(select_affection, function(index, element) {

                var number = $(element);
                var select = $(element).parent().parent().find('.select_affection');

                if(number.val()!=''){

                    var val = number.val();
                    var value = select.find(':selected').data('value');

                    console.log(val);
                    console.log(value);

                    if(select.find(':selected').data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);   
                    }

                    if(select.find(':selected').data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }

                    if(select.find(':selected').data('condition')=='amount_plus'){
                        amount += val*value;
                    }

                    if(select.find(':selected').data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            $("#ensure-amount").text(formatNumberWithSpaces(amount));
        }

        function spouse(){

            var amount = 0;
            
            var formule = $('#formule').find(":selected");
            var insurance_type = $('#insurance_type').find(":selected");
            var amount_formule = parseInt(formule.data('amount'));
            var radio = $('#div-spouse').find('.radio:checked');
            var value = radio.data('value');
            
            amount_formule = amount_formule>0 ? amount_formule : 0;

            if(radio.data('condition')=='percente_plus'){    
                amount += amount_formule*(value/100);
            }
            if(radio.data('condition')=='percente_minus'){
                amount -= amount_formule*(value/100);
            }
            if(radio.data('condition')=='amount_plus'){
                amount += value;
            }
            if(radio.data('condition')=='amount_minus'){
                amount -= value;
            }

            var checks = $('#div-spouse').find('.check:checked');

            $.each(checks, function(index, element) {

                var check = $(element);
                var value = check.data('value');

                if(check.data('condition')=='percente_plus'){    
                    amount += amount_formule*(value/100);
                }
                if(check.data('condition')=='percente_minus'){
                    amount -= amount_formule*(value/100);
                }
                if(check.data('condition')=='amount_plus'){
                    amount += value;
                }
                if(check.data('condition')=='amount_minus'){
                    amount -= value;
                }
            });

            var numbers = $('#div-spouse').find('.number');

            $.each(numbers, function(index, element) {

                var number = $(element);

                if(number.val()!=''){

                    var val = parseInt(number.val());
                    var value = number.data('value');

                    if(number.data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='amount_plus'){
                        amount += val*value;
                    }
                    if(number.data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            var select_affection = $('#div-spouse').find('.select_value');

            $.each(select_affection, function(index, element) {

                var number = $(element);
                var select = $(element).parent().parent().find('.select_affection');

                if(number.val()!=''){

                    var val = number.val();
                    var value = select.find(':selected').data('value');

                    console.log(val);
                    console.log(value);

                    if(select.find(':selected').data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);   
                    }

                    if(select.find(':selected').data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }

                    if(select.find(':selected').data('condition')=='amount_plus'){
                        amount += val*value;
                    }

                    if(select.find(':selected').data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            $("#spouse-amount").text(formatNumberWithSpaces(amount));
        }

        function div(){

            var amount = 0;
            
            var formule = $('#formule').find(":selected");
            var insurance_type = $('#insurance_type').find(":selected");
            var amount_formule = parseInt(formule.data('amount'));
            var radio = $('#div').find('.radio:checked');
            var value = radio.data('value');
            
            amount_formule = amount_formule>0 ? amount_formule : 0;

            if(radio.data('condition')=='percente_plus'){    
                amount += amount_formule*(value/100);
            }
            if(radio.data('condition')=='percente_minus'){
                amount -= amount_formule*(value/100);
            }
            if(radio.data('condition')=='amount_plus'){
                amount += value;
            }
            if(radio.data('condition')=='amount_minus'){
                amount -= value;
            }

            var checks = $('#div').find('.check:checked');

            $.each(checks, function(index, element) {

                var check = $(element);
                var value = check.data('value');

                if(check.data('condition')=='percente_plus'){    
                    amount += amount_formule*(value/100);
                }
                if(check.data('condition')=='percente_minus'){
                    amount -= amount_formule*(value/100);
                }
                if(check.data('condition')=='amount_plus'){
                    amount += value;
                }
                if(check.data('condition')=='amount_minus'){
                    amount -= value;
                }
            });

            var numbers = $('#div').find('.number');

            $.each(numbers, function(index, element) {

                var number = $(element);

                if(number.val()!=''){

                    var val = parseInt(number.val());
                    var value = number.data('value');

                    if(number.data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }
                    if(number.data('condition')=='amount_plus'){
                        amount += val*value;
                    }
                    if(number.data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            var select_affection = $('#div').find('.select_value');

            $.each(select_affection, function(index, element) {

                var number = $(element);
                var select = $(element).parent().parent().find('.select_affection');

                if(number.val()!=''){

                    var val = number.val();
                    var value = select.find(':selected').data('value');

                    console.log(val);
                    console.log(value);

                    if(select.find(':selected').data('condition')=='percente_plus'){    
                        amount += amount_formule*(val*value/100);   
                    }

                    if(select.find(':selected').data('condition')=='percente_minus'){
                        amount -= amount_formule*(val*value/100);
                    }

                    if(select.find(':selected').data('condition')=='amount_plus'){
                        amount += val*value;
                    }

                    if(select.find(':selected').data('condition')=='amount_minus'){
                        amount -= val*value;
                    }
                }

            });

            $("#div-amount").text(formatNumberWithSpaces(amount));
        }

        function formatNumberWithSpaces(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
        }

    </script>
</body>
</html>