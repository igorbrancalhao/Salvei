<?php
/***************************************************************************
*File Name				:promotelistings.tpl
*File Created			:Wednesday, June 21, 2006
* File Last Modified	:Wednesday, June 21, 2006
* Copyright			:(C) 2001 AJ Square Inc
* Email				:licence@ajsquare.net
* Software Language	:PHP
* Version Created		:V 4.3.2
* Programmers worked	:S.Priya, B.ReenaKumari, K.Shanmuga priya
* Modified By			:B.Reena
* $Id                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
***************************************************************************/


/****************************************************************************

*      Licence Agreement: 

*     This program is a Commercial licensed software; 
*     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
*     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
*     either user and developer versions of the License, or (at your option) 
*     any later version is applicable for the same.

*****************************************************************************/
?>
<script language="javascript" type="text/javascript">
    function pay_refresh()
    {
        payment = document.RTEDemo.payment.value;
        if (payment == "") {
            pay.innerHTML = "";
        }
        else if (payment == 1) {
            txt = "<input type=text name=payid value=<?php echo $payment_id;?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>Paypal Id</b></font>" + txt;
        }
        else if (payment == 2) {
            txt = "<input type=text name=payid value=<?php echo $payid;?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>INT-Gold Id</b></font> " + txt;
        }
        else if (payment == 3) {
            txt = "<input type=text name=payid value=<?php echo $payid;?>>";
            txtname = "<input type=text name=payname value=<?php echo  $payname; ?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>E-Gold Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Gold name</b></font>" + txtname;
        }
        else if (payment == 4) {
            txt = "<input type=text name=payid value=<?php echo $payid;?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>Money Bookers Id</b></font>" + txt;
        }
        else if (payment == 5) {
            txt = "<input type=text name=payid value=<?php echo $payid;?>>";
            txtname = "<input type=text name=payname value=<?php echo  $payname; ?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>E-Bullion Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; " + txt + "<br><b>E-Bullion name</b></font>  " + txtname;
        }
        else if (payment == 6) {
            txt = "<input type=text name=payid value=<?php echo $payid;?>>";
            document.getElementById("pay").innerHTML = "<font class=banner1 size=2><b>Stormpay Id</b></font>" + txt;
        }
    }
    function validate()
    {
        if (document.RTEDemo.txttitle.value == '')
        {
            alert("Please enter the title");
            return false;
        }

        if (document.RTEDemo.payment.value == 0)
        {
            alert("Please Select the Payment");
            document.RTEDemo.payment.focus();
            return false;
        }
        var payment_name = document.RTEDemo.payment.value;
        if (payment_name == 1 || payment_name == 2 || payment_name == 4 || payment_name == 6)
        {
            if (document.RTEDemo.payid.value == "")
            {
                alert("Please Enter the Payment ID");
                document.RTEDemo.payid.focus();
                return false;
            }
        }
        else {
            if (document.RTEDemo.payid.value == "")
            {
                alert("Please Enter the Payment ID");
                document.RTEDemo.payid.focus();
                return false;
            }
            else if (document.RTEDemo.payname.value == "")
            {
                alert("Please Enter the Payment ID");
                document.RTEDemo.payname.focus();
                return false;
            }
        }
        if (document.RTEDemo.chkreturns.checked == true)
        {
            if (document.RTEDemo.cboreturndays.value == 0)
            {
                alert("Please Select the Return Days");
                document.RTEDemo.cboreturndays.focus();
                return false;
            }
            if (document.RTEDemo.cborefund.value == 0)
            {
                alert("Please Select the Refund Type");
                document.RTEDemo.cborefund.focus();
                return false;
            }
        }

    }
    function val()
    {
        if (document.RTEDemo.chkreturns.checked == true)
        {
            document.RTEDemo.cboreturndays.disabled = false;
            document.RTEDemo.cborefund.disabled = false;
            document.RTEDemo.txtploicy.disabled = false;
        }
        else
        {
            document.RTEDemo.cboreturndays.disabled = true;
            document.RTEDemo.cborefund.disabled = true;
            document.RTEDemo.txtploicy.disabled = true;
        }
        return true;
    }
