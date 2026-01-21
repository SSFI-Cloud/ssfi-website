<?php require_once("config/config.php");?>
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
   <div class="app-brand demo">
      <a href="index.php" class="app-brand-link">
         <span class="app-brand-logo demo">
            <span style="color: var(--bs-primary)">
               <img src="assets/img/favicon/SSFI_main.png" alt="" style="heigth:25px; width:75px; border-radius:20px">
            </span>
         </span>
         <span class="app-brand-text demo menu-text fw-semibold ms-2">SSFI</span>
      </a>
      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
         <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path
               d="M8.47365 11.7183C8.11707 12.0749 8.11707 12.6531 8.47365 13.0097L12.071 16.607C12.4615 16.9975 12.4615 17.6305 12.071 18.021C11.6805 18.4115 11.0475 18.4115 10.657 18.021L5.83009 13.1941C5.37164 12.7356 5.37164 11.9924 5.83009 11.5339L10.657 6.707C11.0475 6.31653 11.6805 6.31653 12.071 6.707C12.4615 7.09747 12.4615 7.73053 12.071 8.121L8.47365 11.7183Z"
               fill-opacity="0.9" />
            <path
               d="M14.3584 11.8336C14.0654 12.1266 14.0654 12.6014 14.3584 12.8944L18.071 16.607C18.4615 16.9975 18.4615 17.6305 18.071 18.021C17.6805 18.4115 17.0475 18.4115 16.657 18.021L11.6819 13.0459C11.3053 12.6693 11.3053 12.0587 11.6819 11.6821L16.657 6.707C17.0475 6.31653 17.6805 6.31653 18.071 6.707C18.4615 7.09747 18.4615 7.73053 18.071 8.121L14.3584 11.8336Z"
               fill-opacity="0.4" />
         </svg>
      </a>
   </div>  
   <div class="menu-inner-shadow"></div>
   <ul class="menu-inner py-1">
      <?php  if (get_permission('club', 'is_view') || get_permission('skater', 'is_view') || get_permission('d-secretary', 'is_view') || get_permission('s-secretary', 'is_view')) { ?>  
      <li class="menu-item ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="ri-dashboard-fill"></i>
            <div data-i18n="Master Control">Master Control</div>
         </a>
         <ul class="menu-sub">
             <?php  if (get_permission('s-secretary', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="s-secretary-list.php" class="menu-link">
                  <div data-i18n=" State - Secretary"> State - Secretary</div>
               </a>
            </li>
            <?php }?> 
            
            <?php  if (get_permission('d-secretary', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="d-secretary-list.php" class="menu-link">
                  <div data-i18n="District - Secretary"> District - Secretary</div>
               </a>
            </li>
            <?php }?> 
            
             
             <?php  if (get_permission('club', 'is_view') ) { ?>
             <li class="menu-item">
               <a href="club-list.php" class="menu-link">
                  <div data-i18n="Club"> Club</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('skater', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="skater-list.php" class="menu-link">
                  <div data-i18n="Skater"> Skater</div>
               </a>
            </li>
            <?php }?>          
                         
                         
                
         </ul>
      </li>
     <?php } ?>
     <?php  if (get_permission('district_event', 'is_view') || get_permission('state_event', 'is_view') || get_permission('national_event', 'is_view')) { ?> 
      <li class="menu-item ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="ri-pages-fill"></i>
            <div data-i18n="Events">Events</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('district_event', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="district-events-list.php" class="menu-link">
                  <div data-i18n="District - Event">District - Event</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('state_event', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="state-event-list.php" class="menu-link">
                  <div data-i18n="State - Event">State - Event</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('national_event', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="national-event-list.php" class="menu-link">
                  <div data-i18n="National - Event">National - Event</div>
               </a>
            </li>
            <?php }?>          
         </ul>
      </li>
      <?php } ?>
      <?php  if (get_permission('register_fee_setup', 'is_view') || get_permission('transaction_history', 'is_view')) { ?> 
      <li class="menu-item ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="ri-truck-line"></i>
            <div data-i18n="Payments">Payments</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('register_fee_setup', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="fees.php" class="menu-link">
                  <div data-i18n="Register Fee Setup">Register Fee Setup</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('transaction_history', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="NDR-Exception_ndr.php" class="menu-link">
                  <div data-i18n="Transaction History">Transaction History</div>
               </a>
            </li>
            <?php }?>          
                
         </ul>
      </li> 
      <?php } ?>
      <?php  if (get_permission('results', 'is_view')) { ?> 
      <li class="menu-item ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="ri-truck-line"></i>
            <div data-i18n="Results">Results</div>
            <!--<div class="badge bg-danger rounded-pill ms-auto">5</div>-->
         </a>
         <ul class="menu-sub">
                  
                <?php  if (get_permission('results', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="NDR-Exception_ndr.php" class="menu-link">
                  <div data-i18n="Results">Results</div>
               </a>
            </li>
            <?php }?>          
              
         </ul>
      </li> 
      <?php } ?>
      <?php  if (get_permission('skatar_report', 'is_view') || get_permission('club_report', 'is_view') || get_permission('secretary_report', 'is_view')
              || get_permission('event_registor_report', 'is_view')|| get_permission('overall_report', 'is_view')) { ?> 
      <li class="menu-item ">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="ri-currency-line"></i>
                <div data-i18n="Reports">Reports</div>
            <!--<div class="badge bg-danger rounded-pill ms-auto">5</div>-->
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('skatar_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="skater_report.php" class="menu-link">
                  <div data-i18n="Skater Reports">Skater Reports</div>
               </a>
            </li>
         <?php }?>          
                <?php  if (get_permission('club_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="club_report.php" class="menu-link">
                  <div data-i18n="Club Report">Club Report</div>
               </a>
            </li>
         <?php }?>          
                <?php  if (get_permission('secretary_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="s-secretary-report.php" class="menu-link">
                  <div data-i18n="State Secretary Report">State Secretary Report</div>
               </a>
            </li>
        <?php }?>   
        <?php  if (get_permission('secretary_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="d-secretary-report.php" class="menu-link">
                  <div data-i18n="District Secretary Report">District Secretary Report</div>
               </a>
            </li>
        <?php }?>   
                <?php  if (get_permission('event_registor_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="events-report.php" class="menu-link">
                  <div data-i18n="Event Register Report">Event Register Report</div>
               </a>
            </li>
        <?php }?>          
                <?php  if (get_permission('overall_report', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="finance_customer_reports.php" class="menu-link">
                  <div data-i18n="Overall Event Report">Overall Event Report</div>
               </a>
            </li>
            <?php }?>          
         </ul>

      </li>
      <?php } ?>
      <?php  if (get_permission('club_renewal', 'is_view') || get_permission('skator_renewal', 'is_view') || get_permission('secretory_renewal', 'is_view')
              || get_permission('faq', 'is_view')) { ?> 
      <li class="menu-item">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
             <i class="ri-signal-tower-line"></i>
            <div data-i18n="Renewal Report">Renewal Report</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('club_renewal', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="ic_customers_support.php" class="menu-link">
                  <div data-i18n="Club Renewal">Club Renewal</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('skator_renewal', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="ic_customers_support.php" class="menu-link">
                  <div data-i18n="Skater Renewal">Skater Renewal</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('secretory_renewal', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="master-rate-calculator.php" class="menu-link">
                  <div data-i18n="Secerotory Renewal">Secerotory Renewal</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('faq', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="ic_faqs.php" class="menu-link">
                  <div data-i18n="FAQs">FAQs</div>
               </a>
            </li>
            <?php }?>          
         </ul>
      </li>
      <?php } ?>
      
      <?php  if (get_permission('user', 'is_view') || get_permission('role', 'is_view')) { ?> 
      <li class="menu-item">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="ri-contacts-line"></i>
            <div data-i18n="Role Management">Role Management</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('role', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="setting-role.php" class="menu-link">
                  <div data-i18n="Role">Role</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('user', 'is_view') ) { ?> 
            <!--<li class="menu-item">-->
            <!--   <a href="setting-permission.php" class="menu-link">-->
            <!--      <div data-i18n="Role">Role</div>-->
            <!--   </a>-->
            <!--</li>-->
            <?php }?>          
                
        </ul>
    </li>
      <?php } ?>
      <?php  if (get_permission('global_setting', 'is_view') || get_permission('district', 'is_view')|| get_permission('annocement_admin', 'is_view')) { ?> 
      <li class="menu-item">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
           <i class="ri-team-line"></i>
            <div data-i18n="Settings">Settings</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('global_setting', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="hr-employee.php" class="menu-link">
                  <div data-i18n="Global Setting">Global Setting</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('district', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="District">District</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('annocement_admin', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="Anouncement - Admin">Anouncement - Admin</div>
               </a>
            </li>
            <?php }?>          

        </ul>
            
        </li>
        <?php } ?>
      <?php  if (get_permission('general_setting', 'is_view') || get_permission('slider', 'is_view')|| get_permission('annocement', 'is_view')|| get_permission('flash_alert', 'is_view')) { ?> 
      <li class="menu-item">
         <a href="javascript:void(0);" class="menu-link menu-toggle">
           <i class="ri-team-line"></i>
            <div data-i18n="Front End Settings">Front End Settings</div>
         </a>
         <ul class="menu-sub">
                <?php  if (get_permission('general_setting', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="General - Settings">General - Settings</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('slider', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="Slider">Slider</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('annocement', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="Announcement">Announcement</div>
               </a>
            </li>
            <?php }?>          
                <?php  if (get_permission('flash_alert', 'is_view') ) { ?> 
            <li class="menu-item">
               <a href="" class="menu-link">
                  <div data-i18n="Flash Alert">Flash Alert</div>
               </a>
            </li>
            <?php }?>          
               
        </ul>
            
        </li>
        <?php } ?>
      
   
</aside>

