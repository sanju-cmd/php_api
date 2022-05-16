<?php
	require 'connect.php';
	
	if(isset($_POST['flag'])){
		$flag=$_POST['flag'];
		//$flag="ResendOTP";
		switch($flag){
			case 'ResendOTP':
			$mobile=$_POST['mobile'];
			$otp="123456";////rand(100000,999900);
			$res=mysqli_query($conn,"SELECT * FROM `tbl_vendor` WHERE `mobile`='$mobile'");
						if(mysqli_num_rows($res)>0){
						
						   // sendsms($mobile,$otp);
						   $check=mysqli_query($conn,"update `tbl_vendor` set otp='$otp' WHERE `mobile`='$mobile'");
							if($check){
							   $output['res']='otp_send';
							   $output['msg']='Otp sent to your Mobile Number';
							   echo json_encode($output);
							}else{
							   $output['res']='error';
							   $output['msg']='OTP not sent';
							   echo json_encode($output);
							   }
						}else{
						   $output['res']='error';
						   $output['msg']='Number not Registered';
						   echo json_encode($output);
						}
			break;
			case 'VerifyOTP':
			$tbl_vendorname=$_POST['mobile'];	
				$otp=$_POST['otp'];
				if(empty($tbl_vendorname)){
					$output['res']='error';
					$output['msg']='Mobile number is required';
					echo json_encode($output);
				}
				else if(empty($otp)){
					$output['res']='error';
					$output['msg']='Enter OTP';
					echo json_encode($output);
				}
				else{
					$res=mysqli_query($conn,"SELECT * FROM tbl_vendor WHERE mobile='$tbl_vendorname'");
					if(mysqli_num_rows($res)>0){
							$values=mysqli_fetch_assoc($res);
						    $tbl_vendor_id=$values['deliveryboy_id'];
							if($values['otp']==$otp){
								
								$output['res']='success';
								$output['msg']='OTP Verified';
								echo json_encode($output);
							}
							else{
								$output['res']='error';
								$output['msg']='Invalid OTP';
								echo json_encode($output);
							}
						
					}else{
							$output['res']='error';
							$output['msg']='Inactive Account';
							echo json_encode($output);
						}
					}
					
			break;
			case 'ResetPassword':
			$mobile=$_POST['username'];
			$newPass=$_POST['password'];
			$res=mysqli_query($conn,"SELECT * FROM `tbl_vendor` WHERE `mobile`='$mobile'");
						if(mysqli_num_rows($res)>0){
						  $values=mysqli_fetch_assoc($res);
						 if($newPass!=$values['password']){
								  $check=mysqli_query($conn,"update `tbl_vendor` set password='$newPass' WHERE `mobile`='$mobile'");
								if($check){
								   $output['res']='success';
								   $output['msg']='Password Reset Successfully';
								   echo json_encode($output);
								}else{
								   $output['res']='error';
								   $output['msg']='Password not Updated';
								   echo json_encode($output);
								   }
							 
						 }else{
							   $output['res']='error';
							   $output['msg']='New Password can not be same as old password';
							   echo json_encode($output);
							   }
						}else{
						   $output['res']='error';
						   $output['msg']='Number not Registered';
						   echo json_encode($output);
						}
			break;
		}
	
	}
	else{
		$output['res']='error';
		$output['msg']='Flag Required';
		echo json_encode($output);
	}
?>