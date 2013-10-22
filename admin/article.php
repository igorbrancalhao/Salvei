<?php
/* * *************************************************************************
 * File Name				:article.php
 * File Created				:Wednesday, June 21, 2006
 * File Last Modified			:Wednesday, June 21, 2006
 * Copyright				:(C) 2001 AJ Square Inc
 * Email				:licence@ajsquare.net
 * Software Language			:PHP
 * Version Created			:V 4.3.2
 * Programmers worked	        	:S.Priya, B.ReenaKumari, K.Shanmuga priya
 * $Id                                  : memberlist.php,v 1.36.2.12 2006/02/07 20:42:51 grahamje Exp $
 *
 * ************************************************************************* */


/* * **************************************************************************

 *      Licence Agreement: 

 *     This program is a Commercial licensed software; 
 *     you are not authorized to redistribute it and/or modify/and or sell it under any publication 
 *     or license /or term it under the GNU General Public License as published by the Free Software Foundation;
 *     either user and developer versions of the License, or (at your option) 
 *     any later version is applicable for the same.

 * *************************************************************************** */
?>
<?php
session_start();
require 'include/connect.php';
require 'include/top.php';
?>
<link rel=stylesheet type=text/css href=include/style.css>
<style type="text/css">
    <!--
    .style1 {
        color: #666666;
        font-weight: bold;
    }
    -->
</style>
<html>
    <head>
        <title>AJ HYIP::: Admin Area</title>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    </head>

    <body>
        <table align="center" width="100%" height="35" bgcolor="#FFCF00">
            <tr>
                <td width="12%" align="center"><a href="article.php?type=art" id="link3">View Article</a></td>
                <td width="16%" align="center"><a href="article.php?type=sub" id="link3">Submit Article</a></td>
                <td width="16%" align="center"><a href="article.php?type=fea" id="link3">Featured Articles</a></td>
            </tr>
        </table><br>
        <?php
        $type = $_GET['type'];
        $mode = $_GET['mode'];
        $artid = $_GET['artid'];

//---------------------Suspending or Activating an Article------------------------------

        if ($mode == 'act')
            $sus_query = "update article_post set approved=0 where article_id=$artid";
        else if ($mode == 'in')
            $sus_query = "update article_post set approved=1 where article_id=$artid";
        $sus_result = mysql_query($sus_query);

//----------------------Suspend or Activating Ends Here----------------------------------
//--------------------- Deleting the Selected Articles------------------------------------

        if (isset($_POST['btn_Delete'])) {
            $artid = $_POST['chkSub'];
            if (strlen($artid) != 0) {
                foreach ($artid as $id) {
                    $del_query = "delete from article_post where article_id=$id";
                    $del_res = mysql_query($del_query);
                }
            }
        }
