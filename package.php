<?php echo Modules::run('Header/Header/index');  
$image = substr($client->profile,'0','4');
$Customer = $this->session->userdata('user_id');
$PID = $packagedetail->PkgId;
switch ($image) {
    case "http":
        $profile = $client->profile;
        break;
    case "user":
        $profile = getuploadpath().'upload/user/'.$client->id.'/'.$client->profile;
        break;
    default:
        $profile = base_url('admin/views/themes/WHITE-COAT/assets/').'img/default_user.png';
}
?>

<div class="space158"></div>
<section class="circle_logo_sec">
    <div class="container">
        <div class="row">
            <img src="<?php echo getuploadpath().'upload/company/'.$packagedetail->CPLOGO;?>" class="img-responsive logo_img" alt="...">
            <div class="col-md-10 col-md-offset-2 col-sm-9 col-sm-offset-3 col-xs-8 col-xs-offset-4">            
                <h4><?php echo $packagedetail->CPNAME ?></h4>
            </div>
        </div>
    </div>
</section> 
<!---->
<section class="introductory_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php echo $packagedetail->CPDESC ?>
            </div>
        </div>
    </div>
</section>
<!---->
<section class="pack_descr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="main_text">Package Description</h1>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <?php echo $packagedetail->Description ?>
            </div>
            <div class="col-md-6 col-sm-6">
                <img src="<?php echo getuploadpath().'upload/package/'.$packagedetail->Cover?>" class="img-responsive center-block" alt="..">
            </div>
        </div>
        
        <div class="space20"></div>
        
        <div class="row">
            <div class="col-md-12">
                <?php echo $packagedetail->Long_Description ?>  
            </div>
            <div class="col-md-12">
                <button type="button" class="btn btn_profile">Package Price $<?=$packagedetail->Price?></button>
                <?php 
                $purchase = $this->db->query("SELECT * FROM tbl_plan_payment WHERE Deleted = '0' AND Pack_status='0' AND Customer = '$Customer' AND Package = '$PID'")->num_rows();
                if($purchase !='0') {  ?>
                <button type="button" class="btn btn_profile">Already Purchased</button>
                <?php } else { ?> 
                    <button type="button" class="btn btn_profile" data-toggle="modal" data-target="#exampleModal">Purchase Package</button>
                <?php }
                ?>
                
            </div>
        </div>
    </div>
