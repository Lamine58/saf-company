@extends('layouts.app')

@section('title', "CRM")

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">CRM</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">CRM</a></li>
                                    <li class="breadcrumb-item active">Accueil</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="rounded-0">
                        <div class="px-4">
                            <div class="row">
                                <div class="col-xxl-5 align-self-center">
                                    <div class="py-4">
                                        <p class="text-primary fs-15 mt-3">Facilite la communication et la collaboration entre les différentes équipes de l'entreprise et avec les clients</p>
                                    </div>
                                </div>
                                <div class="col-xxl-2 ms-auto">
                                    <div class="mb-n5 pb-1 faq-img d-none d-xxl-block">
                                        <img src="assets/images/faq-img.png" alt="" class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                </div>
                <br><br>
                <div class="container">
                    <div class="row justify-content-center">
                        @if(Auth::user()->permission('MAILING'))
                            <div class="col-lg-4">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 text-center">
                                                <img src="{{asset('assets/images/5706675.webp')}}" style="width: 170px" alt="">
                                                <h5 class="mb-1 fw-semibold">RELANCE EMAIL</h5>
                                                <p class="text-muted mb-0">Envoyez des mails de relance</p>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <div class="mt-4">
                                                <a href="{{route('crm.mail')}}" class="btn btn-primary w-100 waves-effect waves-light">Continuer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if(Auth::user()->permission('SMS'))
                            <div class="col-lg-4">
                                <div class="card pricing-box">
                                    <div class="card-body p-4 m-2">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-grow-1 text-center">
                                                <img src="{{asset('assets/images/8326657.webp')}}" style="width: 170px" alt="">
                                                <h5 class="mb-1 fw-semibold">RELANCE SMS</h5>
                                                <p class="text-muted mb-0">Envoyez des sms de relance</p>
                                            </div>
                                        </div>
                                        <hr class="my-4 text-muted">
                                        <div>
                                            <div class="mt-4">
                                                <a href="{{route('crm.sms')}}" class="btn btn-primary w-100 waves-effect waves-light">Continuer</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-4">
                            <div class="card pricing-box">
                                <div class="card-body p-4 m-2">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 text-center">
                                            <img src="{{asset('assets/images/6478904.webp')}}" style="width: 170px" alt="">
                                            <h5 class="mb-1 fw-semibold">SOUSCRIPTEURS</h5>
                                            <p class="text-muted mb-0">Consultez les souscription</p>
                                        </div>
                                    </div>
                                    <hr class="my-4 text-muted">
                                    <div>
                                        <div class="mt-4">
                                            <a href="javascript:void(0);" class="btn btn-primary w-100 waves-effect waves-light">Continuer</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--end row-->
                </div><!--end container-->
                

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->


@endsection