<?php 
$user_data = $this->user_model->get_user($this->session->userdata('current_user_id'));
$user_type = $this->session->userdata('current_user_type');
$total_message_count = $this->user_model->new_message_count();

$template = $this->uri->segment(2);
$submenu = $this->uri->segment(3);
$third_menu = $this->uri->segment(4);
$dashboard = '';
$message = '';
$users = '';
$all_users = '';
$add_new_user = '';

//this variable for members
$members ='';
$all_new_members ='';
$all_members ='';

//this variable for members
$account ='';
$account_category ='';
$add_account='';
$observe_account='';

//this variable for members
$staff ='';
$all_staff ='';
$add_new_staff='';
$report='';

//this variable for members
$lonch ='';
$destination ='';
$lonch_group ='';
$add_new_lonch_group ='';
$all_lonch='';
$all_discount_lonch='';
$add_new_lonch='';
$cabin_type='';

//this variable for members
$payments ='';
$all_payment ='';
$search_payment ='';

//this variable for members
$booking ='';
$all_booking ='';
$add_discount_booking ='';
$offline_booking ='';

//this variable for members
$page ='';
$all_page ='';
$add_new_page ='';
$all_notice ='';
$add_new_notice ='';
$all_slider ='';
$add_new_slider ='';
$all_testimonial ='';
$add_new_testimonial ='';

//this variable for members
$settings ='';
$wallet_mix ='';
$sms_setting ='';
$terminal_map_setting ='';
$website_header ='';
$website_footer ='';
$home_download ='';
$home_testimonial ='';

if($template=='agents'){ $members ='active'; }
if($template=='message'){ $message ='active'; }
elseif($template=='users'){ $users='active'; }
elseif($template=='users'){ $users='active'; }
elseif($template=='dashboard'){ $dashboard='active'; }
elseif($template=='account'){ $account='active'; }
elseif($template=='staff'){ $staff='active'; }
elseif($template=='lonch'){ $lonch='active'; }
elseif($template=='posts'){ $page='active'; }
elseif($template=='settings'){ $settings='active'; }
elseif($template=='booking'){ $booking='active'; }

/*Sub menu handalling*/
if($submenu=='all_user' or $submenu=='edit_user'){ $all_users='active'; }
if($submenu=='add_new'){ $add_new_user='active'; }

if($template=='account' and $submenu=='account_category'){ $account_category ='active'; }
if($template=='account' and $submenu=='add_account'){ $add_account ='active'; }
if($template=='account' and $submenu=='account_observation'){ $observe_account ='active'; }
if($template=='staff' and $submenu=='all_staff'){ $all_staff ='active'; }
if($template=='staff' and $submenu=='add_new'){ $add_new_staff ='active'; }

if($template=='staff' and $submenu=='report'){ $report ='active'; }
if($template=='lonch' and $submenu=='lonch_groups'){ $lonch_group ='active'; }
if($template=='lonch' and $submenu=='all_lonch'){ $all_lonch ='active'; }
if($template=='lonch' and $submenu=='add_new_lonch'){ $add_new_lonch ='active'; }
if($template=='lonch' and $submenu=='destination'){ $destination ='active'; }
if($template=='lonch' and $submenu=='cabin_type'){ $cabin_type ='active'; }

if($template=='posts' and $submenu=='type' and $third_menu=='page'){ $all_page ='active'; }
if($template=='posts' and $submenu=='add_new' and $third_menu=='page'){ $add_new_page ='active'; }

if($template=='posts' and $submenu=='type' and $third_menu=='notice'){ $all_notice ='active'; }
if($template=='posts' and $submenu=='add_new' and $third_menu=='notice'){ $add_new_notice ='active'; }

if($template=='posts' and $submenu=='type' and $third_menu=='testimonial'){ $all_testimonial ='active'; }
if($template=='posts' and $submenu=='add_new' and $third_menu=='testimonial'){ $add_new_testimonial ='active'; }

if($template=='posts' and $submenu=='type' and $third_menu=='slider'){ $all_slider ='active'; }
if($template=='posts' and $submenu=='add_new' and $third_menu=='slider'){ $add_new_slider ='active'; }

if($template=='settings' and $submenu=='walletmix'){ $wallet_mix ='active'; }
if($template=='settings' and $submenu=='sms'){ $sms_setting ='active'; }
if($template=='settings' and $submenu=='terminal'){ $terminal_map_setting ='active'; }
if($template=='settings' and $submenu=='website_header'){ $website_header ='active'; }
if($template=='settings' and $submenu=='website_footer'){ $website_footer ='active'; }
if($template=='settings' and $submenu=='home_download'){ $home_download ='active'; }
if($template=='settings' and $submenu=='home_testimonial'){ $home_testimonial ='active'; }

