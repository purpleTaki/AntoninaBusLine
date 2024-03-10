<header id="header" class="">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto"><a href="./index.php?page=home">Antonina Line Inc.</a></h1>
		

      <nav class="nav-menu d-none d-lg-block" id='top-nav'>
        <ul>
          <li class="nav-home"><a href="./index.php?page=home">Home</a></li>
           <li class="nav-schedule"><a href="./index.php?page=schedule">View Bus Schedule</a></li>
           <li class="nav-admin"><a href="./payment.php">Payment Hub </a></li>
			
           <li class="drop-down nav-user"><a href="#"> </a>
             <ul>
              <li class="nav-admin"><a href="./index.php?page=admin">Admin (Login)</a></li>
				
            </ul>
          </li>
              
        </ul>
      </nav><!-- .nav-menu -->


    </div>
  </header>
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : '' ?>';
      if(page != ''){
        $('#top-nav li').removeClass('active')
        $('#top-nav li.nav-'+page).addClass('active')
      }
      $('#manage_account').click(function(){
      uni_modal('Manage Account','manage_account.php')
  })
    })

  </script>