<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->db->cache_on();
        $this->load->model('front_model');
		$this->load->library('session');
    }
	
	public function index(){
		if(!$this->session->userdata('site_lang')){
			$this->load->view('frontend/landing');
		}else{
			$sliders = $this->front_model->get_all_post('slider');
			$testimonials = $this->front_model->get_all_post('testimonial');
			$data['slider']=$this->make_slider($sliders);
			$data['testimonial']=$this->make_testimonial($testimonials);
			
			$this->load->view('frontend/home', $data);
		}
	}
    
    // this function for make slider 
    public function make_slider($sliders){
        $list=null;
        $items=null;
        $img=null;
        $indicators=null;
        $active=null;
        $counter=0;
        $idicator_counter=0;
        if($sliders){
           
            foreach($sliders as $slider){
                $counter++;
                $idicator_counter=$counter-1;
                if($counter==1){$active='active';}else{$active=null;}
                $indicators.='<li data-target="#carouselExampleCaptions" data-slide-to="'.$idicator_counter.'" class="'.$active.'"></li>';
                $img_url = site_url($this->front_model->thumbnail_src($slider->thumbnail, 'big-size-thumb', true));
                
                $items.='
                <div class="carousel-item '.$active.'">
                    <img class="img-responsive" src="'.$img_url.'" alt="'.$slider->post_title.'" style="width:100%">
                    <!--<div class="carousel-caption d-none d-md-mone">
                      <h5>First slide label</h5>
                      <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                    </div>-->
                  </div>
                ';
            }
            $list.='
            <div class="bd-example">
              <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  '.$indicators.'
                </ol>
                <div class="carousel-inner">
                  '.$items.'
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
            ';
        }
        return $list;
    }
    
    
    // this fuction for make testimonial section
    public function make_testimonial($testimonials){
        $list=null;
        $items=null;
        $img=null;
        $counter=0;
        if($testimonials){
           
            foreach($testimonials as $testimonial){
                $counter++;
                
                $img_url = site_url($this->front_model->thumbnail_src($testimonial->thumbnail, 'big-size-thumb', true));
                
				if($this->session->userdata('site_lang')=='bd'){ 
					$items.='
                  
							<div class="col-sm-4">
								<a href="#">
									<div class="single_testimonial">
										<img class="img-fluid" src="'.$img_url.'" alt="Title">
										<h3> '.$testimonial->post_title.' </h3>
										<p> '.$testimonial->post_excerpt.'  </p>
									</div>
								</a>
							</div>
								';
				}
				else if($this->session->userdata('site_lang')=='en'){ 
					$items.='
                  
							<div class="col-sm-4">
								<a href="#">
									<div class="single_testimonial">
										<img class="img-fluid" src="'.$img_url.'" alt="Title">
										<h3> '.$testimonial->post_title_eng.' </h3>
										<p> '.$testimonial->post_excerpt_eng.'  </p>
									</div>
								</a>
							</div>
								';
				}     
            }
            $list.=$items;
        }
        return $list;
    }
    
    public function mysms1(){
        $this->load->helper('sms');
        $this->sms = new sms();
        $sign_up_sms = $this->user_model->get_setting_data('sign_up_sms');
        $mss_repsonse = $this->sms->send($to="+8801737963893", $sign_up_sms);
        echo $mss_repsonse;
        
    }
    public function mysms(){
        $this->load->helper('message_helper');
        $this->sms = new Message();
    }
    
    
    
    public function __destruct(){
        $this->db->cache_off();
    }
}


