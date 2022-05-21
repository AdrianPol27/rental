<script src=".././assets/scripts/js/jquery-3.3.1.min.js"></script>
<script src=".././assets/scripts/js/popper.min.js"></script>
<script src=".././assets/scripts/js/bootstrap.min.js"></script>
<script src=".././assets/scripts/js/jquery.sticky.js"></script>

<script>
  // Sidebar Collapse Function
  $(document).ready(function() {  
    $('#sidebarCollapse').on('click', function() {
        $('#vertical-nav-toggle, #content').toggleClass('active');
    });
  });
</script>