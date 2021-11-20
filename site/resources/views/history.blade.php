@extends('layouts.visitorsplayground')

@section('content')

<div class="box-header">
    <div class="row mt-3">
        <div class="col-md-6">
            <h3 class="box-title text-color">Savetable</h3>
        </div>
    </div>
  </div>
  <div class="box-body">
      <table id="table_id" class="table display responsive nowrap" width="100%">
          <thead>
                <tr>
                  <th>SR NO</th><br>
                  
                  <th> table_name</th>
                  <th> columns</th>
                  <th>Action</th>
                </tr>
          </thead>
          <tbody>
              <?php $i=1;?>
              @foreach($savetables as $savetable)
              
                <tr>
                    
                    <td>{{$i}}</td><br>
                    
                    <td><a href="{{url('/saved/'.$savetable ->id."/".$savetable ->table_name)}}">{{$savetable->table_name}}</a></td>
                    <td>{{$savetable->columns}}</td>
  
                    <td>
                        <div class="row">
                            
                            <div class="col-md-2">
                                <form action="{{ route('savetables.destroy',$savetable ->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"  class="label" value="Delete" >Delete</button>
                                </form>
                            </div>
                            <div class="col-md-2">
                                {{-- <a href="{{route('savetables.show',$savetable ->id)}}" style="margin-left: 5px;" class="icon"><i class="fa fa-eye  fa-1x" ></i> </span></a> --}}
  
                            </div>
                        </div>
                    </td>
                
                    </tr>
                
                  
              <?php $i++?>
              @endforeach
          </tbody>
      </table>
  </div>

  @endsection