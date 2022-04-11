<!-- ======= Footer ======= -->
  <footer id="footer">


    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-links">
            <h4><?=$language['sitelinks']?></h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="homepage"><?=$language['anasayfa']?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="hakkimizda"><?=$language['hakkimizda']?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="iletisim"><?=$language['iletisim']?></a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="kategoriler"><?=$language['kategoriler']?></a></li>

            </ul>
          </div>



          <div class="col-lg-6 col-md-6 footer-contact">
            <h4><?=$language['bizeulasin']?></h4>
            <p><?php echo $ayarcek['ayar_adress'] ?><br><br>
              <strong>Phone:</strong> <?php echo $ayarcek['ayar_tel'] ?><br>
              <strong>Email:</strong> <?php echo $ayarcek['ayar_mail'] ?><br>
            </p>

          </div>

          <div class="col-lg-3 col-md-6 footer-info">
            <h3><?=$language['about']?></h3>
            <p><?=$language['aboutic']?></p>
            <div class="social-links mt-3">


              <a href="https://<?php echo $ayarcek['ayar_facebook'] ?>" class="facebook"><i class="bx bxl-linkedin"></i></a>


            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Eterna</span></strong>. All Rights Reserved
      </div>
      <div class="credits">Designed by <a href="https://bootstrapmade.com/">BtM</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/jquery-sticky/jquery.sticky.js"></script>
  <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="assets/vendor/counterup/counterup.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/venobox/venobox.min.js"></script>


<script>
 // State
const state = {
  animations: ['fade', 'slide', 'slideUp', 'zoom', 'flipX', 'flipY'],
  view: 'slide' };


// Controls
const controls = Vue.component('controls', {
  template: '#controls',
  data: state,
  methods: {
    setView(animation) {
      state.view = animation;
    } } });



// Transitions
const fade = Vue.component('fade', {
  template: '#page',
  methods: {
    enter(el, done) {
      TweenMax.fromTo(el, 1, {
        autoAlpha: 0,
        scale: 1.5 },
      {
        autoAlpha: 1,
        scale: 1,
        transformOrigin: '50% 50%',
        ease: Power4.easeOut,
        onComplete: done });

    },
    leave(el, done) {
      TweenMax.fromTo(el, 1, {
        autoAlpha: 1,
        scale: 1 },
      {
        autoAlpha: 0,
        scale: 0.8,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



const slide = Vue.component('slide', {
  template: '#page',
  methods: {
    enter(el, done) {
      const tl = new TimelineMax({
        onComplete: done });


      tl.set(el, {
        x: window.innerWidth * 1.5,
        scale: 0.8,
        transformOrigin: '50% 50%' });


      tl.to(el, 0.5, {
        x: 0,
        ease: Power4.easeOut });


      tl.to(el, 1, {
        scale: 1,
        ease: Power4.easeOut });

    },
    leave(el, done) {
      TweenMax.fromTo(el, 1, {
        autoAlpha: 1 },
      {
        autoAlpha: 0,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



const slideUp = Vue.component('slideUp', {
  template: '#page',
  methods: {
    enter(el, done) {
      const tl = new TimelineMax({
        onComplete: done });


      tl.set(el, {
        y: window.innerWidth * 1.5,
        scale: 0.8,
        transformOrigin: '50% 50%' });


      tl.to(el, 0.5, {
        y: 0,
        ease: Power4.easeOut });


      tl.to(el, 1, {
        scale: 1,
        ease: Power4.easeOut });

    },
    leave(el, done) {
      TweenMax.to(el, 1, {
        y: window.innerHeight * -1.5,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



const zoom = Vue.component('zoom', {
  template: '#page',
  methods: {
    enter(el, done) {
      const tl = new TimelineMax({
        onComplete: done });


      tl.set(el, {
        autoAlpha: 0,
        scale: 2,
        transformOrigin: '50% 50%' });


      tl.to(el, 1, {
        autoAlpha: 1,
        scale: 1,
        ease: Power4.easeOut });

    },
    leave(el, done) {
      TweenMax.to(el, 1, {
        scale: 0,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



const flipX = Vue.component('flipX', {
  template: '#page',
  methods: {
    enter(el, done) {
      const tl = new TimelineMax({
        onComplete: done });


      tl.set(el, {
        autoAlpha: 0,
        rotationX: 90,
        transformOrigin: '50% 50%' });


      tl.to(el, 1, {
        autoAlpha: 1,
        rotationX: 0,
        ease: Power4.easeOut });

    },
    leave(el, done) {
      TweenMax.to(el, 1, {
        scale: 0,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



const flipY = Vue.component('flipY', {
  template: '#page',
  methods: {
    enter(el, done) {
      const tl = new TimelineMax({
        onComplete: done });


      tl.set(el, {
        autoAlpha: 0,
        rotationY: 90,
        transformOrigin: '50% 50%' });


      tl.to(el, 1, {
        autoAlpha: 1,
        rotationY: 0,
        ease: Power4.easeOut });

    },
    leave(el, done) {
      TweenMax.to(el, 1, {
        scale: 0,
        ease: Power4.easeOut,
        onComplete: done });

    } } });



// App
const app = new Vue({
  el: '#app',
  data() {
    return state;
  } });
</script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
<script>
  var button = document.getElementById("my-button");

button.addEventListener("mouseover", function() {
    button.style.opacity = 0.5;
});

button.addEventListener("mouesout", function() {
    button.style.opacity = 1.0;
});
</script>

<style>
  .rowdeo {
    background: #e96b56;
  margin-top: 20px;
  margin-left: auto;
  margin-right: auto;
  -webkit-transition: background-color 2s ease-out;
  -moz-transition: background-color 2s ease-out;
  -o-transition: background-color 2s ease-out;
  transition: background-color 2s ease-out;
  box-shadow: rgba(0, 0, 0, 0.15) 0px 15px 25px, rgba(0, 0, 0, 0.05) 0px 5px 10px; 

}
.rowdeo:hover {
  background: #59b3f3;
  cursor: pointer;
  


}
</style>

</body>

</html>