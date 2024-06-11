@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">STATISTIQUES {{$quizze->category->name}} {{$quizze->value_chain->name}} </h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{$quizze->category->name}}</a></li>
                                <li class="breadcrumb-item active">{{$quizze->value_chain->name}}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <form class="col-md-12 row">

                    @if(is_null($user->region_id))
                        <div  class="mb-4 col-md-2">
                            <label class="form-label">Région</label>
                            <select id="region_id" class="form-control select2" name="region_id">
                                <option value="">Tout</option>
                                @foreach($regions as $region)
                                    <option value="{{$region->id}}" {{$region->id==$region_id ? 'selected' : ''}} >{{$region->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if(is_null($user->departement_id))
                        <div  class="mb-4  col-md-2">
                            <label class="form-label">Département</label>
                            <select id="departement_id" class="form-control select2" name="departement_id"> 
                                <option value="">Tout</option>
                                @foreach(($user->region->departements ?? $departements) as $departement)
                                    <option value="{{$departement->id}}" {{$departement->id==$departement_id ? 'selected' : ''}} >{{$departement->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if(is_null($user->region_id) || is_null($user->departement_id))
                        <div  class="mb-4  col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary btn-block" style="width:100%">Filtrer <i class="ri-search-2-line"></i></button>
                        </div>
                    @endif
                    
                </form>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <table id="table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <body>
                                    @foreach($results as $data)
                                        @if($data->total_value>0)
                                            <tr>
                                                <td>{{$data->question}}</td>
                                                <td>{{$data->total_value}}</td>
                                                <td>{{App\Models\Indicator::find($data->indicator_id)->periodicity->name}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </body>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div id="chart"></div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- container-fluid -->
    </div>

@endsection

@section('script')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@latest/dist/apexcharts.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts@latest"></script>

    <script>

        new DataTable("#table", {
            dom: "Bfrtip",
            searching: false, // Désactiver la recherche
            paging: false, // Désactiver la pagination
            buttons: ["excel"],
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
        });

        var options = {
          series: [
            @foreach($results as $data)
                @if($data->total_value>0)
                    {
                        name: "{{$data->question}}",
                        data: [
                            @foreach($months as $month)
                                {{App\Models\Investigation::whereMonth('created_at', $month)->whereIn('id',$investigation_ids)->where('indicator_id',$data->indicator_id)->sum('value')}},
                            @endforeach
                        ]
                    },
                @endif
            @endforeach
        ],
          chart: {
            type: 'bar',
            height: 600,
            stacked: true,
            toolbar: {
              show: true
            },
            zoom: {
              enabled: true
            }
          },
          responsive: [{
            breakpoint: 480,
            options: {
              legend: {
                position: 'bottom',
                offsetX: -10,
                offsetY: 0
              }
            }
          }],
          plotOptions: {
            bar: {
              horizontal: false,
              borderRadius: 10,
              dataLabels: {
                total: {
                  enabled: true,
                  style: {
                    fontSize: '13px',
                    fontWeight: 900
                  }
                }
              }
            },
          },
          xaxis: {
            categories: {!!json_encode($monthsJSON)!!},
            title: {
                text: 'Mois'
            }
          },
          legend: {
            position: 'right',
            offsetY: 40
          },
          fill: {
            opacity: 1
          }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();



        $('#region_id').on('change',function(){

            var regionId = $(this).val();

            $.ajax({
                url: '/regions/' + regionId + '/departements',
                type: 'GET',
                success: function(response) {

                    $('#departement_id').select2('destroy');

                    var options = '<option value="">Tout</option>';
                    $.each(response, function(index, departement) {
                        options += '<option value="' + departement.id + '">' + departement.name + '</option>';
                    });
                    $('#departement_id').html(options);
                    $('#departement_id').select2();
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });

        });

    </script>

@endsection