<?php
    include("../connect.php");

    $sql = "SELECT
    o.depq depq,o.fullname fullname,o.stationno stationno,p.image image
  FROM
    ovst_queue_server_dep o
		left outer JOIN patient_image p on p.hn = o.hn
  WHERE
    o.dep_visit = 'lab' 
    AND CONCAT( SUBSTRING( YEAR ( CURRENT_DATE ( ) ) + 543, 3, 2 ), DATE_FORMAT( CURRENT_DATE, '%m%d' ) ) = SUBSTRING( o.vn, 1, 6 )
    and o.status = 2
  AND o.stationno IS NOT NULL order by o.stationno";

    $query2 = mysqli_query($objCon,$sql);
    $result2=mysqli_fetch_array($query2,MYSQLI_ASSOC);
 ?>
<style>
.profile {
  margin: 20px 0;
}


/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
 
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 100px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {

  color: #5b9bd1;
  font-size: 40px;
  font-weight: 600;
  margin-bottom: 15px;
}

</style>
 <div style="background-color:#0D47A1;color:white;padding-top:1px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <h2 style="text-align: center;font-size: 60px;">กำลังรับบริการ</h2>

        </div>

<div class="profile-sidebar">
     
     <!-- SIDEBAR USERPIC -->
     <div class="profile-userpic">
     <?='<img class="img-responsive"  alt="Responsive image" src="data:image/jpeg;base64,'.base64_encode( $result2['image'] ).'"/>';
         ?>
     </div>
     <!-- END SIDEBAR USERPIC -->
     <!-- SIDEBAR USER TITLE -->
     <div class="profile-usertitle">
       <div class="profile-usertitle-name">
       <?=$result2["depq"];?>
       </div>
       <div class="profile-usertitle-job">
         <?=$result2["fullname"];?>
       </div>
     </div>
     <!-- END SIDEBAR USER TITLE -->
</div>