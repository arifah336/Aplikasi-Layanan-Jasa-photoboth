@extends('layouts.user')

@section('title', 'About - PhotoBooth by Aurami')

@section('content')
<section class="pt-10 px-6 pb-16 max-w-4xl mx-auto">
  <div class="text-center mb-10">
    <h1 class="text-4xl font-bold mb-4">About Photobooth</h1>
    <p class="text-lg" style="color: #594a4e;">
      Photobooth captures the best moments of memories. We created this app to bring that experience home 😉👌
    </p>
  </div>

  <div class="card bg-white shadow-xl p-6 md:p-10 space-y-6">
    <div class="space-y-3" style="color: #594a4e;">
      <p>It started as a fun personal project to make photobooths more accessible with just a click.</p>
      <p>The goal was simple: recreate the classic photobooth feel with stacked photos, text overlays, and easy-to-save photo strips.</p>
      <p>Started as a small idea to help people set up a cost-effective photobooth at home. I'm grateful to everyone who has supported it—whether by using the app, sharing it, or sending suggestions.</p>
    </div>

    <div>
      <h2 class="text-3xl font-bold mb-3">FAQ</h2>

      <div class="collapse collapse-plus mb-2" style="background-color: #c3f0ca;">
        <input type="checkbox" />
        <div class="collapse-title font-medium">How do I use this site?</div>
        <div class="collapse-content" style="color: #594a4e;">
          <ol class="list-decimal pl-6 space-y-1">
            <li>Choose your preferred photo layout.</li>
            <li>Allow camera permissions.</li>
            <li>Pose for each photo—there's a 3-second countdown for each shot.</li>
            <li>Click "Done" or select "Retake" to try again.</li>
            <li>Customize your photo strip with colors, stickers, logo, or date overlays.</li>
            <li>Click "Download" to save it!</li>
          </ol>
        </div>
      </div>

      <div class="collapse collapse-plus mb-2" style="background-color: #c3f0ca;">
        <input type="checkbox" />
        <div class="collapse-title font-medium">Can I customize the photobooth strip?</div>
        <div class="collapse-content" style="color: #594a4e;">
          <p><strong style="color: #33272a;">Absolutely!</strong> You can personalize it with custom colors, stickers, date overlays, and logos.</p>
        </div>
      </div>

      <div class="collapse collapse-plus mb-2" style="background-color: #c3f0ca;">
        <input type="checkbox" />
        <div class="collapse-title font-medium">Can I choose my preferred layout?</div>
        <div class="collapse-content" style="color: #594a4e;">
          <p><strong style="color: #33272a;">Yes!</strong> Choose from 2, 3, 4, or 6-photo strip layouts.</p>
        </div>
      </div>

      <div class="collapse collapse-plus mb-2" style="background-color: #c3f0ca;">
        <input type="checkbox" />
        <div class="collapse-title font-medium">Do you store my photos or data?</div>
        <div class="collapse-content" style="color: #594a4e;">
          <p><strong style="color: #33272a;">Nope!</strong> Everything stays on your device. Nothing is uploaded or stored.</p>
        </div>
      </div>
    </div>

      <p class="italic text-sm text-right" style="color: #594a4e;">BY AURAMI_PHOTOBOOTH</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer footer-center p-4 text-base-content" style="background-color: #c3f0ca;">
    <aside>
      <p>&copy; <script>document.write(new Date().getFullYear())</script> - Created by AURAMI_PHOTOBOOTH</p>
    </aside>
  </footer>

</body>
</html>