//----------------------Deleting Ends Here------------------------------------------------



        if (!$type)
            $type = 'art';
        if (!$mode)
            $mode = 'act';
        if ($type == 'art') {
            if ($mode == 'act')
                echo $art_query = "select * from article_post where approved=1";
            else if ($mode == 'in')
                echo $art_query = "select * from article_post where approved=0";
            $art_result = mysql_query($art_query);
            ?>
            <table border="0" align="center" width="80%" cellpadding="5" cellspacing="2">
                <tr>
                    <td><a href="article.php?type=art&mode=act" id="tablink">Currently Showing</a></td>
                    <td><a href="article.php?type=art&mode=in" id="tablink">In-Active</a></td>
                </tr>
            </table>
            <br>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="80%" class="tablebox">
                <form name="frmArticle" method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
                    <tr bgcolor="#CCCCCC" class="style1">
                        <td><input type="checkbox" name="chkMain" onClick="chkall();" class="check" value=1></td>
                        <td><b>Article Title</b></td><td><b>Posted Date</b></td><td>&nbsp;</td></tr>
                    <?php
                    if (mysql_num_rows($art_result) > 0) {
                        while ($art_row = mysql_fetch_array($art_result)) {
                            $artid = $art_row['article_id'];
                            ?>
                            <tr bgcolor="#EFEFE7">
                                <td><input name="chkSub[]" id="chkSub" type="checkbox" class="check" value="<?php echo $artid; ?>"></td>
                                <td><a href=article.php?type=dis&artid=<?php = $artid ?> id=link1><?php = $art_row['article_title'] ?></a></td><td><?php = $art_row['posted_date'] ?></td>
                                <td><?php if ($mode == 'act') echo "<a href=article.php?type=art&mode=act&artid=$artid id=link1>Suspend</a>";else if ($mode == 'in') echo "<a href=article.php?type=art&mode=in&artid=$artid id=link1>Activate</a>"; ?>
                            </tr>
                            <?php
                        }
                    }
                    else {
                        ?>
                        <tr bgcolor="#EFEFE7"><td colspan="4" align="center">No Article Found</td></tr>
                        <?php
                    }
                    ?>
                    <tr bgcolor="#F7F7F7"><td colspan="10" align="left"><input type="submit" value="Delete" name="btn_Delete" class="button" onClick="return condelete();"></td></tr>
                </form>
            </table>
            <?php
        } else if ($type == 'sub') {
            
        } else if ($type == 'fea') {
            
        } else if ($type == 'com') {
            ?>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" class="tablebox">
                <tr bgcolor="#CCCCCC" class="style1"><td>View Comments</td></tr>
                <?php
                $view_comment_query = "select * from article_comments where article_id=$artid";
                $view_comment_result = mysql_query($view_comment_query);
                if (mysql_num_rows($view_comment_result) > 0) {
                    while ($view_comment_row = mysql_fetch_array($view_comment_result)) {
                        ?>
                        <tr bgcolor="#EFEFE7"><td><?php = $view_comment_row['subject'] ?></td></tr>
                        <tr bgcolor="#EFEFE7"><td><?php = $view_comment_row['comments'] ?></td></tr>
                        <?php
                    }
                } else {
                    ?>
                    <tr bgcolor="#EFEFE7"><td>No Comments Found for the Article</td></tr>
                    <?php
                }
                ?>
            </table>
            <?php
        } else if ($type == 'vcom') {
            ?><table border="0" align="center" cellpadding="5" cellspacing="2" width="100%" class="tablebox">
                <form name="form1" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onSubmit="this.canAdd.value = 1;">
                    <tr bgcolor="#EFEFE7" class="style1"><td colspan="2">Add Comment</td></tr>
                    <tr bgcolor="#EFEFE7"><td>Your Name</td><td><input type="text" name="txtName" class="text"></td></tr>
                    <tr bgcolor="#EFEFE7"><td>Subject </td><td><textarea name=""></textarea></td></tr>
                </form>
            </table>
            <?php
        } else if ($type == 'dis') {
            $artid = $_GET['artid'];
            $art_query = "select * from article_post where article_id=$artid";
            $art_result = mysql_query($art_query);
            $art_row = mysql_fetch_array($art_result);
            $articlename = $art_row['article_title'];
            $articledes = $art_row['article_description'];
            $postedby = $art_row['posted_by'];
            $posteddate = $art_row['posted_date'];
            $postedby = $art_row['posted_by'];
            $approved = $art_row['approved'];
            if ($approved == 0)
                $status = 'In Active';
            else if ($approved == 1)
                $status = 'Active';
            ?>
            <table border="0" align="center" cellpadding="5" cellspacing="2" width="80%" class="tablebox">
                <tr><td width="76%" bgcolor="#cccccc" class="style1">Viewing Details of <?php = $articlename ?></td>
                    <td width="24%" bgcolor="#cccccc" class="style1"> <b>Rating:</b> 
                        <?php for ($i = 1; $i <= $star; $i++) { ?>
                            <img src="../images/fullstar.gif"> 
                            <?php
                        }
                        $star2 = substr($star, 2, 1);
                        if ($star2 >= 5) {
                            ?>
                            <img src="../images/halfstar.gif"> 
                            <?php
                        }
                        $star1 = round($star);
                        ?>
                        <?php for ($j = 1; $j <= (5 - $star1); $j++) { ?>
                            <img src="../images/emptystar.gif"> 
                        <?php } ?>
                    </td>
                </tr>
                <tr><td colspan="2" bgcolor="EFEFE7">Article Name : <?php = $articlename ?></td>
                </tr>
                <tr><td colspan="2" bgcolor="EFEFE7">Article Description : <?php = $articledes ?></td>
                </tr>
                <tr><td colspan="2" bgcolor="EFEFE7">Posted By : <?php = $postedby ?></td>
                </tr>
                <tr><td colspan="2" bgcolor="EFEFE7">Posted Date : <?php = $posteddate ?></td>
                </tr>
                <tr><td colspan="2" bgcolor="EFEFE7">Status : <?php = $status ?></td>
                </tr>
                <tr>
                    <td bgcolor="EFEFE7" colspan="2" align="center"><a href="article.php?type=com&artid=<?php = $artid ?>" id="link">View Comments</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="article.php?type=vcom&artid=<?php = $artid ?>" id="link">Add a New Comment</a></td>
                </tr>
            </table>
            <?php
        }
        require 'include/footer.php';
        ?>
    </body>
</html>
<script language="javascript">
    function chkall() {
        len = document.frmArticle.chkSub.length;
        if (len > 1) {
            for (i = 0; i < len; i++) {
                if (document.frmArticle.chkMain.checked == true) {
                    document.frmArticle.chkSub[i].checked = true;
                }
                else {
                    document.frmArticle.chkSub[i].checked = false;
                }
            }
        }
        else {
            if (document.frmArticle.chkMain.checked == true) {
                document.frmArticle.chkSub.checked = true;
            }
            else {
                document.frmArticle.chkSub.checked = false;
            }

        }
    }

    function condelete()
    {
        var confrm;
        confrm = window.confirm("Are You sure you want to delete this User");
        return confrm;
    }
</script>
