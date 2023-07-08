@extends('admin.dashboard.layout.template')

@section('content')

@if (session()->has('pesan'))
<div class="alert alert-success" role="alert">
	{{session('pesan')}}
</div>
@endif
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Contact Us</h4>
        <a href="/bank/create" class="btn btn-primary my-2 ">Data Contact Us</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table">
            <thead class=" text-primary">
              <th>
                NO
              </th>
              <th>
                Nama Contact
              </th>
              <th>
                No Rek
              </th>
              <th>
                Nomor Contact
              </th>
              <th>
                Email Contact
              </th>
              <th>
                Subject
              </th>
              <th>
                Message
              </th>
              <th>
                Action
              </th>
            </thead>
            <tbody>
              
              @foreach ($contact_us as $bancontact_usk)

              <tr>
               <td>{{$loop->iteration}}</td>
               <td>{{$contact_us->nama_contact}}</td>
               <td>{{$contact_us->nomor_contact}}</td>
               <td>{{$contact_us->email_contact}}</td>
               <td>{{$contact_us->subjek}}</td>
               <td>{{$contact_us->message}}</td>
               <td>
                <a href="#" class="btn btn-sm btn-danger del" data-id="{{$d->contact_id}}" data-nama="{{$d->contact_nama}}"><i class="fa fa-trash-alt"></i></a>
                <a href="https://api.whatsapp.com/send?phone=.{{$d->contact_nomor}}.&text=Halo. Ada Yang Bisa Saya Bantu??" target="blank" class="btn btn-success btn-sm border-0 text-center">Chat</a>
              </td>
              <td> 

                <a href="/contact_us/{{$contact_us->id}}/edit" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                <form  class="d-inline" action="/contact_us/{{ $contact_us->id }}" method="post">
                  @method('delete')
                  @csrf
                  <button class="btn btn-sm btn-danger"><i class="fa fa-trash" onclick="return confirm('Yakin ingin menghapus data ?')"></i></a></button>
                </form>			
              </td>
            </tr>
          </tbody>	
          @endforeach
        </table>
      </div>
    </div>
  </div>
</div>

@endsection          