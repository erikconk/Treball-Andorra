<br><br><br>
<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="banner-container">
                <p class="banner-content">
                    Estàs <span class="banner-strong">buscant feina?</span> Aquí trobaràs totes les ofertes de treball del principat.
                </p>
            </div>
        </div>
        <div class="swiper-slide">
            <div class="banner-container">
                <p class="banner-content">
                    Si tens una empresa o si ets un freelance, pots <span class="banner-strong">anunciar-te de forma gratuïta.</span>
                </p>
            </div>
        </div>
    </div>

    <div class="swiper-pagination"></div>
</div>
<!--

-->
<script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      centeredSlides: true,
      autoplay: {
        delay: 10000,
        disableOnInteraction: false,
      },
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  </script>