<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Salem sulibe</title>
  <meta content="website for making an appointments" name="description">
  <meta content="photographer,instgrame,Salem,salem,salemsulibe" name="keywords">

  <!-- Favicons -->
  <link href="{{asset('assets/img/favicon.png')}}" rel="icon">
  <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/icofont/icofont.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/venobox/venobox.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/owl.carousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <!-- Template Main CSS File -->
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">

  <link href='{{asset('fullcalendar/main.css')}}' rel='stylesheet' />
<script src='{{asset('fullcalendar/main.js')}}'></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
  

<style>
  .sortable-handler {
  touch-action: none;
}

</style>

<script>
  document.addEventListener("mousewheel", { passive: false });
    (() => {
        'use strict';
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation');
      
        // Loop over them and prevent submission
        Array.prototype.slice.call(forms).forEach((form) => {
            form.addEventListener('submit', (event) => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
            }, false);
        });
    })();


    let events = [{
      id: 'a',
      title: 'my event',
      start: '2021-06-21'
    }]

      var today = new Date();
      var dd = String(today.getDate()).padStart(2, '0');
      var mm = String(today.getMonth() + 1).padStart(2, '0'); 
      var mm2 = String(today.getMonth() + parseInt({!! json_encode($appInfo->appointmentsRange) !!})).padStart(2, '0'); // chose how many months in the futuer you want the users can make an appointment's
      var yyyy = today.getFullYear();
    
      today = yyyy + '-' + mm + '-' + dd;
      toDate = yyyy + '-' + mm2 + '-' + dd;

    let startDate;
    let calendarModel;
    document.addEventListener('DOMContentLoaded', function() {
    $('#MobileMessage').hide();
    if (typeof window.orientation !== 'undefined') 
    {
      $('#MobileMessage').show();
    }

      var calendarEl = document.getElementById('calendar');
      var calendar = new FullCalendar.Calendar(calendarEl, {
        editable: false,
        initialView: 'dayGridMonth',
        initialDate: today,
        hiddenDays: {!! json_encode($daysOff) !!},
        selectable:true,
        views: {
          timeGridMonth: {
           dayMaxEventRows: 2 // adjust to 6 only for timeGridWeek/timeGridDay
          }
        },
        events: {!! json_encode($formatedAppointments) !!},
        select:function(start,end,allDays)
        {
            $('#exampleModal').modal('show');
            eventData = 
            {
              title:'title',
              start: start.startStr,
            };
            startDate = start.startStr;
            calendarModel = calendar;
        },
        validRange: function(nowDate) {
        return {
          start: today,
          end: toDate
          };
       }
      });
      // calendar.setOption('locale', 'ar');
      calendar.render();
    });

    function addNewEvent(start)
    {
      $('#exampleModal').modal('hide');
      $('#loadingModal').modal('show');
        let newEvent = {
            title:document.getElementById("name").value,
            start:startDate,
        }
        let dataSaved = {
            title:document.getElementById("name").value,
            start:startDate,
            name:document.getElementById("name").value,
            instagram:document.getElementById("Instagram_input").value,
            time:startDate,
            phone:document.getElementById('phone').value,
            AM:0,
            note:document.getElementById("note").value,
            _token: "{{ csrf_token() }}",
        }
        $.ajax({
            url: "{{route('appointment.store')}}",
            type: 'POST',
            data: dataSaved,
            dataType: 'JSON',
            success: function (res) { 
                    if(res.status == 202)
                    {
                      $('#loadingModal').modal('hide');
                      $('#exampleModal').modal('hide');
                      return;
                    }
                    if(res.status == 201)
                    {
                        $('#loadingModal').modal('hide');
                        $('#exampleModal3').modal('show');
                        document.getElementById("name").value = "";
                        document.getElementById("Instagram_input").value = "";
                        document.getElementById('phone').value = "";
                        document.getElementById("note").value = "";
                        $("textarea#note").val("");
                    }
            },
            error: function(err){
              $('#loadingModal').modal('hide');
              $('#exampleModal2').modal('show')
            }
        });   
    }
  </script>
</head>

