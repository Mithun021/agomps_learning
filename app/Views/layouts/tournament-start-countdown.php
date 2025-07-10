<style>
    #countdown-section h1{
        color: #FFF;
    }
    @media(max-width: 768px){
        #countdown-section h1{
            font-size: 20px;
        }
    }
    #countdown-section .counter{
        font-size: 30px;
        color: #FFF;
        font-weight: bold;
    }
</style>
<section id="countdown-section" class="bg-primary container-fluid mb-3">
    <div class="">
        <div class="row">
            <div class="col-12 col-md-6 text-center">
                <h1 class="mt-0">Tournament Start</h1>
                <h1 class="mt-2">17 April 2025 3:00 PM</h1>
                <h1 class="mt-2">आज ही जॉइन करे ओर जीते </h1>
                <div class="counter" id="countdown">Loading...</div>
            </div>
            <div class="col-12 col-md-6 text-center">
                <img src="<?= base_url() ?>public/assets/images/UPPL.jpg" alt="" width="100%">
            </div>
        </div>
    </div>
</section>
<script>
    // Set the target date to 17 April 2025 at 3:00 PM
    const targetDate = new Date("April 21, 2025 15:00:00").getTime();

    const countdown = document.getElementById("countdown");

    const interval = setInterval(() => {
      const now = new Date().getTime();
      const distance = targetDate - now;

      if (distance < 0) {
        clearInterval(interval);
        countdown.innerHTML = "🎉 Tournament Start";
        return;
      }

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      countdown.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
    }, 1000);
  </script>