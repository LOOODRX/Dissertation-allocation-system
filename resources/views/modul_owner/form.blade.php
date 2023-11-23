@extends('modul_owner.modul_ownerDashboard')
@section('modul_owner')

<div class="page-content">
    <div class="col-md-12 col-xl-10 middle-wrapper">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">CSV Data</h6>
                    <table>
                        @foreach ($csvData as $row)
                            <tr>
                                @foreach ($row as $cell)
                                    <td>{{ $cell }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>       
              </div>
        </div>
    </div>
    </div>

@endsection
