<?php 
    $left = base_url('front/views/themes/WHITE-COAT/assets/').'img/left_arrow.png';
    $right = base_url('front/views/themes/WHITE-COAT/assets/').'img/right_arrow.png';
?>
    <section class="cum_txt">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br> Lorem ipsum doleor social networks.</p>
                </div>
            </div>
        </div>
    </section>
    
    <script type="text/javascript" src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/jquery.js"></script> 
    <script src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/bootstrap.js"></script>
    <script src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/moment.min.js"></script>
    <script src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/fullcalendar.min.js"></script>
    <script src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/jquery.maskedinput.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
    
    
    <script type="text/javascript">
        $(document).ready(function() {
            $("#owl-demo").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items :2,   
                itemsCustom : [
                [0, 1],
                [320, 1],
                [480, 1],
                [768, 2],
                [1200, 2],
                [1400, 2],
                [1600, 2],
                [1920, 2]
            ],
            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
                navigationText: [ 
                    $('.owl-prev').html(),
                    $('.owl-prev').html("<img src='<?php echo $left; ?>'>"),
                    $('.owl-next').html(),
                    $('.owl-next').html("<img src='<?php echo $right; ?>'>"),
                ],
                pagination:false,
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#owl-demoblog").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds                
                responsive : {
            0 : {
                items: 1,
            },
            767 : {
                items: 2,
            },    
          
            1200 : {
                items: 2,
            },
        },
            navigation : true, // Show next and prev buttons
            slideSpeed : 300,
            paginationSpeed : 400,
            nav: true,
    
            navText: [
                "<img src='<?php echo $left; ?>'>",
                    "<img src='<?php echo $right; ?>'>",
            ],
            pagination:false,
            });
        });
        
        var clicked=true;
        function drop(id) {  
            if(clicked)
            {
                clicked=false;
                $(".hoursdrop_"+id).slideDown({"display": 'block'});
            }
            else
            {
                clicked=true;
                $(".hoursdrop_"+id).slideUp({"display": "none"});
            }
        }
        
        $('.srvchover').hover(function(){  
            $('.srvchover img').hide();
            $(this).find('img').show();
        });
        
        $('.media').hover(function(){  
            $('.media .del_edu').hide();
            $(this).find('.del_edu').show();
        });
        
        $('#newservice-form').validate({
            rules:{
                srvc_name:{ required:true },
                srvc_desc:{ required:true }
            },
            messages:{}
        });
        
        $('#upload').on('change',function(){  
            if($(this).val() != "") {
                $('#upload-form').submit();
            }
        })
        
        $('#upload-form').on('submit',function(e){
            e.preventDefault();
                $.ajax({
                    type:'POST', 
                    url:'<?=base_url('consultant/uploadprofile')?>', 
                    data: new FormData(this), 
                    contentType: false,       
                    cache: false,             
                    processData:false,  
                    success:function(response)
                    {   
                        $('#useimgmain').attr('src',response)        
                    }
                });
            })
            
    </script>
    
    </body>
</html>
