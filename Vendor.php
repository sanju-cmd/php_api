<?php
	require 'connect.php';
	
	if(isset($_POST['flag'])){
		$flag=$_POST['flag'];
		// $flag="AddVendor";
		switch($flag){
			case 'Register':
            $name=$_POST['name'];
            $email=$_POST['email'];
            $mobile=$_POST['mobile'];
            $password=$_POST['password'];
            $shop_name=$_POST['shop_name'];
            $token=$_POST['token'];
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
			        
					$result=mysqli_query($conn,"insert into tbl_vendor (oname,email,mobile,password,name,otp,otp_status,wallet,status,delete_status,date,time,token) values ('$name','$email','$mobile','$password','$shop_name','$otp','false','0','false','false','$date','$time','$token')");
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
			case 'VerifyOTP':
			$mobile=$_POST['mobile'];
			$otp=$_POST['otp'];
			if(empty($mobile)||empty($otp)){
				$output['res']='error';
				$output['msg']='Field Required';
			
			}else{
				$check=mysqli_query($conn,"select * from tbl_vendor where mobile='$mobile'");
				if(mysqli_num_rows($check)>0){
					$values=mysqli_fetch_assoc($check);
					if($otp==$values['otp']){
						$update=mysqli_query($conn,"update tbl_vendor set  otp_status='true', status='true', date='$date', time='$time' where mobile='$mobile'");
						// var_dump($conn);
						if($update){
							$check=mysqli_query($conn,"select * from tbl_vendor where mobile='$mobile'");
							$values=mysqli_fetch_assoc($check);
							$output['res']='success';
							$output['msg']='Otp Verified';
							$output['data']=$values;
						}else{
							$output['res']='error';
							$output['msg']='Something went wrong';
						}
					}else{
						    $output['res']='error';
							$output['msg']='Invalid OTP';
					}
				}else{
					
						$output['res']='error';
						$output['msg']='Invalid User';
					
				}
			}
			
			echo json_encode($output);
			break;
			case 'updateProfile':
				$user_id=$_POST['id'];
				$image=$_POST['image'];
				$name=$_POST['shop_name'];
				$gst=$_POST['gst'];
				$pan=$_POST['pan'];
				$gst_img=$_POST['gst_img'];
				$pan_img=$_POST['pan_img'];
				$address=$_POST['address'];
				$lattitude=$_POST['lattitude'];
				$longitude=$_POST['longitude'];
				
				$result=[];
				$sel="select * from tbl_vendor where id='$user_id'";
				$res=mysqli_query($conn,$sel);
				$data_vendor=mysqli_fetch_array($res);
				$data21=array();
				if(mysqli_num_rows($res)>0)
				{
					$UserImage = str_replace('data:image/png;base64,', '', $_POST['image']);
					$UserImage = str_replace(' ', '+', $UserImage);
					$data1 = base64_decode($UserImage);
					$user_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file1 = 'uploads/Vendor/' . $user_image;
					file_put_contents($file1, $data1);
					// $UserImage1=$UserImage1;
					if(empty($image)){
						$user_image=$data_vendor['image'];
					}
					
					$UserImage1 = str_replace('data:image/png;base64,', '', $_POST['pan_img']);
					$UserImage1 = str_replace(' ', '+', $UserImage1);
					$data2 = base64_decode($UserImage1);
					$pan_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file2 = 'uploads/Vendor/' . $pan_image;
					file_put_contents($file2, $data2);
					
					if(empty($pan_img)){
						$pan_image=$data_vendor['pan_img'];
					}
					$UserImage2 = str_replace('data:image/png;base64,', '', $_POST['gst_img']);
					$UserImage2 = str_replace(' ', '+', $UserImage2);
					$data3 = base64_decode($UserImage2);
					$gst_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file3 = 'uploads/Vendor/' . $gst_image;
					file_put_contents($file3, $data3);
					
					if(empty($pan_img)){
						$gst_image=$data_vendor['gst_img'];
					}

					$check=mysqli_query($conn,"update tbl_vendor set image='$user_image',gst_img='$gst_image',pan_img='$pan_image',pan='$pan',gst='$gst', name='$name', address='$address', lat='$lattitude', longi='$longitude' where id='$user_id'");
					if($check){
					$output['res']='success';
					$output['msg']='Profile Updated';
					}else{
						$output['res']='error';
					$output['msg']='Profile Not Updated';
					}
				}
				else
				{
					$output['res']='error';
					$output['msg']='User not Exits';
					$output['data']=[];
				}
				echo json_encode($output);
				break;
				case 'updatePersonalProfile':
				$user_id=$_POST['id'];
				$image=$_POST['image'];
				$name=$_POST['shop_name'];
				$oname=$_POST['name'];
				$email=$_POST['email'];
				$gst=$_POST['gst'];
				$pan=$_POST['pan'];
				$gst_img=$_POST['gst_img'];
				$pan_img=$_POST['pan_img'];
				$address=$_POST['address'];
				$lattitude=$_POST['lattitude'];
				$longitude=$_POST['longitude'];
				
				$result=[];
				$sel="select * from tbl_vendor where id='$user_id'";
				$res=mysqli_query($conn,$sel);
				$data_vendor=mysqli_fetch_array($res);
				$data21=array();
				if(mysqli_num_rows($res)>0)
				{
					$UserImage = str_replace('data:image/png;base64,', '', $_POST['image']);
					$UserImage = str_replace(' ', '+', $UserImage);
					$data1 = base64_decode($UserImage);
					$user_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file1 = 'uploads/Vendor/' . $user_image;
					file_put_contents($file1, $data1);
					// $UserImage1=$UserImage1;
					if(empty($image)){
						$user_image=$data_vendor['image'];
					}
					
					$UserImage1 = str_replace('data:image/png;base64,', '', $_POST['pan_img']);
					$UserImage1 = str_replace(' ', '+', $UserImage1);
					$data2 = base64_decode($UserImage1);
					$pan_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file2 = 'uploads/Vendor/' . $pan_image;
					file_put_contents($file2, $data2);
					
					if(empty($pan_img)){
						$pan_image=$data_vendor['pan_img'];
					}
					$UserImage2 = str_replace('data:image/png;base64,', '', $_POST['gst_img']);
					$UserImage2 = str_replace(' ', '+', $UserImage2);
					$data3 = base64_decode($UserImage2);
					$gst_image="Vendor_".date('YHis').rand(1000,9999). '.jpg';
					$file3 = 'uploads/Vendor/' . $gst_image;
					file_put_contents($file3, $data3);
					
					if(empty($pan_img)){
						$gst_image=$data_vendor['gst_img'];
					}

					$check=mysqli_query($conn,"update tbl_vendor set image='$user_image',gst_img='$gst_image',pan_img='$pan_image',pan='$pan',gst='$gst', name='$name', oname='$oname',email='$email', address='$address', lat='$lattitude', longi='$longitude' where id='$user_id'");
					if($check){
					$output['res']='success';
					$output['msg']='Profile Updated';
					}else{
						$output['res']='error';
					$output['msg']='Profile Not Updated';
					}
				}
				else
				{
					$output['res']='error';
					$output['msg']='User not Exits';
					$output['data']=[];
				}
				echo json_encode($output);
				break;
			case 'Login':
			$mobile=$_POST['mobile'];
			$password=$_POST['password'];
			if(empty($mobile)||empty($password)){
				$output['res']='error';
				$output['msg']='Field Required';
			
			}else{
				
				$check=mysqli_query($conn,"select * from tbl_vendor where mobile='$mobile' and password='$password' and delete_status='false'");
				if(mysqli_num_rows($check)>0){
					$values=mysqli_fetch_assoc($check);
					if($values['otp_status']=='true'){
					
							
								$output['res']='success';
								$output['msg']='Login Successfull !';
								$output['data']=$values;
					
					}else{
						    $output['res']='error';
							$output['msg']='OTP not verified';
					}
					
				}else{
					        $output['res']='error';
							$output['msg']='Invalid sername or password';
				}
			}
			
			echo json_encode($output);
			break;
			
			case 'getUser':
				$user_id=$_POST['user_id'];
				$result=[];
				$sel="select * from tbl_vendor where id='$user_id'";
				$res=mysqli_query($conn,$sel);
				$data21=array();
				if(mysqli_num_rows($res)>0)
				{
					$row=mysqli_fetch_assoc($res);

					$output['res']='success';
					$output['msg']='data found';
					$output['data']=$row;
				}
				else
				{
					$output['res']='error';
					$output['msg']='data not found';
					$output['data']=[];
				}
				echo json_encode($output);
				break;
				
				case 'UpdateLocation':
				$lat=$_POST['lat'];
				$long=$_POST['long'];
				$id=$_POST['id'];
			
				$check=mysqli_query($conn,"update tbl_vendor set lat='$lat' , longi='$long' where id='$id'");
				// var_dump($conn);
				if($check){
					$output['res']='success';
		            $output['msg']='Location Updated !';
					
				}else{
				$output['res']='error';
		        $output['msg']='Not Updated';	
				}
	
			echo json_encode($output);
			break;
		
				case 'updateDetails':
				$user_id=$_POST['id'];
				$name=$_POST['name'];
				$email=$_POST['email'];
				$image=$_POST['image'];
				$shop_name=$_POST['shop_name'];
				$commision=$_POST['commision'];
				$gst=$_POST['gst'];
				$pan=$_POST['pan'];
				$address=$_POST['address'];
				$lattitude=$_POST['lattitude'];
				$longitude=$_POST['longitude'];
				$result=[];
				$sel="select * from tbl_vendor where id='$user_id'";
				$res=mysqli_query($conn,$sel);
				$data21=array();
				if(mysqli_num_rows($res)>0)
				{
					$check="";
					if($image!=""){
						$UserImage = str_replace('data:image/png;base64,', '', $_POST['image']);
						$UserImage = str_replace(' ', '+', $UserImage);
						$data1 = base64_decode($UserImage);
						$UserImage1="Vendor_".date('YHis').rand(1000,9999). '.jpg';
						$file1 = 'uploads/Vendor/' . $UserImage1;
						file_put_contents($file1, $data1);
						$UserImage1=$UserImage1;
						
						$check=mysqli_query($conn,"update tbl_vendor set oname='$name', email='$email', image='$UserImage1', zone='$zone', name='$shop_name', income_commission='$commision', lat='$lattitude' , longi='$longitude',  gst='$gst', pan='$pan', address='$address' where id='$user_id'");
					}else{
						
						$check=mysqli_query($conn,"update tbl_vendor set oname='$name', email='$email', zone='$zone', name='$shop_name', income_commission='$commision', lat='$lattitude' , longi='$longitude',  gst='$gst', pan='$pan', address='$address' where id='$user_id'");
					}
					
					if($check){
					$output['res']='success';
					$output['msg']='Profile Updated';
					}else{
						$output['res']='error';
					$output['msg']='Prifile Not Updated';
					}
				}
				else
				{
					$output['res']='error';
					$output['msg']='User not Exits';
					$output['data']=[];
				}
				echo json_encode($output);
				break;
				case 'ResetPassword':
				$user_id=$_POST['id'];
				$oldPass=$_POST['password'];
				$newPass=$_POST['npassword'];
				if(empty($user_id) or empty($oldPass) or empty($newPass)){
					$output['res']='error';
					$output['msg']='Fill Required';
					echo json_encode([$output]);
				}
				else{
						$check=mysqli_query($conn,"select * from tbl_vendor where id='$user_id'");
						if(mysqli_num_rows($check)>0){
							$values=mysqli_fetch_assoc($check);
							if($oldPass==$values['password']){
								if($newPass!=$values['password']){
									$query="UPDATE tbl_vendor SET password='$newPass' where id='$user_id'";
					
										if(mysqli_query($conn,$query)){
											$output['res']='success';
											$output['msg']='Password Change';
											echo json_encode($output);
										}
										else{
											$output['res']='error';
											$output['msg']='Password not Change';
											echo json_encode($output);
										}
								}else{
											$output['res']='error';
											$output['msg']='New Password can not be same as current';
											echo json_encode($output);
										}
							}else{
											$output['res']='error';
											$output['msg']='Old Password Not Match';
											echo json_encode($output);
										}
						}else{
											$output['res']='error';
											$output['msg']='User not exist';
											echo json_encode($output);
										}
				}
				break;
				case 'ReferralCode':
				$user_id=$_POST['user_id'];
				$code=$_POST['code'];
				$result=[];
				     $sel21="select * from tbl_referral";
				     $res21=mysqli_query($conn,$sel21);
					 $data0=mysqli_fetch_assoc($res21);
					 $amount=$data0['amount'];
				$sel="select * from tbl_vendor where sponsorID='$code'";
				$res=mysqli_query($conn,$sel);
				$data21=array();
				if(mysqli_num_rows($res)>0)
				{
					/*
					function referral($friend_code)
					{
						global $conn;
						$sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE referral_id='$friend_code' order by id desc");
						$data =mysqli_fetch_assoc($sql);
						if($data==false)
						{
							return $friend_code;
						}
						$sql = mysqli_query($conn,"SELECT * FROM tbl_user WHERE referral_id='$friend_code' order by id desc");
						$referral_1 = array();
						$i=0;
						while($row=mysqli_fetch_assoc($sql)) {
							$ref=$row['sponsorID'];
							$sql1 = mysqli_query($conn,"SELECT * FROM tbl_user WHERE referral_id='$ref'");
							$data1 = mysqli_fetch_assoc($sql1);
							$total_ref_1=mysqli_num_rows($sql1);
							$total_ref=array('count'=>$total_ref_1,'user_id'=>$row['id']);
							array_push($referral_1, $total_ref);
						}
						
						$ist=$referral_1[0]['count'];
						$id=$referral_1[0]['user_id'];
						
						for($j=0;$j<count($referral_1);$j++)
						{
							if($ist<$referral_1[$j]['count'])
							{
								$ist=$ist;
								$id=$id;
							}
							else
							{
								$ist=$referral_1[$j]['count'];
								$id=$referral_1[$j]['user_id'];
							}
						}
						
						
						$sql2 = mysqli_query($conn,"SELECT * FROM tbl_user WHERE id='$id'");
						$data2 = mysqli_fetch_assoc($sql2);
						
						$sql9 = mysqli_query($conn,"SELECT * FROM tbl_user WHERE referral_id='".$data2['sponsorID']."'");
						$data9 = mysqli_num_rows($sql9);
						
						if($data9<10) 
						{
							return $data2['sponsorID'];
						}
						else
						{
							return referral($data2['sponsorID']);
						}
					}
					$sql = mysqli_query($conn,"SELECT id FROM tbl_user WHERE referral_id='$code'");
					$total_ref=mysqli_num_rows($sql);	
					if($total_ref<10)
					{
						$code = $_POST['code'];
					}
					else
					{
						$code = referral($code);
					}
					*/
					$code = $_POST['code'];
					$sel66="select * from tbl_vendor where referral_id='$code'";
				    $res66=mysqli_query($conn,$sel66);
					$num=mysqli_num_rows($res66);
					
					 $data=mysqli_fetch_assoc($res);
					 $id=$data['id'];
					 
					 $sel22="select * from tbl_vendor where id='$id'";
				     $res22=mysqli_query($conn,$sel22);
					 $data1=mysqli_fetch_assoc($res22);
					 $amount1=$data1['wallet'];
					 
					 $sel23="select * from tbl_vendor where id='$user_id'";
				     $res23=mysqli_query($conn,$sel23);
					 $data2=mysqli_fetch_assoc($res23);
					 $amount2=$data2['wallet'];
					 
					 if($num<2){
					 $amount1=(int)$amount+(int)$amount1;
					 }
					 $amount2=(int)$amount+(int)$amount2;
					 
						$check=mysqli_query($conn,"update tbl_vendor set  wallet='$amount2', referral_id='$code' where id='$user_id'");
						
						$check=mysqli_query($conn,"update tbl_vendor set  wallet='$amount1' where id='$id'");
						
						$msg="Your wallet is credited of ₹".$amount." For Reffer & Earn!";
						if($num<2){
						$check=mysqli_query($conn,"insert into txn_tbl (txn_id,user_id,amount,msg,txn_type,user_type,date,time) values ('1234567890','$id','$amount','$msg','Credit','Vendor','$date','$time')");
						}
						
						$check=mysqli_query($conn,"insert into txn_tbl (txn_id,user_id,amount,msg,txn_type,user_type,date,time) values ('1234567890','$user_id','$amount','$msg','Credit','Vendor','$date','$time')");
					
					$output['res']='success';
					$output['msg']='Profile Updated';
					$output['amount']="0";
					
				}
				else
				{
					// $check="select * from referal where code='$code'";
					// $rescheck=mysqli_query($conn,$check);
					
					// if(mysqli_num_rows($rescheck)>0)
					// {
						 // $data=mysqli_fetch_assoc($rescheck);
						 // $price=$data['price'];
						 
						  // $sel23="select * from tbl_vendor where id='$user_id'";
				     // $res23=mysqli_query($conn,$sel23);
					 // $data2=mysqli_fetch_assoc($res23);
					 // $amount2=$data2['wallet'];
					 
					
					 // $amount2=(int)$price+(int)$amount2;
					 
						// $check=mysqli_query($conn,"update tbl_vendor set  wallet='$amount2', referral_id='$code' where id='$user_id'");
						
						// $msg="Your wallet is credited of ₹".$price." For Reffer & Earn!";
						
						// $check=mysqli_query($conn,"insert into txn_tbl (txn_id,user_id,amount,msg,txn_type,user_type,date,time) values ('1234567890','$user_id','$price','$msg','Credit','User','$date','$time')");
						 // $output['res']='success';
					     // $output['msg']='Code Valid';
					     // $output['amount']=$price;
					// }else{
						$output['res']='error';
					    $output['msg']='Code is not Valid';
					// }
				}
				echo json_encode($output);
				break;
				case 'UpdateToken':
				$id=$_POST['id'];
				$token=$_POST['token'];
			
				$check=mysqli_query($conn,"update tbl_vendor set token='$token' where id='$id'");
				// var_dump($conn);
				if($check){
					$output['res']='success';
		            $output['msg']='Location Updated !';
					
				}else{
				$output['res']='error';
		        $output['msg']='Not Updated';	
				}
	
			echo json_encode($output);
			break;
			case'category_update':
				$vendor_id=$_POST['vendor_id'];
				$category=$_POST['category'];
				
				if(!empty($vendor_id) and !empty($category)){
					mysqli_query($conn,"delete  from vendor_cat where vendor_id='$vendor_id'");
					$cat_ids=explode(",",$category);
					for($i=0;$i<count($cat_ids);$i++){
					$sql=mysqli_query($conn,"INSERT INTO `vendor_cat` (`cat_id`, `vendor_id`, `status`) VALUES ('".$cat_ids[$i]."', '".$vendor_id."', '0')");
					}
					if($sql){
						$output['res']='success';
						$output['msg']='Update Successfully';
					}else{
						$output['res']='error';
						$output['msg']='Network Problem';
					}
				}else{
					$output['res']='error';
					$output['msg']='Data are require';
				}
				echo json_encode($output);
			break;	
			
			case'get_Mycategory':
			
				$vendor_id=$_POST['vendor_id'];
				$result=[];
				if(!empty($vendor_id)){
					$sql=mysqli_query($conn,"SELECT GROUP_CONCAT(cat_id SEPARATOR ',') as cat_ids FROM  vendor_cat  WHERE vendor_id='$vendor_id'");
					if($sql){
						$data=mysqli_fetch_assoc($sql);
						$category=explode(",",$data['cat_ids']);
						// var_dump($category);
						$sql1=mysqli_query($conn,"SELECT * FROM  tbl_category");
						while($data1=mysqli_fetch_assoc($sql1)){
							
							if(in_array($data1['id'],$category)){
								$data1['select_status']='true';
							}else{
								$data1['select_status']='false'; 
							}
							array_push($result,$data1);
						}
						
					
						$output['res']='success';
						$output['msg']='Data List';
						$output['data']=$result;
						
					}else{
						$output['res']='error';
						$output['msg']='Network Problem';
					}
				}else{
					$output['res']='error';
					$output['msg']='Data are require';
				}
				echo json_encode($output);
			break;	
			
			case 'get_refferal_list':
				
				$user_id=$_POST['user_id'];
				if(!empty($user_id)){
					$sel=mysqli_query($conn,"SELECT sponsorID FROM tbl_vendor where id='$user_id' ");
					$data=mysqli_fetch_assoc($sel);
					if($data){
						$sponsorID=$data['sponsorID'];
						$result=[];
						$sel=mysqli_query($conn,"SELECT * FROM tbl_vendor where referral_id='$sponsorID' ");
						$count=mysqli_num_rows($sel);
						if($count>0){
							while($data=mysqli_fetch_assoc($sel)){
								array_push($result,$data);
							}
							$output['res']='success';
							$output['msg']='Data found';	
							$output['data']=$result;
						}else{
							$output['res']='error';
							$output['msg']='Data not found';		
						}
					}else{
						$output['res']='error';
						$output['msg']='Data not found';	
					}
					
				}else{
					$output['res']='error';
					$output['msg']='Data are require';
				}
				echo json_encode($output);
				
				
			break;
			
			case 'extra_commission':
			
				$vendor_id=$_POST['vendor_id'];
				$commission=$_POST['commission'];
				
				if(!empty($vendor_id) and !empty($commission)){
					$sql=mysqli_query($conn,"UPDATE  tbl_vendor SET extra_commission='$commission' WHERE id='$vendor_id' ");
					if($sql){
						$output['res']='success';
						$output['msg']='Update Successfully';
					}else{
						$output['res']='error';
						$output['msg']='Network error';
					}
				}else{
					$output['res']='error';
					$output['msg']='Data are require';
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
			
				 
			
			      $query="SELECT * FROM `tbl_vendor` WHERE `id`='$user_id'";
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
					// if(empty($image)){
						// $UserImage1=$result['image'];
					// }

			        
					$result=mysqli_query($conn,"insert into tbl_vendor (name,oname,email,mobile,referral_id,image,password,otp,otp_status,wallet,status,delete_status,date,time) values ('$name','$oname','$email','$mobile','$sp_id','$UserImage1','$password','$otp','true','0','true','false','$date','$time')");
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