<section class="section">
  <div class="section-header">
      <h1>Dashboard</h1>
  </div>

  <section class="section">
      <div class="row">
          <div class="col-lg-4">
              <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-users"></i>
                  </div>
                  <div class="card-wrap">
                      <div class="card-header">
                          <h4>Total Karyawan</h4>
                      </div>
                      <div class="card-body">
                          {{ $totalPegawai }}
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-check"></i>
                  </div>
                  <div class="card-wrap">
                      <div class="card-header">
                          <h4>Total Karyawan Yang Sudah Dinilai</h4>
                      </div>
                      <div class="card-body">
                        {{ $totalDinilai }}
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-lg-4">
              <div class="card card-statistic-2">
                  <div class="card-icon shadow-primary bg-primary">
                      <i class="fas fa-times"></i>
                  </div>
                  <div class="card-wrap">
                      <div class="card-header">
                          <h4>Total Karyawan Yan Belum Dinilai</h4>
                      </div>
                      <div class="card-body">
                        {{ $totalBelumDinilai }}
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</section>