if($template=='booking' and $submenu=='all_booking'){ $all_booking ='active'; }
if($template=='booking' and $submenu=='discount_booking'){ $add_discount_booking ='active'; }
if($template=='booking' and $submenu=='offline'){ $offline_booking ='active'; }
?>
 <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo site_url('uploads/users/'.$user_data->image); ?>" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?php echo $user_data->first_name.' '.$user_data->last_name; ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu">
			<li class="header">MAIN NAVIGATION</li>
			
			<li class="<?php echo $dashboard; ?> treeview">
				<a href="<?php echo site_url('admin/dashboard'); ?>"><i class="fa fa-dashboard text-yellow"></i> <span>Dashboard</span></a>
			</li>
			
			<?php if($user_type!='manager'){ ?>
					<li class="treeview <?php echo $lonch; ?>">
						<a href="#">
							<i class="fa fa-ship"></i>
							<span>Lonch</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
						</a>
						<ul class="treeview-menu">
							<?php if($user_type=='admin'):  ?>
								<li class="<?php echo $destination; ?>"><a href="<?php echo site_url('admin/lonch/destination'); ?>"><i class="fa  fa-map-marker"></i>Destination</a></li>
							<?php endif; ?>
							<!--<li class="<?php // echo $cabin_type; ?>"><a href="<?php //echo site_url('admin/lonch/cabin_type'); ?>"><i class="fa fa-random"></i>Cabin Type</a></li>-->
							<li class="<?php echo $lonch_group; ?>"><a href="<?php echo site_url('admin/lonch/lonch_groups'); ?>"><i class="fa  fa-object-group"></i>Lonch Groups</a></li>
							<!--<li class="<?php //echo $add_new_lonch_group; ?>"><a href="<?php //echo site_url('admin/lonch/add_new_group'); ?>"><i class="fa  fa-plus-circle"></i>Add New Group</a></li>-->
							<li class="<?php echo $all_lonch; ?>"><a href="<?php echo site_url('admin/lonch/all_lonch'); ?>"><i class="fa fa-ship"></i>All Lonch</a></li>
							<!--<li class="<?php //echo $all_discount_lonch; ?>"><a href="<?php //echo site_url('admin/lonch/all_discount_lonch'); ?>"><i class="fa fa-ship"></i>All Discount Lonch</a></li>
							<li class="<?php //echo $add_new_lonch; ?>"><a href="<?php //echo site_url('admin/lonch/add_new_lonch'); ?>"><i class="fa fa-plus-circle"></i>Add New Lonch</a></li>-->
						</ul>
					</li>
			<?php } ?>
     
			<li class="treeview <?php echo $booking; ?>">
				<a href="#"><i class="fa fa-pencil-square-o"></i><span>Booking</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
				<ul class="treeview-menu">
					<li class="<?php echo $all_booking; ?>"><a href="<?php echo site_url('admin/booking/all_booking'); ?>"><i class="fa  fa-list"></i>All booking</a></li>
					<li class="<?php echo $offline_booking ?>"><a href="<?php echo site_url('admin/booking/offline'); ?>"><i class="fa  fa-power-off"></i>Offline Booking</a></li>
					<li class="<?php echo $add_discount_booking; ?>"><a href="<?php echo site_url('admin/booking/add_discount_booking'); ?>"><i class="fa  fa-list"></i>Add Discount Rules</a></li>
				</ul>
			</li>
        
			<!--<li class="treeview <?php //echo $payments; ?>">
					<a href="#"><i class="fa fa-money"></i>
					<span>Payments</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li class="<?php //echo $all_payment; ?>"><a href="<?php //echo site_url('admin/payment/all_payments'); ?>"><i class="fa fa-list"></i>All Payments</a></li>
						<li class="<?php //echo $search_payment; ?>"><a href="<?php //echo site_url('admin/payment/search_payment'); ?>"><i class="fa fa-search"></i>Search Payment</a></li>
					</ul>
			</li>-->
     
			<?php if($user_type!='manager'): ?>
				<li class="treeview <?php echo $users; ?>">
					<a href="#"><i class="fa fa-users"></i><span>Users</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
					<ul class="treeview-menu">
						<li class="<?php echo $all_users; ?>"><a href="<?php echo site_url('admin/users/all_user'); ?>"><i class="fa fa-list"></i> All Users</a></li>
						<li class="<?php echo $add_new_user; ?>"><a href="<?php echo site_url('admin/users/add_new'); ?>"><i class="fa fa-plus-circle"></i>Add New User</a></li>
					</ul>
				</li>
			<?php endif; ?>
        
			<?php if($user_type == 'admin'): ?>
					<li class="treeview <?php echo $account; ?>">
						<a href="#"><i class="fa fa-calculator"></i><span>Accounts</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li class="<?php echo $account_category; ?>"><a href="<?php echo site_url('admin/account/account_category'); ?>"><i class="fa fa-list"></i> Account Category</a></li>
							<li class="<?php echo $add_account; ?>"><a href="<?php echo site_url('admin/account/add_account'); ?>"><i class="fa fa-plus-circle"></i>  Account Add</a></li>
							<li class="<?php echo $observe_account; ?>"><a href="<?php echo site_url('admin/account/account_observation'); ?>"><i class="fa fa-search"></i> Account Obersve</a></li>
						</ul>
					</li>
					<li class="treeview <?php echo $staff; ?>">
						<a href="#"><i class="fa fa-users"></i><span>Staff</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li class="<?php echo $all_staff; ?>"><a href="<?php echo site_url('admin/staff/all_staff'); ?>"><i class="fa fa-list"></i> All Staff</a></li>
							<li class="<?php echo $add_new_staff; ?>"><a href="<?php echo site_url('admin/staff/add_new'); ?>"><i class="fa fa-plus-circle"></i>Add New Staff</a></li>
							<li class="<?php echo $report; ?>"><a href="<?php echo site_url('admin/staff/report'); ?>"><i class="fa fa-signal"></i>Salary Report</a></li>
						</ul>
					</li>
					<li class="<?php echo $message; ?>">
						<a href="<?php echo site_url('admin/message'); ?>">
							<i class="fa fa-envelope"></i><span>Message</span>
							<span class="pull-right-container"><small class="label pull-right bg-green"><?php echo $total_message_count; ?> Messages</small></span>
						</a>
					</li>
					<li class="treeview <?php echo $settings.$page; ?>">
						<a href="#"><i class="fa fa-cogs"></i><span>Settings</span>
						<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
						<ul class="treeview-menu">
							<li class="<?php echo $wallet_mix; ?>"><a href="<?php echo site_url('admin/settings/walletmix'); ?>"><i class="fa  fa-google-wallet"></i> Wallet Mix Pament</a></li>
							<li class="<?php echo $sms_setting; ?>"><a href="<?php echo site_url('admin/settings/sms'); ?>"><i class="fa  fa fa-envelope"></i> SMS Setting</a></li>
							<li class="<?php echo $terminal_map_setting; ?>"><a href="<?php echo site_url('admin/settings/terminal'); ?>"><i class="fa fa-map-marker"></i> Terminal Map Setting</a></li>
							
							<li class="<?php echo $website_header.$website_footer.$home_download.$home_testimonial; ?>">
								<a href="#"><i class="fa fa-television"></i>Website Settings<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
								<ul class="treeview-menu">
									<li class="<?php echo $website_header; ?>"><a href="<?php echo site_url('admin/settings/website_header'); ?>"><i class="fa fa-level-up"></i> Header  </a></li>
									<li class="<?php echo $website_footer; ?>"><a href="<?php echo site_url('admin/settings/website_footer'); ?>"><i class="fa fa-level-down"></i> Footer  </a></li>
									<li class="<?php echo $home_download; ?>"><a href="<?php echo site_url('admin/settings/home_download'); ?>"><i class="fa fa-download"></i> Home Download  </a></li>
									<li class="<?php echo $home_testimonial; ?>"><a href="<?php echo site_url('admin/settings/home_testimonial'); ?>"><i class="fa  fa-object-group"></i> Home Testimonial  </a></li>
								</ul>
							</li>

							<li class="treeview <?php echo $page; ?>">
								<a href="#"><i class="fa fa-file-text"></i><span>Page</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
								<ul class="treeview-menu">
									<li class="<?php echo $all_page; ?>"><a href="<?php echo site_url('admin/posts/type/page'); ?>"><i class="fa fa-list"></i> All Pages</a></li>
									<li class="<?php echo $add_new_page; ?>"><a href="<?php echo site_url('admin/posts/add_new/page'); ?>"><i class="fa fa-plus-circle"></i>Add New page</a></li>
									<li class="<?php echo $all_slider; ?>"><a href="<?php echo site_url('admin/posts/type/slider'); ?>"><i class="fa fa-list"></i> All Slider</a></li>
									<li class="<?php echo $add_new_slider; ?>"><a href="<?php echo site_url('admin/posts/add_new/slider'); ?>"><i class="fa fa-plus-circle"></i>Add New Slider</a></li>
									<li class="<?php echo $all_notice; ?>"><a href="<?php echo site_url('admin/posts/type/notice'); ?>"><i class="fa fa-list"></i> All Notice</a></li>
									<li class="<?php echo $add_new_notice; ?>"><a href="<?php echo site_url('admin/posts/add_new/notice'); ?>"><i class="fa fa-plus-circle"></i>Add New Notice</a></li>
									<li class="<?php echo $all_testimonial; ?>"><a href="<?php echo site_url('admin/posts/type/testimonial'); ?>"><i class="fa fa-list"></i> All Testimonial</a></li>
									<li class="<?php echo $add_new_testimonial; ?>"><a href="<?php echo site_url('admin/posts/add_new/testimonial'); ?>"><i class="fa fa-plus-circle"></i>Add New Testimonial</a></li>
								</ul>
							</li>
						</ul>
					</li>
			<?php endif; ?>
			<li class="treeview"><a href="<?php echo site_url('logout'); ?>"><i class="fa fa-power-off text-yellow"></i> <span>Log Out</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>