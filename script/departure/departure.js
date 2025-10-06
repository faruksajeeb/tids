            $(document).ready(function () {
                setInterval(function () {
                    $('#schedule').load('../view/departure_display.php'),
                            $('#clock1').load('../view/clock.php')
                }, 1000);
                setInterval('dispalyNewsTickers()', 1000);
            });
            function dispalyNewsTickers() {

                $.ajax({//create an ajax request to load_page.php
                    type: "GET",
                    url: "../view/tids_scroll_view.php",
                    dataType: "html", //expect html to be returned                
                    success: function (response) {
                        $("#text_scrolling").html(response);
                        //alert(response);
                    }

                });
            }
            $(window).load(function () {
                        $('#slider').nivoSlider();
                    });
                    $('#myModal').on('shown.bs.modal', function () {
                        $('#myInput').focus()
             })
             function blink(){
    //$('.blink').fadeIn(500);
    $('.blink').fadeOut(1200);
}