</section>
<!---->
<?php 
$purchaseone = $this->db->query("SELECT * FROM tbl_plan_payment WHERE Deleted = '0' AND Pack_status='0' AND Customer = '$Customer'")->num_rows();
if($purchaseone !='0') {  ?>
<section class="view_profile">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="main_text">Get guidance from a Professional Consultant</h1>
                <div class="row pbtm20">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="search" id="container-search" class="form-control" placeholder="Search a consultant here..." aria-describedby="basic-addon2">
                                <span class="input-group-addon" id="basic-addon2"><i class="fa fa-search" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="consult">
                    <div id="searchable-container">  
                        <?php if(!empty($allConsultant)): foreach($allConsultant as $consult):
                        $this->load->library('encrypt');
                        $enc_id=$this->encrypt->encode($consult['id']);
                        $enc_cv_id=str_replace(array('+', '/', '='), array('-', '_', '~'), $enc_id);
                        ?>
                        <div class="white_box image_sectiondr">
                            <div class="media">
                                <div class="media-left">
                                    <img src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>img/layer12.png" alt="...">
                                </div>
                                <div class="media-body">
                                    <h5 id="name"><?php echo ucwords($consult['username'])?></h5>
                                    <ul class="list-unstyled">
                                        <?php 
                                        $packId =  $consult['Package'];
                                        $pId = explode(',',$packId); 
                                        foreach($pId as $key){
                                            $data = $this->db->query("SELECT * FROM tbl_package WHERE PkgId ='$key' ")->row();
                                        ?>
                                        <li><?=$data->Name?> - <?=substr($data->Description,0,100)?></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo base_url('store/consultant/').$enc_cv_id?>" class="btn btn_profile">View Profile</a>
                                <button type="button" class="btn btn_profile">Mark as Interested</button>
                            </div>
                        </div>
                        
                        <?php endforeach; else :?>
                        <div class="image_sectiondr">
                              <h1 class="main_text">Consultant(s) not Found.</h1>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<style>
.spin-loader {
  height: 100px;
  background: url("http://awariindia.com/yana/public/img/loader.gif") no-repeat center center transparent;
  position: relative;
  top: 35%;
  height: 160px;
}
</style>
<!---->
<div class="modal payment_model fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="loading-overlay">
                <div class="spin-loader"></div>
            </div>
            <section class="consultant_banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                
                        </div>
                    </div>
                </div>
            </section>
            <?php echo form_open('',array('id'=>'payment-form'));?>
            <input type="hidden" name="userid" id="userid" value="<?=$this->session->userdata('user_id')?>">
            <input type="hidden" name="plan_type" id="plan_type" value="Collection">
            <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $packagedetail->PkgId ?>">
            <input type="hidden" name="plan_name" id="plan_name" value="<?php echo $packagedetail->Name ?>">
            <input type="hidden" name="amount" id="amount" value="<?php echo $packagedetail->Price ?>">
            <input type="hidden" name="description" id="description" value="<?php echo $packagedetail->Description ?>">
            <input type="hidden" name="email" id="email" value="<?php echo $client->email ?>">
            <section class="natus_sec">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <img src="<?=$profile?>" class="img-responsive center-block layer13" alt="">
                        <h1><?=ucwords($client->username)?></h1>
                        <h5><?=$client->email?></h5>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <div class="pull-left white_box wbox">
                            <p>Package Name : <?php echo ucwords($packagedetail->Name); ?></p>
                            <p>Package Price : <?php echo '$'.$packagedetail->Price; ?></p>
                        </div>
                    </div>
                </div>
                <div class="white_box cardpay">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-wrapped full" id="validateCard">
                                    <label>Card Number</label>
                                    <input type="text" size="20" name="ccNumber" class="form-control" maxlength="16" id="cardnumber" class="full" placeholder="1234 5678 9012 3456" data-mask="1234 5678 9012 3456" data-creditcard="true">
                                    <i class="icon-ok"></i>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Month </label>
                                    <select class="form-control" name="card_month" id="card_month">
                                        <option value="">MM</option>
                                        <?php 
                                        for ($i=1; $i<=12 ; $i++) {
                                        ?>
                                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                        } ?>
                                    </select> 
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Year</label>
                                    <input type="text" class="form-control" name="card_year" id="card_year" data-mask="9999" placeholder="Year" aria-required="true" aria-invalid="false">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>CVV </label>
                                    <input maxlength="3" type="text" class="form-control" placeholder="CVV" id="cvv" name="cvv" aria-required="true">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="white_box showpay" style="display:none">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h5></h5>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn_profile closemodel" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn_profile one">Make Payment</button>
                </div>
            </section>
            <?php echo form_close();?>
        </div>
    </div>
</div>
<!---->
<?php echo Modules::run('Footer/Footer/index');?>
<script type="text/javascript" src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/jquery.creditCardValidator.js"></script>
<script type="text/javascript" src="<?php echo base_url('front/views/themes/WHITE-COAT/assets/') ?>js/creditcard.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.js"></script>
<script src="//rawgithub.com/stidges/jquery-searchable/master/dist/jquery.searchable-1.0.0.min.js"></script>
<script type="text/javascript">

$(function () {
    $( '#consult' ).searchable({
        striped: true,
        oddRow: { 'background-color': '#f5f5f5' },
        evenRow: { 'background-color': '#fff' },
        searchType: 'fuzzy'
    });

    $( '#searchable-container' ).searchable({
        searchField: '#container-search',
        selector: '.image_sectiondr',
        childSelector: '#name',
        show: function( elem ) {
            elem.slideDown(100);
        },
        hide: function( elem ) {
            elem.slideUp( 100 );
        }
    })
});

$('#payment-form').validate({
    rules:{
        ccNumber:{ required:true },
        card_month:{ required:true },
        card_year:{ required:true },
        cvv:{ required:true }
    },
    messages:{
        ccNumber:{ required:'Please enter valid card number.' },
        card_month:{ required:'Month' },
        card_year:{ required:'Year' },
        cvv:{ required:'CVV' }
    },
    submitHandler: function (form) {
        var data = $('#payment-form').serialize();
        $('.loading-overlay').show();
        $.ajax({
            'type':'POST',
            'url':'<?=base_url('stripe_payment/checkout')?>',
            'data':data,
            success:function(data)
            {
                $('.loading-overlay').hide();
                $('.cardpay').hide();
                $('.one').hide();
                $('.showpay').css('display','block');
                $('.showpay h5').html(data);
            }
        });
    }
});
$(document).ready(function(){
    $("#cardnumber").mask("9999999999999999");
    $("#card_year").mask("9999");
    $("#cvv").mask("999");
});

</script>