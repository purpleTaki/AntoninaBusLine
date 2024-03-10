<style>
    body {
        background-image: url(./assets/img/bsimgstat.png);
        height: 100%;
        background-position: center;
        background-repeat: no-repeat;
    }

    /* .carousel-inner .carousel-item img {
        height: 100px;
        width: auto;
    } */
</style>

<section id="" class="d-flex align-items-center">
    <div class="container">
        <center>
            <br>
            <h1 class="highlight">BUS SEATS RESERVATION AND TICKETING ONLINE SYSTEM</h1>
        </center>

        <div class="card-body">
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
              <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            </ol>
            <div class="carousel-inner" style="border: 1px solid white; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);">
              <div class="carousel-item active">
                <img class="d-block w-100" src="assets\img\img2.png" alt="First slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="assets\img\img1.png" alt="Second slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="assets\img\img3.png " alt="Third slide">
              </div>
              <div class="carousel-item">
                <img class="d-block w-100" src="assets\img\img4.png " alt="Third slide">
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
              <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-left"></i>
              </span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
              <span class="carousel-control-custom-icon" aria-hidden="true">
                <i class="fas fa-chevron-right"></i>
              </span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>


        <?php if(!isset($_SESSION['login_id'])): ?>
            <center style="margin-top: -500px;"><button class="btn btn-danger btn-lg" type="button" id="book_now">Reserve Your Tickets Now</button></center>
        <?php else: ?>
            <center><br><br><br><h2 class="highlight2">Welcome, <?php echo $_SESSION['login_name'] ?></h2></center>
        <?php endif; ?>
    </div>
</section>

<script>
    $('#book_now').click(function(){
        uni_modal('Find Schedule','book_filter.php')
    })
</script>
