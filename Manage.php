<?php
	require 'connect.php';
	
	if(isset($_POST['flag'])){
		$flag=$_POST['flag'];
		
		switch($flag){
			case 'Credit_Wallet':
				$user_id=$_POST['user_id'];
				$type=$_POST['type'];
				$amount=$_POST['amount'];
				$txn_id=$_POST['txn_id'];
				
				if(!empty($user_id) and !empty($type) and !empty($amount) and !empty($txn_id)){
					
					$sql=mysqli_query($conn,"SELECT * FROM tbl_user WHERE id='$user_id'");
					$data=mysqli_fetch_array($sql);
					if($data){
						$amount_old=$data['wallet'];
						$new_amount=(int)$amount+(int)$amount_old;
						$msg="Rs".$amount." Credit in your wallet, Transaction ID : ".$txn_id;
						
						$sql1=mysqli_query($conn,"INSERT INTO `txn_tbl` (`id`, `txn_id`, `user_id`, `user_type`, `amount`, `msg`, `txn_type`, `date`, `time`) VALUES (NULL, '$txn_id', '$user_id','$type', '$amount', '$msg',  'Credit', '$date', '$time')");
						
						$sql2=mysqli_query($conn,"UPDATE tbl_user SET wallet='$new_amount' WHERE id='$user_id'");
						if($sql2){
							$output['res']='success';
							$output['msg']='Amount Credit success';
						}else{
							$output['res']='error';
							$output['msg']='Network  Error';
						}
					}else{
						$output['res']='error';
						$output['msg']='Invalid User';
					}
					
				}else{
					$output['res']='error';
					$output['msg']='Data Empty';
				}
				echo json_encode($output);
				
            break;
			
			case'Get_attribute':
				$id=$_POST['id'];
				$result=[]; 
				if(!empty($id)){
					$sql=mysqli_query($conn,"SELECT * FROM `tbl_attribute` WHERE product_id='$id' ");
					 $data=mysqli_num_rows($sql);
					if($data>0){
						while($list=mysqli_fetch_assoc($sql)){
							array_push($result,$list);
						}
						$output['res']='success';
						$output['msg']='Data List';
						$output['data']=$result;
					}else{
						$output['res']='error';
						$output['msg']='Empty Data';
					}
				}else{
					$output['res']='error';
					$output['msg']='Empty Id';
				}
			echo json_encode($output);
			break;
			
			case 'delete_attribute':
				$id=$_POST['id'];
				if(!empty($id)){
					$sql=mysqli_query($conn,"DELETE FROM tbl_attribute WHERE id='$id'");
					if($sql){
						$output['res']='success';
						$output['msg']='Delete Success';
					}else{
						$output['res']='error';
						$output['msg']='Network Error';
					}
				}else{
					$output['res']='error';
					$output['msg']='Empty Id';
				}
				echo json_encode($output);
			break;	
			
			case 'CheckPincode':
				$product_id=$_POST['product_id'];
				$pincode=$_POST['pincode'];
			
				$check=mysqli_query($conn,"select pincode FROM product WHERE id='$product_id'");
				$data=mysqli_fetch_assoc($check);
				$pincodes=$data['pincode'];
				if($pincodes=='All'){
				
						$output['res']='success';
						$output['msg']='Delivery in 3-7 days.';
						
				
				}else{
					$pincodes=explode(',',$pincodes);
					if(in_array($pincode,$pincodes)){
						$output['res']='success';
						$output['msg']='Delivery in 3-7 days.';
						
					}else{
						$output['res']='error';
						$output['msg']='Currently out of stock in this area.';	
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