</div>

</body>
<footer class="text-muted py-4">
  <div class="container">
    <p class="float-end mb-1">
      <a href="#">Back to top</a>
    </p>
    <p class="mb-0">Developed by <a href="https://egavilanmedia.com" target="_blank">EGavilan Media</a></p>
  </div>
</footer>
  <script>
      const base_url = "<?= base_url(); ?>";
  </script>

    <!-- Essential javascripts for application to work -->
    <script src="<?= media(); ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media(); ?>/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= media(); ?>/js/functions.js"></script>
    <script src="<?= media(); ?>/js/<?= $data['page_functions_js']; ?>"></script>
    <!-- Page specific javascripts-->
    <script type="text/javascript" src="<?= media(); ?>/js/plugins/alertify.js"></script>
<!-- </footer> -->
</html>