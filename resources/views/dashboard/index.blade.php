@extends('dashboard.tamplate')

@section('content')
  <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Penduduk</p>
                <h5 class="font-weight-bolder">
                  300 Jiwa
                </h5>
                {{-- <p class="mb-0">Jiwa </p> --}}
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">KK</p>
                <h5 class="font-weight-bolder">
                  60 Kepala
                </h5>
                {{-- <p class="mb-0">Keluarga</p> --}}
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="fa fa-users text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Laporan</p>
                <h5 class="font-weight-bolder">
                  1 Laporan
                </h5>
                {{-- <p class="mb-0">laporan</p> --}}
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                <i class="fa fa-newspaper-o text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Balita</p>
                <h5 class="font-weight-bolder">
                  10 Jiwa
                </h5>
                {{-- <p class="mb-0">jiwa</p> --}}
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                <i class="fa fa-child text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
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
<script>
	var ctx1 = document.getElementById("chart-line").getContext("2d");

	var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

	gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
	gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
	gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
	new Chart(ctx1, {
		type: "line",
		data: {
			labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
			datasets: [{
				label: "Mobile apps",
				tension: 0.4,
				borderWidth: 0,
				pointRadius: 0,
				borderColor: "#5e72e4",
				backgroundColor: gradientStroke1,
				borderWidth: 3,
				fill: true,
				data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
				maxBarThickness: 6

			}],
		},
		options: {
			responsive: true,
			maintainAspectRatio: false,
			plugins: {
				legend: {
					display: false,
				}
			},
			interaction: {
				intersect: false,
				mode: 'index',
			},
			scales: {
				y: {
					grid: {
						drawBorder: false,
						display: true,
						drawOnChartArea: true,
						drawTicks: false,
						borderDash: [5, 5]
					},
					ticks: {
						display: true,
						padding: 10,
						color: '#fbfbfb',
						font: {
							size: 11,
							family: "Open Sans",
							style: 'normal',
							lineHeight: 2
						},
					}
				},
				x: {
					grid: {
						drawBorder: false,
						display: false,
						drawOnChartArea: false,
						drawTicks: false,
						borderDash: [5, 5]
					},
					ticks: {
						display: true,
						color: '#ccc',
						padding: 20,
						font: {
							size: 11,
							family: "Open Sans",
							style: 'normal',
							lineHeight: 2
						},
					}
				},
			},
		},
	});
</script>
@endsection
