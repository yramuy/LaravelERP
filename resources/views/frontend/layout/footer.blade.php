  <!-- ======= Footer ======= -->
  <footer>
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="copyright-box">
                      <p class="copyright">&copy; Copyright <strong>RamuFolio</strong>. All Rights Reserved</p>
                      <div class="credits">
                          <!--
              All the links in the footer should remain intact.
              You can delete the links only if you purchased the pro version.
              Licensing information: https://bootstrapmade.com/license/
              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=DevFolio
            -->
                          Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </footer><!-- End  Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
          class="bi bi-arrow-up-short"></i></a>

  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
  <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
  <script src="{{ asset('assets/vendor/typed.js/typed.umd.js') }}"></script>
  <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets/js/main.js') }}"></script>



  <script>
      $(function() {
          GetProfileData();

          function GetProfileData() {
              $.ajax({
                  url: "{{ route('profileData') }}",
                  type: "GET",
                  success: function(response) {
                      console.log(response)
                      var data1 = response.profile;
                      var data2 = response.skills;
                      var services = response.services;
                      $('#nameVal').html(data1.name);
                      $('#profileVal').html(data1.profile);
                      $('#emailVal').html(data1.email);
                      $('#phoneVal').html(data1.phone);
                      $('#longTextVal').html(data1.long_text);

                      // Embed the asset function output within the JavaScript string
                      var imageUrl = "{{ asset('storage/uploads') }}/" + data1.profile_image;
                      //   console.log(imageUrl); // This should print the full URL to the console
                      $('#image-container').html('<img src="' + imageUrl +
                          '" alt="Description of the image" class="img-fluid rounded b-shadow-a">'
                      );

                      for (let index = 0; index < data2.length; index++) {
                          $('#skillList').append('<span>' + data2[index].skill_name +
                              '</span> <span class="pull-right">' + data2[index].percentage +
                              '%</span><div class="progress"><div class="progress-bar" role="progressbar" style="width: ' +
                              data2[index].percentage +
                              '%" aria-valuenow="' +
                              data2[index].percentage +
                              '" aria-valuemin="0" aria-valuemax="100"></div></div>');

                      }

                  }
              });
          }

      });
  </script>
