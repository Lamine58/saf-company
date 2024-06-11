@extends('layouts.app')

@section('title', 'Détails de l\'enquête')

@section('content')

    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                            <h4 class="mb-sm-0">Détails de l'enquête</h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Enquêts</a></li>
                                    <li class="breadcrumb-item active">Détails de l'enquête</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>      
                
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header align-items-center">
                                <h4 class="card-title mb-0 flex-grow-1">{{$collection->category->name}} {{$collection->value_chain->name}} {{$collection->business->legal_name}}</h4>
                                <h5><small>Date : {{date('d/m/Y',strtotime($collection->date))}}<br>Heure : {{date('H:i:s',strtotime($collection->date))}}</small></h5>
                            </div>

                            <div class="card-body">

                                <div class="live-preview">
                                    @foreach($collection->investigations as $investigation)
                                        <p>{{$investigation->indicator->question}} : {{$investigation->value}}</p>
                                        <hr>
                                    @endforeach
                                </div>

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>

                    <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Localisation de l'enquête </h4>
                                <h4 class="card-title mb-0 flex-grow-1">Enquêteur : {{$collection->user->first_name}} {{$collection->user->last_name}}</h4>
                            </div><!-- end card header -->

                            <div class="card-body">

                                <div class="live-preview">
                                    <div id="map" style="height: 400px;"></div>
                                </div>

                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>
                </div>

            </div>
            <!-- container-fluid -->
            
        </div>
        <!-- End Page-content -->


@endsection

@section('css-link')
    
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

@endsection


@section('script')
    @php
        $collection->location = json_decode($collection->location);
    @endphp
    <script>
        new DataTable("#table", {
            dom: "Bfrtip",
            paging:false,
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        var map = L.map('map').setView([{{$collection->location->latitude}}, {{$collection->location->longitude}}], 18); 
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© Ivoire Zodiac'
        }).addTo(map);
        var marker = L.marker([{{$collection->location->latitude}}, {{$collection->location->longitude}}]).addTo(map);

    </script>
@endsection 