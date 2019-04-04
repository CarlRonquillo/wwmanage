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
    <script src="<?php echo base_url("assets/javascripts/datatables.min.js"); ?>"></script>

    <script src="<?php echo base_url("assets/javascripts/autofill.js"); ?>"></script>

    <script>
        // SideNav Initialization
        $(".button-collapse").sideNav();

        var container = document.querySelector('.custom-scrollbar');
        Ps.initialize(container, {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20
        });

            $(function(){
        showNotifications();

        function showNotifications(){
            $.ajax({
                type:'ajax',
                url:'<?php echo base_url() ?>Project/showNotifications',
                async: false,
                dataType: 'json',
                success: function(data){
                    var html = '';
                    var badge = 0;
                    var i;
                    if(data.length > 0)
                    {
                        for(i=0;i < data.length; i++)
                        {
                            html += '<a class="dropdown-item '+ (data[i].Seen == 1 ? '': 'light-blue lighten-4') + '" href="<?php echo base_url() ?>Project/viewFromNotif/'+ data[i].FKProjectID  +'/' + data[i].LogsID +'">'+
                                        '<i class="fa fa-lightbulb-o" aria-hidden="true"></i>' +
                                        '<span><b> '+ data[i].ProjectName + '</b></span><br>' +
                                        '<span> ' + data[i].Title + ' by ' + data[i].CreatedBy + '</span>' +
                                        '<span class="float-right"><i class="fa fa-clock-o" aria-hidden="true"></i> ' + data[i].timedate + '</span>'+
                                    '</a>'
                            if(data[i].Seen == 0)
                            {
                                badge += 1;
                            }
                        }
                        $('#notif').html(html);
                        (badge > 0 ? $('#notifBadge').html(badge) : '');
                    }
                },
                //error: function(){
                //    alert('Could not get notifications');
                }
            })
        }
    })
    </script>

    </body>
</html>