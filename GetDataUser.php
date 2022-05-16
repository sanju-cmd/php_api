<?php
	require 'connect.php';
	
	if(isset($_POST['flag'])){
		$flag=$_POST['flag'];
		// $flag="GetMyUser";
		switch($flag){
			case 'Slider':
			$result=[];
			$sel="select * from tbl_banner where delete_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Testimonial':
			$result=[];
			$sel="select * from tbl_testimonials ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Brands':
			$result=[];
			$sel="select * from tbl_brands where delete_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Settings':
			$result=[];
			$sel="select * from settings";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'GetMyUser':
			$result=[];
			$id=$_POST['id'];
			$amount=0;
			$c="select * from tbl_user where id='$id'";
			$resc=mysqli_query($conn,$c);
			if(mysqli_num_rows($resc)>0)
			{   $data=mysqli_fetch_assoc($resc);
		        $r_id=$data['sponsorID'];
				$sel="select * from tbl_user where referral_id='$r_id'";
				$res=mysqli_query($conn,$sel);
				if(mysqli_num_rows($res)>0)
				{
					while($row=mysqli_fetch_assoc($res))
					{
						$u_id=$row['id'];
						$check="select * from Orders where user_id='$u_id' and  pay_status='true' order by id desc";
						$checkres=mysqli_query($conn,$check);
						
						$che="select SUM(total_price) as total from Orders where user_id='$u_id' and  pay_status='true' order by id desc";
						$reche=mysqli_query($conn,$che);
						$data=mysqli_fetch_assoc($reche);
						
						$uu="0";
						if(mysqli_num_rows($checkres)>0)
						{
						 $uu="1";
						}else{
							$uu="0";
						}
						$row['isActive']=$uu;
						$am=$data['total'];
						$amount=$amount+(float)$am;
						 array_push($result,$row);
					}
					$output['res']='success';
					$output['msg']='data found';
					$output['data']=$result;
					$output['amount']=$amount."";
				}
				else
				{
					$output['res']='error';
					$output['msg']='data not found';
					$output['data']=[];
				}
			}else
				{
					$output['res']='error';
					$output['msg']='data not found';
					$output['data']=[];
				}
			echo json_encode($output);
			break;
			case 'Coupons':
			$result=[];
			$sel="select * from coupon where del_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'UpgradedProduct':
			$result=[];
			$sel="select * from seller_product where del_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Transaction':
			$result=[];
			$id=$_POST['user_id'];
			$sel="select * from txn_tbl where user_id='$id' and user_type='User' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Category':
			$result=[];
			$sel="select * from tbl_category where delete_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					$id=$row['id'];
					$sel1="select * from product where category='$id' and del_status='false' ORDER BY `id` DESC";
					$res1=mysqli_query($conn,$sel1);
					$row['item_count']=mysqli_num_rows($res1)."";
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'SubCategory':
			$result=[];
			$cat_id=$_POST['cat_id'];
			$sel="select * from tbl_subcategory where delete_status='false' and category_id='$cat_id'";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Vendors':
			$result=[];
			$sel="select * from tbl_vendor where delete_status='false' ORDER BY `id` DESC";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Slider1':
			$result=[];
			$sel="select * from tbl_banner where delete_status='false' ORDER BY rand() limit 1";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Varient':
			$result=[];
			$id=$_POST['id'];
			$sel21="select * from product_images where product_id='$id'";
			$res21=mysqli_query($conn,$sel21);
			$dat=mysqli_fetch_assoc($res21);
			$sel="select * from tbl_product_details where product_id='$id'";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					$row['image']=$dat['image'];
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Products':
			$result=[];
			$cat_id=$_POST['c_id'];
			$sub_id=$_POST['sub_id'];
			$user_id=$_POST['user_id'];
			$count=$_POST['count'];
			$page=$_POST['page'];
			$limit=(int)$count;
			$page=(int)$page;
					$main="";
					if($cat_id=='All'){
						$main="select * from product  where   del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					}else{
						$main="select * from product  where  category = '$cat_id' and sub_category = '$sub_id' and del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					}
					$res1=mysqli_query($conn,$main);
					if(mysqli_num_rows($res1)>0)
					{
						// var_dump($res1);
						while($row=mysqli_fetch_assoc($res1))
						{
							// var_dump($row);
							$c_id=$row['category'];
							$brand_id=$row['brand'];
							$sel21="select * from tbl_category where id='$c_id' and delete_status='false'";
							$res21=mysqli_query($conn,$sel21);
							
							 // var_dump($c_id);
							if(mysqli_num_rows($res21)>0){
							
								$subCat_id=$row['sub_category'];
								$sel211="select * from tbl_subcategory where id='$subCat_id' and delete_status='false'";
								$res211=mysqli_query($conn,$sel211);
							if(mysqli_num_rows($res211)>0){
							
								$p_id=$row['id'];
								
								 $dat=mysqli_fetch_assoc($res21);
								 $dat1=mysqli_fetch_assoc($res211);
								$sel2="select * from wishlist where user_id='$user_id' and product_id='$p_id'";
								$res2=mysqli_query($conn,$sel2);
								$state='false';
								if(mysqli_num_rows($res2)>0){
									$state='true';
								}
								
								$p_id=$row['id'];
								$sel23="select * from tbl_cart where product_id='$p_id' and user_id='$user_id'";
								$res23=mysqli_query($conn,$sel23);
								
								
								$row['cart_item']=mysqli_num_rows($res23);
								$row['category']=$dat['name'];
								$row['sub_category']=$dat1['name'];
								$row['cv']=$dat1['user_commission'];
								$row['brand']=$row['brand'];
								$row['faverate']=$state;
								
								$c_id=$row['category'];
					
						
								$sel000="select * from tbl_brands where id='$brand_id'";
								$res000=mysqli_query($conn,$sel000);
								$dat000=mysqli_fetch_assoc($res000);
								$row['brand']=$dat000['name'];
								
								$sel0000="select * from tbl_product_details where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								if(mysqli_num_rows($res0000)>0){
									$dat0000=mysqli_fetch_assoc($res0000);
									
										$unit_id=$dat0000['unit'];
                    					$sel22="select * from tbl_unit where id='$unit_id'";
                    			        $res22=mysqli_query($conn,$sel22);
                    					$dat22=mysqli_fetch_assoc($res22);
					
					
									$row['model']=$dat0000['model'];
									$row['quantity']=$dat0000['quantity'];
									$row['unit']=$dat22['name'];
									$row['stock']=$dat0000['stock'];
									$row['mrp']=$dat0000['mrp'];
									$row['price']=$dat0000['price'];
									$row['discount']=$dat0000['discount'];
									$row['tax']=$dat0000['tax'];
									$row['varient_id']=$dat0000['id'];
									
									$sel0000="select * from product_images where product_id='$p_id'";
									$res0000=mysqli_query($conn,$sel0000);
									$resul=[];
									// var_dump($res0000);
									if(mysqli_num_rows($res0000)>0){
										while($rows=mysqli_fetch_assoc($res0000)){
										array_push($resul,$rows);
									   }
									   
									   $row['images']=$resul;
									
									$sel00000="select * from tbl_attribute where product_id='$p_id'";
									$res00000=mysqli_query($conn,$sel00000);
									$resultt=[];
									if(mysqli_num_rows($res00000)>0){
										while($rows=mysqli_fetch_assoc($res00000)){
										array_push($resultt,$rows);
									   }
									}
									$row['attribute']=$resultt;
							
									array_push($result,$row);
									}
									
								}
								
							}
							}
						}
						
						$output['res']='success';
						$output['msg']='data found';
						$output['data']=$result;
					}else{
						$output['res']='error';
						$output['msg']='data found';
						$output['data']=$result;
					}
				
			echo json_encode($output);
			break;
			case 'ProductsByVendor':
			$result=[];
			$cat_id=$_POST['c_id'];
			$vendor_id=$_POST['vendor_id'];
			$sub_id=$_POST['sub_id'];
			$user_id=$_POST['user_id'];
			$count=$_POST['count'];
			$page=$_POST['page'];
			$limit=(int)$count;
			$page=(int)$page;
					$main="";
					// if($cat_id=='All'){
						$main="select * from product  where  vendor_id='$vendor_id' and  del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					// }else{
						// $main="select * from product  where  category = '$cat_id' and sub_category = '$sub_id' and del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					// }
					$res1=mysqli_query($conn,$main);
					if(mysqli_num_rows($res1)>0)
					{
						// var_dump($res1);
						while($row=mysqli_fetch_assoc($res1))
						{
							// var_dump($row);
							$c_id=$row['category'];
							$brand_id=$row['brand'];
							$sel21="select * from tbl_category where id='$c_id' and delete_status='false'";
							$res21=mysqli_query($conn,$sel21);
							
							 // var_dump($c_id);
							if(mysqli_num_rows($res21)>0){
							
								$subCat_id=$row['sub_category'];
								$sel211="select * from tbl_subcategory where id='$subCat_id' and delete_status='false'";
								$res211=mysqli_query($conn,$sel211);
							if(mysqli_num_rows($res211)>0){
							
								$p_id=$row['id'];
								
								 $dat=mysqli_fetch_assoc($res21);
								 $dat1=mysqli_fetch_assoc($res211);
								$sel2="select * from wishlist where user_id='$user_id' and product_id='$p_id'";
								$res2=mysqli_query($conn,$sel2);
								$state='false';
								if(mysqli_num_rows($res2)>0){
									$state='true';
								}
								
								$p_id=$row['id'];
								$sel23="select * from tbl_cart where product_id='$p_id' and user_id='$user_id'";
								$res23=mysqli_query($conn,$sel23);
								
								
								$row['cart_item']=mysqli_num_rows($res23);
								$row['category']=$dat['name'];
								$row['sub_category']=$dat1['name'];
								$row['cv']=$dat1['user_commission'];
								$row['brand']=$row['brand'];
								$row['faverate']=$state;
								
								$c_id=$row['category'];
					
						
								$sel000="select * from tbl_brands where id='$brand_id'";
								$res000=mysqli_query($conn,$sel000);
								$dat000=mysqli_fetch_assoc($res000);
								$row['brand']=$dat000['name'];
								
								$sel0000="select * from tbl_product_details where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								if(mysqli_num_rows($res0000)>0){
								
								$dat0000=mysqli_fetch_assoc($res0000);
								
									$unit_id=$dat0000['unit'];
                    					$sel22="select * from tbl_unit where id='$unit_id'";
                    			        $res22=mysqli_query($conn,$sel22);
                    					$dat22=mysqli_fetch_assoc($res22);
					
					
								$row['model']=$dat0000['model'];
								$row['quantity']=$dat0000['quantity'];
								$row['unit']=$dat22['name'];
								$row['stock']=$dat0000['stock'];
								$row['mrp']=$dat0000['mrp'];
								$row['price']=$dat0000['price'];
								$row['discount']=$dat0000['discount'];
								$row['tax']=$dat0000['tax'];
									$row['varient_id']=$dat0000['id'];
								
								$sel0000="select * from product_images where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								$resul=[];
								// var_dump($res0000);
								if(mysqli_num_rows($res0000)>0){
									while($rows=mysqli_fetch_assoc($res0000)){
									array_push($resul,$rows);
								   }
								}
								$row['images']=$resul;
								
								$sel00000="select * from tbl_attribute where product_id='$p_id'";
								$res00000=mysqli_query($conn,$sel00000);
								$resultt=[];
								if(mysqli_num_rows($res00000)>0){
									while($rows=mysqli_fetch_assoc($res00000)){
									array_push($resultt,$rows);
								   }
								}
								$row['attribute']=$resultt;
						
								array_push($result,$row);
								}
							}
							}
						}
						
						$output['res']='success';
						$output['msg']='data found';
						$output['data']=$result;
					}else{
						$output['res']='error';
						$output['msg']='data found';
						$output['data']=$result;
					}
				
			echo json_encode($output);
			break;
			
			case 'ProductsByVendor':
			$result=[];
			$cat_id=$_POST['c_id'];
			$vendor_id=$_POST['brand_id'];
			$sub_id=$_POST['sub_id'];
			$user_id=$_POST['user_id'];
			$count=$_POST['count'];
			$page=$_POST['page'];
			$limit=(int)$count;
			$page=(int)$page;
					$main="";
					// if($cat_id=='All'){
						$main="select * from product  where  brand='$vendor_id' and  del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					// }else{
						// $main="select * from product  where  category = '$cat_id' and sub_category = '$sub_id' and del_status='false' and status='approved' ORDER BY `id` limit $page,$limit";
					// }
					$res1=mysqli_query($conn,$main);
					if(mysqli_num_rows($res1)>0)
					{
						// var_dump($res1);
						while($row=mysqli_fetch_assoc($res1))
						{
							// var_dump($row);
							$c_id=$row['category'];
							$brand_id=$row['brand'];
							$sel21="select * from tbl_category where id='$c_id' and delete_status='false'";
							$res21=mysqli_query($conn,$sel21);
							
							 // var_dump($c_id);
							if(mysqli_num_rows($res21)>0){
							
								$subCat_id=$row['sub_category'];
								$sel211="select * from tbl_subcategory where id='$subCat_id' and delete_status='false'";
								$res211=mysqli_query($conn,$sel211);
							if(mysqli_num_rows($res211)>0){
							
								$p_id=$row['id'];
								
								 $dat=mysqli_fetch_assoc($res21);
								 $dat1=mysqli_fetch_assoc($res211);
								$sel2="select * from wishlist where user_id='$user_id' and product_id='$p_id'";
								$res2=mysqli_query($conn,$sel2);
								$state='false';
								if(mysqli_num_rows($res2)>0){
									$state='true';
								}
								
								$p_id=$row['id'];
								$sel23="select * from tbl_cart where product_id='$p_id' and user_id='$user_id'";
								$res23=mysqli_query($conn,$sel23);
								
								
								$row['cart_item']=mysqli_num_rows($res23);
								$row['category']=$dat['name'];
								$row['sub_category']=$dat1['name'];
								$row['cv']=$dat1['user_commission'];
								$row['brand']=$row['brand'];
								$row['faverate']=$state;
								
								$c_id=$row['category'];
					
						
								$sel000="select * from tbl_brands where id='$brand_id'";
								$res000=mysqli_query($conn,$sel000);
								$dat000=mysqli_fetch_assoc($res000);
								$row['brand']=$dat000['name'];
								
								$sel0000="select * from tbl_product_details where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								if(mysqli_num_rows($res0000)>0){
								
								$dat0000=mysqli_fetch_assoc($res0000);
								
									$unit_id=$dat0000['unit'];
                    					$sel22="select * from tbl_unit where id='$unit_id'";
                    			        $res22=mysqli_query($conn,$sel22);
                    					$dat22=mysqli_fetch_assoc($res22);
                    					
								$row['model']=$dat0000['model'];
								$row['quantity']=$dat0000['quantity'];
								$row['unit']=$dat22['name'];
								$row['stock']=$dat0000['stock'];
								$row['mrp']=$dat0000['mrp'];
								$row['price']=$dat0000['price'];
								$row['discount']=$dat0000['discount'];
								$row['tax']=$dat0000['tax'];
									$row['varient_id']=$dat0000['id'];
								
								$sel0000="select * from product_images where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								$resul=[];
								// var_dump($res0000);
								if(mysqli_num_rows($res0000)>0){
									while($rows=mysqli_fetch_assoc($res0000)){
									array_push($resul,$rows);
								   }
								}
								$row['images']=$resul;
								
								$sel00000="select * from tbl_attribute where product_id='$p_id'";
								$res00000=mysqli_query($conn,$sel00000);
								$resultt=[];
								if(mysqli_num_rows($res00000)>0){
									while($rows=mysqli_fetch_assoc($res00000)){
									array_push($resultt,$rows);
								   }
								}
								$row['attribute']=$resultt;
						
								array_push($result,$row);
								}
							}
							}
						}
						
						$output['res']='success';
						$output['msg']='data found';
						$output['data']=$result;
					}else{
						$output['res']='error';
						$output['msg']='data found';
						$output['data']=$result;
					}
				
			echo json_encode($output);
			break;
			case 'Search':
			$result=[];
			$cat_id=$_POST['c_id'];
			$search=$_POST['txt'];
			$user_id=$_POST['user_id'];
			
					$main="";
					if($cat_id=='All'){
						$main="select * from product  where  (name like '%".$search."%' or brand like '%".$search."%' or category like '%".$search."%') and  del_status='false' and status='approved' ORDER BY `id` DESC";
					}else{
						$main="select * from product  where  (name like '%".$search."%' or brand like '%".$search."%' or category like '%".$search."%') and  category = '$cat_id' and del_status='false' and status='true' ORDER BY `id` DESC";
					}
					
					$res1=mysqli_query($conn,$main);
					
					if(mysqli_num_rows($res1)>0)
					{
						// var_dump($res1);
						while($row=mysqli_fetch_assoc($res1))
						{
							// var_dump($row);
							$c_id=$row['category'];
							$brand_id=$row['brand'];
							$sel21="select * from tbl_category where id='$c_id' and delete_status='false'";
							$res21=mysqli_query($conn,$sel21);
							
							 // var_dump($c_id);
							if(mysqli_num_rows($res21)>0){
							
								$subCat_id=$row['sub_category'];
								$sel211="select * from tbl_subcategory where id='$subCat_id' and delete_status='false'";
								$res211=mysqli_query($conn,$sel211);
							if(mysqli_num_rows($res211)>0){
							
								$p_id=$row['id'];
								
								 $dat=mysqli_fetch_assoc($res21);
								 $dat1=mysqli_fetch_assoc($res211);
								$sel2="select * from wishlist where user_id='$user_id' and product_id='$p_id'";
								$res2=mysqli_query($conn,$sel2);
								$state='false';
								if(mysqli_num_rows($res2)>0){
									$state='true';
								}
								
								$p_id=$row['id'];
								$sel23="select * from tbl_cart where product_id='$p_id' and user_id='$user_id'";
								$res23=mysqli_query($conn,$sel23);
								
								
								$row['cart_item']=mysqli_num_rows($res23);
								$row['category']=$dat['name'];
								$row['sub_category']=$dat1['name'];
								$row['cv']=$dat1['user_commission'];
								$row['brand']=$row['brand'];
								$row['faverate']=$state;
								
								$c_id=$row['category'];
					
						
								$sel000="select * from tbl_brands where id='$brand_id'";
								$res000=mysqli_query($conn,$sel000);
								$dat000=mysqli_fetch_assoc($res000);
								$row['brand']=$dat000['name'];
								
								$sel0000="select * from tbl_product_details where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								if(mysqli_num_rows($res0000)>0){
								
								$dat0000=mysqli_fetch_assoc($res0000);
								
									$unit_id=$dat0000['unit'];
                    					$sel22="select * from tbl_unit where id='$unit_id'";
                    			        $res22=mysqli_query($conn,$sel22);
                    					$dat22=mysqli_fetch_assoc($res22);
                    					
                    					
								$row['model']=$dat0000['model'];
								$row['quantity']=$dat0000['quantity'];
								$row['unit']=$dat22['name'];
								$row['stock']=$dat0000['stock'];
								$row['mrp']=$dat0000['mrp'];
								$row['price']=$dat0000['price'];
								$row['discount']=$dat0000['discount'];
								$row['tax']=$dat0000['tax'];
									$row['varient_id']=$dat0000['id'];
								
								$sel0000="select * from product_images where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								$resul=[];
								// var_dump($res0000);
								if(mysqli_num_rows($res0000)>0){
									while($rows=mysqli_fetch_assoc($res0000)){
									array_push($resul,$rows);
								   }
								}
								$row['images']=$resul;
								
								$sel00000="select * from tbl_attribute where product_id='$p_id'";
								$res00000=mysqli_query($conn,$sel00000);
								$resultt=[];
								if(mysqli_num_rows($res00000)>0){
									while($rows=mysqli_fetch_assoc($res00000)){
									array_push($resultt,$rows);
								   }
								}
								$row['attribute']=$resultt;
						
								array_push($result,$row);
								}
							}
							}
						}
						
						$output['res']='success';
						$output['msg']='data found';
						$output['data']=$result;
					}else{
						$output['res']='error';
						$output['msg']='data found';
						$output['data']=$result;
					}
				
			echo json_encode($output);
			break;
			case 'Delivery_Charge':
			$result=[];
			$sel="select * from delivery_charge";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					
					array_push($result,$row);
				}
				$output['res']='success';
				$output['msg']='data found';
				$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
			}
			echo json_encode($output);
			break;
			case 'Wishlist':
			$result=[];
			$id=$_POST['id'];
			$sel="select * from wishlist where user_id='$id'";
			$res=mysqli_query($conn,$sel);
			if(mysqli_num_rows($res)>0)
			{
				while($row=mysqli_fetch_assoc($res))
				{
					$c_id=$row['category'];
							$brand_id=$row['brand'];
							$sel21="select * from tbl_category where id='$c_id' and delete_status='false'";
							$res21=mysqli_query($conn,$sel21);
							
							 // var_dump($c_id);
							if(mysqli_num_rows($res21)>0){
							
								$subCat_id=$row['sub_category'];
								$sel211="select * from tbl_subcategory where id='$subCat_id' and delete_status='false'";
								$res211=mysqli_query($conn,$sel211);
							if(mysqli_num_rows($res211)>0){
							
								$p_id=$row['id'];
								
								 $dat=mysqli_fetch_assoc($res21);
								 $dat1=mysqli_fetch_assoc($res211);
								$sel2="select * from wishlist where user_id='$user_id' and product_id='$p_id'";
								$res2=mysqli_query($conn,$sel2);
								$state='false';
								if(mysqli_num_rows($res2)>0){
									$state='true';
								}
								
								$p_id=$row['id'];
								$sel23="select * from tbl_cart where product_id='$p_id' and user_id='$user_id'";
								$res23=mysqli_query($conn,$sel23);
								
								
								$row['cart_item']=mysqli_num_rows($res23);
								$row['category']=$dat['name'];
								$row['sub_category']=$dat1['name'];
								$row['cv']=$dat1['user_commission'];
								$row['brand']=$row['brand'];
								$row['faverate']=$state;
								
								$c_id=$row['category'];
					
						
								$sel000="select * from tbl_brands where id='$brand_id'";
								$res000=mysqli_query($conn,$sel000);
								$dat000=mysqli_fetch_assoc($res000);
								$row['brand']=$dat000['name'];
								
								$sel0000="select * from tbl_product_details where product_id='$p_id'";
								$res0000=mysqli_query($conn,$sel0000);
								if(mysqli_num_rows($res0000)>0){
									$dat0000=mysqli_fetch_assoc($res0000);
									
										$unit_id=$dat0000['unit'];
                    					$sel22="select * from tbl_unit where id='$unit_id'";
                    			        $res22=mysqli_query($conn,$sel22);
                    					$dat22=mysqli_fetch_assoc($res22);
					
					
									$row['model']=$dat0000['model'];
									$row['quantity']=$dat0000['quantity'];
									$row['unit']=$dat22['name'];
									$row['stock']=$dat0000['stock'];
									$row['mrp']=$dat0000['mrp'];
									$row['price']=$dat0000['price'];
									$row['discount']=$dat0000['discount'];
									$row['tax']=$dat0000['tax'];
									$row['varient_id']=$dat0000['id'];
									
									$sel0000="select * from product_images where product_id='$p_id'";
									$res0000=mysqli_query($conn,$sel0000);
									$resul=[];
									// var_dump($res0000);
									if(mysqli_num_rows($res0000)>0){
										while($rows=mysqli_fetch_assoc($res0000)){
										array_push($resul,$rows);
									   }
									   
									   $row['images']=$resul;
									
									$sel00000="select * from tbl_attribute where product_id='$p_id'";
									$res00000=mysqli_query($conn,$sel00000);
									$resultt=[];
									if(mysqli_num_rows($res00000)>0){
										while($rows=mysqli_fetch_assoc($res00000)){
										array_push($resultt,$rows);
									   }
									}
									$row['attribute']=$resultt;
							
									array_push($result,$row);
									}
									
								}
								
							}
							}
						}
						
						$output['res']='success';
						$output['msg']='data found';
						$output['data']=$result;
			}
			else
			{
				$output['res']='error';
				$output['msg']='data not found';
				$output['data']=[];
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