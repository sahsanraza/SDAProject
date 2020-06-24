<div class="row">
    <div class="col-md-4 offset-md-4 text-center">
        <h3 style="color: #333; font-weight: 300;">Welcome, <?php echo $this->session->userdata('FullName'); ?></h3>
    </div>
</div>

<hr class="mt-4" />
<div class="row text-center " >
    <div class="col-4 myhover">
        <div class="card">
            <div class="card-body bg-info text-light">
                <h5 class="card-title">Total Orders</h5>
                <h2 class="badge badge-light ">910</h2>
            </div>
        </div>
    </div>
    <div class="col-4 myhover">
    <div class="card">
            <div class="card-body bg-warning">
                <h5 class="card-title">Pending Orders</h5>
                <h2 class="badge badge-light ">540</h2>
            </div>
        </div>
    </div>
    <div class="col-4 myhover">
        <div class="card">
            <div class="card-body bg-success text-light">
                <h5 class="card-title">Completed Orders</h5>
                <h2 class="badge badge-light">370</h2>
            </div>
        </div>
    </div>
</div>
<hr />

<div class="row mt-2">
    <div class="col-8 offset-2">
        <h2 style="font-weight: 300;">Find our nearest branch.</h2>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3619.2433343208195!2d67.08262512959844!3d24.88968016689374!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33ecffe2db917%3A0xf28b832f218e1784!2sTime%20Medico!5e0!3m2!1sen!2s!4v1592940657259!5m2!1sen!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>
</div>