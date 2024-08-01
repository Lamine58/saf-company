@extends('layouts.app')

@section('title', "Relance mail")

<style>
    @media (min-width: 992px) {
        .modal-lg, .modal-xl {
            min-width: 1000px;
        }
    }
    #text {
        height: 69%;
        width: 76%;
        position: absolute;
        top: 18%;
        left: 12%;
        overflow: auto;
    }
</style>
@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Relance SMS</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Relance SMS</a></li>
                                    <li class="breadcrumb-item active">Historique relance par sms</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="pb-4 border-bottom border-bottom-dashed">
                                            <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#composemodal"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather  ri-send-plane-fill icon-xs me-1 icon-dual-light"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg> Nouvelle relance</button>
                                        </div>
                                    </div>
                                </div>

                                <table id="table" class="table table-bordered dt-responsive  table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Message</th>
                                            <th>Destinateurs</th>
                                            <th>Date</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td>{{$message->message}}</td>
                                                <td>{{$message->recipient}}</td>
                                                <td>{{date('d/m/Y H:i:s',strtotime($message->created_at))}}</td>
                                                <td>
                                                    @if(Auth::user()->permission('SUPPRESSION ARCHIVE SMS'))
                                                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="ri-more-fill align-middle"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-end">
                                                            <li>
                                                                <a href="javascript:void(0);" onclick="deleted('{{$message->id}}','{{route('crm.delete-sms')}}')" class="dropdown-item remove-item-btn">
                                                                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted" ></i> Supprimer l'archive
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div>
                                <ul class="pagination pagination-separated justify-content-center mb-0">
                                    @if ($messages->onFirstPage())
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-left"></i></span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a href="{{ $messages->previousPageUrl() }}" class="page-link" rel="prev"><i class="mdi mdi-chevron-left"></i></a>
                                        </li>
                                    @endif
                        
                                    @foreach ($messages->getUrlRange(1, $messages->lastPage()) as $page => $url)
                                        @if ($page == $messages->currentPage())
                                            <li class="page-item active">
                                                <span class="page-link">{{ $page }}</span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                                            </li>
                                        @endif
                                    @endforeach
                        
                                    @if ($messages->hasMorePages())
                                        <li class="page-item">
                                            <a href="{{ $messages->nextPageUrl() }}" class="page-link" rel="next"><i class="mdi mdi-chevron-right"></i></a>
                                        </li>
                                    @else
                                        <li class="page-item disabled">
                                            <span class="page-link"><i class="mdi mdi-chevron-right"></i></span>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <br>
                        </div>
                    </div><!--end col-->
                    
                </div><!--end row-->

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->

        <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
            <div data-action="{{route('crm.send-sms')}}" id="form" class="modal-dialog modal-dialog-centered modal-lg" role="document">
                @csrf
                <div class="modal-content modal-lg">
                    <div class="modal-header p-3 bg-light">
                        <h5 class="modal-title" id="composemodalTitle">Message</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-md-7">
                            <div class="mb-3 position-relative">
                                <input type="text" id="recipient" class="form-control" data-choices data-choices-limit="15" value="Souscripteurs,Prospects" data-choices-removeItem placeholder="A">
                            </div>
                            <div class="ck-editor-reverse">
                                <textarea class="form-control" rows="10" id="message" required></textarea>
                            </div>

                        </div>
                        <div class="col-md-5">
                            <img src="{{asset('assets/images/phone-saf.png')}}" style="width: 100%" alt="">
                            <div id="text"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-ghost-danger" data-bs-dismiss="modal">Fermer</button>

                        <div class="btn-group">
                            <button id="submit" class="btn btn-success">Envoyer le sms</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('css-link')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

@endsection 


@section('script')


    <script src="{{asset('assets/js/app.js')}}"></script>
    
    <script>

        $('#message').on('keyup',()=>{
            $('#text').text($('#message').val());
        });
    
        new DataTable("#table", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        new DataTable("#table-insurance", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        $('#submit').on('click',function(){

            var form = {
                '_token': '{{csrf_token()}}',
                'recipient': $('#recipient').val(),
                'message': $('#message').val()
            };

            console.log(form);

            if(form.recipient.trim()==''){
                Toastify({
                    text: 'Vous n\'avez pas choisir de destinateur',
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "red",
                }).showToast();

                return;
            }

            if(form.message.trim()==''){
                Toastify({
                    text: 'Votre message est vide',
                    duration: 3000,
                    gravity: "top",
                    position: 'right',
                    backgroundColor: "red",
                }).showToast();

                return;
            }

            var buttonDefault = $('#submit').text();
            var button = $('#submit');

            button.attr('disabled',true);
            button.text('Veuillez patienter ...');

            $.ajax({
                type: 'POST',
                url: $('#form').data('action'),
                data: form,
                dataType: 'json',
                success: function (result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.status=="success"){

                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "#4CAF50", // green
                        }).showToast();

                        window.location.reload();

                    }else{
                        Toastify({
                            text: result.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }
                    
                },
                error: function(result){

                    button.attr('disabled',false);
                    button.text(buttonDefault);

                    if(result.responseJSON.message){
                        Toastify({
                            text: result.responseJSON.message,
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }else{
                        Toastify({
                            text: "Une erreur c'est produite",
                            duration: 3000, // 3 seconds
                            gravity: "top", // "top" or "bottom"
                            position: 'right', // "left", "center", "right"
                            backgroundColor: "red", // red
                        }).showToast();
                    }

                }
            });
        });
    </script>
@endsection 