</script>
<style type="text/css">
    <!--
    .style1 {
        color: #669933;
        font-weight: bold;
    }
    .rteImage {
        background: #D3D3D3;
        border: 1px solid #D3D3D3;
        cursor: pointer;
        cursor: hand;
    }

    .rteImageRaised, .rteImage:hover {
        background: #D3D3D3;
        border: 1px outset;
        cursor: pointer;
        cursor: hand;
    }

    .rteImageLowered, .rteImage:active {
        background: #D3D3D3;
        border: 1px inset;
        cursor: pointer;
        cursor: hand;
    }

    .rteVertSep {
        margin: 0 4px 0 4px;
    }

    .rteBack {
        background: #D3D3D3;
        border: 1px outset;
        letter-spacing: 0;
        padding: 2px;
    }

    .rteBack tbody tr td, .rteBack tr td {
        background: #D3D3D3;
        padding: 0;
    }

    -->
</style>
<table width="958" cellpadding="0" cellspacing="5" border=0 align="center">
    <tr><td background="images/abtusbg.jpg" height="32"><font class="categories_fonttype">&nbsp;&nbsp;Edit Item Details</font></td></tr>
    <?php if($err_flag==1)
    { 
    ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
                <tr><td>
                        <table width="100%" align="center"><tr><td>
                                    <img src="images/warning_39x35.gif"></td>
                                <td><font class="banner1" color="red">The following must be corrected before continuing:</font></td></tr>


                            <?php if(!empty($err_title))
                            {
                            ?>
                            <tr><td>&nbsp;</td>
                                <td class="banner1"><a href="edit_auction.php#txttitle" class="header_text2">Item Title</a> - <?php echo  $err_title; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_des))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#areades" class="header_text2">Item Description</a> - <?php echo  $err_des; ?></td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img1))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image1" class="header_text2">Image1</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img2))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image2" class="header_text2">Image2</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img3))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image3" class="header_text2">Image3</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img4))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image4" class="header_text2">Image4</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img5))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image5" class="header_text2">Image5</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img6))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image6" class="header_text2">Image6</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                            <?php
                            if(!empty($err_img7))
                            {
                            ?>
                            <tr><td>&nbsp;</td><td class="banner1"><a href="edit_auction.php#image7" class="header_text2">Image7</a> - Please enter valid Fileformat</td></tr>
                            <?php 
                            }
                            ?>
                        </table></td></tr>
            </table></td></tr>
    <?php
    }
    ?>
    <tr><td><table width="948" background="images/contentgrad.jpg" style="border:1px solid #c4dbe7; background-repeat:repeat-x; background-position:bottom; padding-left:20px">
                <tr>
                    <td> 
                        <form name="RTEDemo" action="edit_auction.php" method=post enctype="multipart/form-data" onSubmit="return submitForm();">
                            <table width="100%" cellpadding="5" cellspacing="2" >
                                <tr><td>
                                        <?php if(!empty($err_title))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_title ?></font>
 <br>
 <b><font class="moretxt">Item title</font></b>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="banner1" >Item title</font></b>
                                        <?php 
                                        }
                                        ?>
                                    </td></tr>
                                <tr>
                                    <td width=270><input type="text" name="txttitle" class="txtbig" value="<?php echo  $item_title; ?>">
                                        <font color="#666666">Ensure your title has specific details about your item. </font></td>
                                </tr>
                                <tr><td>
                                        <?php if(!empty($err_des))
                                        {
                                        ?>
                                        <img src="images/warning_9x10.gif">&nbsp;
                                        <font class="moretxt"><?php echo  $err_des; ?></font>
                                        <br>
                                        <b><font class="moretxt">Item Description</font></b>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="banner1" >Item Description</font></b>
                                        <?php
                                        }
                                        ?>
                                    </td></tr>
                                <script language="JavaScript" type="text/javascript" src="html2xhtml.js"></script>
                                <script language="JavaScript" type="text/javascript" src="richtext_compressed.js"></script>
                                <tr><td>
                                        <script language="JavaScript" type="text/javascript">
                                            <!--
                                function submitForm() {
                                                //make sure hidden and iframe values are in sync for all rtes before submitting form
                                                updateRTEs();
                                                //alert(document.RTEDemo.rte1.value);	
                                                document.RTEDemo.content.value = document.RTEDemo.rte1.value;
                                                if (document.RTEDemo.content.value == '')
                                                {
                                                    alert("Please enter the item description");
                                                    return false;
                                                }

                                                return true;
                                            }

                                            //Usage: initRTE(imagesPath, includesPath, cssFile, genXHTML, encHTML)
                                            initRTE("./images/", "./", "", true);
                                            //-->
                                        </script>
                                        <noscript><p><b>Javascript must be enabled to use this form.</b></p></noscript>

                                        <script language="JavaScript" type="text/javascript">
                                            <!--
                                        //build new richTextEditor
                                            var rte1 = new richTextEditor('rte1');
                                                    < ?php
                                                    //format content for preloading
                                                    if (!(isset($_POST["rte1"]))) {
                                            $content = chr(13);
                                                    $content = $_SESSION[des];
                                                    $content = rteSafe($content);
                                            } else {
                                            //retrieve posted value
                                            $content = $_POST["rte1"];
                                                    $content = rteSafe($_POST["rte1"]);
                                            }
                                            ? >
                                                    rte1.html = '<?php echo $content;?>';
                                            //rte1.toggleSrc = false;
                                            rte1.build();
                                            //-->
                                        </script>
                                    </td></tr>

                                <?php
                                if($edit_row['picture1'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img1))
                                        {
                                        ?>
                                        <b><font class="banner1">Image1 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image1 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image1"><img src="thumbnail/<?php echo  $image1 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture2'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img2))
                                        {
                                        ?>
                                        <b><font class="banner1">Image2 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image2 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image2"><img src="thumbnail/<?php echo  $image2 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture3'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img3))
                                        {
                                        ?>
                                        <b><font class="banner1">Image3 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image3 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image3"><img src="thumbnail/<?php echo  $image3 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture4'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img4))
                                        {
                                        ?>
                                        <b><font class="banner1">Image4 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image4 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image4"><img src="thumbnail/<?php echo  $image4 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture5'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img5))
                                        {
                                        ?>
                                        <b><font class="banner1">Image5 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image5 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image5"><img src="thumbnail/<?php echo  $image5 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture6'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img6))
                                        {
                                        ?>
                                        <b><font class="banner1">Image6 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image6 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image6"><img src="thumbnail/<?php echo  $image6 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                if($edit_row['picture7'])
                                {
                                ?>
                                <tr><td>
                                        <?php
                                        if(empty($err_img7))
                                        {
                                        ?>
                                        <b><font class="banner1">Image7 </font></b><br />
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font class="moretxt">Image7 </font></b><br />
                                        <?php
                                        }
                                        ?>
                                        <input type="file" name="image7"><img src="thumbnail/<?php echo  $image7 ?>" width=30 height=30>
                                    </td></tr>
                                <?php
                                }
                                ?>	

                                <tr>
                                    <td class="banner1">
                                        <?php if(!empty($err_pay))

                                        echo '<img src="images/warning_9x10.gif">&nbsp;
                                        <font class="moretxt">'.$err_pay.'</font>
                                        <br>
                                        <b><font class="moretxt">Payment Method</font></b>';
                                        echo '<b><font class="banner1" >Payment Method</font></b>';
                                        ?>
                                    </td>
                                </tr>



                                <tr>
                                    <td>
                                        <?php

                                        $pay_sql="select * from payment_gateway where status='Yes'";
                                        $pay_res=mysql_query($pay_sql);
                                        ?><select name="payment" onChange="pay_refresh()">
                                            <option value="0">Select</option>
                                            <?php
                                            while($pay_row=mysql_fetch_array($pay_res))
                                            {
                                            if($pay_row[gateway_id]==$payment)
                                            {
                                            ?>
                                            <option value="<?php echo $pay_row['gateway_id'];?>" selected><?php echo $pay_row[payment_gateway];?></option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo $pay_row['gateway_id'];?>"><?php echo $pay_row[payment_gateway];?></option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="banner1">
                                        <div id="pay">
                                            <?php
                                            if($payment==1)
                                            {
                                            echo 'Paypal&nbsp;&nbsp;&nbsp;<input type=text name=payid value='.$payment_id.'>';
                                            }
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                                <tr><td class="banner1"><noscript>Javascript must be enabled to enter the payment id.</noscript></td></tr>
                                <tr><td>&nbsp;</td></tr>
                                <tr><td align="left"><div id="pay"></div></td></tr> 
                                <tr><td align="left" class="banner1">
                                        <?php if((!empty($err_amt))||(!empty($err_ship)))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_ship ?></font>
 <br>
 <b><font class="moretxt">Shipping Amount</font></b>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Shipping Amount</font></b>
                                        <?php
                                        }
                                        ?>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name=txtship_amt class="txtsmall" value="<?php echo $shipping_amt;?>"></td></tr>
                                <tr><td align="left" class="banner1"> 
                                        <?php if(!empty($err_tax))
                                        {?>
 <img src="images/warning_9x10.gif">&nbsp;<font class="moretxt"><?php echo  $err_tax ?></font>
 <br>
 <b><font class="moretxt">Tax Amount</font></b>
 <?php
                                        }
                                        else
                                        {
                                        ?>
                                        <b><font size=2>Tax Amount</font></b>
                                        <?php
                                        }
                                        ?>

                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	
                                        <input type="text" name=tax class="txtsmall" value="<?php echo $tax;?>"> <b> % </b> 
                                    </td>
                                </tr>
                                <tr><td class="banner1">
                                        <input type="checkbox" name="chkreturns"  onclick="return val();" <?php if($returns_accepted) { echo "checked"; }?>>
                                               Returns Accepted - Specify a return policy.
                                               <a onClick="window.open('returnpolicy.php', 'My_Popup', 'width=700,height=700');" href="#" class="header_text">Learn More.</a> 
                                    </td></tr>
                                <tr><td class="banner1">
                                        <?php
                                        if(!empty($err_ref))
                                        echo '<img src="images/warning_9x10.gif">&nbsp;&nbsp;<font color=red>'.$err_ref.'</font><br><font color=red>Item must be returned within</font>';
                                        else
                                        echo 'Item must be returned within &nbsp;&nbsp;&nbsp;&nbsp;';   
                                        ?>

                                        <?php  
                                        //modified query to display the duration in order
                                        $auction_query="select * from auction_duration order by duration";
                                        $table=mysql_query($auction_query);
                                        ?>
                                        <select name="cboreturndays">
                                            <option value="0">Select</option>
                                            <?php
                                            while($row=mysql_fetch_array($table))
                                            {
                                            ?>
                                            <?php if($refund_days==$row['duration'])
                                            {
                                            ?>
                                            <option value="<?php echo  $row['duration'] ?>" selected> <?php echo  $row['duration'] ?> Days</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="<?php echo  $row['duration'] ?>" > <?php echo  $row['duration'] ?> Days</option>
                                            <?php
                                            }
                                            } // while($row=mysql_fetch_array($table))
                                            ?>
                                        </select>
                                    </td></tr>
                                <tr><td class="banner1">
                                        <?php
                                        if(!empty($err_method))
                                        {
                                        echo '<img src="images/warning_9x10.gif">&nbsp;<font color=red>'.$err_method.'</font><br><font color=red>Refund will be  as &nbsp;&nbsp;</font>';

                                        }
                                        else
                                        echo "Refund will be given as &nbsp;&nbsp;";
                                        ?>
                                        <select name="cborefund">
                                            <option value="0">Select</option>
                                            <?php 
                                            if($refund_method=="Exchange")
                                            {
                                            ?>
                                            <option value="Exchange" selected="selected">Exchange</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="Exchange">Exchange</option>
                                            <?php
                                            }
                                            ?>
                                            <?php 
                                            if($refund_method=="Money Back")
                                            {
                                            ?>
                                            <option value="Money Back" selected="selected">Money Back</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="Money Back">Money Back</option>
                                            <?php
                                            }
                                            ?>
                                            <?php 
                                            if($refund_method=="Merchandise Credit")
                                            {
                                            ?>
                                            <option value="Merchandise Credit" selected="selected">Merchandise Credit</option>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                            <option value="Merchandise Credit">Merchandise Credit</option>
                                            <?php
                                            }
                                            ?>
                                        </select></td></tr>
                                <tr><td class="banner1"><b>Return Policy Details</b></td></tr>
                                <tr><td>
                                        <textarea name="txtploicy" cols="60" rows="6"><?php echo  $returnpolicy_instructions ?></textarea></td></tr>
                                <tr><td class="banner1"><font class="categories_fonttype"><b>&nbsp;&nbsp;Payment Instructions</b></font></td></tr>
                                <tr><td><font color="#999999">Give clear instructions to assist your buyer with payment and shipping.</font></td></tr>
                                <tr><td>
                                        <textarea name="txtpaymentins" cols="60" rows="6" ><?php echo  $payment_instructions ?> </textarea>
                                    </td></tr>
                                <input type="hidden" name=flag value="1">
                                <input type="hidden" name="cat_id" value=<?php echo  $cat_id; ?>>
                                       <input type="hidden" name=mode value="<?php echo  $mode; ?>">
                                <input type="hidden" name=sell_format value="<?php echo  $sell_format; ?>">
                                <input type="hidden" name=item_id value=<?php echo  $item_id; ?>>
                                       <input type="hidden" name=own_html_flag value=<?php echo  $ownhtml; ?>>
                                       <input type="hidden" name=sellitemid value=<?php echo $sellitemid?>>
                                       <input type="hidden" name="content" value="">
                                <tr><td colspan="2" align="center">

                                        <?php if($mode=="" or $mode=="relist" or $mode=="repost" or $mode=="sellsimilar")
                                        {
                                        ?>
                                        <input type="image" src="images/save.gif" name="Image71" width="62" height="22" border="0" id="Image71" onmouseout="MM_swapImgRestore()" onmouseover="MM_swapImage('Image71', '', 'images/saveo.gif', 1)" onClick="return validate();"/>
                                        <?php
                                        }
                                        else if($mode=="change")
                                        { 
                                        ?>
                                        <input type="submit" name=submit value="Save" class="buttonbig">
                                        <?php
                                        }

                                        ?></td></tr>
                            </table>
                        </form>
                        <?php
                        function rteSafe($strText) {
                        //returns safe code for preloading in the RTE
                        $tmpString = $strText;

                        //convert all types of single quotes
                        $tmpString = str_replace(chr(145), chr(39), $tmpString);
                        $tmpString = str_replace(chr(146), chr(39), $tmpString);
                        $tmpString = str_replace("'", "&#39;", $tmpString);

                        //convert all types of double quotes
                        $tmpString = str_replace(chr(147), chr(34), $tmpString);
                        $tmpString = str_replace(chr(148), chr(34), $tmpString);
                        //	$tmpString = str_replace("\"", "\"", $tmpString);

                        //replace carriage returns & line feeds
                        $tmpString = str_replace(chr(10), " ", $tmpString);
                        $tmpString = str_replace(chr(13), " ", $tmpString);

                        return $tmpString;
                        }
                        ?>
                        <?php //echo $content; ?>
                    </td>
                </tr>
            </table>
        </td></tr>

</table>