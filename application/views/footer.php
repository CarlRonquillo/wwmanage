    <footer class="page-footer pt-0 mt-5 rgba-stylish-light">

        <div class="footer-copyright py-3 text-center">
              <div class="container-fluid">
                 © 2011 Copyright: <a href="http://www.nazarene.org/" target="_blank"> Church of the Nazarene. All rights reserved. </a>

            </div>
        </div>

    </footer>
    
    <script src="<?php echo base_url("assets/javascripts/jquery-3.3.1.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/javascripts/popper.min.js"); ?>"></script>
    <script src="<?php echo base_url("assets/javascripts/bootstrap.js"); ?>"></script>
    <script src="<?php echo base_url("assets/javascripts/mdb.min.js"); ?>"></script>


    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();

        var container = document.querySelector('.custom-scrollbar');
        Ps.initialize(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });
    </script>

    </body>
</html>