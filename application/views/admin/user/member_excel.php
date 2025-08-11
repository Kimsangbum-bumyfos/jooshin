<table border="1" cellpadding="0" cellspacing="0">
<tr bgcolor=#DDDDDD align="center">
    <td>이름</td>
    <td>이메일</td>
    <td>휴대폰</td>
    <td>가입일</td>
    <td>이메일 수신동의</td>
    <td>이메일 수신동의</td>
</tr>
<?php
    $total_row;
    foreach($list as $lt){
?>
<tr>
    <td><?php echo $lt -> user_name; ?></td>
    <td><?php echo $lt -> user_email; ?></td>
    <td><?php echo $lt -> user_phone; ?></td>
    <td><?php echo $lt -> user_reg_date; ?></td>
    <td><?php if($lt -> receive_mail_yn =='Y') echo "동의"; ?></td>
    <td><?php if($lt -> receive_sms_yn =='Y') echo "동의"; ?></td>
</tr>
<?php
}

?>
</table>