<body>

  <!-- ======= Mobile nav toggle button ======= -->
  <button type="button" class="mobile-nav-toggle d-xl-none"><i class="icofont-navigation-menu"></i></button>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex flex-column justify-content-center">

    <nav class="nav-menu">
      <ul>
        <li class="active"><a href="#hero"><i class="bx bx-home"></i> <span>Home</span></a></li>
        <li><a href="#appoinments"><i class="bx bx-book"></i> <span>Appoinments</span></a></li>
        <li><a href="#portfolio"><i class="bx bx-book-content"></i> <span>Portfolio</span></a></li>
      </ul>
    </nav><!-- .nav-menu -->

  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex flex-column justify-content-center">
    <div class="container" data-aos="zoom-in" data-aos-delay="100">
      <h1>Salem sulibe</h1>
      <p>I'm <span class="typed" data-typed-items="Freelancer, Photographer"></span></p>
      <button type="button" class="btn btn-dark" style="background-color: #45505b">
        <a href="#appoinments" style="color: #ffff;  scroll-behavior: smooth; transition: 0.3s;">Make an appointment now!</a>
      </button>
      <div class="social-links">
        <a href="{{$appInfo->facebook}}" target="_blank" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="{{$appInfo->instagram}}" class="instagram" target="_blank"><i class="bx bxl-instagram"></i></a>
      </div>
    </div>
  </section>
  <!-- End Hero -->

  <main id="main">
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModal2Label">Error</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                  Please fill all the fields
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModal2Label" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModal2Label">Add Successfully</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                  Appoinments was made i will contact you throw your phone number to conform the appointment
              </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">New appointment</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form class="needs-validation">
                <div class="form-group">
                  <label for="validationCustom05" class="col-form-label">Name:</label>
                  <input type="text" class="form-control" id="name">
                </div>
                <div class="form-group">
                  <label for="validationCustom05" class="col-form-label">Phone Number:</label>
                  <input type="number" class="form-control" id="phone">
                </div>
                <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Instagram: <small class="form-text text-muted">(Add the instagram tag ex:salemsulibe)</small></label>
                    <input type="text" class="form-control" id="Instagram_input">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Details:  <small class="form-text text-muted">(Add the appointment details like where the pictures will be taken)</small></label>
                  <textarea class="form-control" id="note"></textarea>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button onclick="addNewEvent(startDate)" type="button" class="btn btn-primary">Add</button>
            </div>
          </div>
        </div>
      </div>
      <div data-backdrop="static" data-keyboard="false" class="modal" id="loadingModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Saveing the Appointment</h5>
            </div>
            <div class="modal-body text-center">
              <div class="spinner-grow text-primary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-secondary" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-success" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-danger" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-warning" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-info" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-light" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              <div class="spinner-grow text-dark" role="status">
                <span class="sr-only">Loading...</span>
              </div>
              
            </div>
          </div>
        </div>
      </div>
      
            

    <!-- ======= Facts Section ======= -->
    <section id="appoinments" class="facts">
      <div class="container" data-aos="fade-up">
        <h3>
          Make an Appoinments <b/>
          <span id='MobileMessage'> <p style="color:gray; font-size:12px;">please click the date for 1 second to make an appoinment.</p></span>
        </h3>
        <div id='calendar'></div>
        </div>

      </div>
    </section><!-- End Facts Section -->

    <!-- ======= Skills Section ======= -->

    <!-- End Skills Section -->


    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio section-bg">
      <div class="container" data-aos="fade-up">
        <div class="section-title">
          <h2>Portfolio</h2>
        </div>
        <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">
          @foreach ($images as $image)
          <div class="col-lg-4 col-md-6 portfolio-item filter-app">
            <div class="portfolio-wrap">
              <img loading="lazy" alt="{{$image->link}}" src="{{$image->link}}" class="img-fluid">
              <div class="portfolio-info">
                <div class="portfolio-links">
                  <a href="{{$image->link}}" data-gall="portfolioGallery" class="venobox" title="App 1"><i class="bx bx-plus"></i></a>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </section><!-- End Portfolio Section -->
  </main><!-- End #main -->
  <a href="#" class="back-to-top"><i class="bx bx-up-arrow-alt"></i></a>
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/jquery.easing/jquery.easing.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>
  <script src="{{asset('assets/vendor/waypoints/jquery.waypoints.min.js')}}"></script>
  <script src="{{asset('assets/vendor/counterup/counterup.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/venobox/venobox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/owl.carousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('assets/vendor/typed.js/typed.min.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

  <!-- Calender -->
</body>

</html>