<?php
include_once('config/config.php'); 
 //print_r($_POST); 
$location_query = (isset($_POST['location']) && $_POST['location'] != '')  ? 'location like "%'.$_POST['location'].'%" and ' : ''; 
$job_title_query = (isset($_POST['job_title'])&& $_POST['job_title'] != '')  ? 'title like "%'.$_POST['job_title'].'%" and ' : '';
$department_query = (isset($_POST['department']) && $_POST['department'] != '') ? 'department like "%'.$_POST['department'].'%" and' : '';
$experience_query = (isset($_POST['experience']) && $_POST['experience'] != '')  ?  'to_experience >= '.$_POST['experience'].' and' : '';

$result	= $objTypes->fetchAll("SELECT * FROM tbl_careers WHERE  $location_query  $department_query $job_title_query $experience_query  is_delete = 1 and is_active = 1 order by job_code asc");
$html = ''; 
if(sizeof($result) > 0){
	$html .='<div class="cr_block opening">
            <h3>Current Opening</h3>
          </div>
          <div class="opening_table_con">
            <div class="opening_details">
              <ul>
                <li class="th">
                  <span>Job Code</span>
                  <span>Job Title</span>
                  <span>Function</span>
                  <span>Education</span>
                  <span>Experience</span>
                  <span>Date</span>
                  <span></span>
                </li>
              </ul>
            </div>';
            foreach($result as $res){ 
            $html.='<div class="opening_details" id="opening_details">   
			  <ul>
			    <li>
			      <span>'.$res['job_code'].'</span>
			      <span>'.$res['title'].'<div class="loc">'.$res['location'].'</div></span>
			      <span>'.$res['department'].'</span>
			      <span>'.$res['education'].'</span>
			      <span>'.$res['from_experience'].'-'.$res['to_experience'].' years</span>
			      <span>'.date('d/m/Y',strtotime($res['from_date'])).'
			        <br> TO
			        <br>'.date('d/m/Y',strtotime($res['to_date'])).'</span>
					
			      <span><a href="'.base_url.'career-form-'.$res['id'].'" class="commanBtn">Apply Now</a></span>
			    </li>
			  </ul>
			   <div class="api_links">
	    <a href="'.base_url.'jobdetails-'.$res['id'].'">Read More</a>
	    <a href="javascript:void(0)" class="linkdinlog" id="'.$res['id'].'">Apply With</a>		
		 <!--script type="in/Login"></script-->
	  </div>';
			 }
		   $html.='</div>
	          </div>';
}
echo $html; 
?>