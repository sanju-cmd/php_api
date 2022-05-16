<?php
	require 'connect.php';
	if(isset($_POST['flag'])){
		$flag=$_POST['flag'];
		// $flag="ReferralCode";
		switch($flag){
			case 'AddManager':
            $m_id=$_POST['m_id'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $password=$_POST['password'];
           
			$sponsorID="ZPSMANAGER";
			$otp="123456";//mt_rand(100000,999999); 
			
			$user_img="Avatar-Transparent-Background-PNG.png";
			if( empty($mobile)){
                $output['res']='error';
				$output['msg']='Field Required';
            }
            else{
				$query="SELECT * FROM `tbl_manager` WHERE `mobile`='$mobile'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){

					
						$output['res']='error';
						$output['msg']='Mobile Number Already Exist !';
					
				}
				else
				{
					 $query="SELECT * FROM `tbl_manager` WHERE `id`='$m_id'";
				  $result1=mysqli_query($conn,$query);
				  $dat=mysqli_fetch_assoc($result1);
				  
				  $sp_id=$dat['sponsorID'];
				  
					$result=mysqli_query($conn,"insert into tbl_manager (name,email,password,mobile,referral_id,image,otp,otp_status,wallet,commission,status,delete_status,date,time) values ('$name','$email','$password','$mobile','$sp_id','$user_img','$otp','true','0','0','true','false','$date','$time')");
						if($result){
							
							$query12="SELECT * FROM `tbl_manager` WHERE `mobile`='$mobile'";
							$result12=mysqli_query($conn,$query12);
							if(mysqli_num_rows($result12)>0){
								$row=mysqli_fetch_assoc($result12);
								$sponsorID=$sponsorID."".$row['id'];
								$query2="update `tbl_manager` set sponsorID='$sponsorID' WHERE `mobile`='$mobile'";
							   $result2=mysqli_query($conn,$query2);
								$output['res']='success';
								$output['msg']='OTP Send to your Mobile Number';
							}
						}
						else{
							$output['res']='error';
							$output['msg']='Something went wrong';
						} 
				}
                
            }
			echo json_encode($output);
            
            break;
			case 'AddUser':
            $m_id=$_POST['m_id'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $password=$_POST['password'];
           
			$sponsorID="ZPSUSER";
			$otp="123456";//mt_rand(100000,999999); 
			
			$user_img="Avatar-Transparent-Background-PNG.png";
			if( empty($mobile)){
                $output['res']='error';
				$output['msg']='Field Required';
            }
            else{
				$query="SELECT * FROM `tbl_user` WHERE `mobile`='$mobile'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){

					
						$output['res']='error';
						$output['msg']='Mobile Number Already Exist !';
					
				}
				else
				{
					 $query="SELECT * FROM `tbl_manager` WHERE `id`='$m_id'";
				  $result1=mysqli_query($conn,$query);
				  $dat=mysqli_fetch_assoc($result1);
				  
				  $sp_id=$dat['sponsorID'];
					$result=mysqli_query($conn,"insert into tbl_user (m_id,name,email,password,mobile,image,otp,otp_status,wallet,commission,status,delete_status,date,time) values ('$sp_id','$name','$email','$password','$mobile','$user_img','$otp','true','0','0','true','false','$date','$time')");
						if($result){
							
							$query12="SELECT * FROM `tbl_user` WHERE `mobile`='$mobile'";
							$result12=mysqli_query($conn,$query12);
							if(mysqli_num_rows($result12)>0){
								$row=mysqli_fetch_assoc($result12);
								$sponsorID=$sponsorID."".$row['id'];
								$query2="update `tbl_user` set sponsorID='$sponsorID' WHERE `mobile`='$mobile'";
							   $result2=mysqli_query($conn,$query2);
								$output['res']='success';
								$output['msg']='OTP Send to your Mobile Number';
							}
						}
						else{
							$output['res']='error';
							$output['msg']='Something went wrong';
						} 
				}
                
            }
			echo json_encode($output);
            
            break;
			case 'AddDelivery':
            $m_id=$_POST['m_id'];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $password=$_POST['password'];
			$fb_id="ZPSDB";
			$otp="123456";//rand(000000,999999);
			
			if(empty($name) or empty($password)or empty($email)or empty($mobile)){
                $output['res']='error';
				$output['msg']='Field Required';
            }
            else{
				$query="SELECT * FROM `tbl_deliveryboy` WHERE `mobile`='$mobile'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){

							$output['res']='error';
							$output['msg']='Mobile Number is already register';
				}
				else
				{   
			      $query="SELECT * FROM `tbl_manager` WHERE `id`='$m_id'";
				  $result1=mysqli_query($conn,$query);
				  $dat=mysqli_fetch_assoc($result1);
				  
				  $sp_id=$dat['sponsorID'];
			        
					$result=mysqli_query($conn,"insert into tbl_deliveryboy (m_id,name,email,mobile,password,otp,otp_status,wallet,status,delete_status,date,time) values ('$sp_id','$name','$email','$mobile','$password','$otp','true','0','true','false','$date','$time')");
						if($result){
							
							$query12="SELECT * FROM `tbl_deliveryboy` WHERE `mobile`='$mobile'";
							$result12=mysqli_query($conn,$query12);
							if(mysqli_num_rows($result12)>0){
								$row=mysqli_fetch_assoc($result12);
								$fb_id=$fb_id."".$row['id'];
								$query2="update `tbl_deliveryboy` set sponsorID='$fb_id' WHERE `mobile`='$mobile'";
							   $result2=mysqli_query($conn,$query2);
							   // sendsms($mobile,$otp);
								$output['res']='success';
								$output['msg']='Registration Successfully';
							}
						}
						else{
							$output['res']='error';
							$output['msg']='Something went wrong';
						}
				
				}
                
            }
			echo json_encode($output);
            
            break;
			case 'AddVendor':
            $oname=$_POST['oname'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $password=$_POST['password'];
			$user_id=$_POST['id'];
				$image=$_POST['image'];
				$name=$_POST['name'];
			$fb_id="ZPSVENDOR";
			$otp="123456";//rand(000000,999999);
			
			if(empty($name) or empty($password)or empty($email)or empty($mobile)){
                $output['res']='error';
				$output['msg']='Field Required';
            }
            else{
				$query="SELECT * FROM `tbl_vendor` WHERE `mobile`='$mobile'";
				$result=mysqli_query($conn,$query);
				if(mysqli_num_rows($result)>0){

							$output['res']='error';
							$output['msg']='Mobile Number is already register';
				}
				else
				{   
			
			$query="SELECT * FROM `tbl_manager` WHERE `id`='$m_id'";
				  $result1=mysqli_query($conn,$query);
				  $dat=mysqli_fetch_assoc($result1);
				  
				  $sp_id=$dat['sponsorID'];
				  
			      $UserImage = str_replace('data:image/png;base64,', '', $_POST['image']);
					$UserImage = str_replace(' ', '+', $UserImage);
					$data1 = base64_decode($UserImage);
					$UserImage1="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file1 = 'uploads/Vendor/' . $UserImage1;
					file_put_contents($file1, $data1);
					$UserImage1=$UserImage1;
					if(empty($image)){
						$UserImage1=$result['image'];
					}

			        
					$result=mysqli_query($conn,"insert into tbl_vendor (m_id,name,oname,email,mobile,image,password,otp,otp_status,wallet,status,delete_status,date,time) values ('$sp_id','$user_id','$name','$oname','$email','$mobile','$UserImage1','$password','$otp','true','0','true','false','$date','$time')");
						if($result){
							
							$query12="SELECT * FROM `tbl_vendor` WHERE `mobile`='$mobile'";
							$result12=mysqli_query($conn,$query12);
							if(mysqli_num_rows($result12)>0){
								$row=mysqli_fetch_assoc($result12);
								$fb_id=$fb_id."".$row['id'];
								$query2="update `tbl_vendor` set sponsorID='$fb_id' WHERE `mobile`='$mobile'";
							   $result2=mysqli_query($conn,$query2);
							   // sendsms($mobile,$otp);
								$output['res']='success';
								$output['msg']='Registration Successfully';
							}
						}
						else{
							$output['res']='error';
							$output['msg']='Something went wrong';
						}
				
				}
                
            }
			echo json_encode($output);
            
            break;
			default:
			$output['res']='error';
			$output['msg']='Flag Not Match';
			echo json_encode($output);
			break;
			
			}
	
	}
	else{
		$output['res']='error';
		$output['msg']='Flag Required';
		echo json_encode($output);
	}
?>