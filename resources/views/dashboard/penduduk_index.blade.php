@extends('dashboard.tamplate')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <div class="d-flex">
            <h4 class="me-auto">Data Penduduk</h6>
              <a href="{{ url('dashboard/data-penduduk/create') }}" class="btn btn-primary btn-sm shadow-lg">Tambah KK</a>
          </div>
        </div>
        <div class="card-body px-0 pt-0 pb-2">
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama KK</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama RT</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jumlah
                    Anggota</th>
                  <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Terdata Pada
                  </th>
                  <th class="text-secondary opacity-7">aksi</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($dataPenduduk as $penduduk)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div class="mx-1">
                          {{-- <img src="../assets/img/team-2.jpg" class="avatar avatar-sm me-3" alt="user1"> --}}
                          <i class="fa fa-users" aria-hidden="true"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $penduduk->nama_kk }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $penduduk->noKK }}</p>
                        </div>
                      </div>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <p class="text-xs font-weight-bold mb-0">RT. {{ $penduduk->rt }}</p>
                      <p class="text-xs text-secondary mb-0">Bongoskenti</p>
                    </td>
                    <td class="align-middle text-center text-sm">
                      <span class="badge badge-sm bg-gradient-success">{{ $penduduk->jumlah_anggota }} Jiwa</span>
                    </td>
                    <td class="align-middle text-center">
                      <span class="text-secondary text-xs font-weight-bold">{{ $penduduk->created_at }}</span>
                    </td>
                    <td class="align-middle">
                      <a href="#" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip"
                        data-original-title="Edit user">
                        Edit
                      </a>
                    </td>
                  </tr>
                @endforeach

              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


{{-- section CSS --}}
@section('css')
@endsection


{{-- section Javascript --}}
@section('js')
  <div class="toast-container position-fixed bottom-0 end-0 p-3">
    <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="toast-header">
        <i class="fa fa-bookmark\" aria-hidden="true"></i>
        <strong class="me-auto" id="toaster-title"></strong>
        {{-- <small>0 mins ago</small> --}}
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
      </div>
      <div class="toast-body" id="toaster-body">
      </div>
    </div>
  </div>


  <script>
    const showToaster = (keterangan_, body_) => {
      var toastermodal = document.querySelector('.toast');
      var newToaster = new bootstrap.Toast(toastermodal);
      document.querySelector('#toaster-title').innerHTML = keterangan_;
      document.querySelector('#toaster-body').innerHTML = body_;
      newToaster.show();
    }


		document.addEventListener('DOMContentLoaded', function() {
			@if (session('success'))
				showToaster('success', '{{ session('success') }}');
			@endif
		});


  </script>
@endsection
